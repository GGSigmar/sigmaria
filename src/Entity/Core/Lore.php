<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\ActiveTrait;
use App\Entity\Core\Traits\BaseFieldsTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\LoreSkillRepository")
 * @ORM\Table(name="core_lore")
 */
class Lore extends BaseEntity
{
    use BaseFieldsTrait, ActiveTrait, TimestampableEntity;

    public const ENTITY_NAME = 'lore';

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isVersatile = false;

    /**
     * @return bool
     */
    public function isVersatile(): bool
    {
        return $this->isVersatile;
    }

    /**
     * @param bool $isVersatile
     */
    public function setIsVersatile(bool $isVersatile): void
    {
        $this->isVersatile = $isVersatile;
    }

    public function getLongName(): string
    {
        return $this->name . ' Lore';
    }

    public function __toString(): string
    {
        return $this->getLongName();
    }
}