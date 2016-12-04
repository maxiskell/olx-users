<?php

/**
 * Routes collection defined as an array.
 */

return [
    ['GET', '/users', ['App\Controllers\UsersController', 'index']],
    ['GET', '/users/{id:i}', ['App\Controllers\UsersController', 'show']]
];
