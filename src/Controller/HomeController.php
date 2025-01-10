<?php

namespace App\Controller;

use App\Repository\BookReadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{   
    private BookReadRepository $bookReadRepository;

    public function __construct(BookReadRepository $bookReadRepository)
    {
        $this->bookReadRepository = $bookReadRepository;
    }
    
    #[Route('/', name: 'app.home')]
    public function index(): Response
    {
        $userId = 1;
        $booksRead  = $this->bookReadRepository->findByUserId($userId, false);

        return $this->render('pages/home.html.twig', [
            'booksRead' => $booksRead,
            'name'      => 'Accueil',
        ]);
    }
}
