<?php

namespace App\Entity\Core\Traits;

use App\Entity\Core\Rarity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

trait SimpleRarityTrait
{
    /**
     * @var Rarity
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Rarity")
     *
     * @Assert\NotBlank
     */
    private $rarity;

    /**
     * @return null|Rarity
     */
    public function getRarity(): ?Rarity
    {
        return $this->rarity;
    }

    /**
     * @param Rarity $rarity
     */
    public function setRarity(Rarity $rarity): void
    {
        $this->rarity = $rarity;
    }
}