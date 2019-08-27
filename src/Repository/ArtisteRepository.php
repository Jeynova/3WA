<?php

namespace App\Repository;

use App\Entity\Artiste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Artiste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artiste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artiste[]    findAll()
 * @method Artiste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtisteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Artiste::class);
    }

    // /**
    //  * @return Artiste[] Returns an array of Artiste objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findOneByName($value): ?Artiste
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.name = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findByStyle($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.style = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getArrayResult()
        ;
    }
    public function queryArtist()
    {
      $q1 = $this->createQueryBuilder('a');
      $expr = $q1->expr();
      $subrequest = $q1->select('a.id')
                       ->where($expr->like('a.country',
                                    $expr->literal('UK'))
                              );

    return  $this->createQueryBuilder('a')
           ->select('partial a.{id,name,style}')
           ->addSelect('count(e.id) alias events')
           ->innerJoin('a.events','e')
           ->groupBy('a.id')
           ->where($expr->in('a.id',$subrequest->getDQL()));
    }

}
