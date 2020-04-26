<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 23/04/2020
 * Time: 19:33
 **/

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Genus;
use AppBundle\Entity\GenusNote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $faker = Factory::create();

    // Nombre de Genus que l'on souhaite créer :
    $j=10;
    // Ajouter des Genus :
    $this->addGenus($j, $manager, $faker);

    $listOfGenus = $manager->getRepository('AppBundle:Genus')->findAll();

     // Ajouter des GenusNotes liés aux Genus :
    $this->addMultipleGenusNote($manager, $faker, $listOfGenus);
  }


  private function addGenus($j, ObjectManager $manager, $faker)
  {
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


    $subFamily = $manager->getRepository('AppBundle:SubFamily')->findAll();

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

  public function addMultipleGenusNotesForOneGenus($k, ObjectManager $manager, $faker, Genus $genus)
  {
    for($i=0; $i<$k; $i++) {
      $genusNote = new GenusNote();
      $genusNote->setUsername($faker->userName);
      $genusNote->setUserAvatarFileNname(mb_strtolower($faker->lastName).'.jpeg');
      $avatarArray = ['leanna.jpeg', 'ryan.jpeg'];
      $genusNote->setUserAvatarFileNname($avatarArray[rand(0,1)]);
      $genusNote->setNote($faker->paragraph);
      $genusNote->setCreatedAt($faker->dateTimeBetween('-6 months', 'now'));
      $genusNote->setGenus($genus);
      $manager->persist($genusNote);
    }
    $manager->flush();
  }

  public function addMultipleGenusNote(ObjectManager $manager, $faker, $lisfOfGenus)
  {
    foreach ($lisfOfGenus as $genus) {
      $k = rand(0,10);
      $this->addMultipleGenusNotesForOneGenus($k, $manager, $faker, $genus);
    }
  }


  public function addOneStandAloneGenusNote($j, ObjectManager $manager, $faker)
  {
    for ($i=0; $i<$j; $i++) {
      $genusNote = new GenusNote();
      $genusNote->setUsername($faker->userName);
      $avatarArray = ['leanna.jpeg', 'ryan.jpeg'];
      $genusNote->setUserAvatarFileNname($avatarArray[rand(0,1)]);
      $genusNote->setNote($faker->paragraph);
      $genusNote->setCreatedAt($faker->dateTimeBetween('-6 months', 'now'));
      $manager->persist($genusNote);
    }
    $manager->flush();
  }

}