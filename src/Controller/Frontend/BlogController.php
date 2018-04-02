<?php

namespace App\Controller\Frontend;

use App\Form\Type\SearchType;
use App\Service\Core\CategoryService;
use App\Service\Core\PostService;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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
    public function index($number = 0)
    {
        return $this->render('frontend/toroide/index.html.twig', [
            'posts' => $this->postService->getFiltered(PostService::LIMIT)
        ]);
    }
    /**
     * @Route("/category/{slug}", name="category")
     * @Method({"GET"})
     */
    public function category($slug)
    {
        return $this->render('frontend/toroide/category.html.twig', [
            'category' => $this->categoryService->getOneBy(['slug' => $slug])
        ]);
    }

    /**
     * @Route("{slug}", name = "post", requirements={"slug" = "^(?!.*(search|category)$).*"}, options = {"expose"=true})
     * @Route("/post/{slug}", name="post_alias")
     * @Method({"GET"})
     */
    public function post($slug)
    {
        return $this->render('frontend/toroide/post.html.twig', [
            'post' => $this->postService->getOneBy(['slug' => $slug])
        ]);
    }

    /**
     * @Route("/search", name="search")
     * @Method({"GET"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search(Request $request)
    {
        $form = $this->getSearchForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            return $this->render('frontend/toroide/search.html.twig', [
                'post' => $this->postService->getOneBy(['slug' => $request->query->get('s')])
            ]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function renderSearch(Request $request)
    {
        $form = $this->getSearchForm();
        return $this->render('frontend/toroide/partials/search_form.html.twig', [
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
