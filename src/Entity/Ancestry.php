<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AncestryRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(columns={"min_roll", "max_roll"}), @ORM\UniqueConstraint(columns={"name"})})
 */
class Ancestry
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
     * @ORM\OneToMany(targetEntity="App\Entity\AncestryModifier", mappedBy="ancestry", orphanRemoval=true)
     */
    private $ancestryModifiers;

    public function __construct()
    {
        $this->ancestryModifiers = new ArrayCollection();
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
     * @return Collection|AncestryModifier[]
     */
    public function getAncestryModifiers(): Collection
    {
        return $this->ancestryModifiers;
    }
}
