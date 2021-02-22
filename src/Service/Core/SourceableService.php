<?php

namespace App\Service\Core;

use App\Entity\Core\Interfaces\SourceableInterface;

class SourceableService
{
    /**
     * @param SourceableInterface $sourceableEntity
     */
    public function ensureEmptySourceNullification(SourceableInterface $sourceableEntity): void
    {
        if ($sourceableEntity->getSource()->getSource() === null) {
            $sourceableEntity->setSource(null);
        }
    }
}