<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chatroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $appends = [
        'is_mine',
        'is_edit'
    ];
    protected $fillable = [
        'message',
        'type',
        'chatroom_id',
        'user_id',
        'status',
        'created_at',
        'updated_at'
    ];

    public function chatroom()
    {
        return $this->belongsTo(Chatroom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsMineAttribute()
    {
        if ($this->user_id == auth()->id()) {
            return true;
        }
        return false;
    }

    public function getIsEditAttribute()
    {
        if ($this->created_at != $this->updated_at) {
            return true;
        }
        return false;
    }
}
