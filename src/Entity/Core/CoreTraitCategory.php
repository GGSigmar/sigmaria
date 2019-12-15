<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\CoreTraitCategoryRepository")
 * @ORM\Table(name="core_trait_category")
 */
class CoreTraitCategory
{
    use BaseFieldsTrait;

    public const TRAIT_CATEGORY_ANCESTRAL = 'TRAIT_CATEGORY_ANCESTRAL';
    public const TRAIT_CATEGORY_CLASS = 'TRAIT_CATEGORY_CLASS';

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
}