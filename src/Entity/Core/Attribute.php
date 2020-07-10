<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\ActiveTrait;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\HandleTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\AttributeRepository")
 * @ORM\Table(name="core_attribute")
 */
class Attribute
{
    use BaseFieldsTrait, ActiveTrait, HandleTrait, DescriptionTrait, TimestampableEntity;

    public const ATTRIBUTE_GENERAL = 'ATTRIBUTE_GENERAL';

    /**
     * @var AttributeCategory
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\AttributeCategory")
     * @Assert\NotBlank
     */
    private $category;

    /**
     * @return null|AttributeCategory
     */
    public function getCategory(): ?AttributeCategory
    {
        return $this->category;
    }

    /**
     * @param AttributeCategory $category
     */
    public function setCategory(AttributeCategory $category): void
    {
        $this->category = $category;
    }
}