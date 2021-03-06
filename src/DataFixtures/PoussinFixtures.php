<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Poussin;
use Faker\Provider\zh_TW\DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PoussinFixtures extends Fixture
{

    public const Poulet = 'poulet';



    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $total = [100,2000,1000,600,800];
        $chair = [7,120,70,42,50];



        for ($i=1; $i <=6 ; $i++) {


            $poussin = new Poussin();
            
            $poussin
            ->setNbreTotal($faker->randomElement($total))
            ->setNbreDeces(0)
            ;
            $manager->persist($poussin);



        $manager->flush();
        
        }
        


    }

}