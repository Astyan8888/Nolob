<?php

namespace App\Repository;

use App\Entity\Feeding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Feeding|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feeding|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feeding[]    findAll()
 * @method Feeding[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Feeding::class);
    }


    /**
    * @return Feeding[] Returns an array of Feeding objects
    */
    
    public function findByuserfeeding($iduser)
    {
        return $this->createQueryBuilder('f')
            ->join('f.user', 'user')
            ->Where('f.user = :user')
            ->setParameter('user', $iduser)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Feeding
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
