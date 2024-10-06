<?php

namespace source;

class Router {
    private array $routes = [];
    private array $availableMethods = [];

    private function append_route(string $method, string $path, string $controller): void {
        if (!in_array($method, $this->availableMethods)){
            $this->availableMethods[] = $method;
        }
        $this->routes[] = compact('path', 'controller', 'method');
    }

    function get(string $path, string $controller): void {
        $this->append_route('GET', $path, $controller);
    }

    function post(string $path, string $controller): void {
        $this->append_route('POST', $path, $controller);
    }

    function respond(string $path, string $method): void {
        // TODO: clean the path string
        if (!in_array($method, $this->availableMethods)){
            $this->abort(HTTPStatus::METHOD_NOT_ALLOWED);
        }
        foreach ($this->routes as $route){
            if ($route['path'] != $path or $route['method'] != $method) continue;
            require BASE_DIR . $route['controller'];
            return;
        }
        $this->abort();
    }

    function abort(int $statusCode = HTTPStatus::NOT_FOUND): void {
        http_response_code($statusCode);
        // TODO: require error php file
        die();
    }
}