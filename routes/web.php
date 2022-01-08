<?php

use Phpdic\Dic\HTTP\Route;
use App\Http\Controllers\HomeController;
Route::get('/', function(){
    d('welcome');
});
Route::get('/home', [HomeController::class , 'index']);