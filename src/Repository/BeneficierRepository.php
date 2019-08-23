<?php

namespace App\Repository;

use App\Entity\Beneficier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Beneficier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beneficier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beneficier[]    findAll()
 * @method Beneficier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeneficierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Beneficier::class);
    }

    // /**
    //  * @return Beneficier[] Returns an array of Beneficier objects
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
    public function findOneBySomeField($value): ?Beneficier
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
