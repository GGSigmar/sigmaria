<?php

namespace App\Service\Core;

use App\Entity\Core\Feat;

class FeatHelper
{
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