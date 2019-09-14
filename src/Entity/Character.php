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
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AgeGroup")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ageGroup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ancestry;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BuildType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $buildType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ChaosAlignment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chaosAlignment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Complexion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $complexion;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\DistinguishingMark")
     */
    private $distinguishingMarks;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dooming")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dooming;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Drawback")
     */
    private $drawback;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EyeColor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eyeColor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HairColor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hairColor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Height")
     * @ORM\JoinColumn(nullable=false)
     */
    private $height;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OrderAlignment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderAlignment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profession")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profession;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season")
     * @ORM\JoinColumn(nullable=false)
     */
    private $seasonOfBirth;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SocialClass")
     * @ORM\JoinColumn(nullable=false)
     */
    private $socialClass;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Upbringing")
     * @ORM\JoinColumn(nullable=false)
     */
    private $upbringing;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Weight")
     * @ORM\JoinColumn(nullable=false)
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sex;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AncestralTrait")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ancestralTrait;

    /**
     * @ORM\Column(type="integer")
     */
    private $combat;

    /**
     * @ORM\Column(type="integer")
     */
    private $brawn;

    /**
     * @ORM\Column(type="integer")
     */
    private $agility;

    /**
     * @ORM\Column(type="integer")
     */
    private $perception;

    /**
     * @ORM\Column(type="integer")
     */
    private $intelligence;

    /**
     * @ORM\Column(type="integer")
     */
    private $willpower;

    /**
     * @ORM\Column(type="integer")
     */
    private $fellowship;

    /**
     * @ORM\Column(type="integer")
     */
    private $combatBonus;

    /**
     * @ORM\Column(type="integer")
     */
    private $brawnBonus;

    /**
     * @ORM\Column(type="integer")
     */
    private $agilityBonus;

    /**
     * @ORM\Column(type="integer")
     */
    private $perceptionBonus;

    /**
     * @ORM\Column(type="integer")
     */
    private $intelligenceBonus;

    /**
     * @ORM\Column(type="integer")
     */
    private $willpowerBonus;

    /**
     * @ORM\Column(type="integer")
     */
    private $fellowshipBonus;

    /**
     * @ORM\Column(type="integer")
     */
    private $fatePoints;

    /**
     * @ORM\Column(type="text")
     */
    private $trappings;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Armor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $armor;

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
        int $fellowship,
        string $trappings,
        Armor $armor
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
        $this->trappings = $trappings;
        $this->armor = $armor;
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

    /**
     * @Serializer\Groups({"view","index"})
     * @Serializer\SerializedName("id")
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     * @Serializer\Groups({"view","index"})
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @Serializer\Groups({"view","index"})
     * @Serializer\SerializedName("ageGroup")
     */
    public function getAgeGroupName(): string
    {
        return $this->ageGroup->getName();
    }

    /**
     * @Serializer\Groups({"view","index"})
     * @Serializer\SerializedName("ancestry")
     */
    public function getAncestryName(): string
    {
        return $this->ancestry->getName();
    }

    /**
     * @Serializer\Groups({"view","index"})
     */
    public function getBuildType(): BuildType
    {
        return $this->buildType;
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("chaosAlignment")
     */
    public function getChaosAlignmentName(): string
    {
        return $this->chaosAlignment->getName();
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("complexion")
     */
    public function getComplexionName(): string
    {
        return $this->complexion->getName();
    }

    public function hasDistinguishingMarks(): bool
    {
        return $this->distinguishingMarks->isEmpty();
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("distinguishingMarks")
     * @return Collection|string[]
     */
    public function getDistinguishingMarkValues(): Collection
    {
        return $this->distinguishingMarks->map(function (DistinguishingMark $distinguishingMark) {
            return $distinguishingMark->getName();
        });
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("dooming")
     */
    public function getDoomingName(): string
    {
        return $this->dooming->getName();
    }

    /**
     * @return Drawback
     * @Serializer\Groups("view")
     */
    public function getDrawback(): ?Drawback
    {
        return $this->drawback;
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("eyeColor")
     */
    public function getEyeColorValue(): string
    {
        return $this->eyeColor->getValue();
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("hairColor")
     */
    public function getHairColorValue(): string
    {
        return $this->hairColor->getValue();
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("height")
     */
    public function getHeightValue(): string
    {
        return $this->height->getValue();
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("orderAlignment")
     */
    public function getOrderAlignmentName(): string
    {
        return $this->orderAlignment->getName();
    }

    /**
     * @Serializer\Groups({"view","index"})
     * @Serializer\SerializedName("profession")
     */
    public function getProfessionName(): string
    {
        return $this->profession->getName();
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("seasonOfBirth")
     */
    public function getSeasonOfBirthName(): string
    {
        return $this->seasonOfBirth->getName();
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("socialClass")
     */
    public function getSocialClassName(): string
    {
        return $this->socialClass->getName();
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getUpbringing(): Upbringing
    {
        return $this->upbringing;
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("weight")
     */
    public function getWeightValue(): string
    {
        return $this->weight->getValue();
    }

    /**
     * @Serializer\Groups({"view","index"})
     */
    public function getSex(): ?string
    {
        return $this->sex;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getAncestralTrait(): AncestralTrait
    {
        return $this->ancestralTrait;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getCombat(): int
    {
        return $this->combat;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getBrawn(): int
    {
        return $this->brawn;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getAgility(): int
    {
        return $this->agility;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getPerception(): int
    {
        return $this->perception;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getIntelligence(): int
    {
        return $this->intelligence;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getWillpower(): int
    {
        return $this->willpower;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getFellowship(): int
    {
        return $this->fellowship;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getCombatBonus(): int
    {
        return $this->combatBonus;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getIntelligenceBonus(): int
    {
        return $this->intelligenceBonus;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getFellowshipBonus(): int
    {
        return $this->fellowshipBonus;
    }

    /**
     * @Serializer\Groups("view")
     * todo consider add talent, trait or magick modifier
     */
    public function getPerilThreshold(): int
    {
        return 3 + $this->getWillpowerBonus();
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getWillpowerBonus(): int
    {
        return $this->willpowerBonus;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getDamageThreshold(): int
    {
        return $this->getBrawnBonus() + $this->armor->getDamageThresholdModifier();
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getBrawnBonus(): int
    {
        return $this->brawnBonus;
    }

    /**
     * @Serializer\Groups("view")
     * todo consider add talent, trait or magick modifier
     */
    public function getEncumbranceLimit(): int
    {
        return 3 + $this->getBrawnBonus();
    }

    /**
     * @Serializer\Groups("view")
     * todo consider add talent, trait or magick modifier
     */
    public function getInitiative(): int
    {
        return 3 + $this->getPerceptionBonus();
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getPerceptionBonus(): int
    {
        return $this->perceptionBonus;
    }

    /**
     * @Serializer\Groups("view")
     * todo consider add talent, trait or magick modifier
     */
    public function getMovement(): int
    {
        return 3 + $this->getAgilityBonus();
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getAgilityBonus(): int
    {
        return $this->agilityBonus;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getFatePoints(): int
    {
        return $this->fatePoints;
    }

    /**
     * @Serializer\Groups("view")
     */
    public function getTrappings(): array
    {
        return explode(', ', $this->trappings);
    }

    /**
     * @Serializer\Groups("view")
     * @Serializer\SerializedName("armor")
     */
    public function getArmorName(): string
    {
        return $this->armor->getName();
    }
}
