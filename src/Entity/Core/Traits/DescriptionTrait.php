<?php


namespace App\Entity\Core\Traits;

use Doctrine\ORM\Mapping as ORM;

trait DescriptionTrait
{
    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = ucfirst($description);
    }
}