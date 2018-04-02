<?php

namespace App\Controller\Frontend;

use App\Entity\Core\Category;
use App\Entity\Core\Post;
use App\Form\Type\SearchType;
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

    /**
     * BlogController constructor.
     * @param PostService $postService
     */
    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }

    /**
     * @Route("/", name="index")
     * @Route("/page/{number}", name="index_page", requirements={"page"="\d+"})
     * @Method({"GET", "POST"})
     */
    public function getHome($number = 0)
    {
        return $this->render('frontend/toroide/index.html.twig', [
            'posts' => $this->postService->getFiltered(PostService::LIMIT)
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
     * @Route("/{categorySlug}", name="category", requirements={"slug" = "^(?!.*(search)$).*"}, options = {"expose"=true})
     * @Method({"GET"})
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
     * @param Request $request
     * @return mixed
     */
    public function renderSearch(Request $request)
    {
        $form = $this->getSearchForm();
        return $this->render('frontend/toroide/partials/search/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function renderNavigator(Request $request)
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
