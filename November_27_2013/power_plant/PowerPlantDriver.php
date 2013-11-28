<?php
function load($name)
{
    require_once './src/' . $name . '.php';
}

spl_autoload_register('load');

$powerPlant = new PowerPlant();
$powerPlant->setPowerSource(new CoalFuelSource());

$powerPlant->startPowerGeneration();