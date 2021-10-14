<?php

namespace App\Repository;

use App\Entity\CoolingChamber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoolingChamber|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoolingChamber|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoolingChamber[]    findAll()
 * @method CoolingChamber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoolingChamberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoolingChamber::class);
    }

    // /**
    //  * @return CoolingChamber[] Returns an array of CoolingChamber objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CoolingChamber
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
