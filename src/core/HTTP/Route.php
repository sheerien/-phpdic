<?php
namespace Phpdic\Dic\HTTP;

use Phpdic\Dic\Container\Container;
use Phpdic\Dic\Container\ContainerFactory;

class Route
{
    public static array $routes = [];
    public Request $request;
    public Response $response;
    public Container $container;

    protected static $concretes = [];

    public function __construct(Request $request, Response $response, Container $container)
    {
        $this->container = $container;
        $this->request = $request;
        $this->response = $response;
    }

    public static function get($route, $action)
    {
        self::$routes['get'][$route] = $action;
    }
    
    public static function post($route, $action)
    {
        self::$routes['post'][$route] = $action;
    }
    
    public static function diGet(string $dependencies): mixed
    {
        $container = (new ContainerFactory())->create();
        if ($container) {
            return $container->get($dependencies);
        }
    }

    public function resolveContainer()
    {
        static::$concretes = config("providers");
        foreach (static::$concretes as $key => $item) {
            $this->diGet($item);
        }
    }
    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();
        $action = self::$routes[$method][$path]??false;
        if(! $action){
            // throw new RouteNotFoundException();
            return;
        }
        // page not found 404

        if(is_callable($action)){
            call_user_func($action, []);
        }

        if(is_array($action)){
            $this->resolveContainer();
            [$class, $method] = $action;
            if (class_exists($class)) {
                // $class = new $class();
                // $this->container->set($class);
                // $class = $this->container->get($class);
                $class = static::diGet($class);
                // dd($this->diGet($class));

                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }
    }
}