<?php

namespace App\Controllers;

class UsersController
{
    /**
     * Retrieve all users.
     *
     * @return string
     */
    public function index() : string
    {
        return 'index';
    }

    /**
     * Retrieve a specific user.
     *
     * @param  int
     * @return string
     */
    public function show(int $id) : string
    {
        return 'show';
    }

    /**
     * Create a user entity.
     *
     * @return string
     */
    public function create() : string
    {
        return 'create';
    }

    /**
     * Update a user entity.
     *
     * @param  int
     * @return string
     */
    public function update(int $id) : string
    {
        return 'create';
    }

    /**
     * Delete a user entity.
     *
     * @param  int
     * @return string
     */
    public function destroy(int $id) : string
    {
        return 'create';
    }
}
