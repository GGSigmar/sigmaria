<?php

namespace App\Repository\Core;

use App\Entity\Core\CharacterCreationStep;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class CharacterCreationStepRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterCreationStep::class);
    }

    /**
     * @return array
     */
    public function getSortedCharacterCreationSteps(): array
    {
        $qb = $this->createQueryBuilder('ccs');

        return $this->createQueryBuilder('ccs')
            ->orderBy('ccs.sortOrder', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function getSortedActiveCharacterCreationSteps(): array
    {
        $qb = $this->createQueryBuilder('ccs');

        return $this->createQueryBuilder('ccs')
            ->andWhere('ccs.isActive = true')
            ->orderBy('ccs.sortOrder', 'ASC')
            ->getQuery()
            ->getResult();
    }
}