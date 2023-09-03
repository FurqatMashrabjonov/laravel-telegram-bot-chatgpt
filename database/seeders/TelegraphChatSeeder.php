<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TelegraphChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chats = [];
        for ($i = 0; $i < 100; $i++) {
            $chats[] = [
                'chat_id' => '5512995764',
                'name' => 'Furqat MAshrabjonov',
                'telegraph_bot_id' => 1,
                'from' => null
            ];
        }
        \DB::table('telegraph_chats')->insert($chats);
    }
}
