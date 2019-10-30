<?php

namespace App\Repository\Ancestry;

use App\Entity\Ancestry\AncestralFeature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AncestralFeature|null find($id, $lockMode = null, $lockVersion = null)
 * @method AncestralFeature|null findOneBy(array $criteria, array $orderBy = null)
 * @method AncestralFeature[]    findAll()
 * @method AncestralFeature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AncestralFeatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AncestralFeature::class);
    }

    // /**
    //  * @return BaseLookUpEntity[] Returns an array of BaseLookUpEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BaseLookUpEntity
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
