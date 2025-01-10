<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'auth.login',)]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('auth/login.html.twig', [ //récupére les infos pour se connecter
            'last_username' => $authenticationUtils->getLastUsername(), 
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);

    }
    #[Route('/logout', name: 'auth.logout')]
    public function logout(): void {} //fonction pour se déconnecter
}