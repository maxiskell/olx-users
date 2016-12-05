<?php

namespace UsersApi\Controllers;

use UsersApi\Models\User;
use UsersApi\Http\Request;
use UsersApi\Http\ResponseCodes;
use UsersApi\Helpers\ImageUploader;
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

    /**
     * Upload and set a user's picture.
     *
     * @param  int
     * @return array
     */
    public function uploadPicture(int $id) : array
    {
        $user = User::findOrFail($id);
        $input = (new Request)->input();
        $uploader = new ImageUploader();
        $imageData = $uploader->upload($input['filepath']);

        if (is_null($imageData)) {
            return [
                'status' => ResponseCodes::HTTP_BAD_REQUEST,
                'errors' => 'Invalid image file'
            ];
        }

        $user->update(['picture' => $imageData->url]);

        return [
            'data' => [
                'image_url' => $imageData->url
            ]
        ];
    }
}
