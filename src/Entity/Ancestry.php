<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AncestryRepository")
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
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"index", "view"})
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
