<?php

$router = new \Phroute\Phroute\RouteCollector();

$router->post('/users', function () {
    return 'Hello, users!';
});

return $router;
