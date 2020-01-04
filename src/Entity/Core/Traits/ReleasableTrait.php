<?php

namespace App\Entity\Core\Traits;

use Doctrine\ORM\Mapping as ORM;

trait ReleasableTrait
{
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isToBeReleased = false;

    /**
     * @return bool
     */
    public function isToBeReleased(): bool
    {
        return $this->isToBeReleased;
    }

    /**
     * @param bool $isToBeReleased
     */
    public function setIsToBeReleased(bool $isToBeReleased): void
    {
        $this->isToBeReleased = $isToBeReleased;
    }
}