<?php

require_once 'Controller.php';
require_once 'MailerInterface.php';

class ControllerTest extends PHPUnit_Framework_TestCase
{
    /** @var  Controller */
    protected $controller;
    /** @var  MailerInterface */
    protected $mailer;

    public function setUp()
    {
        $this->controller = new Controller();

        $this->mailer = $this->getMockBuilder('MailerInterface')
            ->getMockForAbstractClass();
        $this->controller->setMailer($this->mailer);
    }

    /**
     * @test
     * @param $method
     * @param $value
     * @dataProvider mailFunctionProvider
     */
    public function mailerIsSetAppropriately($method, $value)
    {
        $this->mailer->expects($this->once())
            ->method($method)
            ->with($value);
        $this->controller->mailIt();
    }

    public function mailFunctionProvider()
    {
        return [
            ['setTo', 'toaddress'],
            ['setFrom', 'fromaddress'],
            ['setBody', 'Body'],
        ];
    }

    /**
     * @test
     */
    public function sendWorks()
    {
        $this->mailer->expects($this->once())
            ->method('send');
        $this->controller->mailIt();
    }
//
//    /**
//     * @test
//     */
//    public function setToSetsEmailAddress()
//    {
//        $this->mailer->expects($this->once())
//            ->method('setTo')
//            ->with('toaddress');
//        $this->controller->mailIt();
//    }
//
//    /**
//     * @test
//     */
//    public function setFromSetsFromFunction()
//    {
//        $this->mailer->expects($this->once())
//            ->method('setFrom')
//            ->with('fromaddress');
//        $this->controller->mailIt();
//    }
//
//    /**
//     * @test
//     */
//    public function setBodySetsBodyFunction()
//    {
//        $this->mailer->expects($this->once())
//            ->method('setBody')
//            ->with('Body');
//        $this->controller->mailIt();
//    }




}