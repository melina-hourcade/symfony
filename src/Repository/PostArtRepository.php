<?php

namespace App\Repository;

use App\Entity\PostArt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostArt|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostArt|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostArt[]    findAll()
 * @method PostArt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostArtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostArt::class);
    }

    // /**
    //  * @return PostArt[] Returns an array of PostArt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostArt
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
