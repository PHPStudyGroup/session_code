<?php

class PhilLaMarr
{
    public static function __callStatic($name, $params)
    {
        if ($name == 'whereIsTheBathroom') {
            return 'upstairs';
        }
        return self::getRandomMovie();
    }

    public static function getRandomMovie()
    {
        $movies = array(
            'The Simpsons',
            'Family Guy',
            'Ultimate Spider-Man',
            'Futurama',
            'American Dad!',
            'Teenage Mutant Ninja Turtles',
            'Pulp Fiction'
        );

        $index = array_rand($movies);

        return $movies[$index];
    }

}

echo "The bathroom is... Hey, Phil, where is the bathroom? " .
    PhilLaMarr::whereIsTheBathroom(), "\n";
echo "And what movie or show were in you in, Phil? " .
    PhilLaMarr::WhatShowWereYouIn(), "\n";
