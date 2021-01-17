<?php

namespace App\Entity\Campaign;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Setting\Location;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Campaign\QuestRepository")
 * @ORM\Table(name="campaign_quest")
 */
class Quest
{
    use BaseFieldsTrait, DescriptionTrait, TimestampableEntity;

    /**
     * @var Campaign
     *
     * @ORM\ManyToOne(targetEntity="Campaign", inversedBy="quests")
     * @Assert\NotBlank
     */
    private $campaign;

    /**
     * @var Location
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Setting\Location")
     * @Assert\NotBlank
     */
    private $location;

    // $questgiver

    /**
     * @var QuestStatus
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Campaign\QuestStatus")
     * @Assert\NotBlank
     */
    private $questStatus;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $reward;

    /**
     * @return Campaign
     */
    public function getCampaign(): Campaign
    {
        return $this->campaign;
    }

    /**
     * @param Campaign $campaign
     */
    public function setCampaign(Campaign $campaign): void
    {
        $this->campaign = $campaign;
    }

    /**
     * @return Location
     */
    public function getLocation(): Location
    {
        return $this->location;
    }

    /**
     * @param Location $location
     */
    public function setLocation(Location $location): void
    {
        $this->location = $location;
    }

    /**
     * @return QuestStatus
     */
    public function getQuestStatus(): QuestStatus
    {
        return $this->questStatus;
    }

    /**
     * @param QuestStatus $questStatus
     */
    public function setQuestStatus(QuestStatus $questStatus): void
    {
        $this->questStatus = $questStatus;
    }

    /**
     * @return string|null
     */
    public function getReward(): ?string
    {
        return $this->reward;
    }

    /**
     * @param string|null $reward
     */
    public function setReward(?string $reward): void
    {
        $this->reward = $reward;
    }
}