<?php

namespace App\Entity\Ancestry;

use App\Entity\Core\Ability;
use App\Entity\Core\Attribute;
use App\Entity\Core\MoveSpeed;
use App\Entity\Core\Size;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Setting\Culture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ancestry\AncestryRepository")
 * @ORM\Table(name="ancestry_ancestry")
 */
class Ancestry
{
    use BaseFieldsTrait, TimestampableEntity;

    public const ADDITIONAL_LANGUAGES_MESSAGE = '';

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
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Ability")
     * @ORM\JoinTable(name="ancestry_ancestry_ability_boost")
     * @Assert\Count(min="2", max="2")
     */
    private $abilityBoosts;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Setting\Culture")
     * @ORM\JoinTable(name="ancestry_ancestry_culture")
     */
    private $cultures;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Attribute")
     * @ORM\JoinTable(name="ancestry_ancestry_attribute")
     * @Assert\Count(min="1")
     */
    private $attributes;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Ancestry\AncestralFeature", inversedBy="ancestries")
     * @ORM\JoinTable(name="ancestry_ancestry_ancestral_feature")
     * @Assert\Count(min="1")
     */
    private $ancestralFeatures;

    public function __construct()
    {
        $this->abilityBoosts = new ArrayCollection();
        $this->cultures = new ArrayCollection();
        $this->attributes = new ArrayCollection();
        $this->ancestralFeatures = new ArrayCollection();
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
     * @param ArrayCollection $abilityBoosts
     */
    public function setAbilityBoosts(ArrayCollection $abilityBoosts): void
    {
        $this->abilityBoosts = $abilityBoosts;
    }

    /**
     * @return Collection|Culture[]
     */
    public function getCultures(): Collection
    {
        return $this->cultures;
    }

    /**
     * @param ArrayCollection $cultures
     */
    public function setCultures(ArrayCollection $cultures): void
    {
        $this->cultures = $cultures;
    }

    /**
     * @return Collection|Attribute[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    /**
     * @param ArrayCollection $attributes
     */
    public function setAttributes(ArrayCollection $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @return Collection|AncestralFeature[]
     */
    public function getAncestralFeatures(): Collection
    {
        return $this->ancestralFeatures;
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
     * @return string
     */
    public function getAbilityBoostNamesAsString(): string
    {
        return $this->getAbilityNamesAsString($this->getAbilityBoosts()->toArray());
    }

    public function getAttributesAsString(): string
    {
        $attributeNames = [];

        foreach ($this->getAttributes()->toArray() as $attribute)
        {
            $attributeNames[] = $attribute->getName();
        }

        return (implode(' <br> ', $attributeNames));
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

        if (count($this->getAttributes()->toArray()) > 1) {
            $value++;
        }

        return $value;
    }

    /**
     * @param array $abilities
     *
     * @return string
     */
    private function getAbilityNamesAsString(array $abilities)
    {
        $abilityNames = [];

        foreach ($abilities as $ability)
        {
            $abilityNames[] = $ability->getName();
        }

        return (implode(' lub ', $abilityNames));
    }
}