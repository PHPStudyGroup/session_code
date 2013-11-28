<?php
/**
 * Created by PhpStorm.
 * User: davidstockton
 * Date: 11/27/13
 * Time: 9:26 PM
 */
require_once 'Shooter.php';
class Supergun implements Shooter
{
    /**
     * Shoots and tells us how many bullets were shot
     *
     * @return integer
     */
    public function shoot()
    {
        echo  "Bam!\nBLAM!!!\n";
        return 2;
    }
}