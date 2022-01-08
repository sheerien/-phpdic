<?php 
namespace Phpdic\Dic\Container;

use Phpdic\Dic\Container\Interfaces\ContainerInterface;
use Phpdic\Dic\Exceptions\DependencyHasNoDefaultValueException;
use Phpdic\Dic\Exceptions\DependencyIsNotInstantiableException;

class ContainerTest implements ContainerInterface
{
	
	/**
	 * Array Of Instance.
	 *
	 * @var array #instance
	*/
    private array $instance=[];
	
	/**
	 * set concrete.
	 * 
	 * @param mixed $id
	 * @param mixed $concrete
	 * @return void
	 */
	public function set($id, $concrete = null)
	{
		if(is_null($concrete)){
			$concrete = $id;
		}
		$this->instance[$id] = $concrete;
	}
	
	/**
	 * Finds an entry of the container by its identifier and returns it.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @return mixed Entry.
	 */
	public function get($id) 
    {
		if(!$this->has($id)){
			$this->set($id);
		}
		$concrete = $this->instance[$id];
		return $this->resolve($concrete);
	}
	
	/**
	 * Returns true if the container can return an entry for the given identifier.
	 * Returns false otherwise.
	 * 
	 * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
	 * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @return bool
	 */
	public function has($id) 
    {
		return isset($this->instance[$id]);
	}

	private function resolve($concrete)
	{
		$reflection = new \ReflectionClass($concrete);
		if(!$reflection->isInstantiable()){
			throw new DependencyIsNotInstantiableException($concrete);
		}

		$constructor = $reflection->getConstructor();
		if(is_null($constructor)){
			return $reflection->newInstance();
		}

		$params = $constructor->getParameters();
		$dependencies = $this->getDependencies($params, $reflection);

		return $reflection->newInstanceArgs($dependencies);
	}

	private function getDependencies($params, $reflection)
	{
		$dependencies = [];
		foreach ($params as $param) {
			$dependency = $param->getType();
			if(is_null($dependency)){
				if($param->isDefaultValueAvailable()){
					$dependencies[] = $param->getDefaultValue();
				}else{
					throw new DependencyHasNoDefaultValueException($param->getName());
				}
			}else{
				$dependencies[] = $this->get($dependency->getName());
			}
		}
		return $dependencies;
	}
}