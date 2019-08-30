<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en');

        //$this->assertResponseIsSuccessful();

          $test = $crawler->filter('body');
          $this->assertContains('Coucou',$test->text());
          $this->assertCount(1, $test);
          $this->assertEquals(200, $client->getResponse()->getStatusCode());
          // $link = $crawler->filter('a:contains("News")') // find all links with the text "Greet"
          // ->eq(0)
          // ->link();
          //
          // // and click it
          // $crawler = $client->click($link);

          $link = $crawler->selectLink('News')->link();
          $crawler = $client->click($link);
          $this->assertEquals(200, $client->getResponse()->getstatusCode());
          $h1 = $crawler->filter('h1');
          $this->assertContains('Actualite', $h1->text(), "Texte trouvé : ".$h1->text());

           $crawler = $client->request('GET', '/en');
          //
           $this->assertEquals(200,$client->getResponse()->getStatusCode());


       }
}
