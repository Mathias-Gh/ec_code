<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'auth.register', methods: ['GET', 'POST'])]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
    ): Response {
        if ($request->isMethod('POST')) {
            // ça permet de récupérer les emails et les passwords
            $email = $request->request->get('email');
            $password = $request->request->get('password');

            if (strlen($password) < 8) {
                return $this->render('auth/register.html.twig', [
                    'errors' => ['Le mot de passe doit contenir au moins 8 caractères.'],
                ]);
            }
            $existingUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($existingUser) {
                // gérer les messages d'erreurs lorsqu'on réutilise un email déja utilisé
                return $this->render('auth/register.html.twig', [
                    'errors' => ['cet email est déja utilisé'],
                ]);
                
            }
            $user = new User();
            $user->setEmail($email);

            // Ici c'est pour hasher le mot de passe pour qu'il soit crypté
            $hashedPassword = $passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword); 

            $entityManager->persist($user);
            $entityManager->flush(); // la on envoit les informations en bases de données

            return $this->redirectToRoute('auth.login'); //redirection vers la page quand l'utilisateur s'est enregistré
        }

        return $this->render('auth/register.html.twig');
    }
}
