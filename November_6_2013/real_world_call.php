<?php
class HamsterWheel
{
    protected $rungs;
    protected $speed;

    public function __call($name, $params)
    {
        if (substr($name, 0, 3) == 'set') {
            $paramName = strtolower(substr($name, 3));
            $this->$paramName = $params[0];
        } else if (substr($name, 0, 3) == 'get') {
            $paramName = strtolower(substr($name, 3));
            return $this->$paramName;
        }
    }
}

$wheel = new HamsterWheel();
$wheel->setRungs(5);
$wheel->setSpeed(42);

echo 'There are ' . $wheel->getRungs() . ' rungs on this here wheel.' . "\n";

$wheel->setHamsterName('Charlie');

var_dump($wheel);