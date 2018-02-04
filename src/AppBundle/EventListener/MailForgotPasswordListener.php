<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use AppBundle\Event\EmailForgotPasswordEvent;

class MailForgotPasswordListener
{
    protected $twig;

    protected $mailer;

    public function __construct(\Twig_Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    public function onMailForgotPasswordEvent(EmailForgotPasswordEvent $event)
    {
        $user = $event->getUser();
        $email = $event->getUser()->getEmail();
        $password = $event->getUser()->getPassword();

        $body = $this->renderTemplate($name, $password);

        $message = \Swift_Message::newInstance()
            ->setSubject('Change Password Success!')
            ->setFrom($email)
            ->setTo($email)
            ->setBody($body, 'text/html')
        ;

        $this->mailer->send($message);
    }

    protected function renderTemplate($name, $password)
    {
		return $this->twig->render(
            'Emails/registration.html.twig',
            [
                'name' => $name,
				'password' => $password
            ]
        );
    }
}
