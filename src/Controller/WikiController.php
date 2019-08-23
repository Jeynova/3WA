<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;
use App\Service\GuzzleMap;


/**
 * @Route("/map")
 */
class WikiController extends AbstractController
{
  private $r;

    /**
     * @Route("/", name="map_index", methods={"GET"})
     */

    public function index(GuzzleMap $gu): Response
    {

      $this->r = $gu->coordinate("42 rue de l'alma Courbevoie");
      //dump($this->r).die;


        return $this->render('map/index.html.twig', [
            'reponse'=>$this->r,
            'lon' => $this->r[0],
            'lat' => $this->r[1],
        ]);
    }



}
