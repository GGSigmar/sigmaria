<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\HandleTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\RarityRepository")
 * @ORM\Table(name="core_rarity")
 */
class Rarity
{
    use BaseFieldsTrait, HandleTrait, DescriptionTrait, TimestampableEntity;

    public const RARITY_COMMON = 'RARITY_COMMON';
    public const RARITY_UNCOMMON = 'RARITY_UNCOMMON';
    public const RARITY_RARE = 'RARITY_RARE';
    public const RARITY_UNIQUE = 'RARITY_UNIQUE';
}