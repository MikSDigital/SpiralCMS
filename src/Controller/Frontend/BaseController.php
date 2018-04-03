<?php


namespace App\Controller\Frontend;

use App\Entity\Core\Post;
use App\Form\Type\SearchType;
use App\Library\Decorators\PostDecorator;
use App\Service\Core\AuthorService;
use App\Service\Core\CategoryService;
use App\Service\Core\PostService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    /** @var PostService $postService */
    protected $postService;

    /** @var  CategoryService $categoryService */
    protected $categoryService;

    /** @var PostDecorator $postDecorator */
    protected $postDecorator;

    /** @var  AuthorService $authorService */
    protected $authorService;

    /**
     * BlogController constructor.
     * @param PostService $postService
     * @param PostDecorator $postDecorator
     * @param CategoryService $categoryService
     * @param AuthorService $authorService
     * @internal param AuthorService $service
     */
    public function __construct(PostService $postService, PostDecorator $postDecorator, CategoryService $categoryService, AuthorService $authorService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->postDecorator = $postDecorator;
        $this->authorService = $authorService;
    }

    /**
     * @param $category
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param Request $request
     */
    public function renderRelatedPosts($category)
    {
        return $this->render('frontend/toroide/partials/post/related.html.twig', [
            'posts' => $this->postService->getRelatedPostsByCategory($category)
        ]);
    }

    /**
     * @return mixed
     */
    public function renderSearch()
    {
        $form = $this->getSearchForm();

        return $this->render('frontend/toroide/partials/search/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return mixed
     */
    public function renderNavigator()
    {
        return $this->render('frontend/toroide/partials/navigator.html.twig', [
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getSearchForm()
    {
        return $this->get('form.factory')->createNamed(null, SearchType::class, null, [
            'action' => $this->generateUrl('spiral_front_search'),
            'method' => 'GET'
        ]);
    }

}