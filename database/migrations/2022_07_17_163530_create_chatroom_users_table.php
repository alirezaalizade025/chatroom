<?php

use App\Models\User;
use App\Models\Chatroom;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatroom_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Chatroom::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->boolean('is_blocked')->default(false);
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chatroom_users');
    }
};
