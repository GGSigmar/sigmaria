<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\SkillRepository")
 * @ORM\Table(name="core_skill")
 */
class Skill
{
    use BaseFieldsTrait, TimestampableEntity;

    public const SKILL_ACROBATICS = 'SKILL_ACROBATICS';
    public const SKILL_ARCANA = 'SKILL_ARCANA';
    public const SKILL_ATHLETICS = 'SKILL_ATHLETICS';
    public const SKILL_CRAFTING = 'SKILL_CRAFTING';
    public const SKILL_DECEPTION = 'SKILL_DECEPTION';
    public const SKILL_DIPLOMACY = 'SKILL_DIPLOMACY';
    public const SKILL_INTIMIDATION = 'SKILL_INTIMIDATION';
    public const SKILL_MEDICINE = 'SKILL_MEDICINE';
    public const SKILL_NATURE = 'SKILL_NATURE';
    public const SKILL_OCCULTISM = 'SKILL_OCCULTISM';
    public const SKILL_PERFORMANCE = 'SKILL_PERFORMANCE';
    public const SKILL_RELIGION = 'SKILL_RELIGION';
    public const SKILL_SOCIETY = 'SKILL_SOCIETY';
    public const SKILL_STEALTH = 'SKILL_STEALTH';
    public const SKILL_SURVIVAL = 'SKILL_SURVIVAL';
    public const SKILL_THIEVERY = 'SKILL_THIEVERY';

    /**
     * @var Ability
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Ability")
     * @Assert\NotBlank
     */
    private $ability;

    /**
     * @return null|Ability
     */
    public function getAbility(): ?Ability
    {
        return $this->ability;
    }

    /**
     * @param Ability $ability
     */
    public function setAbility(Ability $ability): void
    {
        $this->ability = $ability;
    }
}