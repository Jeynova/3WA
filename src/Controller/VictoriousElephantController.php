<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VictoriousElephantController extends AbstractController
{
    /**
     * @Route("/victorious/elephant", name="victorious_elephant")
     */
    public function index()
    {
        return $this->render('victorious_elephant/index2.html.twig', [
            'controller_name' => 'VictoriousElephantController',
        ]);
    }
}
