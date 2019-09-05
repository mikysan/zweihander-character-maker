<?php

namespace App\Command;

use App\Entity\Character;
use App\Entity\DistinguishingMark;
use App\Service\CharacterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RollCharacterCommand extends Command
{
    protected static $defaultName = 'app:roll:character';

    /**
     * @var CharacterService
     */
    private $characterService;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(CharacterService $characterService, EntityManagerInterface $entityManager, string $name = NULL)
    {
        $this->entityManager = $entityManager;
        $this->characterService = $characterService;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Auto roll a character!')
            ->addOption('save', null, InputOption::VALUE_NONE, ' If set will save the character.')
            ->addOption('roll-drawback', null, InputOption::VALUE_NONE, ' If set will roll a drawback for the character.')
            ->addOption('roll-ancestry', null, InputOption::VALUE_NONE, ' If set will roll an ancestry for the character, otherwise the character will be a human.')
            ->addOption('unlink-alignment', null, InputOption::VALUE_NONE, ' If set will roll separately for Chaos and Order alignment');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $newCharacter = $this->characterService->rollNew($input->getOption('roll-drawback'), $input->getOption('roll-ancestry'), $input->getOption('unlink-alignment'));

        $io->title('Step I: Begin Basic Tier');
        $io->text('You begin in basic Tier.');

        $io->title('Step II: Primary Attributes');
        $io->listing([
            sprintf("Combat: <info>%s</info> [CB <info>%s</info>]", $newCharacter->getCombat(), $newCharacter->getCombatBonus()),
            sprintf("Brawn: <info>%s</info> [BB <info>%s</info>]", $newCharacter->getBrawn(), $newCharacter->getBrawnBonus()),
            sprintf("Agility: <info>%s</info> [AB <info>%s</info>]", $newCharacter->getAgility(), $newCharacter->getAgilityBonus()),
            sprintf("Perception: <info>%s</info> [PB <info>%s</info>]", $newCharacter->getPerception(), $newCharacter->getPerceptionBonus()),
            sprintf("Intelligence: <info>%s</info> [IB <info>%s</info>]", $newCharacter->getIntelligence(), $newCharacter->getIntelligenceBonus()),
            sprintf("Willpower: <info>%s</info> [WB <info>%s</info>]", $newCharacter->getWillpower(), $newCharacter->getWillpowerBonus()),
            sprintf("Fellowship: <info>%s</info> [FB <info>%s</info>]", $newCharacter->getFellowship(), $newCharacter->getFellowshipBonus()),
        ]);

        $io->title('Step III: Sex & Race');
        $io->writeln(sprintf('<info>%s %s</info>', Character::GENDERS[$newCharacter->getSex()], $newCharacter->getAncestryName()));
        $io->section('Ancestral trait');
        $io->writeln('<info>' . $newCharacter->getAncestralTrait()->getName() . '</info>');
        $io->writeln('effect: ' . $newCharacter->getAncestralTrait()->getEffect());

        $io->title('Step IV: Archetype & Profession');
        $io->listing([
            sprintf('Profession: <info>%s</info>', $newCharacter->getProfessionName()),
        ]);
        $io->note('Check Trappings on manual');

        $io->title('Step V: Secondary Attributes');
        $io->listing([
            sprintf('Peril Threshold: <info>%s</info>', $newCharacter->getPerilThreshold()),
            sprintf('Damage Threshold: <info>%s</info>', $newCharacter->getDamageThreshold()),
            sprintf('Encumbrance Limit: <info>%s</info>', $newCharacter->getEncumbranceLimit()),
            sprintf('Initiative: <info>%s</info>', $newCharacter->getInitiative()),
            sprintf('Movement: <info>%s</info>', $newCharacter->getMovement()),
        ]);
        $io->note('Consider this value can be modified by talent, trait or magick and armor’s Damage Threshold Modifier');

        $io->title('Step VI: Background');
        $io->writeln(sprintf('Season of birth: <info>%s</info>', $newCharacter->getSeasonOfBirthName()));
        $io->writeln(sprintf('Dooming: <info>%s</info>', $newCharacter->getDoomingName()));
        $io->writeln(sprintf('Age group: <info>%s</info>', $newCharacter->getAgeGroupName()));
        if ($newCharacter->hasDistinguishingMarks()) {
            $io->writeln('Distinguishing marks:');
            $io->listing($newCharacter->getDistinguishingMarkValues()->toArray());
        }
        $io->writeln(sprintf('Complexion: <info>%s</info>', $newCharacter->getComplexionName()));
        $io->writeln(sprintf('Build type : <info>%s</info> (%s%% price modifier)', $newCharacter->getBuildType()->getName(), $newCharacter->getBuildType()->getPriceModifier() * 100));
        $io->writeln(sprintf('Height: <info>%s</info>', $newCharacter->getHeightValue()));
        $io->writeln(sprintf('Weight: <info>%s</info>', $newCharacter->getWeightValue()));
        $io->writeln(sprintf('Hair color: <info>%s</info>', $newCharacter->getHairColorValue()));
        $io->writeln(sprintf('Eye color: <info>%s</info>', $newCharacter->getEyeColorValue()));
        $io->writeln(sprintf('Upbringing: <info>%s</info> [favorite attribute: <info>%s</info>]', $newCharacter->getUpbringing()->getName(), $newCharacter->getUpbringing()->getFavoredPrimaryAttributeName()));
        $io->writeln(sprintf('Social class: <info>%s</info>', $newCharacter->getSocialClassName()));
        if ($newCharacter->getDrawback()) {
            $io->writeln(sprintf('Drawback: <info>%s</info> %s', $newCharacter->getDrawback()->getName(), $newCharacter->getDrawback()->getEffect()));
        }

        $io->title('Step VII: Hand Of Fate');
        $io->listing([
            sprintf('Fate points: <info>%s</info>', $newCharacter->getFatePoints()),
        ]);

        $io->title('Step VIII: Alignment');
        $io->listing([
            sprintf('Alignment: <info>%s</info>&<info>%s</info>', $newCharacter->getOrderAlignmentName(), $newCharacter->getChaosAlignmentName()),
        ]);

        $io->title('Step IX: Build Your Profession');
        $io->text('Now that you have the basics of the Character creation completed, write down 1,000 Reward Points on the third page of your Character sheet. In Chapter 4: Professions, you’ll spend these Reward Points to finalize creation. Once completed, you’ll be ready to play a game of ZWEIHÄNDER!');

        if ($io->confirm('Do you wish to apply mercy rule to this character?', false)) {
            $io->writeln('<error>There\'s no mercy</error>'); //todo mercy rule.
        }

        if ($answer = $io->ask('Write a name', 'Mario Rossi')){
            $newCharacter->setName($answer);
        }

        if ($input->getOption('save') || $io->confirm('Do you wish to save this character?', false)) {
            $this->entityManager->persist($newCharacter);
            $this->entityManager->flush();
            $io->success('Character Saved!');
        }
    }
}
