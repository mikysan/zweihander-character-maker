<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use RuntimeException;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UpbringingRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(columns={"min_roll", "max_roll"}), @ORM\UniqueConstraint(columns={"name"})})
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
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $favoredPrimaryAttribute;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("favoredPrimaryAttribute")
     */
    public function getFavoredPrimaryAttributeName(): string
    {
        if (null === $this->favoredPrimaryAttribute) {
            throw new  RuntimeException('Invalid Upbringing object');
        }
        return PrimaryAttribute::ATTRIBUTE_NAMES[$this->favoredPrimaryAttribute];
    }
}
