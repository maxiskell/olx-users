<?php

$config = new \Noodlehaus\Config(__DIR__ . '/../config/database.json');
$capsule = new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection([
    'driver'    => $config['driver'],
    'host'      => $config['host'],
    'database'  => $config['database'],
    'username'  => $config['username'],
    'password'  => $config['password'],
    'charset'   => $config['charset'],
    'collation' => $config['collation'],
    'prefix'    => $config['prefix']
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
date_default_timezone_set('UTC');
