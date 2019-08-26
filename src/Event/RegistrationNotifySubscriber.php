<?php
// App\EventSubscriber\RegistrationNotifySubscriber.php
namespace App\Event;

use App\Entity\User;
use App\Event\RegisterEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;


/**
 * Envoi un mail de bienvenue à chaque creation d'un utilisateur
 *
 */
class RegistrationNotifySubscriber implements EventSubscriberInterface
{
    private $mailer;
    private $sender;

    public function __construct(\Swift_Mailer $mailer)
    {
        // On injecte notre expediteur et la classe pour envoyer des mails
        $this->mailer = $mailer;
        $this->sender ="4513e92d92-f7d9cf@inbox.mailtrap.io";
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
        $body = "Bienvenue mon ami.e sur ce tutorial";

        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo($user->getMail())
            ->setFrom($this->sender)
            ->setBody($body, 'text/html')
        ;

        $this->mailer->send($message);
    }
}
