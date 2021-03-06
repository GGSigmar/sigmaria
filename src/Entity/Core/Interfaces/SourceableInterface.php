<?php
declare(strict_types=1);

namespace App\Entity\Core\Interfaces;

use App\Entity\Core\EntitySource;

interface SourceableInterface
{
    public function getSource(): ?EntitySource;

    public function setSource(?EntitySource $source): void;
}