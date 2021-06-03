<?php

namespace App\Repository;

use App\Entity\Dossier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dossier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dossier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dossier[]    findAll()
 * @method Dossier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dossier::class);
    }

    /**
     * @return Dossier[] Returns an array of Dossier objects
     */

    public function infodossiers()
    {
        return $this->createQueryBuilder('do')
            ->from('App\Entity\Dossier', 'd')
            ->join('d.materiel', 'm')
            ->join('m.pannes', 'pa')
            ->getQuery()
            ->getResult();
    }

    public function infodossier($numDoss)
    {
        return $this->createQueryBuilder('do')
            ->from('App\Entity\Dossier', 'd')
            ->join('d.materiel', 'm')
            ->join('m.pannes', 'pa')
            ->join('pa.piece', 'pi')
            ->where('do.num =:id')
            ->setParameter('id', $numDoss)
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Dossier
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
