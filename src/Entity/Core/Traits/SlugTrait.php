<?php

namespace App\Entity\Core\Traits;

use Gedmo\Mapping\Annotation as Gedmo;

trait SlugTrait
{
    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=false)
     */
    private $slug;

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }
}