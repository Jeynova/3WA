<?php

namespace App\Controller;

use App\Entity\User;
use App\Event\RegisterEvent;
use App\Entity\Client;
use App\Form\RegistrationFormType;
use App\Security\AppCustomAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Service\TokenHandle;

class RegistrationController extends AbstractController
{
  /**
  * @Route("/register", name="app_register")
  */
  public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppCustomAuthenticator $authenticator,EventDispatcherInterface $dispatcher,TokenHandle $tokenGen): Response
  {
    $user = new Client();
    $form = $this->createForm(RegistrationFormType::class, $user);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      // encode the plain password
      $user->setPassword(
        $passwordEncoder->encodePassword(
          $user,
          $form->get('plainPassword')->getData()
          )
        );
        //$user->setRoles(["ROLE_USER"]);
        $entityManager = $this->getDoctrine()->getManager();
        // $user->setConfirmationToken($this->generateToken());
        // $token = $user->getConfirmationToken();
        $tokenGen->generateToken($user);
        $username = $user->getScreenName();
        $user->setIsValidate(0);
        $entityManager->persist($user);
        $entityManager->flush();

        // do anything else you need here, like send an email
        $e=new RegisterEvent($user);
        $dispatcher->dispatch($e, RegisterEvent::NAME);


        // return $guardHandler->authenticateUserAndHandleSuccess(
        //   $user,
        //   $request,
        //   $authenticator,
        //   'main' // firewall name in security.yaml
        // );

      }

      return $this->render('registration/register.html.twig', [
        'registrationForm' => $form->createView(),
      ]);
    }
    /**
    * @return string
    * @throws \Exception
    */

  }
