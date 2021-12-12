<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Aliment;
use Faker\Provider\zh_TW\DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AlimentFixtures extends Fixture
{

    public const Aliment = 'aliment';

    

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $quantite = [10,120,80,60,45];
        $prix = [7000,21000,9000,4200,5000];
        $categorie_aliment = ['demerrage', 'croissance', 'finition'];

        for ($i=1; $i <=6 ; $i++) {


            $aliment = new Aliment();

            $aliment
            ->setType($faker->randomElement($categorie_aliment))
            ->setQuantite($faker->randomElement($quantite))
            ->setPrixTotal($faker->randomElement($prix))
            ;
            $manager->persist($aliment);



        $manager->flush();
        }
        


    }

}