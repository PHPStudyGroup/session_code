<?php
class CoalFuelSourceTest extends PHPUnit_Framework_TestCase
{
    /** @var  CoalFuelSource */
    protected $coalFS;

    public function setUp()
    {
        $this->coalFS = new CoalFuelSource();
    }

    /**
     * @test
     */
    public function fuelSourceImplementsFuelSource()
    {
        $this->assertInstanceOf('FuelSource', $this->coalFS);
    }

    /**
     * Make sure we get back a coal object when we get the fuel
     *
     * @test
     */
    public function getFuelReturnsACoal()
    {
        $this->assertInstanceOf('Coal', $this->coalFS->getFuel());
    }
}