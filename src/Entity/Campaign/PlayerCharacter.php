<?php

namespace App\Entity\Campaign;

use App\Entity\Ancestry\Ancestry;
use App\Entity\Ancestry\Heritage;
use App\Entity\Core\CharacterClass;
use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\SlugTrait;
use App\Entity\Core\User;
use App\Entity\Setting\Background;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Campaign\PlayerCharacterRepository")
 * @ORM\Table(name="campaign_player_character")
 */
class PlayerCharacter
{
    use BaseFieldsTrait, SlugTrait, DescriptionTrait, TimestampableEntity;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\User")
     * @Assert\NotBlank
     */
    private $player;

    /**
     * @var Ancestry
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry\Ancestry")
     * @Assert\NotBlank
     */
    private $ancestry;

    /**
     * @var Heritage|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ancestry\Heritage")
     * @Assert\NotBlank
     */
    private $heritage;

    /**
     * @var Background
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Setting\Background")
     * @Assert\NotBlank
     */
    private $background;

    /**
     * @var CharacterClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\CharacterClass")
     * @Assert\NotBlank
     */
    private $class;

    /**
     * @var Campaign
     *
     * @ORM\ManyToOne(targetEntity="Campaign", inversedBy="playerCharacters")
     * @Assert\NotBlank
     */
    private $campaign;

    /**
     * @return User
     */
    public function getPlayer(): User
    {
        return $this->player;
    }

    /**
     * @param User $player
     */
    public function setPlayer(User $player): void
    {
        $this->player = $player;
    }

    /**
     * @return Ancestry
     */
    public function getAncestry(): Ancestry
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
     * @return Heritage|null
     */
    public function getHeritage(): ?Heritage
    {
        return $this->heritage;
    }

    /**
     * @param Heritage|null $heritage
     */
    public function setHeritage(?Heritage $heritage): void
    {
        $this->heritage = $heritage;
    }

    /**
     * @return Background
     */
    public function getBackground(): Background
    {
        return $this->background;
    }

    /**
     * @param Background $background
     */
    public function setBackground(Background $background): void
    {
        $this->background = $background;
    }

    /**
     * @return CharacterClass
     */
    public function getClass(): CharacterClass
    {
        return $this->class;
    }

    /**
     * @param CharacterClass $class
     */
    public function setClass(CharacterClass $class): void
    {
        $this->class = $class;
    }

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
    public function getLevel(): int
    {
        return $this->getCampaign()->getCurrentLevel();
    }
}