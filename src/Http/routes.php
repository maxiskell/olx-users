<?php

/**
 * Routes collection defined as an array.
 */

return [
    ['GET', '/users', ['UsersApi\Controllers\UsersController', 'index']],
    ['POST', '/users', ['UsersApi\Controllers\UsersController', 'create']],
    ['GET', '/users/{id:i}', ['UsersApi\Controllers\UsersController', 'show']],
    ['PATCH', '/users/{id:i}', ['UsersApi\Controllers\UsersController', 'update']],
    ['DELETE', '/users/{id:i}', ['UsersApi\Controllers\UsersController', 'destroy']],
    ['POST', '/users/{id:i}/picture', ['UsersApi\Controllers\UsersController', 'uploadPicture']]
];
