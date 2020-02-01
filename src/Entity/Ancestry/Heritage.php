<?php

namespace App\Entity\Ancestry;

use App\Entity\Core\Ability;
use App\Entity\Core\Attribute;
use App\Entity\Core\Feat;
use App\Entity\Core\MoveSpeed;
use App\Entity\Core\Size;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\ReleasableTrait;
use App\Entity\Core\Traits\ShortDescriptionTrait;
use App\Entity\Core\Traits\SimpleRarityTrait;
use App\Entity\Core\Traits\ValueTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ancestry\HeritageRepository")
 * @ORM\Table(name="ancestry_heritage")
 */
class Heritage
{
    use BaseFieldsTrait, ShortDescriptionTrait, ValueTrait, SimpleRarityTrait, ReleasableTrait, TimestampableEntity;

    public const HERITAGE_FEATURES_NOTE = 'Zobacz podstronę dziedzictwa aby zapoznać się z jego zdolnościami.';

    /**
     * @var Ancestry
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry\Ancestry", inversedBy="heritages")
     * @Assert\NotBlank
     */
    private $ancestry;

    /**
     * @var AncestralHitPoints
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry\AncestralHitPoints")
     */
    private $hitPoints;

    /**
     * @var Size
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Size")
     */
    private $size;

    /**
     * @var MoveSpeed
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\MoveSpeed")
     */
    private $speed;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Ability", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="ancestry_heritage_ability_boost")
     * @Assert\Count(max="2")
     */
    private $abilityBoosts;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Attribute", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="ancestry_heritage_attribute")
     * @Assert\Count(min="1")
     */
    private $attributes;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Ancestry\AncestralFeature", inversedBy="ancestries", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="ancestry_heritage_ancestral_feature")
     */
    private $ancestralFeatures;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Feat", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"level"="ASC", "name"="ASC"})
     * @ORM\JoinTable(name="ancestry_heritage_feat")
     */
    private $feats;

    public function __construct()
    {
        $this->isActive = false;
        $this->abilityBoosts = new ArrayCollection();
        $this->attributes = new ArrayCollection();
        $this->ancestralFeatures = new ArrayCollection();
        $this->feats = new ArrayCollection();
    }

    /**
     * @return Ancestry|null
     */
    public function getAncestry(): ?Ancestry
    {
        return $this->ancestry;
    }

    /**
     * @param Ancestry $ancestry
     */
    public function setAncestry(Ancestry $ancestry): void
    {
        $this->ancestry = $ancestry;
    }

    /**
     * @return null|AncestralHitPoints
     */
    public function getHitPoints(): ?AncestralHitPoints
    {
        return $this->hitPoints;
    }

    /**
     * @param AncestralHitPoints|null $hitPoints
     */
    public function setHitPoints(?AncestralHitPoints $hitPoints): void
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
     * @param Size|null $size
     */
    public function setSize(?Size $size): void
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
     * @param MoveSpeed|null $speed
     */
    public function setSpeed(?MoveSpeed $speed): void
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
        }

        return;
    }

    /**
     * @return Collection|Feat[]
     */
    public function getFeats(): Collection
    {
        return $this->feats;
    }

    /**
     * @return Collection|Feat[]
     */
    public function getActiveFeats(): Collection
    {
        return $this->feats->filter(function ($feat) {
            return $feat->isActive();
        });
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
    public function getFeaturesNote(): string
    {
        return self::HERITAGE_FEATURES_NOTE;
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

        if ($this->getHitPoints()) {
            $value += $this->getHitPoints()->getValue();
        }

        if ($this->getSpeed()) {
            $value += $this->getSpeed()->getValue();
        }

        return $value;
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