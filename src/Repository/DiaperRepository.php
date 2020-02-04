<?php

namespace App\Repository;

use App\Entity\Diaper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Diaper|null find($id, $lockMode = null, $lockVersion = null)
 * @method Diaper|null findOneBy(array $criteria, array $orderBy = null)
 * @method Diaper[]    findAll()
 * @method Diaper[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiaperRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Diaper::class);
    }

//    /**
//     * @return Diaper[] Returns an array of Diaper objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Diaper
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
