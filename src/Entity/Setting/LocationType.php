<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\HandleTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\LocationTypeRepository")
 * @ORM\Table(name="setting_location_type")
 */
class LocationType
{
    use BaseFieldsTrait, HandleTrait, TimestampableEntity;
}