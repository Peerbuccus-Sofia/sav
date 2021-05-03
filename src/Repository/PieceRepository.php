<?php

namespace App\Repository;

use App\Entity\Piece;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Piece|null find($id, $lockMode = null, $lockVersion = null)
 * @method Piece|null findOneBy(array $criteria, array $orderBy = null)
 * @method Piece[]    findAll()
 * @method Piece[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PieceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Piece::class);
    }

    /**
     * @return Piece[] Returns an array of Piece objects
     */

    public function infopiece($id)
    {
        return $this->createQueryBuilder('p')
            ->from('App\Entity\Piece', 'pi')
            ->join('pi.pannes', 'pa')
            ->join('pa.materiel', 'm')
            ->where('m.id =:id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

}
