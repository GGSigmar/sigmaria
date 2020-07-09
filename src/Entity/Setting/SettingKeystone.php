<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\SortOrderTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\SettingKeystoneRepository")
 * @ORM\Table(name="setting_keystone")
 */
class SettingKeystone
{
    use BaseFieldsTrait, DescriptionTrait, SortOrderTrait, TimestampableEntity;

    public const ENTITY_NAME = 'setting_keystone';
}