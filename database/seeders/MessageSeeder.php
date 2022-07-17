<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\MessageFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MessageFactory::class);
    }
}
