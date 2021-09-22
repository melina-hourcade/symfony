<?php

namespace App\Controller;

use App\Controller\registrationForm;
use App\Form\UserRegistrationFormType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use function PHPUnit\Framework\throwException;

class SecurityController extends AbstractController
{
     /**
     * @Route("/register", name="app_register", methods={"GET", "POST"})
     * 
     */
//inject encoder interface and entity manager for persist user     
    public function register(Request $request, EntityManagerInterface $em,  UserPasswordEncoderInterface $passwordEncoder) : Response
    {
        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {
           // dd($form->getData());
           $user = $form->getData();
//we need a hashing about plainPassword (userRegstrationFormType.php)
            $plainPassword = ($form['plainPassword']->getData());

            $user->setPassword($passwordEncoder->encodePassword($user, $plainPassword));
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Incription Validée');

            return $this->redirectToRoute('app_login');

        }


        //dd($form);
        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView()
        ]);
    }
    


    /**
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     * 
     */
    public function login() 
    {
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout() 
    {
        throw new \logicException('This method can be blank - it will be intercepted 
        by the logout key on your firewall.');
    }



}