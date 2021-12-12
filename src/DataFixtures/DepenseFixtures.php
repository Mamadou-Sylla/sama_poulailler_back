<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Aliment;
use App\Entity\Depense;
use Faker\Provider\zh_TW\DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class DepenseFixtures extends Fixture
{

    public const Depense = 'depense';

    

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $quantite = [10,120,80,60,45];
        $prix = [7000,21000,9000,4200,5000];

        for ($i=1; $i <=6 ; $i++) {


            $depense = new Depense();

            $depense
            ->setLibelle('libelle_'.$i)
            ->setQuantite($faker->randomElement($quantite))
            ->setPrixTotal($faker->randomElement($prix))
            ->setDate(($faker->dateTime()))
            ;
            $manager->persist($depense);



        $manager->flush();
        }
        


    }

}