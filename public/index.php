<?php

require __DIR__ . '/../bootstrap/autoload.php';
require __DIR__ . '/../bootstrap/database.php';

$app = require __DIR__ . '/../bootstrap/app.php';

$response = $app->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

echo json_encode($response);
