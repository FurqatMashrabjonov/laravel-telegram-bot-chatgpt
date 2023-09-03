<?php

namespace App\Filament\Widgets;

use App\Enums\MessageStatus;
use App\Models\Chat;
use App\Models\ChatText;
use App\Models\Message;
use DefStudio\Telegraph\Models\TelegraphChat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ChatsOverview extends BaseWidget
{
    protected  $chat;
    protected  $chat_text;

    public function __construct()
    {
        $this->chat = Chat::query();
        $this->chat_text = ChatText::query();
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Telegram Users', $this->chat->count())
                ->description(
                    $this->chat->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count().
                ' users in ' . now()->monthName
                )
                ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Sent Messages', Message::query()->where('status', MessageStatus::SENT)->count())
//                ->description()
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('OpenAI Requests', ChatText::query()->count())
                ->description(
                    $this->chat_text->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count().
                    ' requests in ' . now()->monthName
                )
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
