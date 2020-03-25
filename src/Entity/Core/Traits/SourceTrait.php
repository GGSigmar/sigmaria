<?php

namespace App\Entity\Core\Traits;

use App\Entity\Core\Source;
use Doctrine\ORM\Mapping as ORM;

trait SourceTrait
{
    /**
     * @var Source
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Source")
     */
    private $source;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sourceStartingPageNumber = 0;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sourceEndingPageNumber = 0;

    /**
     * @return Source|null
     */
    public function getSource(): ?Source
    {
        return $this->source;
    }

    /**
     * @param Source|null $source
     */
    public function setSource(?Source $source): void
    {
        $this->source = $source;
    }

    /**
     * @return int|null
     */
    public function getSourceStartingPageNumber(): ?int
    {
        return $this->sourceStartingPageNumber;
    }

    /**
     * @param int|null $sourceStartingPageNumber
     */
    public function setSourceStartingPageNumber(?int $sourceStartingPageNumber): void
    {
        $this->sourceStartingPageNumber = $sourceStartingPageNumber;
    }

    /**
     * @return int|null
     */
    public function getSourceEndingPageNumber(): ?int
    {
        return $this->sourceEndingPageNumber;
    }

    /**
     * @param int|null $sourceEndingPageNumber
     */
    public function setSourceEndingPageNumber(?int $sourceEndingPageNumber): void
    {
        $this->sourceEndingPageNumber = $sourceEndingPageNumber;
    }

    /**
     * @return string|null
     */
    public function getPagesInfo(): ?string
    {
        $pagesText = null;

        $startingPage = $this->getSourceStartingPageNumber();

        if ($startingPage) {
            $pagesText = "(p. {$startingPage}";

            $endingPage = $this->getSourceEndingPageNumber();

            if ($endingPage && $endingPage != $startingPage) {
                $pagesText .= "-{$endingPage})";
            } else {
                $pagesText .= ')';
            }
        }

        return $pagesText;
    }
}