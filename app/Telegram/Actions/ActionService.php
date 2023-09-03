<?php

namespace App\Telegram\Actions;

class ActionService
{

    public static function set(string $action): mixed{
        if (\App\Models\Action::query()->count() > 0){
            return false;
        }else {
         return \App\Models\Action::query()->create([
                'action' => $action
            ]);
        }
    }

    public static function get(): string|null{
        return \App\Models\Action::query()->first()?->action;
    }

    public static function delete(): bool{
        return \App\Models\Action::query()->delete();
    }

    public static function update(string $action): bool{
        return \App\Models\Action::query()->update([
            'action' => $action
        ]);
    }

}
