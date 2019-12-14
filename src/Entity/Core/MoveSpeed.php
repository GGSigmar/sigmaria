<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\ValueTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\MoveSpeedRepository")
 * @ORM\Table(name="core_move_speed")
 */
class MoveSpeed
{
    use BaseFieldsTrait, ValueTrait;

    public const MOVE_SPEED_20 = 'MOVE_SPEED_20';
    public const MOVE_SPEED_25 = 'MOVE_SPEED_25';
    public const MOVE_SPEED_30 = 'MOVE_SPEED_30';

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
}