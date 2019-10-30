<?php

namespace App\Repository\Ancestry;

use App\Entity\Ancestry\Ancestry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ancestry|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ancestry|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ancestry[]    findAll()
 * @method Ancestry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AncestryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ancestry::class);
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
