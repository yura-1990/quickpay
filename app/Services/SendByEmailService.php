<?php
namespace App\Services;

use App\Mail\SendConfirmationCode;
use Illuminate\Support\Facades\Mail;

class SendByEmailService implements ProviderInterface
{
    public function __construct(
        protected $provider = 'email'
    ){}

    public function send($provider, $verificationCode)
    {
        Mail::to($provider->input('contact'))->send(new SendConfirmationCode($verificationCode));
    }
}
