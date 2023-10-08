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

    private $em;
    private $userRepo;
    private $compagnieRepo;

    public function __construct(EntityManagerInterface $em, UserRepository $userRepo, CompagnieRepository $compagnieRepo)
    {
        $this->em = $em;
        $this->userRepo = $userRepo;
        $this->compagnieRepo = $compagnieRepo;
    }

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
    public function store(Request $request): JsonResponse
    {

        $data = json_decode($request->getContent());

        $createur = $this->userRepo->findOneBy(['id' => $data->createur]);

        $compagnie = $this->compagnieRepo->findOneBy(['id' => $data->compagnie]);

        $userTo = $this->userRepo->findOneBy(['id' => $data->user_id]);

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
        $this->em->persist($tache);
        $this->em->flush();

        return $this->json(["message" => "Added with success"]);
    }



    #[Route("tache/update/{id}", name: "tache.update", methods: ["PUT","PATCH"])]
    public function upgate(Request $request, Tache $tache): JsonResponse
    {
        $data = json_decode($request->getContent());

        $createur = $this->userRepo->findOneBy(['id' => $data->createur]);

        $compagnie = $this->compagnieRepo->findOneBy(['id' => $data->compagnie]);

        $userTo = $this->userRepo->findOneBy(['id' => $data->user_id]);
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
            $periodicite = $tache->getPeriodicite();
            $periodicite->setType($data->type)
                ->setFrequence($data->frequence);

            $tache->setPeriodicite($periodicite);
        }
        $this->em->persist($tache);
        $this->em->flush();


        return $this->json(["message" => "Updated Seccussfully"]);
    }




    #[Route("tache/delete/{id}", name: "tache.destroy", methods: ["POST"])]
    public function delete(Tache $tache): JsonResponse
    {

        $this->em->remove($tache);
        $this->em->flush();
        return $this->json(["message" => "Tache :" . $tache->getTitre() . " Deleted Seccussfully"]);
    }
}
