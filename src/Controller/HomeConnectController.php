<?php

namespace App\Controller;

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
    public function index(): Response
    {
        return $this->render('HomeConnect/index.html.twig');
    }
}
