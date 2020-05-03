<?php
namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\SortOrderTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\EntitySourceRepository")
 * @ORM\Table(name="core_entity_source")
 */
class EntitySource
{
    use TimestampableEntity;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

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