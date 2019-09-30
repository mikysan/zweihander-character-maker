<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AgeGroupRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(columns={"min_roll", "max_roll"}), @ORM\UniqueConstraint(columns={"name"})})
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
     * @ORM\Column(type="string", length=180)
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
