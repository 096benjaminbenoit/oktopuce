<?php

namespace App\Repository;

use App\Entity\GasTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GasTypes>
 *
 * @method GasTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method GasTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method GasTypes[]    findAll()
 * @method GasTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GasTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GasTypes::class);
    }

//    /**
//     * @return GasTypes[] Returns an array of GasTypes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GasTypes
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
