<?php

namespace App\Controllers;

use App\Models\User;
use App\Http\Request;
use App\Http\ResponseCodes;
use Form\Validator;

class UsersController
{
    /**
     * Retrieve all users.
     *
     * @return string
     */
    public function index() : array
    {
        return ['data' => User::all()->toArray()];
    }

    /**
     * Retrieve a specific user.
     *
     * @param  int
     * @return array
     */
    public function show(int $id) : array
    {
        return ['data' => User::findOrFail($id)->toArray()];
    }

    /**
     * Create a user entity.
     *
     * @return array
     */
    public function create() : array
    {
        $input = (new Request)->input();
        $validator = new Validator(User::validationRules());

        if ($validator->validate($input)) {
            return [
                'status' => ResponseCodes::HTTP_CREATED,
                'data' => User::create($input)
            ];
        } else {
            return [
                'status' => ResponseCodes::HTTP_BAD_REQUEST,
                'errors' => $validator->getErrors()
            ];
        }
    }

    /**
     * Update a user entity.
     *
     * @param  int
     * @return array
     */
    public function update(int $id) : array
    {
        $input = (new Request)->input();
        $validator = new Validator(User::validationRules());

        if ($validator->validate($input)) {
            $user = User::findOrFail($id);
            $user->update($input);

            return ['data' => $user->toArray()];
        } else {
            return [
                'status' => ResponseCodes::HTTP_BAD_REQUEST,
                'errors' => $validator->getErrors()
            ];
        }

        return 'create';
    }

    /**
     * Delete a user entity.
     *
     * @param  int
     * @return array
     */
    public function destroy(int $id) : array
    {
        User::findOrFail($id)->delete();

        return ['data' => 'The user has been successfully deleted'];
    }
}
