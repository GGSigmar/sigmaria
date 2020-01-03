<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\AbilityRepository")
 * @ORM\Table(name="core_ability")
 */
class Ability
{
    use BaseFieldsTrait, TimestampableEntity;

    public const ABILITY_STRENGTH = 'ABILITY_STRENGTH';
    public const ABILITY_DEXTERITY = 'ABILITY_DEXTERITY';
    public const ABILITY_CONSTITUTION = 'ABILITY_CONSTITUTION';
    public const ABILITY_INTELLIGENCE = 'ABILITY_INTELLIGENCE';
    public const ABILITY_WISDOM = 'ABILITY_WISDOM';
    public const ABILITY_CHARISMA = 'ABILITY_CHARISMA';
}