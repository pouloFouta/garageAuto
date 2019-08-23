<?php

namespace App\Repository;

use App\Entity\ReparationPanne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ReparationPanne|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReparationPanne|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReparationPanne[]    findAll()
 * @method ReparationPanne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReparationPanneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ReparationPanne::class);
    }

    // /**
    //  * @return ReparationPanne[] Returns an array of ReparationPanne objects
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
    public function findOneBySomeField($value): ?ReparationPanne
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
