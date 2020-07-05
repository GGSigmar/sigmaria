<?php

namespace App\Entity\Core\Traits;

use App\Entity\Core\Paragraph;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

trait ParagraphsTrait
{
    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Core\Paragraph", cascade={"remove"})
     * @ORM\OrderBy({"sortOrder"="ASC"})
     */
    private $paragraphs;

    /**
     * @return Collection
     */
    public function getParagraphs(): Collection
    {
        return $this->paragraphs;
    }

    /**
     * @return Collection
     */
    public function getActiveParagraphs(): Collection
    {
        return $this->paragraphs->filter(function ($paragraph) {
            return $paragraph->isActive();
        });
    }

    /**
     * @param Paragraph $paragraph
     */
    public function addParagraph(Paragraph $paragraph): void
    {
        if (!$this->paragraphs->contains($paragraph)) {
            $this->paragraphs->add($paragraph);
        }

        return;
    }

    /**
     * @param Paragraph $paragraph
     */
    public function removeParagraph(Paragraph $paragraph): void
    {
        if ($this->paragraphs->contains($paragraph)) {
            $this->paragraphs->removeElement($paragraph);
        }

        return;
    }
}