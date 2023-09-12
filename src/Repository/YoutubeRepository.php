<?php

namespace App\Repository;

use App\Entity\Youtube;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Youtube>
 *
 * @method Youtube|null find($id, $lockMode = null, $lockVersion = null)
 * @method Youtube|null findOneBy(array $criteria, array $orderBy = null)
 * @method Youtube[]    findAll()
 * @method Youtube[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YoutubeRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 5;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Youtube::class);
    }

    public function findPaginated(int $offset) : Paginator
    {
       $query = $this->createQueryBuilder('c')
                ->setMaxResults(self::PAGINATOR_PER_PAGE)
                ->setFirstResult($offset)
                ->getQuery()
            ;

        return new Paginator($query);
    }

//    /**
//     * @return Youtube[] Returns an array of Youtube objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('y')
//            ->andWhere('y.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('y.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Youtube
//    {
//        return $this->createQueryBuilder('y')
//            ->andWhere('y.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
