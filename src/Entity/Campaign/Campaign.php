<?php

namespace App\Entity\Campaign;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\SlugTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Campaign\CampaignRepository")
 * @ORM\Table(name="campaign_campaign")
 */
class Campaign
{
    use BaseFieldsTrait, SlugTrait, DescriptionTrait, TimestampableEntity;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Campaign\PlayerCharacter", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="campaign_campaign_player_character")
     */
    private $playerCharacters;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank
     * @Assert\Range(min=0, max=20)
     */
    private $currentLevel;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Campaign\Session", mappedBy="campaign", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"number"="ASC"})
     * @ORM\JoinTable(name="campagin_campagin_session")
     */
    private $sessions;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Campaign\Quest", mappedBy="campaign", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"name"="ASC"})
     * @ORM\JoinTable(name="campagin_campagin_quest")
     */
    private $quests;

    public function __construct()
    {
        $this->playerCharacters = new ArrayCollection();
        $this->sessions = new ArrayCollection();
        $this->quests = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getPlayerCharacters(): ArrayCollection
    {
        return $this->playerCharacters;
    }

    /**
     * @param PlayerCharacter $playerCharacter
     */
    public function addPlayerCharacter(PlayerCharacter $playerCharacter): void
    {
        if (!$this->playerCharacters->contains($playerCharacter)) {
            $this->playerCharacters->add($playerCharacter);
        }

        return;
    }

    /**
     * @param PlayerCharacter $playerCharacter
     */
    public function removePlayerCharacter(PlayerCharacter $playerCharacter): void
    {
        if ($this->playerCharacters->contains($playerCharacter)) {
            $this->playerCharacters->removeElement($playerCharacter);
        }

        return;
    }

    /**
     * @return int
     */
    public function getCurrentLevel(): int
    {
        return $this->currentLevel;
    }

    /**
     * @param int $currentLevel
     */
    public function setCurrentLevel(int $currentLevel): void
    {
        $this->currentLevel = $currentLevel;
    }

    /**
     * @return ArrayCollection
     */
    public function getSessions(): ArrayCollection
    {
        return $this->sessions;
    }

    /**
     * @param Session $session
     */
    public function addSession(Session $session): void
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
        }

        return;
    }

    /**
     * @param Session $session
     */
    public function removeSession(Session $session): void
    {
        if ($this->sessions->contains($session)) {
            $this->sessions->removeElement($session);
        }

        return;
    }

    /**
     * @return ArrayCollection
     */
    public function getQuests(): ArrayCollection
    {
        return $this->quests;
    }

    /**
     * @param Quest $quest
     */
    public function addQuest(Quest $quest): void
    {
        if (!$this->quests->contains($quest)) {
            $this->quests->add($quest);
        }

        return;
    }

    /**
     * @param Quest $quest
     */
    public function removeQuest(Quest $quest): void
    {
        if ($this->quests->contains($quest)) {
            $this->quests->removeElement($quest);
        }

        return;
    }
}