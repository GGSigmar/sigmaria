<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\ActiveTrait;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\ScriptRepository")
 * @ORM\Table(name="setting_script")
 */
class Script
{
    use BaseFieldsTrait, ActiveTrait, DescriptionTrait, TimestampableEntity;
}