<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\ActiveTrait;
use App\Entity\Core\Traits\BaseFieldsTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\LoreSkillRepository")
 * @ORM\Table(name="core_lore")
 */
class Lore extends BaseEntity
{
    use BaseFieldsTrait, ActiveTrait, TimestampableEntity;

    public const ENTITY_NAME = 'lore';
}