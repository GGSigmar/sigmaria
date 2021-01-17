<?php


namespace App\Entity\Core;


class BaseEntity
{
    public const ENTITY_NAME = 'some_name';

    public static function getFormattedName(): string
    {
        $explodedEntityName = explode('_', static::ENTITY_NAME);
        $uppercaseParts = [];
        foreach ($explodedEntityName as $part) {
            $uppercaseParts[] = ucfirst($part);
        }
        return implode(' ', $uppercaseParts);
    }

    public static function getEntityName(): string
    {
        return static::ENTITY_NAME;
    }
}