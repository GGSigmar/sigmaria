<?php

namespace App\Repository\Equipment\Weapon;

use App\Entity\Equipment\Weapon\WeaponProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method WeaponProperty|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeaponProperty|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeaponProperty[]    findAll()
 * @method WeaponProperty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeaponPropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeaponProperty::class);
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
