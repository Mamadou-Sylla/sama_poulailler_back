<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Profil;
use App\Entity\Poulailler;
use Faker\Provider\zh_TW\DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PoulaillerFixtures extends Fixture
{

    public const Poulailler = 'poulailler';



    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $poulailler = new Poulailler();
        for ($i=1; $i <=10 ; $i++) {


            $poulailler =  new Poulailler();

            $poulailler
            ->setNom("poulailler_".$i)
            ->setDateDebut($faker->dateTime())
            ->setArchived(false)
            // ->setEmploye($this->getReference(UserFixtures::employe))
            // ->AddUser($this->getReference(UserFixtures::admin))
            ;
            // $this->addReference(self::Poulailler, $poulailler);
            $manager->persist($poulailler);



        $manager->flush();
        }
        


    }

}