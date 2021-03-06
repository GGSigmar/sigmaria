<?php

namespace App\Entity\Ancestry;

use App\Entity\Core\Ability;
use App\Entity\Core\Attribute;
use App\Entity\Core\BaseEntity;
use App\Entity\Core\Feat;
use App\Entity\Core\MoveSpeed;
use App\Entity\Core\Size;
use App\Entity\Core\Traits\ActiveTrait;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\HandleTrait;
use App\Entity\Core\Traits\ParagraphsTrait;
use App\Entity\Core\Traits\ReleasableTrait;
use App\Entity\Core\Traits\SimpleRarityTrait;
use App\Entity\Core\Traits\SlugTrait;
use App\Entity\Core\Traits\SortOrderTrait;
use App\Entity\Setting\Culture;
use App\Service\Core\FeatHelper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ancestry\AncestryRepository")
 * @ORM\Table(name="ancestry_ancestry")
 */
class Ancestry extends BaseEntity
{
    use BaseFieldsTrait, ActiveTrait, SlugTrait, HandleTrait, DescriptionTrait, SimpleRarityTrait, ParagraphsTrait, ReleasableTrait, TimestampableEntity, SortOrderTrait;

    public const ENTITY_NAME = 'ancestry';

    public const ANCESTRY_VALUE = 6;

    public const LANGUAGES_MESSAGE = 'You know 2 languages common to your culture or prevalent in your region
    (usually Common and the language of your ancestry). If your Intelligence modifier is positive, 
    you know additional languages equal to its value. Additional languages should also be common to you.
    ';

    public const ANCESTRY_HUMAN = 'ANCESTRY_HUMAN';
    public const ANCESTRY_DWARF = 'ANCESTRY_DWARF';
    public const ANCESTRY_ELF = 'ANCESTRY_ELF';
    public const ANCESTRY_HALFLING = 'ANCESTRY_HALFLING';

    public const ANCESTRY_ORC = 'ANCESTRY_ORC';
    public const ANCESTRY_LIZARDFOLK = 'ANCESTRY_LIZARDFOLK';
    public const ANCESTRY_HOBGOBLIN = 'ANCESTRY_HOBGOBLIN';
    public const ANCESTRY_KOBOLD = 'ANCESTRY_KOBOLD';

    public const PRIMARY_ANCESTRIES = [
        self::ANCESTRY_HUMAN,
        self::ANCESTRY_DWARF,
        self::ANCESTRY_ELF,
        self::ANCESTRY_HALFLING,
    ];

    public const SECONDARY_ANCESTRIES = [
        self::ANCESTRY_ORC,
        self::ANCESTRY_LIZARDFOLK,
        self::ANCESTRY_HOBGOBLIN,
        self::ANCESTRY_KOBOLD,
    ];

    /**
     * @var AncestralHitPoints
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry\AncestralHitPoints")
     * @Assert\NotBlank
     */
    private $hitPoints;

    /**
     * @var Size
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Size")
     * @Assert\NotBlank
     */
    private $size;

    /**
     * @var MoveSpeed
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\MoveSpeed")
     * @Assert\NotBlank
     */
    private $speed;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Ability", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="ancestry_ancestry_ability_boost")
     * @Assert\Count(max="2")
     */
    private $abilityBoosts;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Setting\Culture", mappedBy="commonAncestries", fetch="EXTRA_LAZY")
     */
    private $cultures;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Attribute", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="ancestry_ancestry_attribute")
     * @Assert\Count(min="1")
     */
    private $attributes;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Ancestry\AncestralFeature", inversedBy="ancestries", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"name"="ASC"})
     * @ORM\JoinTable(name="ancestry_ancestry_ancestral_feature")
     */
    private $ancestralFeatures;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Ancestry\Heritage", mappedBy="ancestry", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"name"="ASC"})
     * @ORM\JoinTable(name="ancestry_ancestry_heritage")
     */
    private $heritages;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Feat", inversedBy="ancestries", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"level"="ASC", "name"="ASC"})
     * @ORM\JoinTable(name="ancestry_ancestry_feat")
     */
    private $feats;

    public function __construct()
    {
        $this->isActive = false;
        $this->abilityBoosts = new ArrayCollection();
        $this->cultures = new ArrayCollection();
        $this->attributes = new ArrayCollection();
        $this->ancestralFeatures = new ArrayCollection();
        $this->feats = new ArrayCollection();
        $this->heritages = new ArrayCollection();
        $this->paragraphs = new ArrayCollection();
    }

    /**
     * @return null|AncestralHitPoints
     */
    public function getHitPoints(): ?AncestralHitPoints
    {
        return $this->hitPoints;
    }

    /**
     * @param AncestralHitPoints $hitPoints
     */
    public function setHitPoints(AncestralHitPoints $hitPoints): void
    {
        $this->hitPoints = $hitPoints;
    }

    /**
     * @return null|Size
     */
    public function getSize(): ?Size
    {
        return $this->size;
    }

    /**
     * @param Size $size
     */
    public function setSize(Size $size): void
    {
        $this->size = $size;
    }

    /**
     * @return null|MoveSpeed
     */
    public function getSpeed(): ?MoveSpeed
    {
        return $this->speed;
    }

    /**
     * @param MoveSpeed $speed
     */
    public function setSpeed(MoveSpeed $speed): void
    {
        $this->speed = $speed;
    }

    /**
     * @return Collection|Ability[]
     */
    public function getAbilityBoosts(): Collection
    {
        return $this->abilityBoosts;
    }

    /**
     * @param Ability $abilityBoost
     */
    public function addAbilityBoost(Ability $abilityBoost): void
    {
        if (!$this->abilityBoosts->contains($abilityBoost)) {
            $this->abilityBoosts->add($abilityBoost);
        }

        return;
    }

    /**
     * @param Ability $abilityBoost
     */
    public function removeAbilityBoost(Ability $abilityBoost): void
    {
        if ($this->abilityBoosts->contains($abilityBoost)) {
            $this->abilityBoosts->removeElement($abilityBoost);
        }

        return;
    }

    /**
     * @return Collection|Culture[]
     */
    public function getCultures(): Collection
    {
        return $this->cultures;
    }

    /**
     * @return Collection|Culture[]
     */
    public function getActiveCultures(): Collection
    {
        return $this->cultures->filter(function ($culture) {
            return $culture->isActive();
        });
    }

    /**
     * @param Culture $culture
     */
    public function addCulture(Culture $culture): void
    {
        if (!$this->cultures->contains($culture)) {
            $this->cultures->add($culture);
            $culture->addCommonAncestry($this);
        }

        return;
    }

    /**
     * @param Culture $culture
     */
    public function removeCulture(Culture $culture): void
    {
        if ($this->cultures->contains($culture)) {
            $this->cultures->removeElement($culture);
            $culture->removeCommonAncestry($this);
        }

        return;
    }

    /**
     * @return Collection|Attribute[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes->filter(function ($attribute) {
            return $attribute->isActive();
        });
    }

    /**
     * @param Attribute $attribute
     */
    public function addAttribute(Attribute $attribute): void
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes->add($attribute);
        }

        return;
    }

    /**
     * @param Attribute $attribute
     */
    public function removeAttribute(Attribute $attribute): void
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
        }

        return;
    }

    /**
     * @return Collection|AncestralFeature[]
     */
    public function getAncestralFeatures(): Collection
    {
        return $this->ancestralFeatures;
    }

    /**
     * @return Collection|AncestralFeature[]
     */
    public function getActiveAncestralFeatures(): Collection
    {
        return $this->ancestralFeatures->filter(function ($ancestralFeature) {
            return $ancestralFeature->isActive();
        });
    }

    /**
     * @param AncestralFeature $ancestralFeature
     */
    public function addAncestralFeature(AncestralFeature $ancestralFeature): void
    {
        if (!$this->ancestralFeatures->contains($ancestralFeature)) {
            $this->ancestralFeatures->add($ancestralFeature);
            $ancestralFeature->addAncestry($this);
        }

        return;
    }

    /**
     * @param AncestralFeature $ancestralFeature
     */
    public function removeAncestralFeature(AncestralFeature $ancestralFeature): void
    {
        if ($this->ancestralFeatures->contains($ancestralFeature)) {
            $this->ancestralFeatures->removeElement($ancestralFeature);
            $ancestralFeature->removeAncestry($this);
        }

        return;
    }

    /**
     * @return Collection|Heritage[]
     */
    public function getHeritages(): Collection
    {
        return $this->heritages;
    }

    /**
     * @return Collection|Heritage[]
     */
    public function getActiveHeritages(): Collection
    {
        return $this->heritages->filter(function ($heritage) {
            return $heritage->isActive();
        });
    }

    /**
     * @param Heritage $heritage
     */
    public function addHeritage(Heritage $heritage): void
    {
        if (!$this->heritages->contains($heritage)) {
            $this->heritages->add($heritage);
        }

        return;
    }

    /**
     * @param Heritage $heritage
     */
    public function removeHeritage(Heritage $heritage): void
    {
        if ($this->heritages->contains($heritage)) {
            $this->heritages->removeElement($heritage);
        }

        return;
    }

    /**
     * @return array
     */
    public function getHeritageValues(): array
    {
        $heritageValues = [];

        foreach ($this->getHeritages() as $heritage)
        {
            $value = $heritage->getValue();

            if (!in_array($value, $heritageValues)) {
                $heritageValues[] = $value;
            }
        }

        sort($heritageValues);

        return $heritageValues;
    }

    /**
     * @return Collection|Feat[]
     */
    public function getFeats(): Collection
    {
        return $this->feats;
    }

    /**
     * @return array|Feat[]
     */
    public function getGroupedFeats(): array
    {
        return FeatHelper::groupFeatsByLevel($this->feats);
    }

    /**
     * @return array|Feat[]
     */
    public function getActiveFeats(): array
    {
        return $this->getActiveGroupedFeats();
    }

    /**
     * @return array|Feat[]
     */
    public function getActiveGroupedFeats(): array
    {
        return FeatHelper::groupFeatsByLevel(
            $this->feats->filter(function ($feat) {
                return $feat->isActive();
            })
        );
    }

    /**
     * @param Feat $feat
     */
    public function addFeat(Feat $feat): void
    {
        if (!$this->feats->contains($feat)) {
            $this->feats->add($feat);
        }

        return;
    }

    /**
     * @param Feat $feat
     */
    public function removeFeat(Feat $feat): void
    {
        if ($this->feats->contains($feat)) {
            $this->feats->removeElement($feat);
        }

        return;
    }

    /**
     * @return string
     */
    public function getLanguagesMessage(): string
    {
        return self::LANGUAGES_MESSAGE;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        $value = 0;

        foreach ($this->getAncestralFeatures() as $ancestralFeature) {
            $value += $ancestralFeature->getValue();
        }

        $value += $this->getHitPoints()->getValue();
        $value += $this->getSpeed()->getValue();

        return $value;
    }

    /**
     * @return int
     */
    public function getNumberOfFreeFeats(): int
    {
        return self::ANCESTRY_VALUE - $this->getValue();
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;

        if (!$isActive) {
            $this->isToBeReleased = false;
        }
    }
}