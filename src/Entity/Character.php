<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterRepository")
 * @ORM\Table(name="`character`")
 */
class Character
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"index", "view"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AgeGroup")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups({"index", "view"})
     */
    private $ageGroup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups({"index", "view"})
     */
    private $ancestry;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BuildType")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups({"index", "view"})
     */
    private $buildType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ChaosAlignment")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups("view")
     */
    private $chaosAlignment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Complexion")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups("view")
     */
    private $complexion;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\DistinguishingMark")
     * @Serializer\Groups("view")
     */
    private $distinguishingMarks;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dooming")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups("view")
     */
    private $dooming;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Drawback")
     * @Serializer\Groups("view")
     */
    private $drawback;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EyeColor")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups("view")
     */
    private $eyeColor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HairColor")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups("view")
     */
    private $hairColor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Height")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups("view")
     */
    private $height;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OrderAlignment")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups("view")
     */
    private $orderAlignment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profession")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups({"index", "view"})
     */
    private $profession;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups("view")
     */
    private $seasonOfBirth;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SocialClass")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups("view")
     */
    private $socialClass;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Upbringing")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups("view")
     */
    private $upbringing;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Weight")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups("view")
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=1)
     * @Serializer\Groups({"index", "view"})
     */
    private $sex;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AncestralTrait")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups("view")
     */
    private $ancestralTrait;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $combat;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $brawn;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $agility;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $perception;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $intelligence;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $willpower;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $fellowship;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $combatBonus;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $brawnBonus;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $agilityBonus;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $perceptionBonus;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $intelligenceBonus;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $willpowerBonus;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $fellowshipBonus;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups("view")
     */
    private $fatePoints;

    const GENDERS = [
        'm' => 'Male',
        'f' => 'Female'
    ];

    public function __construct(
        Ancestry $ancestry,
        AncestralTrait $ancestralTrait,
        string $sex,
        Profession $profession,
        BuildType $buildType,
        Complexion $complexion,
        EyeColor $eyeColor,
        HairColor $hairColor,
        Height $height,
        Weight $weight,
        AgeGroup $ageGroup,
        array $distinguishingMarks,
        Season $seasonOfBirth,
        Dooming $dooming,
        ChaosAlignment $chaosAlignment,
        OrderAlignment $orderAlignment,
        ?Drawback $drawback,
        SocialClass $socialClass,
        Upbringing $upbringing,
        int $combat,
        int $brawn,
        int $agility,
        int $perception,
        int $intelligence,
        int $willpower,
        int $fellowship
    )
    {
        $this->ageGroup = $ageGroup;
        $this->ancestry = $ancestry;
        $this->buildType = $buildType;
        $this->chaosAlignment = $chaosAlignment;
        $this->complexion = $complexion;
        $this->distinguishingMarks = new ArrayCollection($distinguishingMarks);
        $this->dooming = $dooming;
        $this->drawback = $drawback;
        $this->eyeColor = $eyeColor;
        $this->hairColor = $hairColor;
        $this->height = $height;
        $this->orderAlignment = $orderAlignment;
        $this->profession = $profession;
        $this->seasonOfBirth = $seasonOfBirth;
        $this->socialClass = $socialClass;
        $this->upbringing = $upbringing;
        $this->weight = $weight;
        $this->sex = $sex;
        $this->ancestralTrait = $ancestralTrait;
        $this->combat = $combat;
        $this->brawn = $brawn;
        $this->agility = $agility;
        $this->perception = $perception;
        $this->intelligence = $intelligence;
        $this->willpower = $willpower;
        $this->fellowship = $fellowship;

        // Elaborate Attribute Bonuses
        $combatBonus = floor($combat / 10);
        $brawnBonus = floor($brawn / 10);
        $agilityBonus = floor($agility / 10);
        $perceptionBonus = floor($perception / 10);
        $intelligenceBonus = floor($intelligence / 10);
        $willpowerBonus = floor($willpower / 10);
        $fellowshipBonus = floor($fellowship / 10);
        foreach ($ancestry->getAncestryModifiers() as $modifier) {
            $attributeBonusName = strtolower($modifier->getPrimaryAttribute()->getName()) . 'Bonus';
            isset($$attributeBonusName) && $$attributeBonusName = $$attributeBonusName + $modifier->getValue();
        }

        $this->combatBonus = $combatBonus;
        $this->brawnBonus = $brawnBonus;
        $this->agilityBonus = $agilityBonus;
        $this->perceptionBonus = $perceptionBonus;
        $this->intelligenceBonus = $intelligenceBonus;
        $this->willpowerBonus = $willpowerBonus;
        $this->fellowshipBonus = $fellowshipBonus;

        // Elaborate FatePoints
        $this->fatePoints = $drawback ? 2 : 1;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgeGroup(): ?AgeGroup
    {
        return $this->ageGroup;
    }

    public function getAncestry(): ?Ancestry
    {
        return $this->ancestry;
    }

    public function getBuildType(): ?BuildType
    {
        return $this->buildType;
    }

    public function getChaosAlignment(): ?ChaosAlignment
    {
        return $this->chaosAlignment;
    }

    public function getComplexion(): ?Complexion
    {
        return $this->complexion;
    }

    /**
     * @return Collection|DistinguishingMark[]
     */
    public function getDistinguishingMarks(): Collection
    {
        return $this->distinguishingMarks;
    }

    public function getDooming(): ?Dooming
    {
        return $this->dooming;
    }

    public function getDrawback(): ?Drawback
    {
        return $this->drawback;
    }

    public function getEyeColor(): ?EyeColor
    {
        return $this->eyeColor;
    }

    public function getHairColor(): ?HairColor
    {
        return $this->hairColor;
    }

    public function getHeight(): ?Height
    {
        return $this->height;
    }

    public function getOrderAlignment(): ?OrderAlignment
    {
        return $this->orderAlignment;
    }

    public function getProfession(): ?Profession
    {
        return $this->profession;
    }

    public function getSeasonOfBirth(): ?Season
    {
        return $this->seasonOfBirth;
    }

    public function getSocialClass(): ?SocialClass
    {
        return $this->socialClass;
    }

    public function getUpbringing(): ?Upbringing
    {
        return $this->upbringing;
    }

    public function getWeight(): ?Weight
    {
        return $this->weight;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function getAncestralTrait(): ?AncestralTrait
    {
        return $this->ancestralTrait;
    }

    public function getCombat(): ?int
    {
        return $this->combat;
    }

    public function getBrawn(): ?int
    {
        return $this->brawn;
    }

    public function getAgility(): ?int
    {
        return $this->agility;
    }

    public function getPerception(): ?int
    {
        return $this->perception;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function getWillpower(): ?int
    {
        return $this->willpower;
    }

    public function getFellowship(): ?int
    {
        return $this->fellowship;
    }

    public function getCombatBonus(): ?int
    {
        return $this->combatBonus;
    }

    public function getBrawnBonus(): ?int
    {
        return $this->brawnBonus;
    }

    public function getAgilityBonus(): ?int
    {
        return $this->agilityBonus;
    }

    public function getPerceptionBonus(): ?int
    {
        return $this->perceptionBonus;
    }

    public function getIntelligenceBonus(): ?int
    {
        return $this->intelligenceBonus;
    }

    public function getWillpowerBonus(): ?int
    {
        return $this->willpowerBonus;
    }

    public function getFellowshipBonus(): ?int
    {
        return $this->fellowshipBonus;
    }

    // todo consider add talent, trait or magick modifier
    /**
     * @Serializer\Groups("view")
     */
    public function getPerilThreshold(): ?int
    {
        return 3 + $this->getWillpowerBonus();
    }

    // todo add armor’s Damage Threshold Modifier
    /**
     * @Serializer\Groups("view")
     */
    public function getDamageThreshold(): ?int
    {
        return $this->getBrawnBonus();
    }

    // todo consider add talent, trait or magick modifier
    /**
     * @Serializer\Groups("view")
     */
    public function getEncumbranceLimit(): ?int
    {
        return 3 + $this->getBrawnBonus();
    }

    // todo consider add talent, trait or magick modifier
    /**
     * @Serializer\Groups("view")
     */
    public function getInitiative(): ?int
    {
        return 3 + $this->getPerceptionBonus();
    }

    // todo consider add talent, trait or magick modifier
    /**
     * @Serializer\Groups("view")
     */
    public function getMovement(): ?int
    {
        return 3 + $this->getAgilityBonus();
    }

    public function getFatePoints(): ?int
    {
        return $this->fatePoints;
    }
}
