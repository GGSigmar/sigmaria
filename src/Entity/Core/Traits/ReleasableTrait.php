<?php

namespace App\Entity\Core\Traits;

use App\Entity\Core\Release;
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
     * @var Release
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Release")
     */
    private $release;

    /**
     * @return bool
     */
    public function isToBeReleased(): bool
    {
        if (is_null($this->isToBeReleased)) {
            return false;
        }

        return $this->isToBeReleased;
    }

    /**
     * @param bool $isToBeReleased
     */
    public function setIsToBeReleased(bool $isToBeReleased): void
    {
        $this->isToBeReleased = $isToBeReleased;
    }

    /**
     * @return null|Release
     */
    public function getRelease(): ?Release
    {
        return $this->release;
    }

    /**
     * @param Release $release
     */
    public function setRelease(Release $release): void
    {
        $this->release = $release;
    }
}