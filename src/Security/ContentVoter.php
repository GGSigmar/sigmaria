<?php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class ContentVoter extends Voter
{
    public const VIEW = 'view';

    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     *
     * @return bool|void
     */
    protected function supports($attribute, $subject): ?bool
    {
        if (!in_array($attribute, [self::VIEW])) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool|void
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): ?bool
    {
        $user = $token->getUser();

        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        if (!$subject->isActive()) {
            return false;
        }

        return true;
    }
}