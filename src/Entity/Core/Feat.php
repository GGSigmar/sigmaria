<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\RarityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\FeatRepository")
 * @ORM\Table(name="core_feat")
 */
class Feat
{
    use BaseFieldsTrait, RarityTrait;

    /**
     * @var Actions
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Actions")
     *
     * @Assert\NotBlank
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\CoreTrait")
     * @Assert\Count(min="1")
     */
    private $traits;

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->traits = new ArrayCollection();
    }

    /**
     * @return null|Actions
     */
    public function getActions(): ?Actions
    {
        return $this->actions;
    }

    /**
     * @param Actions $actions
     */
    public function setActions(Actions $actions): void
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
}