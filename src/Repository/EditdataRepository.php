<?php

namespace App\Repository;

use App\Entity\Editdata;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Editdata|null find($id, $lockMode = null, $lockVersion = null)
 * @method Editdata|null findOneBy(array $criteria, array $orderBy = null)
 * @method Editdata[]    findAll()
 * @method Editdata[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EditdataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Editdata::class);
    }

//    /**
//     * @return Editdata[] Returns an array of Editdata objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Editdata
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
