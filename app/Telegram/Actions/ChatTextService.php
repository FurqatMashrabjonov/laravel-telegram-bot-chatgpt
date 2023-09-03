<?php

namespace App\Telegram\Actions;

use App\Models\ChatText;

class ChatTextService
{

    public static function create($chat_id, $text)
    {
        return ChatText::query()->create(['chat_id' => $chat_id, 'text' => $text]);
    }

    public static function update($chat_id, $text)
    {
        return ChatText::query()->where('chat_id', $chat_id)->update(['text' => $text]);
    }

    public static function get($chat_id)
    {
        return ChatText::query()->where('chat_id', $chat_id)->first();
    }

}
