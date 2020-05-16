<?php

namespace App\Entity\Setting;

use App\Entity\Core\Ability;
use App\Entity\Core\Feat;
use App\Entity\Core\Lore;
use App\Entity\Core\Skill;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\ReleasableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\BackgroundRepository")
 * @ORM\Table(name="setting_background")
 */
class Background
{
    use BaseFieldsTrait, DescriptionTrait, ReleasableTrait, TimestampableEntity;

    public const ENTITY_NAME = 'background';

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Ability", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="setting_background_ability_boost")
     * @Assert\Count(min="2", max="2")
     */
    private $abilityBoosts;

    /**
     * @var Skill
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Skill")
     */
    private $trainedSkill;

    /**
     * @var Lore
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Lore")
     */
    private $trainedLore;

    /**
     * @var Feat
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Feat")
     */
    private $feat;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $atypicalAbilityBoosts;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $atypicalRules;

    public function __construct()
    {
        $this->isActive = false;
        $this->abilityBoosts = new ArrayCollection();
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
     * @return null|Skill
     */
    public function getTrainedSkill(): ?Skill
    {
        return $this->trainedSkill;
    }

    /**
     * @param Skill $trainedSkill
     */
    public function setTrainedSkill(Skill $trainedSkill): void
    {
        $this->trainedSkill = $trainedSkill;
    }

    /**
     * @return null|Lore
     */
    public function getTrainedLore(): ?Lore
    {
        return $this->trainedLore;
    }

    /**
     * @param Lore $trainedLore
     */
    public function setTrainedLore(Lore $trainedLore): void
    {
        $this->trainedLore = $trainedLore;
    }

    /**
     * @return null|Feat
     */
    public function getFeat(): ?Feat
    {
        return $this->feat;
    }

    /**
     * @param Feat $feat
     */
    public function setFeat(Feat $feat): void
    {
        $this->feat = $feat;
    }

    /**
     * @return string|null
     */
    public function getAtypicalAbilityBoosts(): ?string
    {
        return $this->atypicalAbilityBoosts;
    }

    /**
     * @param string|null $atypicalAbilityBoosts
     */
    public function setAtypicalAbilityBoosts(?string $atypicalAbilityBoosts): void
    {
        $this->atypicalAbilityBoosts = $atypicalAbilityBoosts;
    }

    /**
     * @return string|null
     */
    public function getAtypicalRules(): ?string
    {
        return $this->atypicalRules;
    }

    /**
     * @param string|null $atypicalRules
     */
    public function setAtypicalRules(?string $atypicalRules): void
    {
        $this->atypicalRules = $atypicalRules;
    }
    
    
}