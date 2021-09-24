<?php

namespace App\Controller;

use App\Repository\PostArtRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="app_home", methods={"GET"})
     * 
     */
    public function index(PostArtRepository $ripo)
    {
      //  return $this->render('home.html.twig');
        
        $posts = $ripo->findAll();
        
        return $this->render('HomeConnect/index.html.twig', [
            "posts" => $posts
        ]);
    }
}