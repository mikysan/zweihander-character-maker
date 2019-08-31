<?php

namespace App\Serializer\Normalizer;

use App\Entity\Character;
use App\Entity\DistinguishingMark;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CharacterNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($object, $format = null, array $context = array()): array
    {
        /** @var $object Character */
        $data['id'] = $object->getId();
        $data['ageGroup'] = $object->getAgeGroup()->getName();
        $data['ancestry'] = $object->getAncestry()->getName();
        $data['buildType'] = $object->getBuildType()->getName();
        $data['chaosAlignment'] = $object->getChaosAlignment()->getName();
        $data['complexion'] = $object->getComplexion()->getName();
        $data['distinguishingMarks'] = array_map(function (DistinguishingMark $distinguishingMark) {
            return $distinguishingMark->getName();
        }, $object->getDistinguishingMarks()->toArray());
        $data['dooming'] = $object->getDooming()->getName();
        $data['drawback'] = $object->getDrawback() ? $object->getDrawback()->getName() : null;
        $data['eyeColor'] = $object->getEyeColor()->getValue();
        $data['hairColor'] = $object->getHairColor()->getValue();
        $data['height'] = $object->getHeight()->getValue();
        $data['orderAlignment'] = $object->getOrderAlignment()->getName();
        $data['archetype'] = $object->getProfession()->getArchetype()->getName();
        $data['profession'] = $object->getProfession()->getName();
        $data['seasonOfBirth'] = $object->getSeasonOfBirth()->getName();
        $data['socialClass'] = $object->getSocialClass()->getName();
        $data['upbringing'] = $object->getUpbringing()->getName();
        $data['weight'] = $object->getWeight()->getValue();
        $data['sex'] = $object->getSex();
        $data['ancestralTrait'] = $object->getAncestralTrait()->getName();
        $data['combat'] = $object->getCombat();
        $data['brawn'] = $object->getBrawn();
        $data['agility'] = $object->getAgility();
        $data['perception'] = $object->getPerception();
        $data['intelligence'] = $object->getIntelligence();
        $data['willpower'] = $object->getWillpower();
        $data['fellowship'] = $object->getFellowship();
        $data['combatBonus'] = $object->getCombatBonus();
        $data['brawnBonus'] = $object->getBrawnBonus();
        $data['agilityBonus'] = $object->getAgilityBonus();
        $data['perceptionBonus'] = $object->getPerceptionBonus();
        $data['intelligenceBonus'] = $object->getIntelligenceBonus();
        $data['willpowerBonus'] = $object->getWillpowerBonus();
        $data['fellowshipBonus'] = $object->getFellowshipBonus();
        $data['perilThreshold'] = $object->getPerilThreshold();
        $data['damageThreshold'] = $object->getDamageThreshold();
        $data['encumbranceLimit'] = $object->getEncumbranceLimit();
        $data['initiative'] = $object->getInitiative();
        $data['movement'] = $object->getMovement();
        $data['fatePoints'] = $object->getFatePoints();

        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Character;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
