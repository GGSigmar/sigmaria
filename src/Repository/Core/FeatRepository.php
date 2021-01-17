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
        $qb = $this->createQueryBuilder('f');
        $expr = $qb->expr();

        return $qb
            ->where($expr->orX(
                $expr->andX(
                    $expr->eq('f.isActive', ':false'),
                    $expr->eq('f.isToBeReleased', ':true')
                ),
                $expr->andX(
                    $expr->isNotNull('f.edits'),
                    $expr->eq('f.isToBeReleased', ':true')
                )
            ))
            ->setParameter('false', false)
            ->setParameter('true', true)
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