<?php

namespace App\Models;

use App\Models\User;
use App\Models\Message;
use App\Models\ChatroomUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chatroom extends Model
{
    use HasFactory;
    protected $appends = ['last_message', 'created_at_formatted'];
    protected $guarded = [];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, ChatroomUser::class, 'chatroom_id', 'id', 'id', 'user_id');
    }
    public function chatroomUsers()
    {
        return $this->hasMany(ChatroomUser::class);
    }

    protected function getLastMessageAttribute()
    {
        return $this->messages()->orderBy('created_at', 'DESC')->first();
    }

    protected function getCreatedAtFormattedAttribute()
    {
        return $this->messages()->orderBy('created_at', 'DESC')->first()->created_at->diffForHumans();
    }
}
