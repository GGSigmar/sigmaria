<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\HandleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\AttributeCategoryRepository")
 * @ORM\Table(name="core_attribute_category")
 */
class AttributeCategory
{
    use BaseFieldsTrait, HandleTrait, TimestampableEntity;

    public const ATTRIBUTE_CATEGORY_GENERAL = 'ATTRIBUTE_CATEGORY_GENERAL';
    public const ATTRIBUTE_CATEGORY_ANCESTRAL = 'ATTRIBUTE_CATEGORY_ANCESTRAL';
    public const ATTRIBUTE_CATEGORY_CLASS = 'ATTRIBUTE_CATEGORY_CLASS';
    public const ATTRIBUTE_CATEGORY_CULTURAL = 'ATTRIBUTE_CATEGORY_CULTURAL';
    public const ATTRIBUTE_CATEGORY_HERITAGE = 'ATTRIBUTE_CATEGORY_HERITAGE';

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Core\Attribute", mappedBy="category")
     */
    private $attributes;

    /**
     * @return Collection|Attribute[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    /**
     * @param Attribute $attribute
     */
    public function addAttribute(Attribute $attribute): void
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes->add($attribute);
        }

        return;
    }

    /**
     * @param Attribute $attribute
     */
    public function removeAttribute(Attribute $attribute): void
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
        }

        return;
    }
}