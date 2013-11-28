<?php
function load($name)
{
    $path = '../src/' . str_replace('_', '/', $name) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }

}

spl_autoload_register('load');
