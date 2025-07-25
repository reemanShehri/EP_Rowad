<?php

namespace App\Models;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //


    public function participants()
{
    return $this->belongsToMany(User::class, 'conversation_participants')
                ->withTimestamps();
}

public function messages()
{
    return $this->hasMany(Message::class)->latest();
}
}
