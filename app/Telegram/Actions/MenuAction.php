<?php

namespace App\Telegram\Actions;

use App\Models\ChatText;
use App\Telegram\Enum\ConstantTexts;
use DefStudio\Telegraph\Models\TelegraphChat;

class MenuAction
{

    protected TelegraphChat $chat;

    public function __construct(TelegraphChat $chat)
    {
        $this->chat = $chat;
    }

    public function sendMessage()
    {
        if (!ActionService::get()) {
            ActionService::set('sendMessage');
        } else {
            ActionService::update('sendMessage');
        }
        $this->chat->html(ConstantTexts::SEND_MESSAGE)->send();
    }

    public function getStats()
    {
        if (!is_null(ActionService::get())) {
            ActionService::set('getStats');
        } else {
            ActionService::update('getStats');
        }

        $chatModalQuery = TelegraphChat::query();
        $chatTextModalQuery = ChatText::query();

        $stats = [
            $chatModalQuery->count(),
            $chatModalQuery->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count(),
            $chatTextModalQuery->count(),
            $chatTextModalQuery->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count(),
        ];
        $layout = [':chats_count', ':chats-count-current-month', ':openai_requests_count', ':openai-requests-count-current-month'];
        $this->chat->html(str_replace($layout, $stats, ConstantTexts::STATS))->send();
    }

    public function resetToken()
    {
        if (!ActionService::get()) {
            ActionService::set('resetToken');
        } else {
            ActionService::update('resetToken');
        }
        $this->chat->html(ConstantTexts::SEND_TOKEN)->send();
    }

    public function addChannel()
    {
        if (!is_null(ActionService::get())) {
            ActionService::set('addChannel');
        } else {
            ActionService::update('addChannel');
        }
        $this->chat->html('kanal qo\'shish')->send();
    }


}
