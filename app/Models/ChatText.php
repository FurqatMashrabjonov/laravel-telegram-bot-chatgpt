<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatText extends Model
{
    protected $fillable = ['text', 'chat_id'];
}
