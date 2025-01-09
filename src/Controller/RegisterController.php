<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;


class RegisterController extends AbstractController
{
    #[Route('/register', name: 'auth.register', methods: ['GET', 'POST'])]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
    ): Response {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');

            if (strlen($password) < 8) {
                return $this->render('auth/register.html.twig', [
                    'errors' => ['Le mot de passe doit contenir au moins 8 caractères.'],
                ]);
            }
            $existingUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($existingUser) {
                // Si l'email est déjà pris, afficher un message d'erreur
                return $this->render('auth/register.html.twig', [
                    'errors' => ['cet email existe déja'],
                ]);
                
            }

            $user = new User();
            $user->setEmail($email);

            $hashedPassword = $passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('auth.login');
        }

        return $this->render('auth/register.html.twig');
    }
}
