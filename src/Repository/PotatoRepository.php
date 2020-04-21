<?php

namespace App\Repository;

use App\Entity\Potato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Potato|null find($id, $lockMode = null, $lockVersion = null)
 * @method Potato|null findOneBy(array $criteria, array $orderBy = null)
 * @method Potato[]    findAll()
 * @method Potato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PotatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Potato::class);
    }

    // /**
    //  * @return Potato[] Returns an array of Potato objects
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
    public function findOneBySomeField($value): ?Potato
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
