<?php

use source\Router;

const BASE_DIR = __DIR__ . '/../';

spl_autoload_register(function ($class) {
    require BASE_DIR . $class . '.php';
});

$router = new Router();

$routes = require BASE_DIR . 'routes.php';
$url_query = parse_url($_SERVER['REQUEST_URI']);

$router->respond($url_query['path'], $_SERVER['REQUEST_METHOD']);