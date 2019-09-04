<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HairColorRepository")
 */
class HairColor
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
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups("view")
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
