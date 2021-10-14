<?php

namespace App\Repository;

use App\Entity\Hygrodata;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hygrodata|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hygrodata|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hygrodata[]    findAll()
 * @method Hygrodata[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HygrodataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hygrodata::class);
    }

    // /**
    //  * @return Hygrodata[] Returns an array of Hygrodata objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hygrodata
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
