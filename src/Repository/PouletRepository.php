<?php

namespace App\Repository;

use App\Entity\Poulet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Poulet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Poulet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Poulet[]    findAll()
 * @method Poulet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PouletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Poulet::class);
    }

    // /**
    //  * @return Poulet[] Returns an array of Poulet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Poulet
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
