<?php

namespace App\Entity\Setting;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\ParagraphsTrait;
use App\Entity\Core\Traits\SlugTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\LocationRepository")
 * @ORM\Table(name="setting_location")
 */
class Location
{
    use BaseFieldsTrait, DescriptionTrait, ParagraphsTrait, SlugTrait, TimestampableEntity;

    /**
     * @var LocationType
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Setting\LocationType", inversedBy="locations")
     * @Assert\NotBlank
     */
    private $type;

    /**
     * @var Location
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
     * @return LocationType
     */
    public function getType(): LocationType
    {
        return $this->type;
    }

    /**
     * @param LocationType $type
     */
    public function setType(LocationType $type): void
    {
        $this->type = $type;
    }

    /**
     * @return Location
     */
    public function getParentLocation(): Location
    {
        return $this->parentLocation;
    }

    /**
     * @param Location $parentLocation
     */
    public function setParentLocation(Location $parentLocation): void
    {
        $this->parentLocation = $parentLocation;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildrenLocations(): ArrayCollection
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