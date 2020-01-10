<?php

namespace App\Repository\Ancestry;

use App\Entity\Ancestry\Heritage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class HeritageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Heritage::class);
    }

    /**
     * @return array|Heritage[]
     */
    public function getHeritagesForRelease(): array
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.isActive = false')
            ->andWhere('h.isToBeReleased = true')
            ->getQuery()
            ->getResult();
    }
}
