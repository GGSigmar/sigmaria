<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RarityNameToNeuterExtension extends AbstractExtension
{
    private const RARITY_NAME_TO_NEUTER_ARRAY = [
        'Pospolita' => 'Pospolite',
        'Niepospolita' => 'Niepospolite',
        'Rzadka' => 'Rzadkie',
        'Unikalna' => 'Unikalne',
    ];

    public function getFilters()
    {
        return [
            new TwigFilter('neuter', [$this, 'changeRarityNameToNeuter']),
        ];
    }

    /**
     * @param string $singularEntityName
     *
     * @return string
     */
    public function changeRarityNameToNeuter(string $singularEntityName): string
    {
        if (!array_key_exists($singularEntityName, self::RARITY_NAME_TO_NEUTER_ARRAY)) {
            return $singularEntityName;
        }

        return self::RARITY_NAME_TO_NEUTER_ARRAY[$singularEntityName];
    }
}