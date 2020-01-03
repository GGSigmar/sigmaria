<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\SizeRepository")
 * @ORM\Table(name="core_size")
 */
class Size
{
    use BaseFieldsTrait, TimestampableEntity;

    public const SIZE_TINY = 'SIZE_TINY';
    public const SIZE_SMALL = 'SIZE_SMALL';
    public const SIZE_MEDIUM = 'SIZE_MEDIUM';
    public const SIZE_LARGE = 'SIZE_LARGE';
    public const SIZE_HUGE = 'SIZE_HUGE';
    public const SIZE_GARGANTUAN = 'SIZE_GARGANTUAN';

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isPlayerCharacterSize = false;

    /**
     * @return bool
     */
    public function isPlayerCharacterSize(): bool
    {
        return $this->isPlayerCharacterSize;
    }

    /**
     * @param bool $isPlayerCharacterSize
     */
    public function setIsPlayerCharacterSize(bool $isPlayerCharacterSize): void
    {
        $this->isPlayerCharacterSize = $isPlayerCharacterSize;
    }
}