<?php

namespace App\Controller;

use App\Entity\Periodicite;
use App\Entity\Tache;
use App\Repository\CompagnieRepository;
use App\Repository\TacheRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api/', name: '_api')]
class TacheController extends AbstractController
{

    #[Route('taches', name: 'taches.index')]
    public function index(TacheRepository $rep): JsonResponse
    {
        $taches = $rep->findAll();

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'data' => $taches,
        ]);
    }

    #[Route('tache', name: 'tache.store', methods: ["POST"])]
    public function store(Request $request, EntityManagerInterface $em, UserRepository $userRepo, CompagnieRepository $compagnieRep): JsonResponse
    {

        $data = json_decode($request->getContent());

        $createur = $userRepo->findOneBy(['id' => $data->createur]);

        $compagnie = $compagnieRep->findOneBy(['id' => $data->compagnie]);

        $userTo = $userRepo->findOneBy(['id' => $data->user_id]);

        $tache = new Tache();
        $tache
            ->setCreator($createur)
            ->setTitre($data->titre)
            ->setComplexite($data->complexite)
            ->setPriorite($data->priorite)
            ->setDescription($data->description)
            ->setReferance($data->referance)
            ->setMotCles($data->mot_cles)
            ->setReferanciel($data->referanciel)
            ->setDateDebut(new \DateTimeImmutable())
            ->setEcheance(new \DateTimeImmutable('+1 week'))
            ->setStatut($data->statut)
            ->setEstRecurrente($data->est_recurrente)
            ->setRole($data->role)

            ->setCompagnie($compagnie)
            ->addUser($userTo);

        if ($data->est_recurrente) {
            $periodicite = new Periodicite();
            $periodicite->setType($data->type)
                ->setFrequence($data->frequence);

            $tache->setPeriodicite($periodicite);
        }
        $em->persist($tache);
        $em->flush();

        return $this->json(["message"=>"Added with success"]);
    }




    public function upgate(): JsonResponse
    {
        return $this->json([]);
    }
    public function delete(): JsonResponse
    {
        return $this->json([]);
    }
}
