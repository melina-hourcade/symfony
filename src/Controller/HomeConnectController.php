<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PostArt;
use App\Form\PostArtType;
use App\Repository\PostArtRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeConnectController extends AbstractController
{
    /**
     * @Route("/homeConnect", name="app_homeConnect_index")
     * @IsGranted("ROLE_USER")
     */
    public function index(PostArtRepository $ripo)
    {
        // $post = new Post();
        // $post->setTitle('titre 1')
        // ->setContent('blabla')
        // ->setAuthor('moi meême ')
        // ->setCreateAt(new \DateTimeImmutable());

        //dd($post);
        $posts = $ripo->findAll();
        
        return $this->render('HomeConnect/index.html.twig', [
            "posts" => $posts
        ]);
    }

    /**
     * @Route("/posts/{id}", name="show_post")
     * @IsGranted("ROLE_USER")
     */
    public function show(PostArt $post) {
         return $this->render('blog/post.html.twig', [
            "post" => $post
        ]);
    }

     /**
     * @Route("/posts/{id}/edit", name="app_article_update")
     * @IsGranted("ROLE_USER")
     */
    public function edit(PostArt $poste) {

        $form = $this->createForm(PostArtType::class);

        
         return $this->render('blog/edit.html.twig', [
            'post' => $poste,
            'form' => $form->createView()
         ]);

    }





}
