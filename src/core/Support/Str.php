<?php 
namespace Phpdic\Dic\Support;

class Str
{
    public static function lower($str)
    {
        return strtolower($str);
    }

    public static function upper($str)
    {
        return strtoupper($str);
    }

    public static function contains($haystack, $needle)
    {
        return str_contains($haystack, $needle);
    }

    public static function explode($delimiter, $string, $limit = null)
    {
        return explode($delimiter, $string, $limit);
    }
}