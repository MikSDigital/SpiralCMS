<?php

namespace App\Repository\Core;

use App\Entity\Core\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    /**
     * PostRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @param $limit
     * @param string $orderBy
     * @param string $order
     * @return mixed
     */
    public function getLimited($limit, $orderBy = 'p.id', $order = 'asc')
    {
        $query = $this->createQueryBuilder('p')
            ->orderBy($orderBy, $order)
            ->setMaxResults( $limit );

        return $query->getQuery()->getResult();
    }

    /**
     * @param $title
     * @return mixed
     */
    public function findLikeTitle($title)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.title LIKE :title')
            ->setParameter('title', '%' . $title . '%');

        return $query->getQuery()->getResult();
    }


//    /**
//     * @return Post[] Returns an array of Post objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Post
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
