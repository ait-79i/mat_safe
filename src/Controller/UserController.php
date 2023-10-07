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

    #[Route('api/user', name: 'user.store', methods: ['POST', 'GET'])]
    public function store(
        Request $request,
        ManagerRegistry $doctrine,
        UserPasswordHasherInterface $passwordHasher,
        CompagnieRepository  $repository,
        RoleRepository  $rolerepository,
        EntityManagerInterface $entityManager
    ): Response {

        if ($request->isMethod('GET')) {
            // Do something for GET requests
            return
                $this->json([
                    'message' => 'this is a get method try POST to add w new user 😊👍'
                ]);
        } else {

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
            $randomIndex = mt_rand(0, count($compagnies) - 1);

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
                ->setCompagnie($compagnies[$randomIndex])
                ->addUserRole($role)
                ->setLongue($data->longue);

            //* store User Adresse 

            $adresse = new Adresse();
            $adresse
                ->setDestinataireType($data->destinataireType)
                ->setAdresse($data->adresse)
                ->setCodePostal($data->code_postal)
                ->setVille($data->ville)
                ->setPays($data->pays);
            $user->setAdresse($adresse);

            //* invetation info

            $validation = new DateTimeImmutable();
            $demo = new DateTimeImmutable();
            $invetation = new Invetation();
            $invetation->setDateValidation($validation)
                ->setFinDemo($demo)
                ->setIsConfirmed($data->confirmation);
            $user->addInvetation($invetation);
            $em->persist($user);


            //* set roles and permissions
            $permission = new Permission();
            $permission->setTitre($data->permission)
                ->addRole($role);
            $em->persist($permission);

            $em->flush();
            return $this->json([
                'message' => 'User was Added Successfully  check the database'
            ]);
        }
    }


    // =========================================================================

    //* UPDATE USER DATA

    #[Route('api/user/edition/{id}', name: 'user.update', methods: ['GET', "POST"])]
    public function update(
        Request $request,
        User $user,
        AdresseRepository $adresserepo,
        RoleRepository $rolerepo,
        EntityManagerInterface $Manager,
        int $id
    ): Response {
        if ($request->isMethod('GET')) {

            $userRolesArray = [];
            $userPermissionsArray = [];
            foreach ($user->getRoleId() as $role) {
                $userRolesArray[] = $role->getTitre();

                foreach ($role->getPermissions() as $permission) {
                    $userPermissionsArray[] = $permission->getTitre();
                }
            }
            return $this->json([
                'message' => 'Update route',
                "user " => [
                    "nom" => $user->getNom(),
                    "prenom" => $user->getPrenom(),
                    "fonction" => $user->getFonction(),
                    "email" => $user->getEmail(),
                    "telephone" => $user->getTelephone(),
                    "destinataireType" => $user->getNom(),
                    "adresse" => $user->getAdresse()->getAdresse(),
                    "code_postal" => $user->getAdresse()->getCodePostal(),
                    "ville" => $user->getAdresse()->getVille(),
                    "pays" => $user->getAdresse()->getPays(),
                    "longue" => $user->getLongue(),
                    "role" => $userRolesArray,
                    "permissions" => $userPermissionsArray,
                ]
            ]);
        } else {

            $newData = json_decode($request->getContent());
            $adresseIns = $adresserepo->find($user);
            // $roleinst = $rolerepo->findOneBy(['id' => $user]);
            // $adresseIns
            //     ->setAdresse($newData->adresse)
            //     ->setCodePostal($newData->code_postal)
            //     ->setVille($newData->ville)
            //     ->setPays($newData->pays);


            $user->setNom($newData->nom)
                ->setPrenom($newData->prenom)
                ->setFonction($newData->fonction)
                ->setEmail($newData->email)
                ->setTelephone($newData->telephone)
                ->setLongue($newData->longue);
            // ->setAdresse($adresseIns);
            $Manager->persist($user);
            $Manager->flush();
            //     // ->addRoleId($roleinst);

            // // "role" => $userRolesArray,
            // // "permissions" => $userPermissionsArray,

            return $this->json(["user " => [
                "nom" => $user->getNom(),
                "prenom" => $user->getPrenom(),
                "fonction" => $user->getFonction(),
                "email" => $user->getEmail(),
                "telephone" => $user->getTelephone(),
                "destinataireType" => $user->getNom(),
                "adresse" => $user->getAdresse()->getAdresse(),
                "code_postal" => $user->getAdresse()->getCodePostal(),
                "ville" => $user->getAdresse()->getVille(),
                "pays" => $user->getAdresse()->getPays(),
                "longue" => $user->getLongue()
            ]]);
        }
    }

    // =========================================================================

    //* DELETE A USER 


    #[Route('api/user/delete/{id}', 'user.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, User $user,): Response
    {
        $manager->remove($user);
        $manager->flush();
        return $this->json(['message' => 'DELETED SUCCESSFULLY']);
    }
}
