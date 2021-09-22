<?php

namespace App\Security;
use App\Repository\UserRepository;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\PasswordUpgradeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class LoginFormAuthenticator extends AbstractAuthenticator
{

    private $userRepository;
    private $urlGenerator;
    public function __construct(UserRepository $userRepository, UrlGeneratorInterface $urlGenerator)
    {
        $this->userRepository = $userRepository;
        $this->urlGenerator = $urlGenerator;

     //   dd($userRepository);
    }

  
    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'app_login'
         && $request->isMethod('POST');
    }
   

    public function authenticate(Request $request): PassportInterface
    {
        //dd($request->request->get('email'));

        $user = $this->userRepository->findOneByEmail($request->request->get('email'));
        // saving in session of what is entered by the user
        $request->getSession()->set(
            'app_login_form_old_email', 
            $request->request->get('email') 
        );


        if (!$user) {
            throw new CustomUserMessageAuthenticationException('invalid Credentials!');
        }

        return new Passport(
            $user,
            new PasswordCredentials($request->request->get('password')), [
                new CsrfTokenBadge('login_form', $request->request->get('csrf_token')),
            //for remerber_me
                new RememberMeBadge 


        //a revoir et utiliser si l'encodage change     
        //new PasswordUpgradeBadge($request->get('password'), $this->userRepository)
        ]);
    }
   


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
         $request->getSession()->getFlashBag()->add('success', 'Vous êtes connecté');
        return new RedirectResponse($this->urlGenerator->generate('app_home'));
    }
   

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        //dd($exception);
        $request->getSession()->getFlashBag()->add('error', 'Email ou Password Invalide');
        return new RedirectResponse($this->urlGenerator->generate('app_login'));
    }
   
   
   
}