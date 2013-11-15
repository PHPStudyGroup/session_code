<?php
class Sleepy
{
    public $name = "sleepy";

    public $greeting;

    public $roommates = 6.6;

    public $axeMaterial = 'wood';

    public function __construct()
    {
//        $this->greeting = function() {
//            echo 'Hello, I am ' . $this->name . "\n";
//        };
    }

    public function __sleep()
    {
        return array('name', 'roommates', 'axeMaterial');
    }

    public function getGreeting()
    {
        return $this->greeting;
    }

    public function __wakeup()
    {
        $this->name = 'Grumpy';
        $this->greeting = function() {
            echo 'Hello, I am ' . $this->name . "\n";
        };
    }

    public static function __set_state($stuff)
    {
        $dwarf = new static;

        $dwarf->name = $stuff['name'];
        $dwarf->greeting = function () {
            echo 'Done with __set_state';
        };
        $dwarf->roommates = $stuff['roommates'];
        $dwarf->axeMaterial = $stuff['axeMaterial'];
        return $dwarf;
    }
}

$sleepy = new Sleepy();

$someJunk = var_export($sleepy, true);
$someJunk = '$anotherSleepy =' . $someJunk . ";";
echo $someJunk;
eval($someJunk);


var_dump($anotherSleepy);