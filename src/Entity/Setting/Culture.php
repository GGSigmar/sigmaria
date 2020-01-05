<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\ReleasableTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\CultureRepository")
 * @ORM\Table(name="setting_culture")
 */
class Culture
{
    use BaseFieldsTrait, ReleasableTrait, TimestampableEntity;
}