<?php

namespace App\Service;


use App\Entity\Artiste;
use GuzzleHttp\Client;
use App\Service\GuzzleMap;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Http\Message\ResponseInterface;

class Wiki extends Client
{
    private $url;
    private $type;
    public function __construct($link)
    {
      $this->url=$link;
    }

    public function load(string $search)
    {
      $treated=str_replace(" ","_",$search);

      $client = new Client();
      $this->response = $client->request('GET', $this->url.$treated.'&format=json');
      $result=json_decode($this->response->getBody(),true);
      //var_dump($result);


      return $result;

    }


}
