<?php
class Flurpdy
{
    public function doAFlurpdy()
    {
        $flurpdy = 'frisbee';
        $frisbee = 'inception!';
        $foo = ${$this->getTheThing()};
        print "I done did a {$$foo}s!\n";
    }

    protected function getTheThing()
    {
        return 'flurpdy';
    }
}