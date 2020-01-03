<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\AttributeCategoryRepository")
 * @ORM\Table(name="core_attribute_category")
 */
class AttributeCategory
{
    use BaseFieldsTrait, TimestampableEntity;

    public const TRAIT_CATEGORY_ANCESTRAL = 'TRAIT_CATEGORY_ANCESTRAL';
    public const TRAIT_CATEGORY_CLASS = 'TRAIT_CATEGORY_CLASS';
}