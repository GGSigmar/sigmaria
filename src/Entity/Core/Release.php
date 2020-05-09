<?php

namespace App\Entity\Core;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\ReleaseRepository")
 * @ORM\Table(name="core_release")
 */
class Release
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
     * @var string
     *
     * @ORM\Column(length=80)
     *
     * @Assert\NotBlank
     * @Assert\Length(max=80)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(length=20)
     *
     * @Assert\NotBlank
     * @Assert\Length(max=20)
     */
    private $contentVersion = '';

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $contentReleased = [];

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $contentChanges = '';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = ucfirst($name);
    }

    /**
     * @return string
     */
    public function getContentVersion(): string
    {
        return $this->contentVersion;
    }

    /**
     * @param string $contentVersion
     */
    public function setContentVersion(string $contentVersion): void
    {
        $this->contentVersion = $contentVersion;
    }

    /**
     * @return array
     */
    public function getContentReleased(): array
    {
        return $this->contentReleased;
    }

    /**
     * @param array $contentReleased
     */
    public function setContentReleased(array $contentReleased): void
    {
        $this->contentReleased = $contentReleased;
    }

    /**
     * @return string|null
     */
    public function getContentChanges(): ?string
    {
        return $this->contentChanges;
    }

    /**
     * @param string|null $contentChanges
     */
    public function setContentChanges(?string $contentChanges): void
    {
        $this->contentChanges = $contentChanges;
    }

    /**
     * @return bool
     */
    public function isLaunched(): bool
    {
        if ($this->contentReleased) {
            return true;
        }

        return false;
    }

    public function __toString()
    {
        return sprintf('%s, (%s)', $this->getName(), $this->getContentVersion());
    }
}