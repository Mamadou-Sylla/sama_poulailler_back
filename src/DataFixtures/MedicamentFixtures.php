<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Medicament;
use Faker\Provider\zh_TW\DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MedicamentFixtures extends Fixture
{

    public const Medicament = 'medicament';

    

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $quantite = [10,120,80,60,45];
        $prix = [7000,21000,9000,4200,5000];

        for ($i=1; $i <=6 ; $i++) {


            $medicament = new Medicament();

            $medicament
            ->setLibelle("medicament_".$i)
            ->setQuantite($faker->randomElement($quantite))
            ->setPrixTotal($faker->randomElement($prix))
            ;
            $manager->persist($medicament);



        $manager->flush();
        }
        


    }

}