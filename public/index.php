<?php 

/*
|-------------------------------------------------
| Minimal Mvc PHP Framework
|-------------------------------------------------
|
|@author Sherieen Bassem <devsherienbassem@gmail.com>
*/

/*
|-------------------------------------------------
| Register the autoloader
|-------------------------------------------------
|
| Load the autoloader that will generated classes that will be used
*/
require_once realpath(dirname(__DIR__ ). '/vendor/autoload.php');


/*
|-------------------------------------------------
| Run the Application
|-------------------------------------------------
|
| Handle the request and send response
*/
$dotenv = Dotenv\Dotenv::createImmutable(realpath(dirname(__DIR__)));
$dotenv->load();
Application::run();