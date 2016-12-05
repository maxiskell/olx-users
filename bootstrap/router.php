<?php

/**
 * Router definition.
 *
 * Capture all the defined routes in a route collector and return it.
 */

$router = new \Phroute\Phroute\RouteCollector();
$routes = require_once __DIR__ . '/../src/Http/routes.php';

foreach ($routes as $route) {
    $router->addRoute($route[0], $route[1], $route[2]);
}

return $router;
