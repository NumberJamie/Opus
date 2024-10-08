<?php

use source\Config;
use source\Router;

const BASE_DIR = __DIR__ . '/../';
require_once BASE_DIR . 'source/functions.php';

spl_autoload_register(function ($class) {
    require BASE_DIR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
});

$config = new Config();
$router = new Router();

$routes = require_once BASE_DIR . 'routes.php';

$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->respond($url_path, $_SERVER['REQUEST_METHOD']);