<?php
namespace App\Services;

class SendByTelegramService implements ProviderInterface
{
    public function __construct(
        protected $provider = 'telegram'
    ){}

    public function send($provider, $verificationCode)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $cid = env('TELEGRAM_CHAT_ID');

        $sendtelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$cid}&parse_mode=html&text={$verificationCode->code}", "r");

        return !!$sendtelegram;
    }
}
