<?php

namespace App\Traits\SMS;

use DOMDocument;
use DOMAttr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

trait MojaSMS
{

    public function authToken()
    {
        $minutes = 3600; // seconds until token expires

        return Cache::remember('myToken', $minutes, function () {

            $client = new \GuzzleHttp\Client();

            $response = $client->post(
                'https://api.mojasms.dev/login',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'email' => env('MOJA_SMS_EMAIL'),
                        'password' => env('MOJA_SMS_PASSWORD'),
                    ],
                ]
            );

            return json_decode((string)$response->getBody());
        });
    }


    public function getMojaGateSmsBalance()
    {

        $token = $this->authToken()->data->token;


        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get(
                'https://api.mojasms.dev/balance',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]
            );
            return json_decode((string)$response->getBody());
            
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $errorResponse = $e->getResponse();
            $response = [
                'status' => 'failed',
                'status_code' => $errorResponse->getStatusCode()
            ];

            return json_decode(json_encode($response), FALSE);
        }
    }

    public function sendMojaGateSingleSMS($phone, $message, $message_id)
    {

        $token = $this->authToken()->data->token;

        try {

            $client = new \GuzzleHttp\Client();
            $response = $client->post(
                'https://api.mojasms.dev/sendsms',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'from' => env('APP_NAME'),
                        'phone' => $phone,
                        'message' => $message,
                        'message_id' => $message_id,
                        'webhook_url' => 'https://mojagate.com/sms-webhook',
                    ],
                ]
            );
            return json_decode((string)$response->getBody());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $errorResponse = $e->getResponse();
            $response = [
                'status' => 'failed',
                'status_code' => $errorResponse->getStatusCode()
            ];

            return json_decode(json_encode($response), FALSE);
        }
    }


    public function sendMojaGateBulkSMS($data)
    {

        $token = $this->authToken()->data->token;

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post(
                'https://api.mojasms.dev/batch-sms',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'from' => env('APP_NAME'),
                        'messages' => [
                            [
                                'message' => 'just another test message',
                                'phone' => '254727242802',
                            ],
                        ],
                        'webhook_url' => 'https://mojagate.com/sms-webhook',
                    ],
                ]
            );
            return json_decode((string)$response->getBody());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $response = [
                'status' => 'failed'
            ];
            return   $response;
        }
    }
}
