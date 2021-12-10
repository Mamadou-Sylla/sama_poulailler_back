<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Profil;

class ProfilFixtures extends Fixture
{
    public const Profil_Admin = 'ADMIN';
    public const Profil_Employe = 'EMPLOYE';




    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $profil_admin = new Profil();
        $profil_admin
            ->setLibelle("ADMIN")
            ;
        $this->addReference(self::Profil_Admin, $profil_admin);
        $manager->persist($profil_admin);

       


        $profil_employe = new Profil();
        $profil_employe
            ->setLibelle("EMPLOYE")
            ;
        $this->addReference(self::Profil_Employe, $profil_employe);
        $manager->persist($profil_employe);

        $manager->flush();


    }

}