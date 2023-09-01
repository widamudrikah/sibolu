<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class UploadImageHelper
{
    public static function uploadImage($imageFile)
    {
        $client = new Client();

        $response = $client->request('POST', 'https://api.imgbb.com/1/upload', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'key' => config('services.imgbb.api_key'),
                'image' => base64_encode(file_get_contents($imageFile->path())),
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        $imageUrl = $body['data']['url'];

        return $imageUrl;
    }
}