<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\ActiveTrait;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\ReleasableTrait;
use App\Entity\Core\Traits\SimpleRarityTrait;
use App\Entity\Core\Traits\SlugTrait;
use App\Entity\Core\Traits\SortOrderTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\LanguageRepository")
 * @ORM\Table(name="setting_language")
 */
class Language
{
    use BaseFieldsTrait, ActiveTrait, SlugTrait, DescriptionTrait, SimpleRarityTrait, ReleasableTrait, SortOrderTrait, TimestampableEntity;

    public const ENTITY_NAME = 'language';

    /**
     * @var Script
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Setting\Script")
     */
    private $script;

    public function __construct()
    {
        $this->isActive = false;
    }

    /**
     * @return null|Script
     */
    public function getScript(): ?Script
    {
        return $this->script;
    }

    /**
     * @param Script|null $script
     */
    public function setScript(?Script $script): void
    {
        $this->script = $script;
    }
}