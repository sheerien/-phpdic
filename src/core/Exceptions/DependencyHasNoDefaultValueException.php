<?php
namespace Phpdic\Dic\Exceptions;
use Phpdic\Dic\Container\Interfaces\NotFoundExceptionInterface;

class DependencyHasNoDefaultValueException extends \Exception implements NotFoundExceptionInterface
{
    public function __construct($dependency, $code = 0, \Exception $previous = null)
    {
        $message = "Sorry can\'t resolve class {$dependency} ";
        parent::__construct($message, $code, $previous);
    }
}