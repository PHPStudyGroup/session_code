<?php
namespace Tests\DI;

use DI\RequiredFilter;

class RequiredFilterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  RequiredFilter */
    protected $filter;

    public function setUp()
    {
        $this->filter = new RequiredFilter;
    }

    /**
     * Ensures that the filter is an input validator
     *
     * @return void
     * @test
     */
    public function filterIsInstanceOfInputValidator()
    {
        $this->assertInstanceOf(
            'DI\InputFilterInterface',
            $this->filter
        );
    }

    /**
     * Ensures that the filter passes if a value is sent in
     *
     * @param mixed $value Value to test
     * @param boolean $valid Should it be considered valid
     *
     * @return void
     *
     * @test
     * @dataProvider valueProvider
     */
    public function filterWithRequiredValueIsValid(
        $value,
        $valid
    ) {
        $this->filter->setValue($value);
        if ($valid) {
            $this->assertTrue($this->filter->isValid());
            $this->assertEmpty($this->filter->getMessages());
        } else {
            $this->assertFalse($this->filter->isValid());

            $messages = $this->filter->getMessages();
            $this->assertInternalType('array', $messages);
            $this->assertNotEmpty($messages);
            $this->assertContains(
                'Value is required',
                $messages
            );
        }
    }

    public function valueProvider()
    {
        return array(
            array(1, true),
            array('banana', true),
            array(new \stdClass(), true),
            array(array(1), true),
            array(true, true),
            array(false, true),
            array(array(), true),
            array(0, true),
            array(0.0, true),
            array("0", true),
            array('', false),
            array(null, false),
        );
    }

    /**
     * Ensures the validator is validating validly.
     *
     * @return void
     * @test
     */
    public function messagesDoNotPersistBetweenIsValidCalls()
    {
        $this->filter->isValid();
        $this->assertCount(1, $this->filter->getMessages());

        $this->filter->isValid();
        $this->assertCount(1, $this->filter->getMessages());
    }

    /**
     * @test
     * @group QABugz
     * @expectedException \RuntimeException
     */
    public function anotherBugFoundByQA()
    {
        $this->filter->isValid();
        $this->assertCount(1, $this->filter->getMessages());

        $this->filter->setValue('banana');
        $this->filter->getMessages();
    }
}