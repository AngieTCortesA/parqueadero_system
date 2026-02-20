<?php

namespace Framework;

use Framework\Middleware\Middleware;

class Router
{
    protected $routes = [];

    public function __construct()
    {
        $this->loadRoutes('web');
    }

    public function get(string $uri, array $action, string|null $middleware = null)
    {
        $this->routes['GET'][$uri] = [
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    public function post(string $uri, array $action,string|null $middleware = null)
    {
        $this->routes['POST'][$uri] =[
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    public function delete(string $uri,array $action,string|null $middleware = null)
    {
        $this->routes['DELETE'][$uri] = [
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    public function put(string $uri, array $action,string|null $middleware = null)
    {
        $this->routes['PUT'][$uri] = [
            'action' => $action,    
            'middleware' => $middleware
        ];
    }

    public function run()
    {

        $uri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH); //PHP_URL_QUERY

        $method =  $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']; // GET,POST, DELETE,PUT
        
        $action = $this->routes[$method] [$uri]['action'] ?? null;

        if (!$action) {
            exit('Route not found' . $method . '' . $uri);
        }

        $middleware = $this ->routes[$method][$uri]['middleware'] ?? null;

        if($middleware){
           Middleware::run(new $middleware());
        }

        [$controller, $method]= $action;

        (new $controller())->$method();
    }
    public function loadRoutes(string $file)
    {
        $router = $this;
        $filePath= __DIR__ . '/../routes/web.php';
        require $filePath;
    }
}