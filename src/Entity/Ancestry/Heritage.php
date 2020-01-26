<?php

namespace App\Entity\Ancestry;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\ReleasableTrait;
use App\Entity\Core\Traits\SimpleRarityTrait;
use App\Entity\Core\Traits\ValueTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ancestry\HeritageRepository")
 * @ORM\Table(name="ancestry_heritage")
 */
class Heritage
{
    use BaseFieldsTrait, ValueTrait, SimpleRarityTrait, ReleasableTrait, TimestampableEntity;

    /**
     * @var Ancestry
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry\Ancestry", inversedBy="heritages")
     */
    private $ancestry;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Ancestry\AncestralFeature", inversedBy="ancestries", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="ancestry_heritage_ancestral_feature")
     */
    private $ancestralFeatures;

    public function __construct()
    {
        $this->isActive = false;
        $this->ancestralFeatures = new ArrayCollection();
    }

    /**
     * @return Ancestry|null
     */
    public function getAncestry(): ?Ancestry
    {
        return $this->ancestry;
    }

    /**
     * @param Ancestry $ancestry
     */
    public function setAncestry(Ancestry $ancestry): void
    {
        $this->ancestry = $ancestry;
    }

    /**
     * @return Collection|AncestralFeature[]
     */
    public function getAncestralFeatures(): Collection
    {
        return $this->ancestralFeatures;
    }

    /**
     * @return Collection|AncestralFeature[]
     */
    public function getActiveAncestralFeatures(): Collection
    {
        return $this->ancestralFeatures->filter(function ($ancestralFeature) {
            return $ancestralFeature->isActive();
        });
    }

    /**
     * @param AncestralFeature $ancestralFeature
     */
    public function addAncestralFeature(AncestralFeature $ancestralFeature): void
    {
        if (!$this->ancestralFeatures->contains($ancestralFeature)) {
            $this->ancestralFeatures->add($ancestralFeature);
        }

        return;
    }

    /**
     * @param AncestralFeature $ancestralFeature
     */
    public function removeAncestralFeature(AncestralFeature $ancestralFeature): void
    {
        if ($this->ancestralFeatures->contains($ancestralFeature)) {
            $this->ancestralFeatures->removeElement($ancestralFeature);
        }

        return;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        $value = 0;

        foreach ($this->getAncestralFeatures() as $ancestralFeature) {
            $value += $ancestralFeature->getValue();
        }

        return $value;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;

        if (!$isActive) {
            $this->isToBeReleased = false;
        }
    }
}