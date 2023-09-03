<?php

namespace App\OpenAi;

use App\Models\Token;
use App\Telegram\Enum\ConstantTexts;
use DefStudio\Telegraph\Models\TelegraphChat;
use OpenAI;

class TextCompletion
{

    protected string $token;
    protected $client;
    protected TelegraphChat $from;
    protected $config = [
        'model' => 'text-davinci-003',

    ];

    public function __construct(TelegraphChat $chat)

    {
        $this->token = Token::query()->first()?->token;
        $this->client = OpenAI::client($this->token);
        $this->from = $chat;
    }

    public function text($text): mixed
    {
        try {
            $result = $this->client->completions()->create(array_merge($this->config, ['prompt' => $text]));
            $str = '';
            foreach ($result['choices'] as $choice) {
                $str .= $choice['text'] . "\n";
            }
            return $str;
        } catch (\Exception $exception) {
            $chat = TelegraphChat::query()->where('chat_id', config('telegraph.admin_chat_id'))->first();
            if ($chat) {
                $chat->html(str_replace([':error', ':chat_id'], [$exception->getMessage(), $this->from->chat_id], ConstantTexts::ERROR_OPENAI))->send();
                return null;
            }
        } finally {
            return null;
        }
    }
}
