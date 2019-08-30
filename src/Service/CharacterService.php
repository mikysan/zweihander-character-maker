<?php


namespace App\Service;


use App\Entity\AgeGroup;
use App\Entity\AncestralTrait;
use App\Entity\Ancestry;
use App\Entity\Archetype;
use App\Entity\BuildType;
use App\Entity\ChaosAlignment;
use App\Entity\Character;
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

class CharacterService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function rollNew(bool $rollDrawback = true, bool $rollForAncestry = false, bool $unlinkAlignment = false): Character
    {
        $primaryAttributes = [];
        foreach ($this->entityManager->getRepository(PrimaryAttribute::class)->findAll() as $primaryAttribute) {
            $primaryAttributes[strtolower($primaryAttribute->getName())] = $primaryAttribute->calcPseudoRandomValue();
        }
        $ancestryRepository = $this->entityManager->getRepository(Ancestry::class);
        $ancestry = $rollForAncestry ? $ancestryRepository->findByRoll() : $ancestryRepository->findOneBy(['name' => 'Human']);
        $seasonOfBirth = $this->entityManager->getRepository(Season::class)->findByRoll();
        $ageGroup = $this->entityManager->getRepository(AgeGroup::class)->findByRoll();
        $distinguishingMarks = [];
        for ($i = 0; $i < $ageGroup->getDistinguishingMarkCoefficient(); $i++) {
            $distinguishingMarks[] = $this->entityManager->getRepository(DistinguishingMark::class)->findByRoll();
        }
        $buildType = $this->entityManager->getRepository(BuildType::class)->findByRoll();
        $hwRoll = null;
        $sex = mt_rand(1, 2) % 2 === 0 ? 'm' : 'f';


        $alignmentRoll = null;
        $orderAlignment = $this->entityManager->getRepository(OrderAlignment::class)->findByRoll($alignmentRoll);
        $unlinkAlignment && $alignmentRoll = null;
        $chaosAlignment = $this->entityManager->getRepository(ChaosAlignment::class)->findByRoll($alignmentRoll);

        return new Character(
            $ancestry,
            $this->entityManager->getRepository(AncestralTrait::class)->findByRoll($ancestry),
            $sex,
            $this->entityManager->getRepository(Profession::class)->findByRoll($this->entityManager->getRepository(Archetype::class)->findByRoll()),
            $buildType,
            $this->entityManager->getRepository(Complexion::class)->findByRoll(),
            $this->entityManager->getRepository(EyeColor::class)->findByRoll($ancestry),
            $this->entityManager->getRepository(HairColor::class)->findByRoll($ancestry),
            $this->entityManager->getRepository(Height::class)->findByRoll($sex, $ancestry, $hwRoll),
            $this->entityManager->getRepository(Weight::class)->findByRoll($sex, $ancestry, $buildType, $hwRoll),
            $ageGroup,
            $distinguishingMarks,
            $seasonOfBirth,
            $this->entityManager->getRepository(Dooming::class)->findByRoll($seasonOfBirth),
            $chaosAlignment,
            $orderAlignment,
            $rollDrawback ? $this->entityManager->getRepository(Drawback::class)->findByRoll() : null,
            $this->entityManager->getRepository(SocialClass::class)->findByRoll(),
            $this->entityManager->getRepository(Upbringing::class)->findByRoll(),
            $primaryAttributes['combat'],
            $primaryAttributes['brawn'],
            $primaryAttributes['agility'],
            $primaryAttributes['perception'],
            $primaryAttributes['intelligence'],
            $primaryAttributes['willpower'],
            $primaryAttributes['fellowship']
        );
    }


}