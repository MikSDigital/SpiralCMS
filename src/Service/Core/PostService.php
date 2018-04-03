<?php


namespace App\Service\Core;

use App\Entity\Core\Category;
use App\Entity\Core\Post;
use Doctrine\Common\Persistence\ManagerRegistry;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;


class PostService
{
    const LIMIT = 10;

    /** @var ManagerRegistry $doctrine */
    private $doctrine;

    /** @var \Doctrine\Common\Persistence\ObjectManager $manager */
    private $manager;

    /** @var \Doctrine\Common\Persistence\ObjectRepository $repository */
    private $repository;

    /**
     * PostService constructor.
     * @param ManagerRegistry $doctrine
     * @param PaginatorInterface $paginator
     */
    public function __construct(ManagerRegistry $doctrine, PaginatorInterface $paginator)
    {
        $this->doctrine = $doctrine;
        $this->manager = $doctrine->getManager();
        $this->repository = $this->doctrine->getRepository(Post::class);
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getFiltered($limit)
    {
        return $this->repository->getLimited($limit);
    }

    /**
     * @param $args
     * @return null|object
     */
    public function getOneBy($args)
    {
        return $this->repository->findOneBy($args);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function getAllQuery()
    {
        return $this->repository->findAllQuery();
    }

    public function getByCategoryQuery(Category $category)
    {
        return $this->repository->findByCategoryQuery($category);
    }

    /**
     * @return array
     */
    public function getBy($args)
    {
        return $this->repository->findBy($args);
    }

    /**
     * @param $args
     * @return mixed
     */
    public function getLikeTitle($args)
    {
        return $this->repository->findLikeTitle($args);
    }

    /**
     * @param $posts
     * @return array
     */
    public function getFeaturedPosts($posts)
    {
        return [
            $this->getRandomPost($posts),
            $this->getRandomPost($posts),
        ];
    }

    /**
     * @param $posts
     * @return mixed
     */
    public function getRandomPost($posts)
    {
        return $posts[rand(0, sizeof($posts)-1)];
    }

    /**
     * @param $category
     * @param int $limit
     * @return mixed
     */
    public function getRelatedPostsByCategory($category, $limit = 3)
    {
        return $this->repository->findRelatedPostsByCategory($category, $limit);
    }
}