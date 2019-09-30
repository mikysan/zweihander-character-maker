<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AncestralTraitRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(columns={"min_roll", "max_roll", "ancestry_id"})})
 */
class AncestralTrait implements TraitInterface
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
     * @Serializer\Groups("view")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Serializer\Groups("view")
     */
    private $effect;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ancestry;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEffect(): ?string
    {
        return $this->effect;
    }

    public function getAncestry(): ?Ancestry
    {
        return $this->ancestry;
    }
}
