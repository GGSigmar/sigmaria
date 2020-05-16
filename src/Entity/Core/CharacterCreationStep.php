<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\HandleTrait;
use App\Entity\Core\Traits\SortOrderTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\CharacterCreationStepRepository")
 * @ORM\Table(name="core_character_creation_step")
 */
class CharacterCreationStep
{
    use BaseFieldsTrait, HandleTrait, DescriptionTrait, SortOrderTrait, TimestampableEntity;

    public const ENTITY_NAME = 'character_creation_step';

    public const CHARACTER_CREATION_STEP_CONCEPT = 'CHARACTER_CREATION_STEP_CONCEPT';
    public const CHARACTER_CREATION_STEP_INITIAL_ABILITY_SCORES = 'CHARACTER_CREATION_STEP_INITIAL_ABILITY_SCORES';
    public const CHARACTER_CREATION_STEP_ANCESTRY = 'CHARACTER_CREATION_STEP_ANCESTRY';
    public const CHARACTER_CREATION_STEP_BACKGROUND = 'CHARACTER_CREATION_STEP_BACKGROUND';
    public const CHARACTER_CREATION_STEP_CLASS = 'CHARACTER_CREATION_STEP_CLASS';
    public const CHARACTER_CREATION_STEP_ABILITY_SCORES = 'CHARACTER_CREATION_STEP_ABILITY_SCORES';
    public const CHARACTER_CREATION_STEP_CLASS_DETAILS = 'CHARACTER_CREATION_STEP_CLASS_DETAILS';
    public const CHARACTER_CREATION_STEP_EQUIPMENT = 'CHARACTER_CREATION_STEP_EQUIPMENT';
    public const CHARACTER_CREATION_STEP_MODIFIERS = 'CHARACTER_CREATION_STEP_MODIFIERS';
    public const CHARACTER_CREATION_STEP_FINISH = 'CHARACTER_CREATION_STEP_FINISH';
}