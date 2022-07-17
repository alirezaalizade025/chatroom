<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Chatroom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatroomUser>
 */
class ChatroomUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'chatroom_id' => Chatroom::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
