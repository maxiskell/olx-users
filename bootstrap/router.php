<?php

/**
 * Router definition.
 *
 * Captures all the defined routes in a route collector and returns it.
 */

$router = new \Phroute\Phroute\RouteCollector();
$routes = require_once __DIR__ . '/../app/Http/routes.php';

foreach ($routes as $route) {
    $router->addRoute($route[0], $route[1], $route[2]);
}

return $router;
