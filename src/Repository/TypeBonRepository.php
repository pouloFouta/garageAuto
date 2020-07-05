<?php

namespace App\Repository;

use App\Entity\TypeBon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeBon|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeBon|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeBon[]    findAll()
 * @method TypeBon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeBonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeBon::class);
    }

    // /**
    //  * @return TypeBon[] Returns an array of TypeBon objects
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
    public function findOneBySomeField($value): ?TypeBon
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
