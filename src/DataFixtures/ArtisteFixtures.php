<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Artiste;
use Faker\Factory;
use Faker\Generator;
use App\Repository\ArtisteRepository;
use App\Entity\Event;
use App\Entity\Produit;

class ArtisteFixtures extends Fixture
{


  private static $musicStyle = [
  'Rock',
  'Salsa',
  'Country',
  'Jazz',
  'Metal',
  'Disco',
  'Grunge',
  'Electro'
];
private static $eventType = [
'Bal',
'Concert',
'Meeting',
'Festival',
'Tour',
'Tv show'
];

private static $tabId = [];

    public function load(ObjectManager $manager)
    {

      $faker = Factory::create();




        for ($i=0; $i < 25; $i++) {

            //$tabId[]=$a[$i]->getId();

            $artiste = new Artiste();
            $artiste->setName($faker->firstName)
                ->setCountry($faker->countryCode)
                ->setStyle($faker->randomElement(self::$musicStyle))
                ->setDescription($faker->sentence($nbWords = 6, $variableNbWords = true))
                ->setPicture($faker->imageUrl($width = 320, $height = 240));
                $manager->persist($artiste);

}
$manager->flush();
$a= $manager->getRepository(Artiste::class);
$a=$a->findAll();
// for ($k=0; $k < count($a); $k++) {
//
//     $tabId[]=$a[$k]->getId();
//
//     // $artiste = new Artiste();
//     // $artiste->setName($faker->firstName)
//     //     ->setCountry($faker->countryCode)
//     //     ->setStyle($faker->randomElement(self::$musicStyle))
//     //     ->setDescription($faker->sentence($nbWords = 6, $variableNbWords = true));
//
// }
for ($i=0; $i < 25 ; $i++) {

    $rand=rand(0,(count($a)-1));
    $event = new Event();
    $event->setType($faker->randomElement(self::$eventType))
          ->setStartDate($faker->dateTime($max = 'now', $timezone = null))
          ->setEndDate($faker->dateTime($max = 'now', $timezone = null))
          ->setPlace($faker->countryCode)
          ->setCity($faker->city)
          ->setDescription($faker->sentence($nbWords = 6, $variableNbWords = true))
          ->setPrice($faker->numberBetween($min = 1000, $max = 350))
          ->setArtisteId($a[$rand]);
    $manager->persist($event);
}




    $manager->flush();
    for ($i=0; $i < 25 ; $i++) {

        $rand=rand(0,(count($a)-1));
        $product = new Produit();
        $product->setTitle($faker->catchPhrase)
              ->setProductionDate($faker->dateTime($max = 'now', $timezone = null))
              ->setDescription($faker->realText($maxNbChars = 30, $indexSize = 1))
              ->setArtiste($a[$rand]);
        $manager->persist($product);
}




    $manager->flush();
}
}
