<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class NumberToRomanRepresentationExtension extends AbstractExtension
{
    private const ROMAN_REPRESENTATION_ARRAY = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    ];

    public function getFilters()
    {
        return [
            new TwigFilter('roman', [$this, 'numberToRomanRepresentation']),
        ];
    }

    /**
     * @param int $number
     *
     * @return string
     */
    public function numberToRomanRepresentation(int $number): string
    {
        if ($number === 0 ) {
            return 0;
        }

        $returnValue = '';

        while ($number > 0) {
            foreach (self::ROMAN_REPRESENTATION_ARRAY as $roman => $int)
            {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }

        return $returnValue;
    }
}