<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\Adresse;
use App\Entity\Permission;
use App\Entity\Compagnie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $faker, $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create("fr_FR");
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

        $LONGUES = [
            "français", "espagnol", "anglais", "allemand", "italien", "portugais", "russe", "chinois", "japonais", "arabe",
            "hindi", "néerlandais", "suédois", "norvégien", "danois", "finnois", "coréen", "grec", "turc", "polonais",
            "hébreu", "persan", "thaï", "vietnamien", "indonésien", "malais", "tagalog", "swahili", "hongrois", "tchèque",
            "roumain", "bulgare", "ukrainien", "croate", "serbe", "slovaque", "slovène", "lituanien", "letton", "estonien",
            "maltais", "albanais", "macédonien", "bosniaque", "monténégrin", "kazakh", "ouzbek", "turkmène", "kirghize",
            "tadjik", "mongol", "népalais", "bengali", "tamil", "marathi", "gujarati", "ourdou", "pendjabi", "bengali",
            "télougou", "Kannada", "malayalam", "sanskrit", "catalan", "galicien", "basque", "gallois", "irlandais", "écossais",
            "breton", "gaélique", "maltais", "finlandais", "estonien", "letton", "lituanien", "biélorusse", "ukrainien", "russe",
            "arménien", "géorgien", "azerbaïdjanais", "kazakh", "ouzbek", "turkmène", "kirghize", "tadjik", "mongol", "Nepali",
            "bengali", "tamil", "marathi", "gujarati", "urdu", "Punjabi", "telugu", "Kannada", "malayalam", "sanskrit",
        ];

        $rolesInstances = [];
        $roles = [
            "ROLE_USER",
            "ROLE_ADMIN",
            "ROLE_INTERVIEW",
        ];

        for ($j = 0; $j <= 2; $j++) {
            $role = new Role();
            $role->setTitre($roles[$j]);
            $manager->persist($role);
            $rolesInstances[] = $role;
        }

        $randomIndex = array_rand($rolesInstances);
        $randomRole = $rolesInstances[$randomIndex];


        $permissions = [
            "add",
            "delete",
            "update",
        ];
        for ($j = 0; $j < 3; $j++) {
            $permission = new Permission();
            $permission->setTitre($permissions[$j]);
            mt_rand(0, 1) == 1 ? $permission->addRole($randomRole) : null;
            $manager->persist($permission);
        }


        for ($i = 1; $i <= 6; $i++) {
            $comp = new Compagnie();
            $comp->setNom($this->faker->company())
                ->setSiret($this->faker->uuid())
                ->setSite($this->faker->url())
                ->setSecteur($this->faker->catchPhrase())
                ->setType($this->faker->randomElement(['Filiale', 'Sous-traitant', 'Client']));

            $user = new User;

            $password = $this->hasher->hashPassword($user, 'admin');
            $user->setUsername($this->faker->email())
                ->setEmail($this->faker->email())
                ->setPassword($password)
                ->setRoles($this->faker->randomElement([["ROLE_ADMIN"], ["ROLE_INTERVIEW"], ["ROLE_USER"]]))
                ->setNom($this->faker->lastName())
                ->setPrenom($this->faker->firstName())
                ->setTelephone($this->faker->e164PhoneNumber())
                ->setFonction($this->faker->words(3, true))
                ->setLongue($this->faker->randomElement($LONGUES))
                ->setCompagnie($comp);


            $adresse = new Adresse();
            $adresse
                ->setDestinataireType($this->faker->randomElement(["ORGANISME", "AUTRE"]))
                ->setAdresse($this->faker->address())
                ->setCodePostal($this->faker->postcode())
                ->setVille($this->faker->city())
                ->setPays($this->faker->country());

            $user->setAdresse($adresse);
            mt_rand(0, 1) == 1 ? $user->addRoleId($randomRole) : null;

            $manager->persist($comp);
            $manager->persist($user);
        }




        $manager->flush();
    }
}
