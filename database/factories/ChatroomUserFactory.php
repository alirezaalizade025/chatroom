<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Chatroom;
use App\Models\ChatroomUser;
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
        $chatroom = [
            'chatroom_id' => Chatroom::all()->random()->id,
            'user_id' => User::all()->unique()->random()->id,
            'is_blocked' => $this->faker->randomElement([true, false]),
            'role' => $this->faker->randomElement(['admin', 'user']),
        ];

        while (ChatroomUser::where([['chatroom_id', $chatroom['chatroom_id']], ['user_id', $chatroom['user_id']]])->get()->count() > 0) {
            $chatroom['user_id'] = User::all()->random()->id;
        }
        return $chatroom;
    }
}
