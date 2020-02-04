<?php

namespace App\Repository;

use App\Entity\PC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PC|null find($id, $lockMode = null, $lockVersion = null)
 * @method PC|null findOneBy(array $criteria, array $orderBy = null)
 * @method PC[]    findAll()
 * @method PC[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PCRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PC::class);
    }

//    /**
//     * @return PC[] Returns an array of PC objects
//     */
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
    public function findOneBySomeField($value): ?PC
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
