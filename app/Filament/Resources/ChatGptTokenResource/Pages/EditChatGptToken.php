<?php

namespace App\Filament\Resources\ChatGptTokenResource\Pages;

use App\Filament\Resources\ChatGptTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChatGptToken extends EditRecord
{
    protected static string $resource = ChatGptTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
