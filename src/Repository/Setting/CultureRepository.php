<?php

namespace App\Repository\Setting;

use App\Entity\Setting\Culture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class CultureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Culture::class);
    }

    /**
     * @return array|Culture[]
     */
    public function getCulturesForRelease(): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.isActive = false')
            ->andWhere('c.isToBeReleased = true')
            ->getQuery()
            ->getResult();
    }
}
