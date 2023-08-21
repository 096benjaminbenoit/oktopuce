<?php

namespace App\Repository;

use App\Entity\InterventionQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InterventionQuestion>
 *
 * @method InterventionQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method InterventionQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method InterventionQuestion[]    findAll()
 * @method InterventionQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterventionQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InterventionQuestion::class);
    }

//    /**
//     * @return InterventionQuestion[] Returns an array of InterventionQuestion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InterventionQuestion
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
