<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AgeGroupRepository")
 */
class AgeGroup
{
    use d100Trait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"index", "view"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $distinguishingMarkCoefficient;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDistinguishingMarkCoefficient(): ?int
    {
        return $this->distinguishingMarkCoefficient;
    }
}
