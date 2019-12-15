<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\CoreTraitRepository")
 * @ORM\Table(name="core_trait")
 */
class CoreTrait
{
    use BaseFieldsTrait;

    /**
     * @var CoreTraitCategory
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\CoreTraitCategory")
     * @Assert\NotBlank
     */
    private $category;

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return null|CoreTraitCategory
     */
    public function getCategory(): ?CoreTraitCategory
    {
        return $this->category;
    }

    /**
     * @param CoreTraitCategory $category
     */
    public function setCategory(CoreTraitCategory $category): void
    {
        $this->category = $category;
    }
}