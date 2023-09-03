<?php

namespace App\Telegram\Actions;

use App\Models\Token;

class OpenAiTokenService
{
    public static function get(): ?string
    {
        return Token::query()->first()?->token;
    }

    public static function set(string $token): void
    {
        Token::query()->create(['token' => $token]);
    }

    public static function update(string $token): void
    {
        Token::query()->first()->update(['token' => $token]);
    }

    public static function delete(): void
    {
        Token::query()->delete();
    }
}
