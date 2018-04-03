<?php


namespace App\Library\Decorators;


use App\Entity\Core\Category;
use App\Service\Core\PostService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PostDecorator
{

    /** @var PostService $postService */
    private $postService;

    /** @var PaginatorInterface $paginator */
    private $paginator;

    /**
     * PostService constructor.
     * @param PostService $postService
     * @param PaginatorInterface $paginator
     */
    public function __construct(PostService $postService, PaginatorInterface $paginator)
    {
        $this->postService = $postService;
        $this->paginator = $paginator;
    }

    /**
     * @param $parameter
     * @param $route
     * @param null $query
     * @return mixed
     */
    public function getPaginated($parameter, $route, $query = null)
    {
        if(!$query) {
            $query = $this->postService->getAllQuery();
        }

        $pagination = $this->paginator->paginate(
            $query,
            $parameter,
            5
        );
        $pagination->setUsedRoute($route);

        return $pagination;
    }

    /**
     * @param Category $category
     * @param $parameter
     * @param $route
     * @return mixed
     */
    public function getPaginatedByCategory(Category $category, $parameter, $route)
    {
        return $this->getPaginated($parameter, $route, $this->postService->getByCategoryQuery($category));
    }

}