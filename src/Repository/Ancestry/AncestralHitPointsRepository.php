<?php

namespace App\Repository\Ancestry;

use App\Entity\Ancestry\AncestralHitPoints;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class AncestralHitPointsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AncestralHitPoints::class);
    }
}
