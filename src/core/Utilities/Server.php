<?php
namespace Phpdic\Dic\Utilities;

class Server
{
    /**
     * Server Constructor
     */
    private function __construct() {}

    /**
     * Get the Server object, so it can be used as a dependency of getServer
     * 
     * @return Server
     */
    public static function getServer()
    {
        return new self;
    }

    /**
     * Get the value from the server by given key
     * @param string $key
     * @return mixed
     */
    public static function get(string $key)
    {
        return static::has($key)? $_SERVER[$key]: null;
    }

    /**
     * Check that Server has the key
     * 
     * @param string $key
     * @return bool
     */
    public static function has(string $key)
    {
        return isset($_SERVER[$key]);
    }

    /**
     * Get All Server Data
     * 
     * @return array
     */
    public static function all()
    {
        return $_SERVER;
    }

    /**
     * Get path info for paths
     * @param string $path
     * @return array|string
     */
    public static function path_info(string $path)
    {
        return pathinfo($path);
    }
}