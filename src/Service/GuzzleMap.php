<?php

namespace App\Service;


use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GuzzleMap extends Client
{
    private $response;

    public function __construct()
    {

    }

    public function load(string $search)
    {
      $treated=str_replace(" ","+",$search);
      // $client = new Client(['base_uri' => 'https://api-adresse.data.gouv.fr/']);
      $client = new Client();
      $this->response = $client->request('GET', 'https://api-adresse.data.gouv.fr/search/?q='.$treated.'');
      $result=json_decode($this->response->getBody(),true);
      var_dump($result);


      return $result;
    }

    public function coordinate(string $search){
      $result=$this->load($search);
      $coordinate= $result["features"][0]["geometry"]["coordinates"];

      return $coordinate;

    }


}
