<?php


namespace App\Library\Decorators;


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
     * @param Request $request
     * @param $route
     * @param $item
     * @return mixed
     */
    public function getAllPostsPaginated(Request $request, $route, $item)
    {
        $pagination = $this->paginator->paginate(
            $this->postService->getAllQuery(),
            $request->query->get('page', $item),
            5
        );
        $pagination->setUsedRoute($route);

        return $pagination;
    }

}