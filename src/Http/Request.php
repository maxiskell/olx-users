<?php

namespace UsersApi\Http;

class Request
{
    /**
     * Return the request body.
     *
     * @return array
     */
    public function input() : array
    {
        return json_decode(file_get_contents('php://input'), true) ?? [];
    }
}
