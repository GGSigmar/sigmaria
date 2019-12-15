<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\LanguageRepository")
 * @ORM\Table(name="setting_language")
 */
class Language
{
    use BaseFieldsTrait;

    public const LANGUAGE_COMMON = 'LANGUAGE_COMMON';
    public const LANGUAGE_ELVISH = 'LANGUAGE_ELVISH';
    public const LANGUAGE_DWARVISH = 'LANGUAGE_DWARVISH';

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
}