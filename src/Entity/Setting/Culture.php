<?php

namespace App\Entity\Setting;

use App\Entity\Ancestry\Ancestry;
use App\Entity\Core\CharacterClass;
use App\Entity\Core\Feat;
use App\Entity\Core\Traits\ActiveTrait;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\ParagraphsTrait;
use App\Entity\Core\Traits\ReleasableTrait;
use App\Entity\Core\Traits\SlugTrait;
use App\Service\Core\UtilityService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Setting\CultureRepository")
 * @ORM\Table(name="setting_culture")
 */
class Culture
{
    use BaseFieldsTrait, ActiveTrait, SlugTrait, DescriptionTrait, ParagraphsTrait, ReleasableTrait, TimestampableEntity;

    public const ENTITY_NAME = 'culture';

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Ancestry\Ancestry", inversedBy="commonAncestries", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="setting_culture_ancestry")
     * @Assert\Count(min="1")
     */
    private $commonAncestries;
    
    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\CharacterClass", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="setting_culture_character_class")
     * @Assert\Count(min="1")
     */
    private $commonClasses;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Setting\Background", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="setting_culture_background")
     */
    private $commonBackgrounds;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Setting\Language", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="setting_culture_language")
     * @ORM\OrderBy({"sortOrder"="ASC", "name"="ASC"})
     */
    private $commonLanguages;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Feat", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"level"="ASC"})
     * @ORM\JoinTable(name="setting_culture_feat")
     */
    private $feats;

    public function __construct()
    {
        $this->isActive = false;
        $this->commonAncestries = new ArrayCollection();
        $this->commonClasses = new ArrayCollection();
        $this->commonBackgrounds = new ArrayCollection();
        $this->commonLanguages = new ArrayCollection();
        $this->feats = new ArrayCollection();
    }

    /**
     * @return Collection|Ancestry[]
     */
    public function getCommonAncestries(): Collection
    {
        return $this->commonAncestries;
    }

    /**
     * @return Collection|Ancestry[]
     */
    public function getActiveCommonAncestries(): Collection
    {
        return $this->commonAncestries->filter(function ($entity) {
            return $entity->isActive();
        });
    }

    /**
     * @param Ancestry $ancestry
     */
    public function addCommonAncestry(Ancestry $ancestry): void
    {
        if (!$this->commonAncestries->contains($ancestry)) {
            $this->commonAncestries->add($ancestry);
            $ancestry->addCulture($this);
        }

        return;
    }

    /**
     * @param Ancestry $ancestry
     */
    public function removeCommonAncestry(Ancestry $ancestry): void
    {
        if ($this->commonAncestries->contains($ancestry)) {
            $this->commonAncestries->removeElement($ancestry);
            $ancestry->removeCulture($this);
        }

        return;
    }

    /**
     * @return Collection|CharacterClass[]
     */
    public function getCommonClasses(): Collection
    {
        return $this->commonClasses;
    }

    /**
     * @param CharacterClass $class
     */
    public function addCommonClass(CharacterClass $class): void
    {
        if (!$this->commonClasses->contains($class)) {
            $this->commonClasses->add($class);
        }

        return;
    }

    /**
     * @param CharacterClass $class
     */
    public function removeCommonClass(CharacterClass $class): void
    {
        if ($this->commonClasses->contains($class)) {
            $this->commonClasses->removeElement($class);
        }

        return;
    }

    /**
     * @return Collection|Background[]
     */
    public function getCommonBackgrounds(): Collection
    {
        return $this->commonBackgrounds;
    }

    /**
     * @return Collection|Background[]
     */
    public function getActiveCommonBackgrounds(): Collection
    {
        return $this->commonBackgrounds->filter(function ($entity) {
            return $entity->isActive();
        });
    }

    /**
     * @param Background $background
     */
    public function addCommonBackground(Background $background): void
    {
        if (!$this->commonBackgrounds->contains($background)) {
            $this->commonBackgrounds->add($background);
        }

        return;
    }

    /**
     * @param Background $background
     */
    public function removeCommonBackground(Background $background): void
    {
        if ($this->commonBackgrounds->contains($background)) {
            $this->commonBackgrounds->removeElement($background);
        }

        return;
    }

    /**
     * @return Collection|Language[]
     */
    public function getCommonLanguages(): Collection
    {
        return $this->commonLanguages;
    }

    /**
     * @return Collection|Language[]
     */
    public function getActiveCommonLanguages(): Collection
    {
        return $this->commonLanguages->filter(function ($entity) {
            return $entity->isActive();
        });
    }

    /**
     * @param Language $language
     */
    public function addCommonLanguage(Language $language): void
    {
        if (!$this->commonLanguages->contains($language)) {
            $this->commonLanguages->add($language);
        }

        return;
    }

    /**
     * @param Language $language
     */
    public function removeCommonLanguage(Language $language): void
    {
        if ($this->commonLanguages->contains($language)) {
            $this->commonLanguages->removeElement($language);
        }

        return;
    }

    /**
     * @return Collection|Feat[]
     */
    public function getFeats(): Collection
    {
        return $this->feats;
    }

    /**
     * @return array|Feat[]
     */
    public function getGroupedFeats(): array
    {
        return UtilityService::groupFeatsByLevel($this->feats);
    }

    /**
     * @return array|Feat[]
     */
    public function getActiveFeats(): array
    {
        return $this->getActiveGroupedFeats();
    }

    /**
     * @return array|Feat[]
     */
    public function getActiveGroupedFeats(): array
    {
        return UtilityService::groupFeatsByLevel(
            $this->feats->filter(function ($feat) {
                return $feat->isActive();
            })
        );
    }

    /**
     * @param Feat $feat
     */
    public function addFeat(Feat $feat): void
    {
        if (!$this->feats->contains($feat)) {
            $this->feats->add($feat);
        }

        return;
    }

    /**
     * @param Feat $feat
     */
    public function removeFeat(Feat $feat): void
    {
        if ($this->feats->contains($feat)) {
            $this->feats->removeElement($feat);
        }

        return;
    }
}