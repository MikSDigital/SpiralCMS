<?php

namespace App\Service\Core;

use App\Entity\Core\Category;
use Doctrine\Common\Persistence\ManagerRegistry;

class CategoryService
{
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
        $this->repository = $this->doctrine->getRepository(Category::class);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->repository->findAll();
    }

    /**
     * @param $args
     * @return null|object
     */
    public function getOneBy($args)
    {
        return $this->repository->findOneBy($args);
    }
}