<?php

namespace App\Repository;

use App\Entity\MiseEnLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MiseEnLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MiseEnLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MiseEnLocation[]    findAll()
 * @method MiseEnLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiseEnLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MiseEnLocation::class);
    }

    // /**
    //  * @return MiseEnLocation[] Returns an array of MiseEnLocation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MiseEnLocation
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
