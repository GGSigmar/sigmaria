<?php

namespace App\Repository\Setting;

use App\Entity\Setting\Background;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class BackgroundRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Background::class);
    }

    /**
     * @return array|Background[]
     */
    public function getBackgroundsForRelease(): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.isActive = false')
            ->andWhere('b.isToBeReleased = true')
            ->getQuery()
            ->getResult();
    }
}
