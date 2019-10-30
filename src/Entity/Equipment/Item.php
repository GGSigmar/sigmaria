<?php

namespace App\Entity\Equipment;

abstract class Item
{
    /**
     * @var string
     */
    private $bulk;

    /**
     * @var int
     */
    private $price;

    public function getBulk(): ?string
    {
        return $this->bulk;
    }

    public function setBulk(string $bulk): self
    {
        $this->bulk = $bulk;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}