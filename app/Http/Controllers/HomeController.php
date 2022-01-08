<?php
namespace App\Http\Controllers;

use Phpdic\Dic\HTTP\Request;

class HomeController
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index()
    {
        dd($this->request->method);
        dd('Welcome From home controller with index function');
    }
}