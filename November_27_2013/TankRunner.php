<?php
function load($name) {
    require_once $name . '.php';
}

spl_autoload_register('load');

$thomas = new Tank();
$thomas->setGun(new UberPotatoGun());
echo "You have " . $thomas->getAmmo() . " ammo remaining\n";
$thomas->shoot();
echo "You have " . $thomas->getAmmo() . " ammo remaining\n";

$thomas->selfDestruct();

$thomas->shoot();
