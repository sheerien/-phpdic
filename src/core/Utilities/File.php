<?php
namespace Phpdic\Dic\Utilities;

class File
{
    /**
     * File Constructor
     */
    private function __construct() {}

    /**
     * Get the File object, so it can be used as a dependency of getFile
     * 
     * @return File
     */
    public static function getFile()
    {
        return new static;
    }

    /**
     * Root Path
     * 
     * @return string
     */
    public static function root()
    {
        return ROOT;
    }

    /**
     * Directory Separator
     * 
     * @return string
     */
    public static function ds()
    {
        return DS;
    }

    /**
     * Get file full path
     * 
     * @param string $path
     * @return string
     */
    public static function path(string $path)
    {
        $path = static::root() . static::ds() . trim($path, '/');
        $path = str_replace(['/', '\\'], static::ds(), $path);
        return $path;
    }

    /**
     * Check the file exists
     * 
     * @param string $path
     * @return bool
     */
    public static function exists(string $path)
    {
        return file_exists(static::path($path));
    }

    /**
     * Require File
     * 
     * @param string $path
     * @return mixed
     */
    public static function require_file(string $path)
    {
        if(static::exists($path)){
            return require_once static::path($path);
        }
        throw new \Exception("this $path is not exists");
    }

    /**
     * Include File
     * 
     * @param string $path
     * @return mixed
     */
    public static function include_file(string $path)
    {
        if(static::exists($path)){
            return include static::path($path);
        }
        throw new \Exception("this $path is not exists");
    }

    /**
     * Require Directory
     * 
     * @param string $path
     * @return mixed
     */
    public static function require_dir(string $path)
    {
        $files = array_diff(scandir(static::path($path)), ['.', '..']);
        foreach ($files as $file) {
            $file_path = $path . static::ds() . $file;
            if(static::exists($file_path)) {
                static::require_file($file_path);
            }
        }
    }
}