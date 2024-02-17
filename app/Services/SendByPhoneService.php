<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class SendByPhoneService implements ProviderInterface
{
    public function __construct(
        protected $provider = 'phone'
    ){}

    public function send($provider, $verificationCode)
    {
        $client = new Client([
            'base_uri' => "https://qyvgr2.api.infobip.com/",
            'headers' => [
                'Authorization' => env('PORTAL_INFO_API'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);

        $response = $client->request(
            'POST',
            'sms/2/text/advanced',
            [
                RequestOptions::JSON => [
                    'messages' => [
                        [
                            'from' => 'InfoSMS',
                            'destinations' => [
                                ['to' => $provider->input('contact')]
                            ],
                            'text' => 'confirmation code: ' . $verificationCode->code,
                        ]
                    ]
                ],
            ]
        );

        return $response->getStatusCode();
    }
}
