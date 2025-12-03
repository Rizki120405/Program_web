<?php

namespace App\Core;

class Router
{
    private $routes = [];

    public function get($uri, $controller)
    {
        $this->addRoute('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        $this->addRoute('POST', $uri, $controller);
    }

    private function addRoute($method, $uri, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    public function resolve($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['uri'] === $uri) {
                $this->callController($route['controller']);
                return;
            }
        }

        // Jika tidak ditemukan route yang cocok
        http_response_code(404);
        echo "404 - Page Not Found";
    }

    private function callController($controller)
    {
        $parts = explode('@', $controller);
        $controllerName = $parts[0];
        $methodName = $parts[1];

        $controllerInstance = new $controllerName();
        $controllerInstance->$methodName();
    }
}