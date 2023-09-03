<?php

namespace App\Filament\Resources;

use App\Enums\MessageStatus;
use App\Filament\Resources\MessageResource\Pages;
use App\Filament\Resources\MessageResource\RelationManagers;
use App\Jobs\SendMessage;
use App\Models\Message;
use App\Models\Token;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('message_id')->label('Message ID')->sortable(),
                Tables\Columns\TextColumn::make('from.name')->label('Jo\'natuvchi')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Xabar')->limit(50)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')->label('Holati')->color('success')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->description(fn(Message $message) => $message->updated_at->diffForHumans())
                    ->label('Saqlangan Sana')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->description(fn(Message $message) => $message->updated_at->diffForHumans())
                    ->label('Yakunlangan Sana')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
                Action::make('Qayta yuborish')
                    ->requiresConfirmation()
                    ->action(fn (Message $message) => dispatch(new SendMessage($message->id)))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
