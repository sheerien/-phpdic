<?php
namespace Phpdic\Dic\Exceptions;

class DependencyIsNotInstantiableException extends \Exception
{
    public function __construct($dependency, $code = 0, \Exception $previous = null)
    {
        $message = "Class {$dependency} is not instantiable";
        parent::__construct($message, $code, $previous);
    }
}