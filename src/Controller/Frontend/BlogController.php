<?php

namespace App\Controller\Frontend;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        // $this->get('blog');

        return $this->render('frontend/toroide/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
}
