<?php

namespace App\Models;

use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message_id', 'status', 'description', 'from_chat_id'];

    public function from ()
    {
        return $this->belongsTo(TelegraphChat::class, 'from_chat_id', 'chat_id');
    }
}
