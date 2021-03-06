<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\ActiveTrait;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\HandleTrait;
use App\Entity\Core\Traits\SortOrderTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\SourceRepository")
 * @ORM\Table(name="core_source")
 */
class Source extends BaseEntity
{
    use BaseFieldsTrait, ActiveTrait, HandleTrait, DescriptionTrait, SortOrderTrait, TimestampableEntity;

    public const ENTITY_NAME = 'source';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=120)
     *
     * @Assert\Length(max=255)
     */
    private $sourceProductLink = '';

    /**
     * @return string|null
     */
    public function getCopyrightNotice(): ?string
    {
        return $this->getDescription();
    }

    /**
     * @return string|null
     */
    public function getSourceProductLink(): ?string
    {
        return $this->sourceProductLink;
    }

    /**
     * @param string $sourceProductLink
     */
    public function setSourceProductLink(string $sourceProductLink): void
    {
        $this->sourceProductLink = $sourceProductLink;
    }

    /**
     * @return string|null
     */
    public function getProductLink(): ?string
    {
        return $this->getSourceProductLink();
    }
}