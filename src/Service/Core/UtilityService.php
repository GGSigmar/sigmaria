<?php

namespace App\Service\Core;

use App\Entity\Core\Feat;
use Doctrine\Common\Collections\Collection;

class UtilityService
{
    /**
     * @param Collection|Feat[] $featCollection
     *
     * @return array
     */
    public static function groupFeatsByLevel(Collection $featCollection): array
    {
        $groupedFeats = [];

        foreach ($featCollection as $feat) {
            $featLevel = $feat->getLevel();

            if (!array_key_exists($featLevel, $groupedFeats)) {
                $groupedFeats[$featLevel] = [$feat];
            } else {
                $groupedFeats[$featLevel][] = $feat;
            }
        }

        return $groupedFeats;
    }
}