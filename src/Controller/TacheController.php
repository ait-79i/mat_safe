<?php

namespace App\Controller;

use App\Repository\TacheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TacheController extends AbstractController
{
    #[Route('/tache', name: 'app_tache')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TacheController.php',
        ]);
    }
    
    #[Route('/api/taches', name:'taches.index')]
    public function getTachesAction(TacheRepository $rep): JsonResponse
    {
        $taches = $rep->findAll();


        return $this->json([
            'message' => 'Welcome to your new controller!',
            'data' => $taches,
        ]);
    }
}
