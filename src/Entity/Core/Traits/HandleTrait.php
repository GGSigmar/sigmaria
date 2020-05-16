<?php

namespace App\Entity\Core\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait HandleTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, unique=true)
     *
     * @Assert\NotBlank
     * @Assert\Length(max=80)
     */
    private $handle = '';

    /**
     * @return string
     */
    public function getHandle(): string
    {
        return $this->handle;
    }

    /**
     * @param string $handle
     */
    public function setHandle(string $handle): void
    {
        $this->handle = str_replace(' ', '_', trim(strtoupper($handle)));
    }
}