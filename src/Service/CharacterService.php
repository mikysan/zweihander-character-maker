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

    public function rollNew(bool $rollDrawback = true, bool $rollAncestry = false, bool $unlinkAlignment = false): Character
    {
        $primaryAttributes = [];
        foreach (array_keys(PrimaryAttribute::ATTRIBUTE_NAMES) as $primaryAttribute) {
            $primaryAttributes[$primaryAttribute] = PrimaryAttribute::calcPseudoRandomValue();
        }
        $ancestryRepository = $this->entityManager->getRepository(Ancestry::class);
        $ancestry = $rollAncestry ? $ancestryRepository->findByRoll() : $ancestryRepository->findOneBy(['name' => 'Human']);
        if (null === $ancestry) {
            throw new \Exception('Required data is missing on database.');
        }
        $seasonOfBirth = $this->entityManager->getRepository(Season::class)->findByRoll();
        $ageGroup = $this->entityManager->getRepository(AgeGroup::class)->findByRoll();
        $distinguishingMarks = [];
        for ($i = 0; $i < $ageGroup->getDistinguishingMarkCoefficient(); ++$i) {
            $distinguishingMark = $this->entityManager->getRepository(DistinguishingMark::class)->findByRoll();
            if (in_array($distinguishingMark->getName(), $distinguishingMarks)) {
                --$i;

                continue;
            }
            $distinguishingMarks[] = $distinguishingMark->getName();
        }
        $buildType = $this->entityManager->getRepository(BuildType::class)->findByRoll();
        $hwRoll = null;
        $sex = 0 === mt_rand(1, 2) % 2 ? 'm' : 'f';
        $archetype = $this->entityManager->getRepository(Archetype::class)->findByRoll();

        $alignmentRoll = null;
        $orderAlignment = $this->entityManager->getRepository(OrderAlignment::class)->findByRoll($alignmentRoll);
        if ($unlinkAlignment) {
            $alignmentRoll = null;
        }
        $chaosAlignment = $this->entityManager->getRepository(ChaosAlignment::class)->findByRoll($alignmentRoll);

        return new Character(
            $ancestry,
            $this->entityManager->getRepository(AncestralTrait::class)->findByRoll($ancestry),
            $sex,
            $this->entityManager->getRepository(Profession::class)->findByRoll($archetype),
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
            $primaryAttributes[PrimaryAttribute::COMBAT],
            $primaryAttributes[PrimaryAttribute::BRAWN],
            $primaryAttributes[PrimaryAttribute::AGILITY],
            $primaryAttributes[PrimaryAttribute::PERCEPTION],
            $primaryAttributes[PrimaryAttribute::INTELLIGENCE],
            $primaryAttributes[PrimaryAttribute::WILLPOWER],
            $primaryAttributes[PrimaryAttribute::FELLOWSHIP],
            $archetype->getTrappings(),
            $archetype->getArmor()
        );
    }
}
