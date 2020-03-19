<?php

namespace App\Entity\Core;

use App\Entity\Ancestry\Ancestry;
use App\Entity\Ancestry\Heritage;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\ReleasableTrait;
use App\Entity\Core\Traits\SimpleRarityTrait;
use App\Entity\Core\Traits\SourceTrait;
use App\Entity\Setting\Culture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\FeatRepository")
 * @ORM\Table(name="core_feat")
 */
class Feat
{
    use BaseFieldsTrait, SimpleRarityTrait, ReleasableTrait, SourceTrait, TimestampableEntity;

    /**
     * @var Actions
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Actions")
     */
    private $actions;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank
     * @Assert\GreaterThanOrEqual(value="0")
     * @Assert\LessThanOrEqual(value="20")
     */
    private $level = 0;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $prerequisites;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $frequency;

    /**
     * @var string|null
     *
     * @ORM\Column(name="`trigger`", type="string", nullable=true)
     */
    private $trigger;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $requirements;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $specialRules;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Attribute", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"name"="ASC"})
     * @ORM\JoinTable(name="core_feat_attribute")
     * @Assert\Count(min="1")
     */
    private $attributes;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Ancestry\Ancestry", mappedBy="feats", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"name"="ASC"})
     */
    private $ancestries;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Ancestry\Heritage", mappedBy="feats", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"name"="ASC"})
     */
    private $heritages;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Setting\Culture", mappedBy="feats", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"name"="ASC"})
     */
    private $cultures;

    public function __construct()
    {
        $this->isActive = false;
        $this->attributes = new ArrayCollection();
        $this->ancestries = new ArrayCollection();
        $this->heritages = new ArrayCollection();
        $this->cultures = new ArrayCollection();
    }

    /**
     * @return null|Actions
     */
    public function getActions(): ?Actions
    {
        return $this->actions;
    }

    /**
     * @param Actions|null $actions
     */
    public function setActions(?Actions $actions): void
    {
        $this->actions = $actions;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    /**
     * @return string|null
     */
    public function getPrerequisites(): ?string
    {
        return $this->prerequisites;
    }

    /**
     * @param string|null $prerequisites
     */
    public function setPrerequisites(?string $prerequisites): void
    {
        $this->prerequisites = $prerequisites;
    }

    /**
     * @return string|null
     */
    public function getFrequency(): ?string
    {
        return $this->frequency;
    }

    /**
     * @param string|null $frequency
     */
    public function setFrequency(?string $frequency): void
    {
        $this->frequency = $frequency;
    }

    /**
     * @return string|null
     */
    public function getTrigger(): ?string
    {
        return $this->trigger;
    }

    /**
     * @param string|null $trigger
     */
    public function setTrigger(?string $trigger): void
    {
        $this->trigger = $trigger;
    }

    /**
     * @return string|null
     */
    public function getRequirements(): ?string
    {
        return $this->requirements;
    }

    /**
     * @param string|null $requirements
     */
    public function setRequirements(?string $requirements): void
    {
        $this->requirements = $requirements;
    }

    /**
     * @return string|null
     */
    public function getSpecialRules(): ?string
    {
        return $this->specialRules;
    }

    /**
     * @param string|null $specialRules
     */
    public function setSpecialRules(?string $specialRules): void
    {
        $this->specialRules = $specialRules;
    }

    /**
     * @return Collection|Attribute[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
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
     * @return Collection|Ancestry[]
     */
    public function getAncestries(): Collection
    {
        return $this->ancestries;
    }

    /**
     * @return Collection|Ancestry[]
     */
    public function getActiveAncestries(): Collection
    {
        return $this->ancestries->filter(function ($feat) {
            return $feat->isActive();
        });
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
        return $this->heritages->filter(function ($feat) {
            return $feat->isActive();
        });
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
        return $this->cultures->filter(function ($feat) {
            return $feat->isActive();
        });
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