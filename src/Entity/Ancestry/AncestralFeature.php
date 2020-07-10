<?php

namespace App\Entity\Ancestry;

use App\Entity\Core\Traits\ActiveTrait;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
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
    use BaseFieldsTrait, ActiveTrait, DescriptionTrait, ValueTrait, TimestampableEntity;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Ancestry", mappedBy="ancestralFeatures", fetch="EXTRA_LAZY")
     */
    private $ancestries;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Heritage", mappedBy="ancestralFeatures", fetch="EXTRA_LAZY")
     */
    private $heritages;

    public function __construct()
    {
        $this->ancestries = new ArrayCollection();
        $this->heritages = new ArrayCollection();
    }

    /**
     * @return Collection|Ancestry[]
     */
    public function getAncestries(): Collection
    {
        return $this->ancestries;
    }

    /**
     * @return Collection|Ancestry[]
     */
    public function getActiveAncestries(): Collection
    {
        return $this->ancestries->filter(function ($ancestry) {
            return $ancestry->isActive();
        });
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

    /**
     * @return Collection|Heritage[]
     */
    public function getHeritages(): Collection
    {
        return $this->heritages;
    }

    /**
     * @return Collection|Heritage[]
     */
    public function getActiveHeritages(): Collection
    {
        return $this->heritages->filter(function ($heritage) {
            return $heritage->isActive();
        });
    }

    /**
     * @param Heritage $heritage
     */
    public function addHeritage(Heritage $heritage): void
    {
        if (!$this->heritages->contains($heritage)) {
            $this->heritages->add($heritage);
            $heritage->addAncestralFeature($this);
        }

        return;
    }

    /**
     * @param Heritage $heritage
     */
    public function removeHeritage(Heritage $heritage): void
    {
        if ($this->heritages->contains($heritage)) {
            $this->heritages->removeElement($heritage);
            $heritage->removeAncestralFeature($this);
        }

        return;
    }
}
