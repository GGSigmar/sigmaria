<?php

namespace App\Repository\Equipment\Weapon;

use App\Entity\Equipment\Weapon\WeaponDamage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method WeaponDamage|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeaponDamage|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeaponDamage[]    findAll()
 * @method WeaponDamage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeaponDamageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeaponDamage::class);
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
