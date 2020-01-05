<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TranslateReleasedContentArrayKeyExtension extends AbstractExtension
{
    private const ENTITY_ARRAY_KEYS_TO_POLISH_ARRAY = [
        'ancestry' => 'Rasy',
        'feat' => 'Atuty',
        'language' => 'Języki',
        'background' => 'Pochodzenia',
        'culture' => 'Kultury',
    ];

    public function getFilters()
    {
        return [
            new TwigFilter('releaseKey', [$this, 'translateReleaseContentKeyToPolish']),
        ];
    }

    /**
     * @param string $singularEntityName
     *
     * @return string
     */
    public function translateReleaseContentKeyToPolish(string $singularEntityName): string
    {
        if (!array_key_exists($singularEntityName, self::ENTITY_ARRAY_KEYS_TO_POLISH_ARRAY)) {
            return $singularEntityName;
        }

        return self::ENTITY_ARRAY_KEYS_TO_POLISH_ARRAY[$singularEntityName];
    }
}