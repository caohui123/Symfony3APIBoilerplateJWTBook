<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use AppBundle\Event\EmailRegistrationUserEvent;

class MailRegistrationUserListener
{
    protected $twig;

    protected $mailer;

    public function __construct(\Twig_Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    public function onMailRegistrationUserEvent(EmailRegistrationUserEvent $event): void
    {
        $user = $event->getUser();
        $email = $event->getUser()->getEmail();
        $password = $event->getUser()->getPassword();
        $name = $event->getUser()->getName();

        $body = $this->renderTemplate($name, $email);

        $message = (new \Swift_Message('Registration User Successfully!'))
            ->setFrom($email)
            ->setTo($email)
            ->setBody($body, 'text/html')
        ;

        $this->mailer->send($message);
    }

    protected function renderTemplate($name, $email): string
    {
        return $this->twig->render(
            'Emails/registration.html.twig',
            [
                'name' => $name,
                'email' => $email
            ]
        );
    }

}
