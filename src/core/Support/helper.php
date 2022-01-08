<?php

use Phpdic\Dic\Bootstrap\App;
use Phpdic\Dic\Support\Config;
use Phpdic\Dic\Utilities\File;
use Phpdic\Dic\Utilities\Server;

if(! function_exists('env')){
    /**
    * set key for env
    * @param mixed $key
    * @param mixed $default
    * @return mixed
    */
    function env($key, $default = null){
    
    return $_ENV[$key] ?? value($default);
    
    }
}
if(!function_exists('app')){
    
    /**
     * singleton method for the run of framework.
     * 
     * @return App|null
     */
    function app(){
        static $instance = null;
        if(is_null($instance)){
            $instance = new App();
        }
        return $instance;
    }
}
    
    if(! function_exists('value')){
    /**
    * set value from action routers
    * @param mixed $value
    * @return mixed
    */
    function value($value){
    
    return ($value instanceof Closure) ? $value() : $value;
    
    }
}

if(!function_exists('dd')){
    
    /**
     * dump and die
     * 
     * @param mixed $data
     * @return void
     */
    function dd($data){
        dump($data);
        die();
    }
    
}

if(!function_exists('d')){
    
    /**
     * dump
     * 
     * @param mixed $data
     * @return void
     */
    function d($data){
        dump($data);
    }
    
}

if(!function_exists('files')){
    
    /**
     * dump
     * 
     * @param mixed $data
     * @return void
     */
    function files(){
        return File::getFile()?:null;
    }
    
}
if(!function_exists('server')){
    
    /**
     * dump
     * 
     * @param mixed $data
     * @return void
     */
    function server(){
        Server::getServer();
    }
    
}

if(!function_exists('config_path')){
    function config_path(){
        return realpath(dirname(__DIR__) . '/../../config');
    }
}

if(!function_exists('config')){
    function config($key = null, $default = null){
        if(is_null($key)){
            return Config::getItems();
        }
        if(is_array($key)){
            return Config::set($key);
        }
        return Config::get($key, $default);
    }
}