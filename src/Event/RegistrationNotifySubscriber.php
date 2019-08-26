<?php
// App\EventSubscriber\RegistrationNotifySubscriber.php
namespace App\Event;

use App\Entity\User;
use App\Event\RegisterEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Twig\Environment;



/**
 * Envoi un mail de bienvenue à chaque creation d'un utilisateur
 *
 */
class RegistrationNotifySubscriber implements EventSubscriberInterface
{



    private $mailer;
    private $sender;
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        // On injecte notre expediteur et la classe pour envoyer des mails
        $this->mailer = $mailer;
        $this->sender ="4513e92d92-f7d9cf@inbox.mailtrap.io";
        $this->renderer = $renderer;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            // le nom de l'event et le nom de la fonction qui sera déclenché
            RegisterEvent::NAME => 'onUserRegistrated',
        ];
    }

    public function onUserRegistrated(RegisterEvent $event): void
    {
        /** @var User $user */
        $user = $event->getUser();

        $subject = "Bienvenue";
        //$body = "Bievenue ".$user->getScreenName()." Vous pouvez valider votre inscription en allant vers ce lien";

        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo($user->getMail())
            ->setFrom($this->sender)
            ->setBody( $this->renderer->render('mail/validationMail.html.twig',['username' => $user->getScreenName(),
            'mail' => $user->getMail(),
            'token' => $user->getConfirmationToken()]),'text/html')
        ;
        $this->mailer->send($message);


    }
}
