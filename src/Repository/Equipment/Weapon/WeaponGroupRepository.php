<?php

namespace App\Repository\Equipment\Weapon;

use App\Entity\Equipment\Weapon\WeaponGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method WeaponGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeaponGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeaponGroup[]    findAll()
 * @method WeaponGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeaponGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeaponGroup::class);
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
