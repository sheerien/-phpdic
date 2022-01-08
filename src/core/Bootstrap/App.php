<?php
namespace Phpdic\Dic\Bootstrap;


use Test\User;
use Phpdic\Dic\HTTP\Route;
use Phpdic\Dic\HTTP\Request;
use Phpdic\Dic\HTTP\Response;
use Phpdic\Dic\Support\Config;
use Phpdic\Dic\Utilities\File;
use Phpdic\Dic\Utilities\Server;
use Phpdic\Dic\Utilities\Whoops;
use Phpdic\Dic\Container\Container;

class App
{
    public Container $container;
    public Request $request;
    public Response $response;
    public Route $route;
    public function __construct()
    {
        $this->container = new Container();
        $this->request = new Request;
        $this->response = new Response;
        $this->route = new Route($this->request, $this->response, $this->container);
    }

    public static function loadConfig()
    {
        $files = array_diff(scandir(config_path()), ['.', '..']);
        foreach ($files as $file) {
            $files_name = explode('.', $file)[0];
            yield $files_name => require config_path() . DIRECTORY_SEPARATOR . $file;
        }
        // dump($files);
    }
    
    public function boot()
    {
        //Whoops handle error
        Whoops::handle();
        // d(app());
        // $route = $this->container->get(Route::class);
        // $user->userModel()->set('Mahsoon');
        // d($route->request->method());
        // dd($user->userModel()->get());
        // dd($user);
        Config::setItems(static::loadConfig());
        // dd(config("providers"));
        $this->route->resolve();
        // dd(app());
    }
}