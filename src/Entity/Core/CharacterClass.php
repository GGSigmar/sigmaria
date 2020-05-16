<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\HandleTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\CharacterClassRepository")
 * @ORM\Table(name="core_character_class")
 */
class CharacterClass
{
    use BaseFieldsTrait, HandleTrait, TimestampableEntity;

    /* Core Rulebook Classes */
    public const CHARACTER_CLASS_ALCHEMIST = 'CHARACTER_CLASS_ALCHEMIST';
    public const CHARACTER_CLASS_BARBARIAN = 'CHARACTER_CLASS_BARBARIAN';
    public const CHARACTER_CLASS_BARD = 'CHARACTER_CLASS_BARD';
    public const CHARACTER_CLASS_CHAMPION = 'CHARACTER_CLASS_CHAMPION';
    public const CHARACTER_CLASS_CLERIC = 'CHARACTER_CLASS_CLERIC';
    public const CHARACTER_CLASS_DRUID = 'CHARACTER_CLASS_DRUID';
    public const CHARACTER_CLASS_FIGHTER = 'CHARACTER_CLASS_FIGHTER';
    public const CHARACTER_CLASS_MONK = 'CHARACTER_CLASS_MONK';
    public const CHARACTER_CLASS_RANGER = 'CHARACTER_CLASS_RANGER';
    public const CHARACTER_CLASS_ROGUE = 'CHARACTER_CLASS_ROGUE';
    public const CHARACTER_CLASS_SORCERER = 'CHARACTER_CLASS_SORCERER';
    public const CHARACTER_CLASS_WIZARD = 'CHARACTER_CLASS_WIZARD';

    /* Advanced Player's Guide Classes */
    public const CHARACTER_CLASS_INVESTIGATOR = 'CHARACTER_CLASS_INVESTIGATOR';
    public const CHARACTER_CLASS_ORACLE = 'CHARACTER_CLASS_ORACLE';
    public const CHARACTER_CLASS_SWASHBUCKLER = 'CHARACTER_CLASS_SWASHBUCKLER';
    public const CHARACTER_CLASS_WITCH = 'CHARACTER_CLASS_WITCH';
}