<?php

namespace App\Models;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chatroom extends Model
{
    use HasFactory;
    protected $appends = ['last_message', 'created_at_formatted'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
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
