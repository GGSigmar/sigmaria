<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\ValueTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\MoveSpeedRepository")
 * @ORM\Table(name="core_move_speed")
 */
class MoveSpeed
{
    use BaseFieldsTrait, ValueTrait, TimestampableEntity;

    public const MOVE_SPEED_20 = 'MOVE_SPEED_20';
    public const MOVE_SPEED_25 = 'MOVE_SPEED_25';
    public const MOVE_SPEED_30 = 'MOVE_SPEED_30';
}