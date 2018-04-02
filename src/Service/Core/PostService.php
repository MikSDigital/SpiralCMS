<?php


namespace App\Service\Core;

use App\Entity\Core\Post;
use Doctrine\Common\Persistence\ManagerRegistry;


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
     */
    public function __construct(ManagerRegistry $doctrine)
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

    /**
     * @return array
     */
    public function getBy($args)
    {
        return $this->repository->findBy($args);
    }
}