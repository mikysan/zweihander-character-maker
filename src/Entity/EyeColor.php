<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EyeColorRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(columns={"min_roll", "max_roll", "ancestry_id"})})
 */
class EyeColor
{
    use d100Trait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ancestry;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAncestry(): ?Ancestry
    {
        return $this->ancestry;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}
