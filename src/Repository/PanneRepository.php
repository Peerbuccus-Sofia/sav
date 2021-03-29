<?php

namespace App\Repository;

use App\Entity\Panne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Panne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Panne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Panne[]    findAll()
 * @method Panne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Panne::class);
    }

    /**
     * @return Panne[] Returns an array of Panne objects
     */

    public function infopanne($iddossier)
    {
        return $this->createQueryBuilder('p')
            ->from('App\Entity\Dossier', 'd')
            ->join('d.materiel', 'm')
            ->join('m.panne', 'pa')
            ->where('d.num = :iddossier')
            ->setParameter('iddossier', $iddossier)
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Panne
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
