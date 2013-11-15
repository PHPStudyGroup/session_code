<?php

class Sleepy
{
    protected $name = "sleepy";

    protected $greeting;

    protected $roommates = 6.6;

    private $axeMaterial = 'wood';

    public function __construct()
    {
        $this->greeting = function() {
            echo 'Hello, I am ' . $this->name . "\n";
        };
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
}

$dwarf = new Sleepy();
$greeting = $dwarf->getGreeting();
$greeting();

$serialized = serialize($dwarf);
$newDwarf = unserialize($serialized);
$newDwarfGreeting = $newDwarf->getGreeting();
$newDwarfGreeting();

session_start();

if (isset($_SESSION['dwarf'])) {
    var_dump($_SESSION['dwarf']);
}

$_SESSION['dwarf'] = $dwarf;

