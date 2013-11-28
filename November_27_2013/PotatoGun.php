<?php
require_once 'Shooter.php';
require_once 'GunTrait.php';

class PotatoGun implements Shooter
{
    use GenericShooter;
}