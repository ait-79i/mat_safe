<?php

namespace App\Controller;

use App\Entity\User;
use DateTimeImmutable;
use App\Entity\Adresse;
use App\Entity\Invetation;
use App\Entity\Permission;
use App\Repository\AdresseRepository;
use App\Repository\RoleRepository;
use App\Repository\CompagnieRepository;
use App\Repository\InvetationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

// #[Route("/api", name: "api_")]
class UserController extends AbstractController
{
    #[Route('user', name: 'app_user')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
        ]);
    }

    #[Route('api/user', name: 'user.store', methods: ['POST'])]
    public function store(
        Request $request,
        ManagerRegistry $doctrine,
        UserPasswordHasherInterface $passwordHasher,
        CompagnieRepository  $repository,
        RoleRepository  $rolerepository,
        EntityManagerInterface $entityManager
    ): Response {

        $em = $doctrine->getManager();
        $data = json_decode($request->getContent());

        $user = new User();
        $nomComplet = $data->prenom . $data->prenom;
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $nomComplet
        );

        //! retrive compagnies 

        $compagnies = $repository->findAll();

        //! SAFE IN THE USER TABLE 
        $role = $rolerepository->find($data->role);

        $user
            ->setNom($data->nom)
            ->setPrenom($data->prenom)
            ->setFonction($data->fonction)
            ->setEmail($data->email)
            ->setTelephone($data->telephone)
            ->setUsername($nomComplet)
            ->setPassword($hashedPassword)
            ->setRoles($data->roles)
            ->setCompagnie($compagnies[mt_rand(1, 5)])

            ->addUserRole($role)
            ->setLongue($data->longue);
        $em->persist($user);


        //! store IN THE ADRESSE TABLE 

        $adresse = new Adresse();

        $adresse
            ->setDestinataireType($data->destinataireType)
            ->setAdresse($data->adresse)
            ->setCodePostal($data->code_postal)
            ->setVille($data->ville)
            ->setPays($data->pays);
        $em->persist($adresse);

        //! STORE IN THE INVETATION TABLE 
        $validation = new DateTimeImmutable();
        $demo = new DateTimeImmutable();
        $invetation = new Invetation();
        $invetation->setDateValidation($validation)
            ->setFinDemo($demo)
            ->setIsConfirmed($data->confirmation)
            ->setUser($user);
        $em->persist($invetation);

        //! STORE IN THE INVETATION TABLE 
        //* set roles and permissions
        $permission = new Permission();
        $permission->setTitre($data->permission)
            ->addRole($role);
        $em->persist($permission);

        $em->flush();
        return $this->json([
            'message' => 'Registered Successfully chof database',
            "roles" => $role,
            "compagnies" => $compagnies
        ]);
    }

    #[Route('api/user/delete/{id}', 'user.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, User $user,): Response
    {
        $manager->remove($user);
        $manager->flush();
        return $this->json(['message' => 'DELETED SUCCESSFULLY']);
    }

    //* UPDATE USER DATA

    #[Route('api/user/edition/{id}', name: 'user.update', methods: ['GET', "POST"])]
    public function update(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        CompagnieRepository $repository,
        User $user,
    ): Response {
        return $this->json([
            'message' => 'Update route',
            "user " => [
                "nom" => $user->getNom(),
                "prenom" => $user->getPrenom(),
                "fonction" => $user->getNom(),
                "email" => $user->getEmail(),
                "telephone" => $user->getTelephone(),
                "destinataireType" => $user->getNom(),
                "adresse" => $user->getAdresse()->getCodePostal(),
                "longue" => $user->getLongue(),
                "roles" => $user->getUserRoles(),
                "role" => $user->getRoleId(),
            ]
        ]);
    }
}
