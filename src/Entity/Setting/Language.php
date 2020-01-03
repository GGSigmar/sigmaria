<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\LanguageRepository")
 * @ORM\Table(name="setting_language")
 */
class Language
{
    use BaseFieldsTrait, TimestampableEntity;

    public const LANGUAGE_COMMON = 'LANGUAGE_COMMON';
    public const LANGUAGE_ELVISH = 'LANGUAGE_ELVISH';
    public const LANGUAGE_DWARVISH = 'LANGUAGE_DWARVISH';
}