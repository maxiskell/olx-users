<?php

namespace UsersApi;

use UsersApi\Http\ResponseCodes;

require __DIR__ . '/../bootstrap/autoload.php';
require __DIR__ . '/../bootstrap/database.php';

$app = require __DIR__ . '/../bootstrap/app.php';

$logfile = __DIR__ . '/../logs/users.log';

try {
    $dispatched = $app->dispatch(
        $_SERVER['REQUEST_METHOD'],
        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
    );

    $response = [
        'status' => $dispatched['status'] ?? ResponseCodes::HTTP_OK
    ];

    if ($dispatched['data']) {
        $response['data'] = $dispatched['data'];
    }

    if ($dispatched['errors']) {
        $response['errors'] = $dispatched['errors'];
    }
} catch (\Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
    $response = [
        'status' => ResponseCodes::HTTP_NOT_FOUND,
        'errors' => '404 - Not Found'
    ];
} catch (\Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
    $response = [
        'status' => ResponseCodes::HTTP_METHOD_NOT_ALLOWED,
        'errors' => '405 - Method Not Allowed'
    ];
} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    $response = [
        'status' => ResponseCodes::HTTP_NOT_FOUND,
        'errors' => '404 - Resource Not Found'
    ];
} catch (\Exception $e) {
    error_log('['.date('Y-m-d@H:i:s').']->'.$e->getMessage(), 3, $logfile);

    $response = [
        'status' => ResponseCodes::HTTP_INTERNAL_SERVER_ERROR,
        'errors' => '500 - Internal Server Error'
    ];
} catch (\Error $e) {
    error_log('['.date('Y-m-d@H:i:s').']->'.$e->getMessage(), 3, $logfile);

    $response = [
        'status' => ResponseCodes::HTTP_INTERNAL_SERVER_ERROR,
        'errors' => '500 - Internal Server Error'
    ];
}

header('Content-Type: application/json');
http_response_code($response['status']);
echo json_encode($response);
