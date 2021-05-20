<?php

namespace App\Repository;

use App\Entity\Ordine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ordine|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ordine|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ordine[]    findAll()
 * @method Ordine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ordine::class);
    }

    // /**
    //  * @return Ordine[] Returns an array of Ordine objects
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
    public function findOneBySomeField($value): ?Ordine
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
