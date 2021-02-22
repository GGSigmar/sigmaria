<?php

namespace App\Service\Core;

use App\Entity\Core\Feat;
use Doctrine\Common\Collections\Collection;

class FeatHelper
{
    /**
     * @param Collection|Feat[] $featCollection
     *
     * @return array
     */
    public static function groupFeatsByLevel($featCollection): array
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

    public function applyEdits(Feat $feat): void
    {
        $edits = $feat->getEdits();

        if ($edits) {
            $feat->setName($edits->getName());
            $feat->setDescription($edits->getDescription());
            $feat->setRarity($edits->getRarity());
            $feat->setActions($edits->getActions());
            $feat->setLevel($edits->getLevel());
            $feat->setPrerequisites($edits->getPrerequisites());
            $feat->setFrequency($edits->getFrequency());
            $feat->setTrigger($edits->getTrigger());
            $feat->setRequirements($edits->getRequirements());
            $feat->setSpecialRules($edits->getSpecialRules());
            $feat->setSource($edits->getSource());

            $feat->getAttributes()->clear();
            foreach ($edits->getAttributes() as $attribute) {
                $feat->addAttribute($attribute);
            }
        }
    }
}