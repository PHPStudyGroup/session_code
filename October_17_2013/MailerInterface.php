<?php

interface MailerInterface
{
    public function setTo($toAddress);
    public function setFrom($fromAddress);
    public function setBody($body);
    public function send();
}