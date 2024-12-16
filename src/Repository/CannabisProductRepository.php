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
    public function findByFilter(
        string $search,
        array $producers
    ): array {
        if(empty($producers) && empty($search)){
            return $this->findAll();
        }

        $builder = $this->createQueryBuilder('c');

        if(!empty($search)) {
            $builder
                ->leftJoin('c.producer', 'p')
                ->andWhere('p.name LIKE :search')
                ->orWhere('c.name LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        foreach ($producers as $key => $producer) {
            $varName = 'val'.$key;
            $builder
                ->andWhere('c.producer = :'.$varName)
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
