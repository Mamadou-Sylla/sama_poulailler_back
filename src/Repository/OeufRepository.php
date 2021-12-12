<?php

namespace App\Repository;

use App\Entity\Oeuf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Oeuf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Oeuf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Oeuf[]    findAll()
 * @method Oeuf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OeufRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oeuf::class);
    }

    // /**
    //  * @return Oeuf[] Returns an array of Oeuf objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Oeuf
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
