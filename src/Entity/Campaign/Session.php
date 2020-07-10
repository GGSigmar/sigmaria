<?php

namespace App\Entity\Campaign;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Campaign\SessionRepository")
 * @ORM\Table(name="campaign_session")
 */
class Session
{
    use BaseFieldsTrait, DescriptionTrait, TimestampableEntity;

    /**
     * @var Campaign
     *
     * @ORM\ManyToOne(targetEntity="Campaign")
     * @Assert\NotBlank
     */
    private $campaign;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank
     * @Assert\Range(min=1)
     */
    private $number;

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
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }
}