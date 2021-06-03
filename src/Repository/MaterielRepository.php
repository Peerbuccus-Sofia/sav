<?php

namespace App\Repository;

use App\Entity\Materiel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Materiel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materiel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materiel[]    findAll()
 * @method Materiel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materiel::class);
    }

     /**
       * return last row of this table
      */
    public function findByMateriel()
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
        "SELECT ID FROM App\Entity\Materiel WHERE ID = (
              SELECT MAX(ID) FROM App\Entity\Materiel)");
  
        $result= $query->execute();
        // $result= $query->getOneOrNullResult();

        dump($query);
        return $result[0];
        // return $this->createQueryBuilder('m.ID')
        //         ->from('App\Entity\Materiel', 'm')
        //         ->where('m.ID' =: $id->getDSL())
    }


    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Materiel
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
