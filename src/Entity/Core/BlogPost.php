<?php

namespace App\Entity\Core;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\BlogPostRepository")
 * @ORM\Table(name="core_blog_post")
 */
class BlogPost
{
    use BaseFieldsTrait, DescriptionTrait, TimestampableEntity;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\User")
     */
    private $author;

    /**
     * @var Release
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Core\Release")
     */
    private $release;

    /**
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    /**
     * @return Release|null
     */
    public function getRelease(): ?Release
    {
        return $this->release;
    }

    /**
     * @param Release|null $release
     */
    public function setRelease(?Release $release): void
    {
        $this->release = $release;
    }


}