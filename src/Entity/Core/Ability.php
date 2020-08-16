<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\HandleTrait;
use App\Entity\Core\Traits\SortOrderTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\AbilityRepository")
 * @ORM\Table(name="core_ability")
 */
class Ability
{
    use BaseFieldsTrait, HandleTrait, SortOrderTrait, TimestampableEntity;

    public const ABILITY_STRENGTH = 'ABILITY_STRENGTH';
    public const ABILITY_DEXTERITY = 'ABILITY_DEXTERITY';
    public const ABILITY_CONSTITUTION = 'ABILITY_CONSTITUTION';
    public const ABILITY_INTELLIGENCE = 'ABILITY_INTELLIGENCE';
    public const ABILITY_WISDOM = 'ABILITY_WISDOM';
    public const ABILITY_CHARISMA = 'ABILITY_CHARISMA';

    public const ABILITY_STRENGTH_ABBREVIATION = 'STR';
    public const ABILITY_DEXTERITY_ABBREVIATION = 'DEX';
    public const ABILITY_CONSTITUTION_ABBREVIATION = 'CON';
    public const ABILITY_INTELLIGENCE_ABBREVIATION = 'INT';
    public const ABILITY_WISDOM_ABBREVIATION = 'WIS';
    public const ABILITY_CHARISMA_ABBREVIATION = 'CHA';

    /**
     * @var string
     *
     * @ORM\Column(length=3)
     *
     * @Assert\Length(max=3)
     */
    private $abbreviation = '';

    /**
     * @return string
     */
    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    /**
     * @param string $abbreviation
     */
    public function setAbbreviation(string $abbreviation): void
    {
        $this->abbreviation = ucfirst($abbreviation);
    }
}