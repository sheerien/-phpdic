<?php

/*
* This file is part of the MagmaCore package.
*
* (c) Ricardo Miller <sherieenbassem@lava-studio.co.uk>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

declare(strict_types=1);
namespace Phpdic\Dic\Container\Interfaces;


/** PSR-11 Container */
interface ContainerServicesInterface
{

    /**
     * Set Class services
     *
     * @param array $services
     * @return self
     */
    public function setServices(array $services = []): self;

    /**
     * Get class service or services
     *
     * @return array
     */
    public function getServices(): array;

    /**
     * Unregister a service from being instantiable
     *
     * @param array $args - optional argument
     * @return ContainerServicesInterface ;
     */
    public function unregister(array $args = []): self;

    /**
     * Register service or services with auto-wiring
     *
     * @return void
     */
    public function register();
}