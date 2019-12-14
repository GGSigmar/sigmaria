<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\BaseFieldsTrait;

class Language
{
    use BaseFieldsTrait;

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
}