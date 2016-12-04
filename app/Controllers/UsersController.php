<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
    /**
     * Retrieve all users.
     *
     * @return string
     */
    public function index() : array
    {
        return User::all()->toArray();
    }

    /**
     * Retrieve a specific user.
     *
     * @param  int
     * @return string
     */
    public function show(int $id) : array
    {
        return User::findOrFail($id)->toArray();
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
