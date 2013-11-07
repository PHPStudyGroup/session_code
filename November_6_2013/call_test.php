<?php
class MyClass
{
    public function __call($name, $params)
    {
        echo 'Tried to call ' . $name . "\n";
        var_dump($params);
    }

    public function foo()
    {
        echo 'This be foo, foo!' , "\n";
    }

    protected function bar()
    {
        echo 'This is the bar function' . "\n";
    }

    private  function baz()
    {
        echo 'The amazing baz method.' , "\n";
    }

    public function callFoo()
    {
        $this->foo();
    }

    public function callBar()
    {
        $this->bar();
    }

    public function callBaz()
    {
        $this->baz();
    }

    public function callFizzBuzz()
    {
        $this->fizzbuzz();
    }
}

$class = new MyClass();

// Call methods directly
$class->foo(); // This be foo, foo!
$class->bar(); // This is the bar function (Tried to call bar)
$class->baz(); // The amazing baz method. (Tried to call baz)
$class->fizzbuzz(7); // Nothing (Tried to call fizzbuzz)

echo "Calling the call functions below:\n";

$class->callFoo(); // This be foo, foo!
$class->callBar(); // This is the bar function
$class->callBaz(); // The amazing baz method.
$class->callFizzBuzz(); // Nothing (Tried to call fizzbuzz)