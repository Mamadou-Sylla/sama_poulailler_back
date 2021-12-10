<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Profil;
use App\Entity\Employe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;


class UserFixtures extends Fixture
{
    private $encoder;
    public function  __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }

    // public const employe = 'EMPLOYE';
    // public const admin = 'ADMIN';


    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

      
        for ($i=1; $i <=4 ; $i++) {
            # code...
            $user = new User();
            $hash = $this->encoder->encodePassword($user, 'password');
            $user
                ->setPrenom($faker->firstName)
                ->setNom($faker->LastName)
                ->setPassword($hash)
                ->setEmail($faker->email)
                ->setTelephone($faker->phoneNumber)
                ->setIsDeleted(false)
                ->setProfil($this->getReference(ProfilFixtures::Profil_Admin));
                // $this->addReference(self::admin, $user);
            $manager->persist($user);




            $employe = new Employe();
            $hash = $this->encoder->encodePassword($employe, 'password');
            $employe
                ->setPrenom($faker->firstName)
                ->setNom($faker->LastName)
                ->setPassword($hash)
                ->setEmail($faker->email)
                ->setTelephone($faker->phoneNumber)
                ->setIsDeleted(false)
                ->setProfil($this->getReference(ProfilFixtures::Profil_Employe));
                // $this->addReference(self::employe, $employe);
            $manager->persist($employe);



            $manager->flush();
        }
    }
}
