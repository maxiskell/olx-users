<?php

namespace App;

$router = require_once __DIR__ . '/../app/routes.php';
$app = new \Phroute\Phroute\Dispatcher($router->getData());

return $app;
