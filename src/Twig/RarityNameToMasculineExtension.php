<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RarityNameToMasculineExtension extends AbstractExtension
{
    private const RARITY_NAME_TO_MASCULINE_ARRAY = [
        'Pospolita' => 'Pospolity',
        'Niepospolita' => 'Niepospolity',
        'Rzadka' => 'Rzadki',
        'Unikalna' => 'Unikalny',
    ];

    public function getFilters()
    {
        return [
            new TwigFilter('masculine', [$this, 'changeRarityNameToMasculine']),
        ];
    }

    /**
     * @param string $singularEntityName
     *
     * @return string
     */
    public function changeRarityNameToMasculine(string $singularEntityName): string
    {
        if (!array_key_exists($singularEntityName, self::RARITY_NAME_TO_MASCULINE_ARRAY)) {
            return $singularEntityName;
        }

        return self::RARITY_NAME_TO_MASCULINE_ARRAY[$singularEntityName];
    }
}