<?php
/**
 * Created by PhpStorm.
 * User: davidstockton
 * Date: 11/27/13
 * Time: 9:22 PM
 */
require_once 'Shooter.php';

class RegularTankGun implements Shooter
{
    /**
     * Shoots and tells us how many bullets were shot
     *
     * @return integer
     */
    public function shoot()
    {
        echo "BLAM!\n";
        return 1;
    }

} 