<?php

namespace App\Entity\Ancestry;

use App\Entity\Core\Traits\BaseFieldsTrait;
use App\Entity\Core\Traits\ValueTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ancestry\AncestralHitPointsRepository")
 * @ORM\Table(name="ancestry_ancestral_hit_points")
 */
class AncestralHitPoints
{
    use BaseFieldsTrait, ValueTrait, TimestampableEntity;

    public const ANCESTRAL_HIT_POINTS_6 = 'ANCESTRAL_HIT_POINTS_6';
    public const ANCESTRAL_HIT_POINTS_8 = 'ANCESTRAL_HIT_POINTS_8';
    public const ANCESTRAL_HIT_POINTS_10 = 'ANCESTRAL_HIT_POINTS_10';
    public const ANCESTRAL_HIT_POINTS_12 = 'ANCESTRAL_HIT_POINTS_12';
}