<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\ParagraphsTrait;
use App\Entity\Core\Traits\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\LocationRepository")
 * @ORM\Table(name="setting_location")
 */
class Location
{
    use BaseFieldsTrait, DescriptionTrait, ParagraphsTrait, SlugTrait, TimestampableEntity;
}