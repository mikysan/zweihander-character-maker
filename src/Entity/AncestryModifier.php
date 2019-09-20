<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AncestryModifierRepository")
 */
class AncestryModifier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry", inversedBy="ancestryModifiers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ancestry;

    /**
     * @ORM\Column(type="integer")
     */
    private $primaryAttribute;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function getAncestry(): ?Ancestry
    {
        return $this->ancestry;
    }

    public function getPrimaryAttribute(): ?int
    {
        return $this->primaryAttribute;
    }
}
