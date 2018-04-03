<?php

namespace App\Controller\Frontend;

use App\Entity\Core\Author;
use App\Entity\Core\Category;
use App\Entity\Core\Post;
use App\Form\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends BaseController
{
    /**
     * @Route("/", name="spiral_front_index")
     * @Route("/page/{page}", name="spiral_front_index_listing", requirements={"page"="\d+"})
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getHome(Request $request, $page = 1)
    {
        $posts = $this->postDecorator->getPaginated($request->query->get('page', $page), 'spiral_front_index_listing');

        return $this->render('frontend/toroide/index.html.twig', [
            'posts' => $posts,
            'featuredPosts' => $this->postService->getFeaturedPosts($posts),
        ]);
    }

    /**
     * @Route("/search", name="spiral_front_search")
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
     * @Route("/about/{authorSlug}", name="spiral_front_about")
     * @Method({"GET"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAbout(Request $request, $authorSlug)
    {
        $author = $this->authorService->getOneBy(['slug' => $authorSlug]);
        if(!$author instanceof Author) {
            throw new NotFoundHttpException();
        }

        return $this->render('frontend/toroide/author.html.twig', ['author' => $author]);
    }

    /**
     * @Route("/{categorySlug}", name="spiral_front_category", requirements={"slug" = "^(?!.*(search|listing)$).*"}, options = {"expose"=true})
     * @Route("/{categorySlug}/{page}", name="spiral_front_category_listing", requirements={"page"="\d+"})
     * @Method({"GET"})
     * @param Request $request
     * @param $categorySlug
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCategory(Request $request, $categorySlug, $page = 1)
    {
        $category = $this->categoryService->getOneBy(['slug' => $categorySlug]);
        if(!$category instanceof Category) {
            throw new NotFoundHttpException();
        }

        $parameter = $request->query->get('page', $page);
        $posts = $this->postDecorator->getPaginatedByCategory($category, $parameter, 'spiral_front_category_listing');

        return $this->render('frontend/toroide/category.html.twig', [
            'category' => $category,
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/{categorySlug}/{slug}", name="spiral_front_post")
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
}
