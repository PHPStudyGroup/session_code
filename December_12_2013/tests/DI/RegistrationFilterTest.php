<?php

namespace Tests\DI;


use DI\InputFilterInterface;
use DI\RegistrationFilter;
use DI\RequiredFilter;

class RegistrationFilterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RegistrationFilter
     */
    protected $filter;
    /** @var  InputFilterInterface */
    protected $required;

    public function setUp()
    {
        $mb = $this->getMockBuilder('DI\InputFilterInterface');
        $this->required = $mb->getMockForAbstractClass();

        $this->required->expects($this->atLeastOnce())
            ->method('isValid');

        $this->filter = new RegistrationFilter(
            $this->required
        );
    }

    /**
     * Messages from registration for missing username come
     * from the RequiredFilter's messages
     *
     * @test
     * @return void
     */
    public function usernameIsRequired()
    {
        $this->filter->setValues(array('username' => null));

        $this->required->expects($this->never())
            ->method('setValue');

        $this->required->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $uniqid = uniqid('randomstuff_');
        $this->required->expects($this->atLeastOnce())
            ->method('getMessages')
            ->will($this->returnValue(
                    array($uniqid)
                )
            );

        $this->assertFalse(
            $this->filter->validateUsername()
        );
        $messages = $this->filter->getMessages();
        $this->assertNotEmpty($messages);

        $this->assertContains(
            $uniqid,
            $messages['username']
        );
    }

    /**
     * @test
     */
    public function ifUsernameIsProvidedIsValid()
    {
        $this->markTestSkipped();
        $this->filter->setValues(
            array('username' => 'foo')
        );
        $this->assertTrue($this->filter->validateUsername());
    }

    /**
     * @test
     */
    public function ifUsernameIsNotProvidedMessageIsCorrect()
    {
        $this->markTestSkipped();
        $this->filter->setValues(array());
        $this->assertFalse($this->filter->validateUsername());
        $messages = $this->filter->getMessages();

        $this->assertNotEmpty($messages);
        $this->assertArrayHasKey('username', $messages);

        $this->assertContains(
            'Username is required',
            $messages['username']
        );
    }

    /**
     * Tests username length validation
     *
     * @param string $username Username to validate
     * @param string $message Message if invalid
     *
     * @test
     * @dataProvider usernameProvider
     */
    public function usernameMustBeTheRightSize($username, $message = null)
    {
        $this->markTestSkipped();
        $this->filter->setValues(array('username' => $username));
        if (is_null($message)) {
            // Valid username
            $this->assertTrue($this->filter->validateUsername());
            $this->assertEmpty($this->filter->getMessages());
            return;
        } else {
            // Invalid username
            $this->assertFalse($this->filter->isValid());
            $messages = $this->filter->getMessages();
            $this->assertNotEmpty($messages);

            $this->assertArrayHasKey('username', $messages);
            $this->assertContains($message, $messages['username']);
        }
    }

    /**
     * Provides a list of usernames. If it's blah...
     * @return array
     */
    public function usernameProvider()
    {
        return array(
            array('foobarSalami'),
            array('bc'),
            array(str_repeat('a', 40)),
            array(str_repeat('b', 41), 'Username must be less than 40 characters'),
            array('a', 'Username must be at least 2 characters'),
            array('foo@bar', 'Username contains invalid characters'),
            array('sam&banana', 'Username contains invalid characters'),
            array('*********', 'Username contains invalid characters'),
            array('broniez_4_life'),
        );
    }

    /**
     * @test
     * @dataProvider lowercaseUsernameProvider
     */
    public function validationLowercasesUsernames($username)
    {
        $this->markTestSkipped();
        $this->filter->setValues(array('username' => $username));
        $this->assertTrue($this->filter->validateUsername());
        $this->assertEquals(
            strtolower($username),
            $this->filter->getValue('username')
        );
    }

    public function lowercaseUsernameProvider()
    {
        return array(
            array('FOO'),
            array('Foo'),
            array('12345'),
            array('FoO'),
            array('Bar'),
        );
    }

    /**
     * @test
     */
    public function passwordIsRequired()
    {
        $this->markTestSkipped();
        $this->filter->setValues(array());
        $this->assertFalse($this->filter->validatePassword());
        $messages = $this->filter->getMessages();
        $this->assertNotEmpty($messages);
        $this->assertArrayHasKey('password', $messages);
        $this->assertContains('Password is required', $messages['password']);
    }

    /**
     *
     * @param string $password Password to test
     * @param boolean $valid Is it valid?
     *
     * @test
     *
     * @dataProvider passwordLengthProvider
     */
    public function passwordIsAtLeast8Characters($password, $valid)
    {
        $this->markTestSkipped();
        $this->filter->setValues(array('password' => $password));

        if ($valid) {
            $this->assertTrue($this->filter->validatePassword());
        } else {
            $this->assertFalse($this->filter->validatePassword());
            $messages = $this->filter->getMessages();
            $this->assertNotEmpty($messages);
            $this->arrayHasKey('password', $messages);
            $this->assertContains(
                'Password must be at least 8 characters',
                $messages['password']
            );
        }
    }

    public function passwordLengthProvider()
    {
        return array(
            array('a', false),
            array('bb', false),
            array('ccc', false), // ...
            array('abcdefg', false),
            array('abcdefgh1@', true),
        );
    }

    /**
     * @param string $password Password to validate
     * @param boolean $valid If it's valid
     *
     * @test
     * @dataProvider complexPasswordProvider
     */
    public function passwordComplexityValidationWorks($password, $valid)
    {
        $this->markTestSkipped();
        $this->filter->setValues(array('password' => $password));
        if ($valid) {
            $this->assertTrue($this->filter->validatePassword());
        } else {
            $this->assertFalse($this->filter->validatePassword());
            $messages = $this->filter->getMessages();
            $this->assertNotEmpty($messages);
            $this->arrayHasKey('password', $messages);
            $this->assertContains(
                'Password complexity is too low',
                $messages['password']
            );
        }
    }

    public function complexPasswordProvider()
    {
        return array(
            array('a', false),
            array('a1', false),
            array('a1111111111', false),
            array('aBc234235', true),
            array('a@#$%Baaaa', true),
            array('p@ssw0rd', true),
            array('Aa1^2salami', true),
        );
    }
} 