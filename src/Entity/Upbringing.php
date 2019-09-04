<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UpbringingRepository")
 */
class Upbringing
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
     * @Serializer\Groups("view")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PrimaryAttribute")
     * @ORM\JoinColumn(nullable=false)
     */
    private $favoredPrimaryAttribute;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getFavoredPrimaryAttribute(): ?PrimaryAttribute
    {
        return $this->favoredPrimaryAttribute;
    }
}
