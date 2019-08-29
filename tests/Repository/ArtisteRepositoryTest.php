<?php

namespace App\Tests\Repository;

use App\Entity\Artiste;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ArtisteRepository;

class ArtisteRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;
    private static $musicStyle = [
    'Rock',
    'Salsa',
    'Country',
    'Metal',
    'Disco',
    'Grunge',
    'Electro'
  ];
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {

        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

            $faker = Factory::create();
              for ($i=0; $i < 25; $i++) {

                  //$tabId[]=$a[$i]->getId();

                  $artiste = new Artiste();
                  $artiste->setName($faker->firstName)
                      ->setCountry($faker->countryCode)
                      ->setStyle($faker->randomElement(self::$musicStyle))
                      ->setDescription($faker->sentence($nbWords = 6, $variableNbWords = true))
                      ->setPicture($faker->imageUrl($width = 320, $height = 240));
                      $this->entityManager->persist($artiste);

      }
      $this->entityManager->flush();

    }

    public function testSearchByStyleName()
    {
        $artiste = $this->entityManager
            ->getRepository(Artiste::class)
            ->findByStyle('jazz')
        ;

        $this->assertCount(6, $artiste);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
}





















 ?>
