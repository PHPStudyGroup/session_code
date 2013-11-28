<?php
/**
 * Created by PhpStorm.
 * User: davidstockton
 * Date: 11/27/13
 * Time: 9:13 PM
 */

class SuperTank extends Tank
{
    public function __construct()
    {
        parent::__construct();
        $this->ammo = 200;
    }

    public function shoot()
    {
        if (! $this->intact) {
            return;
        }
        echo "BLAM\nBLAM!\n";
        $this->ammo -= 2;
    }

} 