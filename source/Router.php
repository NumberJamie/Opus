<?php

namespace source;

class Router {
    private array $routes = [];
    private array $availableMethods = [];

    private function append_route(string $method, string $path, string $controller){
        if (!in_array($method, $this->availableMethods)){
            $this->availableMethods[] = $method;
        }
        $this->routes[] = ['path' => $path, "controller" => $controller, "method" => $method];
    }

    function get(string $path, string $controller): void {
        $this->append_route('GET', $path, $controller);
    }

    function post(string $path, string $controller): void {
        $this->append_route('POST', $path, $controller);
    }

    function respond(string $path, string $method): void {
        if (!in_array($method, $this->availableMethods)){
            $this->abort(405);
        }
        foreach ($this->routes as $route){
            if ($route['path'] != $path or $route['method'] != $method) continue;
            require BASE_DIR . $route['controller'];
            return;
        }
        $this->abort();
    }

    function abort(int $statusCode = 404): void {
        http_response_code($statusCode);
        // TODO: return error php file
        die();
    }
}