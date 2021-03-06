<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\ChatroomFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChatroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ChatroomFactory::class);
    }
}
