<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Hello\HelloWorld;
use App\Entity\Artiste;
use App\Form\ActualiteType;
use App\Repository\ActualiteRepository;
use App\Repository\ArtisteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Magnify;
use App\Service\Wiki;
use Symfony\Component\HttpFoundation\JsonResponse;




class HomeController extends AbstractController
{
    /**
     * @Route("/{_locale}", name="home", defaults={"_locale": "en"})
     */
    public function index(ActualiteRepository $actualiteRepository,HelloWorld $h,Wiki $wiki)
    {
      $actu = $actualiteRepository->findAll();
      $user = $this->getUser();
      $artiste = $wiki->load("adele");
      //dump($artiste).die;
      $link = $artiste[3][0];
      $nom = $artiste[1][0];
      $desc = $artiste[2][0];



        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user'=>$user,
            'actualites'=>$actu,
            'hello'=>$h->yoUpper(),
            'nom'=>$nom,
            'desc'=>$desc,
            'link'=>$link,
        ]);
    }

    /**
     * @Route("/ajax", name="ajax")
     */
    public function ajaxSearch(Request $request,ArtisteRepository $artisteRepository,Wiki $wiki){
        $value =$request->request->get("value");
        $treated=str_replace(" ","_",$value);
        $artiste= $wiki->load($treated);
        //dump($artiste).die;
        return new JsonResponse($artiste);
    }
}
