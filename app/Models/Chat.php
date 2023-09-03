<?php

namespace App\Models;

use DefStudio\Telegraph\Models\TelegraphChat;

class Chat extends TelegraphChat
{

    protected $table = 'telegraph_chats';

    public function texts()
    {
        return $this->hasMany(ChatText::class, 'chat_id', 'chat_id');
    }

    public function getMessageCountAttribute(){
        return $this->texts()->count();
    }

}
