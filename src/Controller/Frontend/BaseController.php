<?php


namespace App\Controller\Frontend;

use App\Entity\Core\Post;
use App\Form\Type\SearchType;
use App\Library\Decorators\PostDecorator;
use App\Service\Core\AuthorService;
use App\Service\Core\CategoryService;
use App\Service\Core\PostService;
use App\Service\Frontend\SitemapService;
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

    protected $sitemapService;

    /**
     * BlogController constructor.
     * @param PostService $postService
     * @param PostDecorator $postDecorator
     * @param CategoryService $categoryService
     * @param AuthorService $authorService
     * @param SitemapService $sitemapService
     * @internal param AuthorService $service
     */
    public function __construct(PostService $postService, PostDecorator $postDecorator, CategoryService $categoryService, AuthorService $authorService, SitemapService $sitemapService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->postDecorator = $postDecorator;
        $this->authorService = $authorService;
        $this->sitemapService = $sitemapService;
    }

    /**
     * @param $category
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param Request $request
     */
    public function renderRelatedPosts($category)
    {
        return $this->render('frontend/toroide/partials/post/_related.html.twig', [
            'posts' => $this->postService->getRelatedPostsByCategory($category)
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param Request $request
     */
    public function renderFooter()
    {
        return $this->render('frontend/toroide/partials/_footer.html.twig');
    }

    /**
     * @return mixed
     */
    public function renderSearch()
    {
        $form = $this->getSearchForm();

        return $this->render('frontend/toroide/partials/search/_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return mixed
     */
    public function renderNavigator()
    {
        return $this->render('frontend/toroide/partials/_navigator.html.twig', [
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