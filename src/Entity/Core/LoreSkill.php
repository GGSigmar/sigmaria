<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\LoreSkillRepository")
 * @ORM\Table(name="core_lore_skill")
 */
class LoreSkill
{
    use BaseFieldsTrait, TimestampableEntity;
}