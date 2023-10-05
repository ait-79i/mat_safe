<?php

namespace App\Repository;

use App\Entity\Invetation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Invetation>
 *
 * @method Invetation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Invetation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Invetation[]    findAll()
 * @method Invetation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvetationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invetation::class);
    }

//    /**
//     * @return Invetation[] Returns an array of Invetation objects
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

//    public function findOneBySomeField($value): ?Invetation
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
