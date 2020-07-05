<?php

namespace App\Repository;

use App\Entity\Bon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BonReparation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BonReparation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BonReparation[]    findAll()
 * @method BonReparation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bon::class);
    }

    // /**
    //  * @return BonReparation[] Returns an array of BonReparation objects
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
    public function findOneBySomeField($value): ?BonReparation
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
