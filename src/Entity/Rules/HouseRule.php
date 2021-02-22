<?php
declare(strict_types=1);

namespace App\Entity\Rules;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\DescriptionTrait;
use App\Entity\Core\Traits\SourceTrait;

class HouseRule
{
    use BaseFieldsTrait;
    use DescriptionTrait;
    use SourceTrait;

    public const ENTITY_NAME = 'house_rule';
}