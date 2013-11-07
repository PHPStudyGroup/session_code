<?php
class AnotherExample
{
    protected $nonExistentVariable;

    public function __get($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }

    public function __unset($name)
    {
        unset($this->$name);
    }

    public function propertyStatus()
    {
        if (property_exists($this, 'nonExistentVariable')) {
            echo 'I can has nonExistentVariable', "\n";
        } else {
            echo 'No can has nonExistentVariable :(' , "\n";
        }

        if (property_exists($this, 'somethingIMadeUp')) {
            echo 'I can has somethingIMadeUp', "\n";
        } else {
            echo 'No can has somethingIMadeUp :(' , "\n";
        }
    }
}

$foo = new AnotherExample();
var_dump($foo);
$foo->propertyStatus();

$foo->nonExistentVariable = 'Ham Sammich';
$foo->somethingIMadeUp = 'Easter Bunny';

var_dump($foo);
$foo->propertyStatus();
//if (isset($foo->nonExistentVariable)) {
//    echo 'I would like a ' . $foo->nonExistentVariable, "\n";
//}

unset($foo->nonExistentVariable);
unset($foo->somethingIMadeUp);

var_dump($foo);
$foo->propertyStatus();

$foo->nonExistentVariable = 'Ham Sammich';
$foo->somethingIMadeUp = 'Easter Bunny';

//echo 'Echoing anyway ' . $foo->nonExistentVariable, "\n";

var_dump($foo);
$foo->propertyStatus();