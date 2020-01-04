<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\BackgroundRepository")
 * @ORM\Table(name="setting_background")
 */
class Background
{
    use BaseFieldsTrait, TimestampableEntity;
}