<?php
namespace Tests\DI;
use DI\InputFilterInterface;

class InputFilterInterfaceTest
    extends \PHPUnit_Framework_TestCase
{
    protected $mock;

    public function setUp()
    {
        $mockFactory = $this->getMockBuilder(
            'DI\InputFilterInterface'
        );
        $this->mock = $mockFactory->getMockForAbstractClass();
    }

    /**
     * Ensures that we have the methods we want
     *
     * @param string $method Method to test for
     *
     * @test
     * @return void
     * @dataProvider methodsWeWantProvider
     */
    public function interfaceHasMethodsWeWant($method)
    {
        $this->assertTrue(
            method_exists($this->mock, $method)
        );
    }

    public function methodsWeWantProvider()
    {
        return array(
            array('isValid'),
            array('setValue'),
            array('getMessages'),
        );
    }
} 