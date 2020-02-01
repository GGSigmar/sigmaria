<?php

namespace App\Repository\Core;

use App\Entity\Core\BlogPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

class BlogPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPost::class);
    }

    public function getBlogPostsQueryBuilder(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('bp');
        $qb->andWhere('bp.isActive = true');

        return $qb->orderBy('bp.createdAt', 'DESC');
    }
}