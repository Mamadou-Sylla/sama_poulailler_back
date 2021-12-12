<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Poulet;
use Faker\Provider\zh_TW\DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PouletFixtures extends Fixture
{

    public const Poulet = 'poulet';



    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $total = [100,2000,1000,600,800];
        $pondeuse = [30,600,300,180,240];
        $chair = [70,1400,700,420,560];



        for ($i=1; $i <=5 ; $i++) {


            $poulet = new Poulet();
            
            $poulet
            ->setNbreTotal($faker->randomElement($total))
            ->setNbrePondeuse($faker->randomElement($pondeuse))
            ->setNbrePchair($faker->randomElement($chair))
            ->setNbreDeces(0)
            ;
            $manager->persist($poulet);



        $manager->flush();
        
        }
        


    }

}