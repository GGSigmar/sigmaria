<?php

namespace App\Service\Core;

use App\Entity\Core\Interfaces\SourcableInterface;

class SourcableService
{
    /**
     * @param SourcableInterface $sourcableEntity
     */
    public function ensureEmptySourceNullification(SourcableInterface $sourcableEntity): void
    {
        if ($sourcableEntity->getSource()->getSource() === null) {
            $sourcableEntity->setSource(null);
        }
    }
}