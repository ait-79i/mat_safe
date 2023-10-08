<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Compagnie;
use App\Repository\AdresseRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path: "api/", name: "_api")]
class CompagnieController extends AbstractController
{
    #[Route('compagnie', name: 'app_compagnie', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CompagnieController.php',
        ]);
    }
    #[Route('compagnie', name: 'compagnie.store', methods: ['POST'])]
    public function store(Request $request, EntityManagerInterface $em): JsonResponse
    {

        $data = json_decode($request->getContent());
        $compagnie = new Compagnie();
        $compagnie->setNom($data->nom)
            ->setSecteur($data->secteur)
            ->setSiret($data->siret)
            ->setType($data->type)
            ->setSite($data->site);

        $em->persist($compagnie);
        //* store Company Adresse 
        $adresse = new Adresse();
        $adresse
            ->setDestinataireType($data->destinataire_type)
            ->setAdresse($data->adresse)
            ->setCodePostal($data->code_postal)
            ->setVille($data->ville)
            ->setPays($data->pays)
            ->setCompagnie($compagnie);
        $em->persist($adresse);

        $em->flush();

        return $this->json([
            'message' => $data
        ]);
    }

    #[Route('compagnie/update/{id}', name: 'compagnie.update', methods: ['PUT', 'PATCH'])]
    public function update(Request $request, EntityManagerInterface $em, Compagnie $compagnie, AdresseRepository $adresseRepo): JsonResponse
    {
        $compagnieAdresse = $adresseRepo->findOneBy(["compagnie" => $compagnie->getId()]);
        $data = json_decode($request->getContent());
        $compagnie->setNom($data->nom)
            ->setSecteur($data->secteur)
            ->setSiret($data->siret)
            ->setType($data->type)
            ->setSite($data->site);

        $compagnieAdresse->setDestinataireType($data->destinataire_type)
            ->setAdresse($data->adresse)
            ->setCodePostal($data->code_postal)
            ->setVille($data->ville)
            ->setPays($data->pays);
        $em->persist($compagnieAdresse);
        $em->persist($compagnie);
        $em->flush();

        return $this->json([
            'message' => 'Compagnie Updated succussfully!'
        ]);
    }

    #[Route('compagnie/delete/{id}', name: 'compagnie.destroy', methods: ['POST'])]
    public function delete(EntityManagerInterface $manager, Compagnie $compagnie, UserRepository $userRepository, AdresseRepository $adresseRepo): JsonResponse
    {
        $compadresse = $adresseRepo->findOneBy(["compagnie" => $compagnie->getId()]);

        $users = $userRepository->findBy(["compagnie" => $compagnie->getId()]);
        foreach ($users as $user) {
            $manager->remove($user);
        }
        $manager->remove($compadresse);
        $manager->remove($compagnie);
        $manager->flush();
        return $this->json(['message' => "deleted succussfully"]);
    }
}
