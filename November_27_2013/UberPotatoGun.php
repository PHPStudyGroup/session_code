<?php
require_once 'PotatoGun.php';

class UberPotatoGun extends  PotatoGun
{
    public function shoot()
    {
        echo "Everything smells like fries!\n";

        return 7;
    }
} 