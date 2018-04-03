<?php

namespace App\Controller\Frontend;

use App\Entity\Core\Category;
use App\Entity\Core\Post;
use App\Form\Type\SearchType;
use App\Library\Decorators\PostDecorator;
use App\Service\Core\CategoryService;
use App\Service\Core\PostService;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    /** @var PostService $postService */
    private $postService;

    /** @var  CategoryService $categoryService */
    private $categoryService;

    /** @var PostDecorator $postDecorator */
    private $postDecorator;

    /**
     * BlogController constructor.
     * @param PostService $postService
     * @param PostDecorator $postDecorator
     * @param CategoryService $categoryService
     */
    public function __construct(PostService $postService, PostDecorator $postDecorator, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->postDecorator = $postDecorator;
    }

    /**
     * @Route("/", name="index")
     * @Route("/page/{page}", name="index_listing", requirements={"page"="\d+"})
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getHome(Request $request, $page = 0)
    {
        $posts = $this->postDecorator->getAllPostsPaginated($request, 'index_listing', $page);

        return $this->render('frontend/toroide/index.html.twig', [
            'posts' => $posts,
            'featuredPosts' => $this->postService->getFeaturedPosts($posts),
        ]);
    }

    /**
     * @Route("/search", name="search")
     * @Method({"GET"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getSearch(Request $request)
    {
        $form = $this->getSearchForm();
        $form->handleRequest($request);

        $searchInput = $request->query->get('s');
        if(!$searchInput) {
            throw new NotFoundHttpException();
        }

        $posts = $this->postService->getLikeTitle($searchInput);

        if($form->isSubmitted() && $form->isValid()) {
            return $this->render('frontend/toroide/search.html.twig', [
                'posts' => $posts,
                'searchInput' => $searchInput,
                'count' => count($posts),
            ]);
        }
    }

    /**
     * @Route("/whoami", name="whoami")
     * @Method({"GET"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getWhoami(Request $request)
    {
        return $this->render('frontend/toroide/author.html.twig');
    }

    /**
     * @Route("/{categorySlug}", name="category", requirements={"slug" = "^(?!.*(search|listing)$).*"}, options = {"expose"=true})
     * @Method({"GET"})
     * @param $categorySlug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCategory($categorySlug)
    {
        $category = $this->categoryService->getOneBy(['slug' => $categorySlug]);
        if(!$category instanceof Category) {
            throw new NotFoundHttpException();
        }

        $posts = $this->postService->getBy(['category' => $category]);

        return $this->render('frontend/toroide/category.html.twig', [
            'category' => $category,
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/{categorySlug}/{slug}", name="post")
     * @Method({"GET"})
     * @param $categorySlug
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPost($categorySlug, $slug)
    {
        $category = $this->categoryService->getOneBy(['slug' => $categorySlug]);
        if(!$category instanceof Category) {
            throw new NotFoundHttpException();
        }

        return $this->render('frontend/toroide/post.html.twig', [
            'post' => $this->postService->getOneBy(['slug' => $slug, 'category' => $category])
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
    private function getSearchForm()
    {
        return $this->get('form.factory')->createNamed(null, SearchType::class, null, [
            'action' => $this->generateUrl('search'),
            'method' => 'GET'
        ]);
    }
}
