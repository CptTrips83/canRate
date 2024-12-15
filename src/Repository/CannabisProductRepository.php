<?php

namespace App\Repository;

use App\Entity\CannabisProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CannabisProduct>
 */
class CannabisProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CannabisProduct::class);
    }

        /**
         * @return CannabisProduct[] Returns an array of CannabisProduct objects
         */
    public function findByProducers(array $producers): array
    {
        if(empty($producers)){
            return $this->findAll();
        }

        $builder = $this->createQueryBuilder('c');

        foreach ($producers as $key => $producer) {
            $varName = 'val'.$key;
            $builder
                ->orWhere('c.producer = :'.$varName)
                ->setParameter($varName, $producer);
        }

        $builder
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;

        return $builder->getQuery()->getResult();
    }

    //    public function findOneBySomeField($value): ?CannabisProduct
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
