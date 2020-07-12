<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\ActiveTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\SortOrderTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\ParagraphRepository")
 * @ORM\Table(name="core_paragraph")
 */
class Paragraph
{
    use DescriptionTrait, ActiveTrait, SortOrderTrait, TimestampableEntity;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(length=80, nullable=true)
     *
     * @Assert\Length(max=80)
     */
    private $name = '';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = ucfirst($name);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name ?? 'Paragraf bez nazwy';
    }
}