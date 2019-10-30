<?php

namespace App\Entity\Equipment\Weapon;

use App\Entity\Base\Traits\BaseFieldsTrait;
use App\Entity\Base\Traits\ValueTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Equipment\Weapon\WeaponPropertyRepository")
 * @ORM\Table(name="WeaponProperty")
 */
class WeaponProperty
{
    use BaseFieldsTrait, ValueTrait;

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
}