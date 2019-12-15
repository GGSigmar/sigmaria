<?php

namespace App\Entity\Ancestry;

use App\Entity\Core\MoveSpeed;
use App\Entity\Core\Size;
use App\Entity\Core\Traits\BaseFieldsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ancestry\AncestryRepository")
 * @ORM\Table(name="ancestry")
 */
class Ancestry
{
    use BaseFieldsTrait;

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
     * @ORM\JoinTable(name="ancestry_ability_boost")
     * @Assert\NotBlank
     */
    private $abilityBoosts;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Ability")
     * @ORM\JoinTable(name="ancestry_ability_flaw")
     * @Assert\NotBlank
     */
    private $abilityFlaws;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Setting\Language")
     * @Assert\NotBlank
     */
    private $languages;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\CoreTrait")
     * @Assert\NotBlank
     */
    private $traits;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Ancestry\AncestralFeature", inversedBy="ancestries")
     */
    private $ancestralFeatures;

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->abilityBoosts = new ArrayCollection();
        $this->abilityFlaws = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->traits = new ArrayCollection();
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
     * @return Collection
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
     * @return Collection
     */
    public function getAbilityFlaws(): Collection
    {
        return $this->abilityFlaws;
    }

    /**
     * @param ArrayCollection $abilityFlaws
     */
    public function setAbilityFlaws(ArrayCollection $abilityFlaws): void
    {
        $this->abilityFlaws = $abilityFlaws;
    }

    /**
     * @return Collection
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    /**
     * @param ArrayCollection $languages
     */
    public function setLanguages(ArrayCollection $languages): void
    {
        $this->languages = $languages;
    }

    /**
     * @return Collection
     */
    public function getTraits(): Collection
    {
        return $this->traits;
    }

    /**
     * @param ArrayCollection $traits
     */
    public function setTraits(ArrayCollection $traits): void
    {
        $this->traits = $traits;
    }

    /**
     * @return Collection
     */
    public function getAncestralFeatures(): Collection
    {
        return $this->ancestralFeatures;
    }

    /**
     * @param AncestralFeature $ancestralFeature
     *
     * @return Ancestry
     */
    public function addAncestralFeature(AncestralFeature $ancestralFeature): self
    {
        if (!$this->ancestralFeatures->contains($ancestralFeature)) {
            $this->ancestralFeatures->add($ancestralFeature);
            $ancestralFeature->addAncestry($this);
        }

        return $this;
    }

    /**
     * @param AncestralFeature $ancestralFeature
     *
     * @return Ancestry
     */
    public function removeAncestralFeature(AncestralFeature $ancestralFeature): self
    {
        if ($this->ancestralFeatures->contains($ancestralFeature)) {
            $this->ancestralFeatures->removeElement($ancestralFeature);
            $ancestralFeature->removeAncestry($this);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getAbilityBoostNamesAsString(): string
    {
        return $this->getAbilityNamesAsString($this->getAbilityBoosts()->toArray());
    }

    /**
     * @return string
     */
    public function getAbilityFlawNamesAsString(): string
    {
        return $this->getAbilityNamesAsString($this->getAbilityFlaws()->toArray());
    }

    public function getTraitsAsString(): string
    {
        $traitNames = [];

        foreach ($this->getTraits()->toArray() as $trait)
        {
            $traitNames[] = $trait->getName();
        }

        return (implode(' <br> ', $traitNames));
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        $value = 0;

        foreach ($this->getAncestralFeatures()->toArray() as $ancestralFeature) {
            $value += $ancestralFeature->getValue();
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