<?php

namespace UsersApi\Helpers;

use GuzzleHttp\Client as ApiClient;
use GuzzleHttp\Exception\ClientException;

class ImageUploader
{
    /**
     * Upload an image via the OLX images API and return the server response
     * as an array.
     *
     * @param  string
     * @return mixed
     */
    public function upload(string $filepath)
    {
        $client = new ApiClient();

        try {
            $response = $client->request('POST', 'https://api.olx.com/v1.0/users/images', [
                'multipart' => [
                    [
                        'name' => 'user_picture',
                        'contents' => fopen($filepath, 'r')
                    ]
                ]
            ]);
        } catch (ClientException $e) {
            return null;
        }

        return json_decode($response->getBody()->getContents());
    }
}
