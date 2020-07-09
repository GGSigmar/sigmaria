<?php

namespace App\Repository\Setting;

use App\Entity\Setting\SettingKeystone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class SettingKeystoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SettingKeystone::class);
    }

    /**
     * @return array
     */
    public function getSortedActiveSettingKeystones(): array
    {
        $qb = $this->createQueryBuilder('sk');

        return $this->createQueryBuilder('sk')
            ->andWhere('sk.isActive = true')
            ->orderBy('sk.sortOrder', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
