<?php

namespace App\Repository\Setting;

use App\Entity\Setting\Language;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class LanguageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Language::class);
    }

    /**
     * @return array|Language[]
     */
    public function getLanguagesForRelease(): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.isActive = false')
            ->andWhere('l.isToBeReleased = true')
            ->getQuery()
            ->getResult();
    }
}
