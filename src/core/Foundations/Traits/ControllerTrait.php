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
namespace Phpdic\Dic\Foundations\Traits;

use Phpdic\Dic\HTTP\Route;
use Phpdic\Dic\Exceptions\BaseInvalidArgumentException;




trait ControllerTrait
{
    /**
     * Method for allowing child controller class to dependency inject other objects
     * 
     * @param array|null $args
     * @return Object
     * @throws BaseInvalidArgumentException
     * @throws \ReflectionException
     * @return mixed
     */
    protected function diContainer(?array $args = null)
    {
        if ($args !== null && !is_array($args)) {
            throw new BaseInvalidArgumentException('Invalid argument called in container. Your dependencies should return a key/value pair array.');
        }
        $args = func_get_args();
        if ($args) {
            $output = '';
            foreach ($args as $arg) {
                foreach ($arg as $property => $class) {
                    if ($class) {
                        $output = ($property === 'dataColumns' || $property === 'column') ? $this->$property = $class : $this->$property = Route::diGet($class);
                    }
                }
            }
            return $output;
        }
    }

    /**
     * Alias of diContainer
     *
     * @param array|null $args
     * @return mixed
     */
    public function addDefinitions(?array $args = null): mixed
    {
        return $this->diContainer($args);
    }
}