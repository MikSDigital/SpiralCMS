<?php


namespace App\Service\Core;


use App\Entity\Core\Author;
use Doctrine\Common\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

class AuthorService
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
        $this->repository = $this->doctrine->getRepository(Author::class);
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