<?php

/**
 * Routes collection defined as an array.
 */

return [
    ['GET', '/users', ['App\Controllers\UsersController', 'index']],
    ['POST', '/users', ['App\Controllers\UsersController', 'create']],
    ['GET', '/users/{id:i}', ['App\Controllers\UsersController', 'show']],
    ['PATCH', '/users/{id:i}', ['App\Controllers\UsersController', 'update']],
    ['DELETE', '/users/{id:i}', ['App\Controllers\UsersController', 'destroy']]
];
