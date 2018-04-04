<?php

namespace App\Service\Frontend;

use App\Entity\Core\Category;
use App\Entity\Core\Post;
use Doctrine\Common\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;

class SitemapService
{
    /** @var ManagerRegistry $doctrine */
    private $doctrine;

    /** @var \Doctrine\Common\Persistence\ObjectManager $manager */
    private $manager;

    /** @var \Doctrine\Common\Persistence\ObjectRepository $postRepository */
    private $postRepository;

    /** @var \Doctrine\Common\Persistence\ObjectRepository $categoryRepository */
    private $categoryRepository;

    /** @var UrlGeneratorInterface $router */
    private $router;

    /**
     * PostService constructor.
     * @param ManagerRegistry $doctrine
     * @param Router $router
     */
    public function __construct(ManagerRegistry $doctrine, UrlGeneratorInterface $router)
    {
        $this->doctrine = $doctrine;
        $this->manager = $doctrine->getManager();
        $this->postRepository = $this->doctrine->getRepository(Post::class);
        $this->categoryRepository = $this->doctrine->getRepository(Category::class);
        $this->router = $router;
    }

    /**
     * @return array
     */
    public function getSitemap()
    {
        return array_merge(
            $this->getIndexUrl(),
            $this->getPostsUrls(),
            $this->getCategoriesUrls()
        );
    }

    /**
     * @return array
     */
    public function getPostsUrls()
    {
        $urls = [];

        foreach ($this->postRepository->findAll() as $post) {
            $urls[] = [
                'loc' => $this->router->generate('spiral_front_post', [
                    'categorySlug' => $post->getCategory()->getSlug(),
                    'slug' => $post->getSlug(),
                ]),
                'priority' => '0.5'
            ];
        }

        return $urls;
    }

    /**
     * @return array
     */
    public function getCategoriesUrls()
    {
        $urls = [];

        foreach ($this->categoryRepository->findAll() as $category) {
            $urls[] = [
                'loc' => $this->router->generate('spiral_front_category', [
                    'categorySlug' => $category->getSlug()
                ]),
                'priority' => '0.5'
            ];
        }

        return $urls;
    }

    /**
     * @return array
     */
    public function getIndexUrl(): array
    {
        $urls[] = [
            'loc' => $this->router->generate('spiral_front_index'),
            'changefreq' => 'daily',
            'priority' => '1.0'
        ];

        return $urls;
    }

}