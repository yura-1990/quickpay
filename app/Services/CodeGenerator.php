<?php
namespace App\Services;

class CodeGenerator
{
    public static function generateCode() {
        return rand(100000, 999999);
    }

    public function mapping()
    {
        return [
            'telegram' => new SendByTelegramService,
            'phone' => new SendByPhoneService,
            'email' => new SendByEmailService,
        ];
    }
}
