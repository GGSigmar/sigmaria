<?php

namespace App\Entity\Core;

class Role
{
    public const ROLES = [
        self::ROLE_USER => self::ROLE_USER,
        self::ROLE_ADMIN => self::ROLE_ADMIN,
        self::ROLE_CONTENT_PREVIEW => self::ROLE_CONTENT_PREVIEW,
    ];

    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_CONTENT_PREVIEW = 'ROLE_CONTENT_PREVIEW';
}