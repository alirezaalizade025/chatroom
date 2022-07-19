<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'users' => $this->users->map(function ($user) {
            return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'role' =>$user->chatroomUser->where('chatroom_id', $this->id)->first()->is_admin ? 'admin' : 'user',
                    'profile_photo_url' => $user->profile_photo_url,
                ];
        }),
            'last_message' => $this->last_message,
            'created_at_formatted' => $this->created_at_formatted,
        ];
    }
}
