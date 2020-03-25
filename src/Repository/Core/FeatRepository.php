<?php

namespace App\Repository\Core;

use App\Entity\Core\Attribute;
use App\Entity\Core\Feat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class FeatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feat::class);
    }

    /**
     * @return array|Feat[]
     */
    public function getFeatsForRelease(): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.isActive = false')
            ->andWhere('f.isToBeReleased = true')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function getGeneralFeats(): array
    {
        return $this->createQueryBuilder('f')
            ->innerJoin('f.attributes', 'a')
            ->andWhere('a.handle LIKE :general_attribute')
            ->setParameter('general_attribute', Attribute::ATTRIBUTE_GENERAL)
            ->getQuery()
            ->getResult();
    }
}