<?php

namespace App\Repository;

use App\Entity\Reparateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Reparateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reparateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reparateur[]    findAll()
 * @method Reparateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReparateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reparateur::class);
    }

    // /**
    //  * @return Reparateur[] Returns an array of Reparateur objects
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
    public function findOneBySomeField($value): ?Reparateur
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
