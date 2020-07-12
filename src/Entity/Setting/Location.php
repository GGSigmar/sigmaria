<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\ActiveTrait;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\ParagraphsTrait;
use App\Entity\Core\Traits\ReleasableTrait;
use App\Entity\Core\Traits\SlugTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\LocationRepository")
 * @ORM\Table(name="setting_location")
 */
class Location
{
    use BaseFieldsTrait, ActiveTrait, DescriptionTrait, ParagraphsTrait, SlugTrait, ReleasableTrait, TimestampableEntity;

    public const ENTITY_NAME = 'location';

    /**
     * @var LocationType|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Setting\LocationType", inversedBy="locations")
     * @Assert\NotBlank
     */
    private $type;

    /**
     * @var Location|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Setting\Location", inversedBy="childrenLocation")
     */
    private $parentLocation;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Setting\Location", mappedBy="parentLocation", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"name"="ASC"})
     * @ORM\JoinTable(name="setting_location_parent_location")
     */
    private $childrenLocations;

    public function __construct()
    {
        $this->paragraphs = new ArrayCollection();
        $this->childrenLocations = new ArrayCollection();
    }

    /**
     * @return LocationType|null
     */
    public function getType(): ?LocationType
    {
        return $this->type;
    }

    /**
     * @param LocationType|null $type
     */
    public function setType(?LocationType $type): void
    {
        $this->type = $type;
    }

    /**
     * @return Location|null
     */
    public function getParentLocation(): ?Location
    {
        return $this->parentLocation;
    }

    /**
     * @param Location|null $parentLocation
     */
    public function setParentLocation(?Location $parentLocation): void
    {
        $this->parentLocation = $parentLocation;
    }

    /**
     * @return Collection|Location[]
     */
    public function getChildrenLocations(): Collection
    {
        return $this->childrenLocations;
    }

    /**
     * @param Location $location
     */
    public function addChildrenLocation(Location $location): void
    {
        if (!$this->childrenLocations->contains($location)) {
            $this->childrenLocations->add($location);
        }

        return;
    }

    /**
     * @param Location $location
     */
    public function removeChildrenLocation(Location $location): void
    {
        if ($this->childrenLocations->contains($location)) {
            $this->childrenLocations->removeElement($location);
        }

        return;
    }
}