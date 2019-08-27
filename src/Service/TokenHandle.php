<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Client;
use App\Form\RegistrationFormType;
use App\Security\AppCustomAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;



class TokenHandle
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
      $this->em=$em;
    }

    public function generateToken(User $user)
    {
        $token = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
        //$this->em->getDoctrine()->getManager();
        $user->setConfirmationToken($token);
        $token = $user->getConfirmationToken();
        $this->em->persist($user);
        return $token;
    }


}
