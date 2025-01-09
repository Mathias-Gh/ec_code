<?php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class LoginController extends AbstractController
{
    #[Route('/auth/login', name: 'auth.login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Obtenez les éventuelles erreurs d'authentification
        $error = $authenticationUtils->getLastAuthenticationError();

        // Récupérez le dernier email saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
            
    }
    
    #[Route('/auth/logout', name: 'auth.logout', methods: ['GET'])]
    public function logout(): void
    {
        // Ce contrôleur peut être vide : Symfony gère la déconnexion automatiquement.
    }
}
