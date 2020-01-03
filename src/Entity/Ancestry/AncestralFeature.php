<?php

namespace App\Entity\Ancestry;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\ValueTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ancestry\AncestralFeatureRepository")
 * @ORM\Table(name="ancestry_ancestral_feature")
 */
class AncestralFeature
{
    use BaseFieldsTrait, ValueTrait, TimestampableEntity;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Ancestry", mappedBy="ancestralFeatures")
     */
    private $ancestries;

    public function __construct()
    {
        $this->ancestries = new ArrayCollection();
    }

    /**
     * @return Collection|Ancestry[]
     */
    public function getAncestries(): Collection
    {
        return $this->ancestries;
    }

    /**
     * @param Ancestry $ancestry
     */
    public function addAncestry(Ancestry $ancestry): void
    {
        if (!$this->ancestries->contains($ancestry)) {
            $this->ancestries->add($ancestry);
            $ancestry->addAncestralFeature($this);
        }

        return;
    }

    /**
     * @param Ancestry $ancestry
     */
    public function removeAncestry(Ancestry $ancestry): void
    {
        if ($this->ancestries->contains($ancestry)) {
            $this->ancestries->removeElement($ancestry);
            $ancestry->removeAncestralFeature($this);
        }

        return;
    }
}
