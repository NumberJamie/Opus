<?php

namespace source;

use Exception;

class Container {
    private array $binds = [];
    private static object $container;

    function bind(string $key, object $func): void {
        $this->binds[$key] = $func;
    }

    static function set($container): void {
        static::$container = $container;
    }

    static function get($key){
        return static::$container->resolve($key);
    }

    function resolve(string $key): object {
        if (!isset($this->binds[$key])){
            throw new Exception("Invalid resolve key found: {$key}.");
        }
        return call_user_func($this->binds[$key]);
    }
}