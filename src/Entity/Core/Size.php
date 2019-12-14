<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\SizeRepository")
 * @ORM\Table(name="core_size")
 */
class Size
{
    use BaseFieldsTrait;

    public const SIZE_SMALL = 'SIZE_SMALL';
    public const SIZE_MEDIUM = 'SIZE_MEDIUM';

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
}