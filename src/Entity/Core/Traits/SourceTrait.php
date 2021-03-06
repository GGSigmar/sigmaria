<?php

namespace App\Entity\Core\Traits;

use App\Entity\Core\EntitySource;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

trait SourceTrait
{
    /**
     * @var EntitySource
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\EntitySource", cascade={"persist"})
     * @Assert\Valid
     */
    private $source;

    /**
     * @return EntitySource|null
     */
    public function getSource(): ?EntitySource
    {
        return $this->source;
    }

    /**
     * @param EntitySource|null $source
     */
    public function setSource(?EntitySource $source): void
    {
        $this->source = $source;
    }
}