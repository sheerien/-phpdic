<?php
declare(strict_types=1);
namespace Phpdic\Dic\Container;



use Phpdic\Dic\Container\Interfaces\ContainerInterface;
use Phpdic\Dic\Exceptions\ContainerInvalidArgumentException;

/** PSR-11 Container */
class ContainerFactory
{

    /** @var array */
    protected array $providers = [];

    /** @return void */
    public function __construct()
    {
    }

    /**
     * Factory method which creates the container object.
     *
     * @param string|null $container
     * @return ContainerInterface
     */
    public function create(?string $container = null): ContainerInterface
    {
        $containerObject = (!is_null($container)) ? new $container() : new Container();
        if (!$containerObject instanceof ContainerInterface) {
            throw new ContainerInvalidArgumentException($container . ' is not a valid container object');
        }
        return $containerObject;
    }
}