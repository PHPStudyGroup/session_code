<?php
class CoalTest extends PHPUnit_Framework_TestCase
{
    /** @var  Coal */
    protected $coal;

    public function setUp()
    {
        $this->coal = new Coal();
    }

    /**
     * @test
     */
    public function coalIsAFuelThing()
    {
        $this->assertInstanceOf('FuelThing', $this->coal);
    }

    /**
     * @test
     */
    public function coalGives45EnergyWhenBurnt()
    {
        $this->assertEquals(45, $this->coal->burn());
    }
}