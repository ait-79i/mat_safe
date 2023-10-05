<?php

namespace App\Repository;

use App\Entity\SousCompagnie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SousCompagnie>
 *
 * @method SousCompagnie|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousCompagnie|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousCompagnie[]    findAll()
 * @method SousCompagnie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousCompagnieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousCompagnie::class);
    }

//    /**
//     * @return SousCompagnie[] Returns an array of SousCompagnie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SousCompagnie
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
