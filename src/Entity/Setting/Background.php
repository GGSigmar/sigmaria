<?php

namespace App\Entity\Setting;

use App\Entity\Core\Ability;
use App\Entity\Core\Feat;
use App\Entity\Core\Lore;
use App\Entity\Core\Skill;
use App\Entity\Core\Traits\BaseFieldsTrait;
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
    use BaseFieldsTrait, ReleasableTrait, TimestampableEntity;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Ability")
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
    private $additionalRules;

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
    public function getAdditionalRules(): ?string
    {
        return $this->additionalRules;
    }

    /**
     * @param string|null $additionalRules
     */
    public function setAdditionalRules(?string $additionalRules): void
    {
        $this->additionalRules = $additionalRules;
    }
}