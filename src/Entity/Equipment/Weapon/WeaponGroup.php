<?php

namespace App\Entity\Equipment\Weapon;

use App\Entity\Base\Traits\BaseFieldsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Equipment\Weapon\WeaponGroupRepository")
 * @ORM\Table(name="weapon_group")
 */
class WeaponGroup
{
    use BaseFieldsTrait;

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
}