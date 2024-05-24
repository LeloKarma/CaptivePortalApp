<?php

namespace App\Services;

use GuzzleHttp\Client;

class OrangeOMService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function initiatePayment($amount, $phoneNumber)
    {
        $response = $this->client->post('https://api.orange.com/orange-money/api/', [
            'json' => [
                'amount' => $amount,
                'phoneNumber' => $phoneNumber,
                'callbackUrl' => route('orange.callback')
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
