<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HeightRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(columns={"min_roll", "max_roll", "gender", "ancestry_id"})})
 */
class Height
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
    private $value;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ancestry;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function getAncestry(): ?Ancestry
    {
        return $this->ancestry;
    }
}
