<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Oeuf;
use App\Entity\User;
use Faker\Provider\zh_TW\DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class OeufFixtures extends Fixture
{

    public const Oeuf = 'oeuf';

    

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $total = [100,1200,800,600,450];
        $casses = [10,120,80,60,45];


        for ($i=1; $i <=6 ; $i++) {


            $oeuf = new Oeuf();

            $oeuf
            ->setNbreTotal($faker->randomElement($total))
            ->setNbreCasses($faker->randomElement($casses))
            ;
            $manager->persist($oeuf);



        $manager->flush();
        }
        


    }

}