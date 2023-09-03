<?php

namespace App\Telegram\Enum;

class ConstantKeyboards
{

    public const MAIN_ADMIN =[
        [
            ['text' => 'Xabar yuborish📨'],
            ['text' => 'Statistika📊'],
        ],
        [
            ['text' => 'Apini yangilash🔁'],
            ['text' => 'Kanal qo\'shish➕'],
        ],
//        [
//            ['text' => 'Admin panel', 'web_app' => ['url' => 'https://payme.uz']]
//        ]
    ];

    const MAIN_MENU_ARRAY = [
        'Xabar yuborish📨' => 'sendMessage',
        'Statistika📊' => 'getStats',
        'Apini yangilash🔁' => 'resetToken',
        'Kanal qo\'shish➕' => 'addChannel'
    ];

}
