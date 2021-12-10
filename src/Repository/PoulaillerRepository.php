<?php

namespace App\Repository;

use App\Entity\Poulailler;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Poulailler|null find($id, $lockMode = null, $lockVersion = null)
 * @method Poulailler|null findOneBy(array $criteria, array $orderBy = null)
 * @method Poulailler[]    findAll()
 * @method Poulailler[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PoulaillerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Poulailler::class);
    }

    // /**
    //  * @return Poulailler[] Returns an array of Poulailler objects
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
    public function findOneBySomeField($value): ?Poulailler
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
