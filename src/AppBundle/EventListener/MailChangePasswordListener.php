<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use AppBundle\Event\EmailChangePasswordEvent;

class MailChangePasswordListener
{
    protected $twig;

    protected $mailer;

    public function __construct(\Twig_Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    public function onMailChangePasswordEvent(EmailChangePasswordEvent $event)
    {
        $user = $event->getUser();
        $name = $event->getUser()->getName();
        $email = $event->getUser()->getEmail();
        $password = $event->getUser()->getPassword();

        $body = $this->renderTemplate($name, $password, $email);

        $message = \Swift_Message::newInstance()
            ->setSubject('Change Password Successfully!')
            ->setFrom($email)
            ->setTo($email)
			->setBody($body, 'text/html')
        ;

        $this->mailer->send($message);
    }

    protected function renderTemplate($name, $password, $email)
    {
		return $this->twig->render(
            'Emails/changePassword.html.twig',
            [
                'name' => $name,
                'password' => $password,
				'email' => $email
            ]
        );
    }
}
