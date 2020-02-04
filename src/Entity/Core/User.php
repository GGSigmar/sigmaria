<?php

namespace App\Entity\Core;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="Wygląda na to, że już masz konto :)")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isEnabled();
    }
}