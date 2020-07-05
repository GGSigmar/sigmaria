<?php

namespace App\Entity\Core;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\SortOrderTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\ParagraphRepository")
 * @ORM\Table(name="core_paragraph")
 */
class Paragraph
{
    use DescriptionTrait, SortOrderTrait;

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
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isActive = true;

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
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name ?? 'Paragraf bez nazwy';
    }
}