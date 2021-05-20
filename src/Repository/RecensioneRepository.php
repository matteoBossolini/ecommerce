<?php

namespace App\Repository;

use App\Entity\Recensione;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recensione|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recensione|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recensione[]    findAll()
 * @method Recensione[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecensioneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recensione::class);
    }

    // /**
    //  * @return Recensione[] Returns an array of Recensione objects
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
    public function findOneBySomeField($value): ?Recensione
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
