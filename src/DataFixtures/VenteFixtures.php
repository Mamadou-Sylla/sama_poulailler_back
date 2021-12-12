<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Vente;
use Faker\Provider\zh_TW\DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class VenteFixtures extends Fixture
{

    public const Vente = 'vente';

    

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $quantite = [700,500,1800,60,50];
        $prix = [3000000,2041000,9000000,120000,150000];

        for ($i=1; $i <=6 ; $i++) {


            $vente = new Vente();

            $vente
            ->setLibelle('libelle_'.$i)
            ->setQuantite($faker->randomElement($quantite))
            ->setPrixTotal($faker->randomElement($prix))
            ->setDate(($faker->dateTime()))
            ;
            $manager->persist($vente);



        $manager->flush();
        }
        


    }

}