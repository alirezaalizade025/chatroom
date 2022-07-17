<?php

namespace Database\Factories;

use App\Models\Chatroom;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'chatroom_id' => Chatroom::all()->pluck('id')->random(),
            'user_id' => User::all()->pluck('id')->random(),
            'type' => 'text',
            'message' => $this->faker->text,
            'status' => 'sent',
        ];
    }
}
