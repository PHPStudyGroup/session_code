<?php
class BetterBar
{
    protected static $instance;

    private function __construct()
    {
        echo 'I am a secret' . "\n";
    }

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            // Using static for late static binding
            static::$instance = new static;
        }

        return static::$instance;
    }
}

// Get instance of BetterBar
//$instance  = BetterBar::getInstance(); // I am a secret
//$instance2 = BetterBar::getInstance(); // Does not create a new instance

class EvenBetterBar extends BetterBar
{
    protected static $instance;
//    public function __construct()
//    {
//        echo 'I am an even better bar.' . "\n";
//    }
}

$someInstance = BetterBar::getInstance();
$otherInstance = EvenBetterBar::getInstance();


echo get_class($otherInstance) . "\n";
echo get_class($someInstance) . "\n";