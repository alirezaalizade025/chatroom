<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Chatroom;
use App\Models\ChatroomUser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        Chatroom::factory(3)->create();
        Message::factory(100)->create();
        ChatroomUser::factory(100)->create();
    }
}
