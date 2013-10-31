<?php
require_once 'MailerInterface.php';
class Controller {

    protected $mailer;

    public function setMailer(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function mailIt()
    {
        $this->mailer->setTo('toaddress');
        $this->mailer->setFrom('fromaddress');
        $this->mailer->setBody('Body');
        $this->mailer->send();
    }
}