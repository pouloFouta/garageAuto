<?php

namespace App\Repository;

use App\Entity\GestionVehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GestionVehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method GestionVehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method GestionVehicule[]    findAll()
 * @method GestionVehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GestionVehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GestionVehicule::class);
    }

    // /**
    //  * @return GestionVehicule[] Returns an array of GestionVehicule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GestionVehicule
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
