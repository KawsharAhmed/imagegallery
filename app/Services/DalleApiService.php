<?php 

namespace App\Services;
use GuzzleHttp\Client;

class DalleApiService
{
    protected $client;

    public function __construct()
    {
        
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('DALLE_API_KEY'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function generateImage($prompt)
{
    $response = $this->client->post('images/generations', [
        'json' => [
            'model' => 'image-alpha-001',
            'prompt' => $prompt,
        ],
    ]);

    $result = json_decode($response->getBody(), true);
    return $result['data'][0]['url'];
}

}