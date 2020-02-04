<?php

namespace App\Repository;

use App\Entity\Sleeper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sleeper|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sleeper|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sleeper[]    findAll()
 * @method Sleeper[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SleeperRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sleeper::class);
    }

//    /**
//     * @return Sleeper[] Returns an array of Sleeper objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sleeper
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
