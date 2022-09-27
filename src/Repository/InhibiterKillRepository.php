<?php

namespace App\Repository;

use App\Entity\InhibiterKill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InhibiterKill>
 *
 * @method InhibiterKill|null find($id, $lockMode = null, $lockVersion = null)
 * @method InhibiterKill|null findOneBy(array $criteria, array $orderBy = null)
 * @method InhibiterKill[]    findAll()
 * @method InhibiterKill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InhibiterKillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InhibiterKill::class);
    }

    public function save(InhibiterKill $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(InhibiterKill $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return InhibiterKill[] Returns an array of InhibiterKill objects
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

//    public function findOneBySomeField($value): ?InhibiterKill
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
