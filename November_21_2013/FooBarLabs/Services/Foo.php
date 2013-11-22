<?php
// Some made up Library
namespace FooBarLabs\Services;

class Foo
{
    public function doAThing()
    {
        echo 'Doing some other things in the '.
            __NAMESPACE__ . " namespace.\n";
    }
}

function strtoupper($string)
{
    return strrev(\strtoupper($string));
}