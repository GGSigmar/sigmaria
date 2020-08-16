<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\ActiveTrait;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\SortOrderTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\SettingFoundationRepository")
 * @ORM\Table(name="setting_foundation")
 */
class SettingFoundation
{
    use BaseFieldsTrait, ActiveTrait, DescriptionTrait, SortOrderTrait, TimestampableEntity;

    public const ENTITY_NAME = 'setting_foundation';
}