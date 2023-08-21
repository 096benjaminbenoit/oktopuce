<?php

namespace App\Repository;

use App\Entity\NfcTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NfcTag>
 *
 * @method NfcTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method NfcTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method NfcTag[]    findAll()
 * @method NfcTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NfcTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NfcTag::class);
    }

//    /**
//     * @return NfcTag[] Returns an array of NfcTag objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NfcTag
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
