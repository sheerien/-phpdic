<?php

class Application
{
    private function __construct() {}

    public static function run()
    {
        define('ROOT', realpath(dirname(__DIR__)));
        
        define('DS', DIRECTORY_SEPARATOR);

        app();
        app()->boot();
    }
}