<?php

namespace App;

use App\Http\ResponseCodes;

require __DIR__ . '/../bootstrap/autoload.php';
require __DIR__ . '/../bootstrap/database.php';

$app = require __DIR__ . '/../bootstrap/app.php';

try {
    $response = $app->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $code = ResponseCodes::HTTP_OK;
} catch (\Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
    $code = ResponseCodes::HTTP_NOT_FOUND;
    $response = '404 - Not Found';
} catch (\Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
    $code = ResponseCodes::HTTP_METHOD_NOT_ALLOWED;
    $response = '405 - Method Not Allowed';
} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    $code = ResponseCodes::HTTP_NOT_FOUND;
    $response = '404 - Not Found';
} catch (Exception $e) {
    $code = ResponseCodes::HTTP_INTERNAL_SERVER_ERROR;
    $response = '500 - Internal Server Error';
}

header('Content-Type: application/json');
http_response_code($code);
echo json_encode($response);
