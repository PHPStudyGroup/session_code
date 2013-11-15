<?php

class Greeter
{
    protected $greeting;

    /**
     * @param mixed $greeting
     *
     * @return static
     */
    public function setGreeting($greeting)
    {
        $this->greeting = $greeting;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGreeting()
    {
        return $this->greeting;
    }

    protected function runMe()
    {
        echo $this->getGreeting();
    }

    public function __invoke()
    {
        return $this->runMe();
    }
}

function runThing($function)
{
    $stuff = $function();
}


$greeter = new Greeter();
$greeter->setGreeting('Hello, World!' . "\n");

runThing($greeter);
