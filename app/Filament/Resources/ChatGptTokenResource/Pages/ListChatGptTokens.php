<?php

namespace App\Filament\Resources\ChatGptTokenResource\Pages;

use App\Filament\Resources\ChatGptTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChatGptTokens extends ListRecords
{
    protected static string $resource = ChatGptTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
