<?php

namespace source;

use Exception;

class Container {
    private array $binds = [];
    private static object $container;

    function bind(string $key, object $func): void {
        $this->binds[$key] = $func;
    }

    public static function set_container($container): void {
        static::$container = $container;
    }

    public static function get_container($key){
        return static::$container->resolve($key);
    }

    function resolve(string $key): object {
        if (!isset($this->binds[$key])){
            throw new Exception("Invalid resolve key found: {$key}.");
        }
        return call_user_func($this->binds[$key]);
    }
}