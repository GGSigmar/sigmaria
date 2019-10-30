<?php

namespace App\Entity\Ancestry;

use App\Entity\Base\Traits\BaseFieldsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ancestry\AncestryRepository")
 * @ORM\Table(name="ancestry")
 */
class Ancestry
{
    use BaseFieldsTrait;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255)
     */
    private $abilityScoreIncrease;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255)
     */
    private $age;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255)
     */
    private $alignment;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255)
     */
    private $size;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255)
     */
    private $speed;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255)
     */
    private $languages;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Ancestry\AncestralFeature", inversedBy="articles")
     */
    private $ancestralFeatures;

    public function __construct()
    {
        $this->isActive = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->ancestralFeatures = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getAbilityScoreIncrease(): ?string
    {
        return $this->abilityScoreIncrease;
    }

    /**
     * @param string|null $abilityScoreIncrease
     *
     * @return Ancestry
     */
    public function setAbilityScoreIncrease(?string $abilityScoreIncrease): self
    {
        $this->abilityScoreIncrease = $abilityScoreIncrease;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAge(): ?string
    {
        return $this->age;
    }

    /**
     * @param string|null $age
     *
     * @return Ancestry
     */
    public function setAge(?string $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAlignment(): ?string
    {
        return $this->alignment;
    }

    /**
     * @param string|null $alignment
     *
     * @return Ancestry
     */
    public function setAlignment(?string $alignment): self
    {
        $this->alignment = $alignment;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * @param string|null $size
     *
     * @return Ancestry
     */
    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSpeed(): ?string
    {
        return $this->speed;
    }

    /**
     * @param string|null $speed
     *
     * @return Ancestry
     */
    public function setSpeed(?string $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLanguages(): ?string
    {
        return $this->languages;
    }

    /**
     * @param string|null $languages
     *
     * @return Ancestry
     */
    public function setLanguages(?string $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAncestralFeatures(): Collection
    {
        return $this->ancestralFeatures;
    }

    /**
     * @param AncestralFeature $ancestralFeature
     *
     * @return Ancestry
     */
    public function addAncestralFeature(AncestralFeature $ancestralFeature): self
    {
        if (!$this->ancestralFeatures->contains($ancestralFeature)) {
            $this->ancestralFeatures->add($ancestralFeature);
            $ancestralFeature->addAncestry($this);
        }

        return $this;
    }

    /**
     * @param AncestralFeature $ancestralFeature
     *
     * @return Ancestry
     */
    public function removeAncestralFeature(AncestralFeature $ancestralFeature): self
    {
        if ($this->ancestralFeatures->contains($ancestralFeature)) {
            $this->ancestralFeatures->removeElement($ancestralFeature);
            $ancestralFeature->removeAncestry($this);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        $value = 0;

        foreach ($this->getAncestralFeatures()->toArray() as $ancestralFeature) {
            $value += $ancestralFeature->getValue();
        }

        return $value;
    }
}