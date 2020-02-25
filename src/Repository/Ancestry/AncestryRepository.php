<?php

namespace App\Repository\Ancestry;

use App\Entity\Ancestry\Ancestry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class AncestryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ancestry::class);
    }

    /**
     * @return array|Ancestry[]
     */
    public function getAncestriesForRelease(): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.isActive = false')
            ->andWhere('a.isToBeReleased = true')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array|Ancestry[]
     */
    public function getCoreAncestries(): array
    {
        $qb = $this->createQueryBuilder('a');
        $ex = $qb->expr();

        return $this->createQueryBuilder('a')
            ->andWhere('a.isActive = true')
            ->andWhere($ex->in('a.handle', Ancestry::CORE_ANCESTRIES))
            ->getQuery()
            ->getResult();
    }
}
