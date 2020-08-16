<?php

namespace App\Repository\Setting;

use App\Entity\Setting\SettingFoundation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class SettingFoundationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SettingFoundation::class);
    }

    /**
     * @return array
     */
    public function getSortedActiveSettingKeystones(): array
    {
        $qb = $this->createQueryBuilder('sf');

        return $this->createQueryBuilder('sf')
            ->andWhere('sf.isActive = true')
            ->orderBy('sf.sortOrder', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
