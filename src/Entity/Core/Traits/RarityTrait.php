<?php

namespace App\Entity\Core\Traits;

use App\Entity\Core\Rarity;

trait RarityTrait
{
    /**
     * @var Rarity
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank
     */
    private $rarity;

    /**
     * @return Rarity
     */
    public function getRarity(): Rarity
    {
        return $this->rarity;
    }

    /**
     * @param Rarity $rarity
     *
     * @return RarityTrait
     */
    public function setRarity(Rarity $rarity): self
    {
        $this->rarity = $rarity;

        return $this;
    }
}