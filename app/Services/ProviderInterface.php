<?php
namespace App\Services;

interface ProviderInterface
{
    public function send($provider, $verificationCode);
}
