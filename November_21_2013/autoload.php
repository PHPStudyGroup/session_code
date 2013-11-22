<?php
class Autoloader
{
    public static function loadCrap($name)
    {

        $name = str_replace('\\', '/', $name);
        $name.= '.php';
        if (file_exists($name)) {
            require_once $name;
        }
    }

    public static function loadUnderscoreJunk($name)
    {
        $name = str_replace('_', '/', $name);
        $name.= '.php';

        if (file_exists($name)) {
            require_once $name;
        }
    }

    public static function classMapLoader($name)
    {
        $map = array(
            'Flurpdy' => './src/foo/bar/baz/Flurpdy.class.jpg.php.inc',
        );

        if (array_key_exists($name, $map)) {
            require_once $map[$name];
        }
    }
}

spl_autoload_register('Autoloader::loadCrap');
spl_autoload_register('Autoloader::loadUnderscoreJunk');
spl_autoload_register('Autoloader::classMapLoader');