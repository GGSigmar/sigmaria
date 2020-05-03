<?php

namespace App\Entity\Core\Interfaces;

use App\Entity\Core\Release;

interface ReleasableInterface
{
    public function isToBeReleased(): bool;

    public function setIsToBeReleased(bool $isToBeReleased): void;

    public function getRelease(): ?Release;

    public function setRelease(Release $release): void;
}