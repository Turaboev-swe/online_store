<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;

class sendTelegramMessage
{
    private $token;
    private $chat_id;
    private $url;
    public function __construct()
    {
        $this->token = config('telegram.bots.telegram');
        $this->chat_id = "https://api.telegram.org/bot$this->token/sendMessage";
        $this->url = config('telegram.admin_chat_id');
    }
    public function __invoke($message):void
    {
        $url = "https://api.telegram.org/bot$this->token/sendMessage";
        Http::post($url, [
            'chat_id' => $this->chat_id,
            'text' => $message,
        ]);
    }
}
