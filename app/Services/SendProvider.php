<?php
namespace App\Services;

class SendProvider
{
    protected ProviderInterface $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function sendMessage($provider, $verificationCode)
    {
        return $this->provider->send($provider, $verificationCode);
    }

}
