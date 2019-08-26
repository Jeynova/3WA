<?php

namespace App\Controller;


use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;


class ValidationSub extends AbstractController {


  /**
  * @Route("/validationSub/{token}", name="validation")
  */
  function checkLink(Request $request,UserRepository $userRepository,String $token){

    $user = $userRepository->findBy(array('confirmationToken' => $token));
    if ($user) {
      return $this->render('validationSub/validationSub.html.twig');
    }
    else {
      return RedirectToAction("home/index", "index");
    }

  }

}

 ?>
