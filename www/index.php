<?php

require 'Core/Autoloader.php';

use App\Core\ConstLoader;
use App\Core\Router;

new ConstLoader();

$uri = $_SERVER['REQUEST_URI'];
$listOfRoutes = yaml_parse_file('routes.yml');

$router = new Router($uri, $listOfRoutes);

try {
    $router->resolveRoute();
} catch (Exception $exception){
    echo 'Error in ' . $_SERVER['PHP_SELF'] . ' : ' . $exception->getMessage();
}