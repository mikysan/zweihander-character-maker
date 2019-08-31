<?php

namespace App\Serializer\Normalizer;

use App\Entity\Character;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CharacterIndexNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface, ContextAwareNormalizerInterface
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
        $data['buildType'] = $object->getBuildType()->getName();
        $data['sex'] = $object->getSex();
        $data['ancestry'] = $object->getAncestry()->getName();
        $data['profession'] = $object->getProfession()->getName();

        return $data;
    }

    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Character && isset($context['index']) && $context['index'];
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
