<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatGptTokenResource\Pages;
use App\Filament\Resources\ChatGptTokenResource\RelationManagers;
use App\Models\ChatGptToken;
use App\Models\Token;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChatGptTokenResource extends Resource
{
    protected static ?string $model = Token::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('token')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('token')->label('Token')->sortable()->copyable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Yangilangan Sana')
                    ->description(fn(Token $token) => $token->updated_at->diffForHumans())
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListChatGptTokens::route('/'),
            'create' => Pages\CreateChatGptToken::route('/create'),
            'edit' => Pages\EditChatGptToken::route('/{record}/edit'),
        ];
    }
}
