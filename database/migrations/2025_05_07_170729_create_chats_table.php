<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('user_one_id')->nullable();
            $table->foreignId('user_two_id')->nullable();
            $table->foreignId('last_message_id')->nullable();
            $table->boolean('is_group')->default(false); // For future group support
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
