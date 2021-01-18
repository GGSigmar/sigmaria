<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\SlugTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\ReleaseRepository")
 * @ORM\Table(name="core_release")
 */
class Release extends BaseEntity
{
    use SlugTrait, TimestampableEntity;

    public const ENTITY_NAME = 'release';

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(length=80)
     *
     * @Assert\NotBlank
     * @Assert\Length(max=80)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(length=20)
     *
     * @Assert\NotBlank
     * @Assert\Length(max=20)
     */
    private $contentVersion = '';

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $contentChangesNote = '';


    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $launchDate = null;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Core\Feat", mappedBy="release")
     * @ORM\OrderBy({"name"="ASC"})
     */
    private $feats;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Feat", inversedBy="updateReleases")
     * @ORM\JoinTable(name="core_feat_update_release")
     * @ORM\OrderBy({"name"="ASC"})
     */
    private $updatedFeats;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Ancestry\Ancestry", mappedBy="release")
     * @ORM\OrderBy({"name"="ASC"})
     */
    private $ancestries;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Ancestry\Heritage", mappedBy="release")
     * @ORM\OrderBy({"name"="ASC"})
     */
    private $heritages;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Setting\Culture", mappedBy="release")
     * @ORM\OrderBy({"name"="ASC"})
     */
    private $cultures;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Setting\Background", mappedBy="release")
     * @ORM\OrderBy({"name"="ASC"})
     */
    private $backgrounds;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Setting\Language", mappedBy="release")
     * @ORM\OrderBy({"name"="ASC"})
     */
    private $languages;

    public function __construct()
    {
        $this->feats = new ArrayCollection();
        $this->updatedFeats = new ArrayCollection();
        $this->ancestries = new ArrayCollection();
        $this->heritages = new ArrayCollection();
        $this->cultures = new ArrayCollection();
        $this->backgrounds = new ArrayCollection();
        $this->languages = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = ucfirst($name);
    }

    /**
     * @return string
     */
    public function getContentVersion(): string
    {
        return $this->contentVersion;
    }

    /**
     * @param string $contentVersion
     */
    public function setContentVersion(string $contentVersion): void
    {
        $this->contentVersion = $contentVersion;
    }

    /**
     * @return string|null
     */
    public function getContentChangesNote(): ?string
    {
        return $this->contentChangesNote;
    }

    /**
     * @param string|null $contentChangesNote
     */
    public function setContentChangesNote(?string $contentChangesNote): void
    {
        $this->contentChangesNote = $contentChangesNote;
    }

    /**
     * @return \DateTime|null
     */
    public function getLaunchDate(): ?\DateTime
    {
        return $this->launchDate;
    }

    /**
     * @param \DateTime|null $launchDate
     */
    public function setLaunchDate(?\DateTime $launchDate): void
    {
        $this->launchDate = $launchDate;
    }

    /**
     * @return Collection
     */
    public function getFeats(): Collection
    {
        return $this->feats;
    }

    /**
     * @param Collection $feats
     */
    public function setFeats(Collection $feats): void
    {
        $this->feats = $feats;
    }

    /**
     * @return Collection
     */
    public function getUpdatedFeats(): Collection
    {
        return $this->updatedFeats;
    }

    /**
     * @param Collection $updatedFeats
     */
    public function setUpdatedFeats(Collection $updatedFeats): void
    {
        $this->updatedFeats = $updatedFeats;
    }

    /**
     * @return Collection
     */
    public function getAncestries(): Collection
    {
        return $this->ancestries;
    }

    /**
     * @param Collection $ancestries
     */
    public function setAncestries(Collection $ancestries): void
    {
        $this->ancestries = $ancestries;
    }

    /**
     * @return Collection
     */
    public function getHeritages(): Collection
    {
        return $this->heritages;
    }

    /**
     * @param Collection $heritages
     */
    public function setHeritages(Collection $heritages): void
    {
        $this->heritages = $heritages;
    }

    /**
     * @return Collection
     */
    public function getCultures(): Collection
    {
        return $this->cultures;
    }

    /**
     * @param Collection $cultures
     */
    public function setCultures(Collection $cultures): void
    {
        $this->cultures = $cultures;
    }

    /**
     * @return Collection
     */
    public function getBackgrounds(): Collection
    {
        return $this->backgrounds;
    }

    /**
     * @param Collection $backgrounds
     */
    public function setBackgrounds(Collection $backgrounds): void
    {
        $this->backgrounds = $backgrounds;
    }

    /**
     * @return Collection
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    /**
     * @param Collection $languages
     */
    public function setLanguages(Collection $languages): void
    {
        $this->languages = $languages;
    }

    public function __toString()
    {
        return sprintf('%s (%s)', $this->getName(), $this->getContentVersion());
    }

    public function isNewContentEmpty(): bool
    {
        if (
            $this->ancestries->isEmpty()
            && $this->heritages->isEmpty()
            && $this->cultures->isEmpty()
            && $this->feats->isEmpty()
            && $this->backgrounds->isEmpty()
            && $this->languages->isEmpty()
        ) {
            return true;
        }

        return false;
    }

    public function isUpdatedContentEmpty(): bool
    {
        return $this->updatedFeats->isEmpty();
    }
}