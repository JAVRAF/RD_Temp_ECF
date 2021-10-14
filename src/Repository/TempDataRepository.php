<?php

namespace App\Repository;

use App\Entity\TempData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TempData|null find($id, $lockMode = null, $lockVersion = null)
 * @method TempData|null findOneBy(array $criteria, array $orderBy = null)
 * @method TempData[]    findAll()
 * @method TempData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TempDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TempData::class);
    }

    // /**
    //  * @return TempData[] Returns an array of TempData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TempData
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
