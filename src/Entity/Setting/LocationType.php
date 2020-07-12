<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\HandleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\LocationTypeRepository")
 * @ORM\Table(name="setting_location_type")
 */
class LocationType
{
    use BaseFieldsTrait, HandleTrait, TimestampableEntity;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Setting\Location", mappedBy="type")
     */
    private $locations;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    /**
     * @return Collection|Location[]
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    /**
     * @param Location $location
     */
    public function addLocation(Location $location): void
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
        }

        return;
    }

    /**
     * @param Location $location
     */
    public function removeLocation(Location $location): void
    {
        if ($this->locations->contains($location)) {
            $this->locations->removeElement($location);
        }

        return;
    }
}