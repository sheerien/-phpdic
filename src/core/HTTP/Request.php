<?php
namespace Phpdic\Dic\HTTP;

use Phpdic\Dic\Support\Str;

class Request
{
    public function method()
    {
        return Str::lower($_SERVER['REQUEST_METHOD']);
    }

    public function path()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        return Str::contains($path, '?') ?Str::explode('?', $path)[0] : $path;
    }
}