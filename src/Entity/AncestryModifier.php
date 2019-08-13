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
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ancestry;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PrimaryAttribute")
     * @ORM\JoinColumn(nullable=false)
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

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getAncestry(): ?Ancestry
    {
        return $this->ancestry;
    }

    public function getPrimaryAttribute(): ?PrimaryAttribute
    {
        return $this->primaryAttribute;
    }

}
