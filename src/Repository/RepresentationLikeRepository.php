<?php

namespace App\Repository;

use App\Entity\RepresentationLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RepresentationLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method RepresentationLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method RepresentationLike[]    findAll()
 * @method RepresentationLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepresentationLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepresentationLike::class);
    }

    // /**
    //  * @return RepresentationLike[] Returns an array of RepresentationLike objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RepresentationLike
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
