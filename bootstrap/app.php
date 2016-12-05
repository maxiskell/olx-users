<?php

namespace UsersApi;

$router = require_once __DIR__ . '/router.php';
$app = new \Phroute\Phroute\Dispatcher($router->getData());

return $app;
