<?php

namespace App\Entity\Core\Traits;

use App\Entity\Core\Rarity;

trait RarityTrait
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