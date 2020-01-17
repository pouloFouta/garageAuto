<?php

namespace App\Repository;

use App\Entity\ReparateurReparation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ReparateurReparation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReparateurReparation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReparateurReparation[]    findAll()
 * @method ReparateurReparation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReparateurReparationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReparateurReparation::class);
    }

    // /**
    //  * @return ReparateurReparation[] Returns an array of ReparateurReparation objects
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
    public function findOneBySomeField($value): ?ReparateurReparation
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
