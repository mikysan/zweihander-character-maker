<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AchetypeRepository")
 */
class Archetype
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
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $trappings;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Armor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $armor;

    public function __toString()
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTrappings()
    {
        return $this->trappings;
    }

    public function getArmor(): ?Armor
    {
        return $this->armor;
    }
}
