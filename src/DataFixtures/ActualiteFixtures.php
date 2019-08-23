<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\actualite;
use Faker\Factory;
use Faker\Generator;
use App\Repository\actualiteRepository;
use App\Entity\Event;

class ActualiteFixtures extends Fixture
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
private static $theme= [
'News',
'Upcoming events',
'Interview',
'Infomercial',
'Tour',
'Tv show'
];

private static $tabId = [];

    public function load(ObjectManager $manager)
    {

      $faker = Factory::create();




        for ($i=0; $i < 12; $i++) {

            //$tabId[]=$a[$i]->getId();

            $actualite = new Actualite();
            $actualite->setTheme($faker->randomElement(self::$theme))
                ->setPublicationDate($faker->dateTime($max = 'now', $timezone = null))
                ->setContent($faker->sentence($nbWords = 6, $variableNbWords = true))
                ->setPicture($faker->imageUrl($width = 640, $height = 480));
                $manager->persist($actualite);

}
$manager->flush();

}
}
