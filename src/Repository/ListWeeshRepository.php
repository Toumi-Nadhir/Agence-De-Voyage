<?php

namespace App\Repository;

use App\Entity\ListWeesh;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListWeesh|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListWeesh|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListWeesh[]    findAll()
 * @method ListWeesh[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListWeeshRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListWeesh::class);
    }

    // /**
    //  * @return ListWeesh[] Returns an array of ListWeesh objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListWeesh
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
