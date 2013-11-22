<?php
// User's Foo class
class Foo
{
    public function doAThing()
    {
        echo 'This is coming from ' .
            __FILE__ . ' at line ' .
            __LINE__ . ' in the directory ' .
            __DIR__ . ' with namespace ' .
            "|" . ((__NAMESPACE__ == '') ?
            "<blank>" : __NAMESPACE__) . "|"
            ."\n";
    }
}
