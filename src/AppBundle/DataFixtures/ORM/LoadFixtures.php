<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 23/04/2020
 * Time: 19:33
 **/

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Genus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $faker = Factory::create();

    $genera = [
      'Octopus',
      'Balaena',
      'Orcinus',
      'Hippocampus',
      'Asterias',
      'Amphiprion',
      'Carcharodon',
      'Aurelia',
      'Cucumaria',
      'Balistoides',
      'Paralithodes',
      'Chelonia',
      'Trichechus',
      'Eumetopias'
    ];

    $subFamily = [
      'Ameloctopus Norman',
      'Cistopus Gray',
      'Euaxoctopus Voss',
      'Hapalochlaena Robson',
      'Robsonella Adam',
      'Scaeurgus Troschel',
      'Velodona Chun'
    ];

    $j = 15;
    for ($i=0; $i<$j; $i++) {
      $genus = new Genus();
      $genus->setName($genera[rand(0,13)]);
      $genus->setSubFamily($subFamily[rand(0,6)]);
      $genus->setSpeciesCount(rand(100,9000));
      $genus->setFunFact($faker->sentence(10, true));
      $genus->setIsPublished($faker->boolean);
      $manager->persist($genus);
    }

    $manager->flush();
  }
}