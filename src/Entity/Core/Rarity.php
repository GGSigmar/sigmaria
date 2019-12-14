<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\RarityRepository")
 * @ORM\Table(name="core_rarity")
 */
class Rarity
{
    use BaseFieldsTrait;

    public const RARITY_COMMON = 'RARITY_COMMON';
    public const RARITY_UNCOMMON = 'RARITY_UNCOMMON';
    public const RARITY_RARE = 'RARITY_RARE';
    public const RARITY_UNIQUE = 'RARITY_UNIQUE';

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
}