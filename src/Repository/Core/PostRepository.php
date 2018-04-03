<?php

namespace App\Repository\Core;

use App\Entity\Core\Post;
use App\Library\StatusInterface;
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
            ->where('p.status = :status ')
            ->setParameter('status', StatusInterface::STATUS_ONLINE)
            ->orderBy($orderBy, $order)
            ->setMaxResults($limit);

        return $query->getQuery()->getResult();
    }

    /**
     * @return mixed
     */
    public function findAllQuery()
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.status = :status ')
            ->setParameter('status', StatusInterface::STATUS_ONLINE);

        return $query->getQuery();
    }

    /**
     * @param $category
     * @return mixed
     */
    public function findByCategoryQuery($category)
    {
        $query = $this->createQueryBuilder('p')
            ->innerJoin('p.category', 'c')
            ->where('c.id = :category ')
            ->andWhere('p.status = :status')
            ->setParameter('category', $category->getId())
            ->setParameter('status', StatusInterface::STATUS_ONLINE);

        return $query->getQuery();
    }

    /**
     * @param $title
     * @return mixed
     */
    public function findLikeTitle($title)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.title LIKE :title')
            ->andWhere('p.status = :status ')
            ->setParameter('title', '%' . $title . '%')
            ->setParameter('status', StatusInterface::STATUS_ONLINE);

        return $query->getQuery()->getResult();
    }

    /**
     * @param $category
     * @param $limit
     * @return mixed
     */
    public function findRelatedPostsByCategory($category, $limit)
    {
        $query = $this->createQueryBuilder('p')
            ->innerJoin('p.category', 'c')
            ->where('c.slug = :category ')
            ->andWhere('p.status = :status ')
            ->setParameter('category', $category)
            ->setParameter('status', StatusInterface::STATUS_ONLINE)
            ->setMaxResults($limit);

        return $query->getQuery()->getResult();
    }
}
