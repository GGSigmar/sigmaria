<?php

namespace App\Entity\Ancestry;

use App\Entity\Base\Traits\BaseFieldsTrait;
use App\Entity\Base\Traits\ValueTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ancestry\AncestralFeatureRepository")
 * @ORM\Table(name="ancestral_feature")
 */
class AncestralFeature
{
    use BaseFieldsTrait, ValueTrait;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Ancestry", mappedBy="ancestralFeatures")
     */
    private $ancestries;

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->ancestries = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getAncestries(): Collection
    {
        return $this->ancestries;
    }

    /**
     * @param Ancestry $ancestry
     *
     * @return AncestralFeature
     */
    public function addAncestry(Ancestry $ancestry): self
    {
        if (!$this->ancestries->contains($ancestry)) {
            $this->ancestries->add($ancestry);
        }

        return $this;
    }

    /**
     * @param Ancestry $ancestry
     *
     * @return AncestralFeature
     */
    public function removeAncestry(Ancestry $ancestry): self
    {
        if ($this->ancestries->contains($ancestry)) {
            $this->ancestries->removeElement($ancestry);
        }

        return $this;
    }
}
