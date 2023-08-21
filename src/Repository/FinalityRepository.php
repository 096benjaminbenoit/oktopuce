<?php

namespace App\Repository;

use App\Entity\Finality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Finality>
 *
 * @method Finality|null find($id, $lockMode = null, $lockVersion = null)
 * @method Finality|null findOneBy(array $criteria, array $orderBy = null)
 * @method Finality[]    findAll()
 * @method Finality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinalityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Finality::class);
    }

//    /**
//     * @return Finality[] Returns an array of Finality objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Finality
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
