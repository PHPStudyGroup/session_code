<?php
interface Walkable
{
    public function stop();

    public function move();
}

class Wheels
{
    public function roll();
}

class Leg implements Walkable
{
    public function stop()
    {
    }

    public function move()
    {
    }
}

class ChickenLeg implements Walkable
{
    public function stop()
    {

    }

    public function move()
    {

    }
}

class RobotLeg implements Walkable
{
    public function stop()
    {
        if (!$this->powerLevel) {
            throw new Exception('No power set.');
        }

        // Do stop things
    }

    public function move()
    {
        if (!$this->powerLevel) {
            throw new Exception('No power set.');
        }

        // do move things
    }

    public function setPowerLevel($power)
    {
        $this->powerLevel = $power;
    }
}

class TestLeg implements Walkable
{
    protected $logPath;

    public function __construct($logPath)
    {
        $this->logPath = $logPath;
    }

    public function stop()
    {
        // Log that stop was called
    }

    public function move()
    {
        // Log that move was called
    }
}

class Dog
{
    protected $legs;

    public function __construct(array $legs)
    {
        $this->legs = array();
        foreach ($legs as $leg) {
            if ($leg instanceof Walkable) {
                $this->legs[] = $leg;
            }
        }
    }

    public function come()
    {
        foreach ($this->legs as $leg) {
            $leg->move();
        }
    }

    public function stay()
    {
        foreach ($this->legs as $leg) {
            $leg->stop();
        }
    }
}

$fido    = new Dog(
    array(new Leg, new Leg, new Leg, new Leg, new ChickenLeg)
);
$mrTesty = new Dog(array(new TestLeg('/path/to/log')));
$hotDog  = new Dog(array());
$roboLeg = new RobotLeg;
$roboLeg->setPowerLevel(42);
$roboDog = new Dog(array($roboLeg));

class Beagle extends Dog
{

}  