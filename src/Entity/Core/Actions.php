<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\ActionsRepository")
 * @ORM\Table(name="core_actions")
 */
class Actions
{
    use BaseFieldsTrait, TimestampableEntity;

    public const ACTIONS_ONE = 'ACTIONS_ONE';
    public const ACTIONS_TWO = 'ACTIONS_TWO';
    public const ACTIONS_THREE = 'ACTIONS_THREE';
    public const ACTIONS_REACTION = 'ACTIONS_REACTION';
    public const ACTIONS_FREE = 'ACTIONS_FREE';
}