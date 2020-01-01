<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PluralEntitiesExtension extends AbstractExtension
{
    private const ENTITY_SINGULAR_TO_PLURAL_ARRAY = [
        'ancestry' => 'ancestries',
    ];

    public function getFunctions()
    {
        return [
            new TwigFunction('plural', [$this, 'entitySingularToPlural']),
        ];
    }

    /**
     * @param string $singularEntityName
     *
     * @return string
     */
    public function entitySingularToPlural(string $singularEntityName): string
    {
        if (!array_key_exists($singularEntityName, self::ENTITY_SINGULAR_TO_PLURAL_ARRAY)) {
            return $singularEntityName;
        }

        return self::ENTITY_SINGULAR_TO_PLURAL_ARRAY[$singularEntityName];
    }
}