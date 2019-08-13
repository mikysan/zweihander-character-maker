<?php

namespace App\Command;

use App\Entity\AgeGroup;
use App\Entity\AncestralTrait;
use App\Entity\Ancestry;
use App\Entity\AncestryModifier;
use App\Entity\Archetype;
use App\Entity\BuildType;
use App\Entity\ChaosAlignment;
use App\Entity\Complexion;
use App\Entity\DistinguishingMark;
use App\Entity\Dooming;
use App\Entity\Drawback;
use App\Entity\EyeColor;
use App\Entity\HairColor;
use App\Entity\Height;
use App\Entity\OrderAlignment;
use App\Entity\PrimaryAttribute;
use App\Entity\Profession;
use App\Entity\Season;
use App\Entity\SocialClass;
use App\Entity\Upbringing;
use App\Entity\Weight;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RollCharacterCommand extends Command
{
    const ANCESTRY_TYPES = ['Human', 'Demi-human'];

    protected static $defaultName = 'app:roll:character';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em, string $name = NULL)
    {
        $this->em = $em;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Auto roll a character!')
            ->addOption('unlink-alignment', 'l', InputOption::VALUE_NONE, ' If set will roll separately for a Chaos and a Order alignment');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $unlinkAlignment = $input->getOption('unlink-alignment');

        $io->title('Step I: Begin Basic Tier');
        $io->text('You begin in basic Tier.');

        $io->title('Step II: Primary Attributes');
        $primaryAttributes = [];
        foreach ($this->em->getRepository(PrimaryAttribute::class)->findAll() as $primaryAttribute) {
            $value = $primaryAttribute->calcPseudoRandomValue();
            $name = $primaryAttribute->getName();
            $primaryAttributes[$primaryAttribute->getId()] = sprintf("%s: %s%% <info>[%sB %s]</info>",
                $name,
                $value,
                substr(ucfirst($name), 0, 1),
                substr($value, 0, 1)
            );
        }
        $io->listing($primaryAttributes);
        $io->comment('Remember that you can apply the Mercy rule!');

        $io->title('Step III: Sex & Race');
        $ancestryRepository = $this->em->getRepository(Ancestry::class);
        $ancestry = $io->choice('Select the type of ancestry', self::ANCESTRY_TYPES, 'Human') === 'Human' ? $ancestryRepository->findOneBy(['name' => 'Human']) : $ancestryRepository->findByRoll();
        $sex = mt_rand(1, 2) % 2 === 0 ? 'Male' : 'Female';

        $io->section(sprintf('%s %s', $sex, $ancestry->getName()));
        $io->writeln('Update primary attributes bonus!');
        $ancestryModifiers = $this->em->getRepository(AncestryModifier::class)->findBy(['ancestry' => $ancestry]);
        $modifier = [];
        foreach ($ancestryModifiers as $ancestryModifier) {
            $primaryAttribute = $ancestryModifier->getPrimaryAttribute();
            $modifier[$primaryAttribute->getId()] = sprintf("%sB: %s",
                substr(ucfirst($primaryAttribute->getName()), 0, 1),
                $ancestryModifier->getValue() > 0 ? '+' . $ancestryModifier->getValue() : $ancestryModifier->getValue()
            );
        }
        $io->listing($modifier);
        $io->section('Ancestral trait');
        $ancestralTrait = $this->em->getRepository(AncestralTrait::class)->findByRoll($ancestry);
        $io->writeln('<info>' . $ancestralTrait->getName() . '</info>');
        $io->writeln('effect: ' . $ancestralTrait->getEffect());

        $io->title('Step IV: Archetype & Profession');
        $archetype = $this->em->getRepository(Archetype::class)->findByRoll();
        $io->writeln(sprintf('Archetype: <info>%s</info>', $archetype->getName()));
        $profession = $this->em->getRepository(Profession::class)->findByRoll($archetype);
        $io->writeln(sprintf('Profession: <info>%s</info>', $profession->getName()));
        $io->comment('Check Trappings on manual!');

        $io->title('Step V: Secondary Attributes');
        $io->section('Peril Threshold');
        $io->text('Determine your base Peril Threshold by adding 3 + your <info>[WB]</info> and any modifier a Talent, Trait or Magick may add. Each additional ‘step’ of Peril Threshold is also noted on the Character sheet as (Peril Threshold+6); (Peril Threshold+12); and (Peril Threshold+18). For example, if Peril Threshold is 10, it is recorded on a Character sheet as such: 10 (16/22/28).');
        $io->section('Damage Threshold');
        $io->text('Determine your base Damage Threshold by adding <info>[BB]</info> and your armor’s Damage Threshold Modifier. It also changes if you wear armor. Additionally, there are Talents and Traits which allow you to grow your total Damage Threshold. Each additional ‘step’ of Damage Threshold is also noted on the Character sheet as (Damage Threshold+6); (Damage Threshold+12); and (Damage Threshold+18). For example, if Damage Threshold is 6, it is recorded on a Character sheet as such: 6 (12/18/24).');
        $io->section('Encumberance Limit');
        $io->text('Your Character has a starting value equal to 3 + <info>[BB]</info>, which changes as your Brawn grows over your Basic, Intermediate and Advanced Tiers. Additionally, there are Talents, Traits and carrying equipment which allow you to grow your total Encumbrance Limit. Trappings and various other equipment will weigh down your Character, measured by this threshold. For every point beyond this initial value (otherwise called Overage), you suffer an ongoing, cumulative -1 to both your Initiative and Movement. Should your Overage ever reduce either your Initiative or Movement to 0, you must drop enough equipment in order to bring the value back to at least 1. ');
        $io->section('Initiative');
        $io->text('Your Character has a starting value equal to 3 + <info>[PB]</info> , which changes as your Perception grows over your Basic, Intermediate and Advanced Tiers. Additionally, there are Talents and Traits which allow you to grow your total Initiative.');
        $io->section('Movement');
        $io->text('Your Character has a starting value equal to 3 + <info>[AB]</info> , which changes as your Agility grows over your Basic, Intermediate and Advanced Tiers. Additionally, there are Talents and Traits which allow you to improve your Movement');

        $io->title('Step VI: Background');
        $season = $this->em->getRepository(Season::class)->findByRoll();
        $io->writeln(sprintf('Season of birth: <info>%s</info>', $season->getName()));
        $dooming = $this->em->getRepository(Dooming::class)->findByRoll($season);
        $io->writeln(sprintf('Dooming: <info>%s</info>', $dooming->getName()));
        $ageGroup = $this->em->getRepository(AgeGroup::class)->findByRoll();
        $io->writeln(sprintf('Age group: <info>%s</info>', $ageGroup->getName()));
        $dMarks = [];
        for ($i = 0; $i < $ageGroup->getDistinguishingMarkCoefficient(); $i++) {
            $dMarks[] = $this->em->getRepository(DistinguishingMark::class)->findByRoll()->getName();
        }
        if (count($dMarks) !== 0) {
            $io->writeln('Distinguishing marks:');
            $io->listing($dMarks);
        }
        $complexion = $this->em->getRepository(Complexion::class)->findByRoll();
        $io->writeln(sprintf('Complexion: <info>%s</info>', $complexion->getName()));
        $buildType = $this->em->getRepository(BuildType::class)->findByRoll();
        $io->writeln(sprintf('Build type : <info>%s</info> (%s%% price modifier)', $buildType->getName(), $buildType->getPriceModifier() * 100));
        $height = $this->em->getRepository(Height::class)->findByRoll($sex, $ancestry);
        $io->writeln(sprintf('Height: <info>%s</info>', $height->getValue()));
        $weight = $this->em->getRepository(Weight::class)->findByRoll($sex, $ancestry, $buildType);
        $io->writeln(sprintf('Weight: <info>%s</info>', $weight->getValue()));
        $hairColor = $this->em->getRepository(HairColor::class)->findByRoll($ancestry);
        $io->writeln(sprintf('Hair color: <info>%s</info>', $hairColor->getValue()));
        $eyeColor = $this->em->getRepository(EyeColor::class)->findByRoll($ancestry);
        $io->writeln(sprintf('Eye color: <info>%s</info>', $eyeColor->getValue()));
        $upbringing = $this->em->getRepository(Upbringing::class)->findByRoll();
        $io->writeln(sprintf('Upbringing: <info>%s</info> [favorite attribute: <info>%s</info>]', $upbringing->getName(), $upbringing->getFavoredPrimaryAttribute()->getName()));
        $socialClass = $this->em->getRepository(SocialClass::class)->findByRoll();
        $io->writeln(sprintf('Social class: <info>%s</info> [starting cash: <info>%s</info>]', $socialClass->getName(), $socialClass->getStartingCash()));
        $drawback = $this->em->getRepository(Drawback::class)->findByRoll();
        $io->writeln(sprintf('Drawback: <info>%s</info> %s', $drawback->getName(), $drawback->getEffect()));

        $io->title('Step VII: Hand Of Fate');
        $io->text('You begin with 1 fate point, or 2 fate point if you take a drawback.');

        $io->title('Step VIII: Alignment');
        $io->comment('todo order&chaos allignment');
        $alignmentRoll = null;
        $orderAlignment = $this->em->getRepository(OrderAlignment::class)->findByRoll($alignmentRoll);
        $chaosAlignment = $this->em->getRepository(ChaosAlignment::class)->findByRoll($alignmentRoll);
        $io->writeln(sprintf('Alignment: <info>%s</info>&<info>%s</info>', $orderAlignment->getName(), $chaosAlignment->getName()));

        $io->title('Step IX: Build Your Profession');
        $io->text('Now that you have the basics of the Character creation completed, write down 1,000 Reward Points on the third page of your Character sheet. In Chapter 4: Professions, you’ll spend these Reward Points to finalize creation. Once completed, you’ll be ready to play a game of ZWEIHÄNDER!');

        $io->success('You have a created a new character!');
    }
}
