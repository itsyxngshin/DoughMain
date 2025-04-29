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
        Schema::create('messages', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('sender_id')->index();
            $table->foreignId('receiver_id')->index();
            $table->foreignId('order_id')->index()->nullable();
            $table->text('message');
            $table->enum('status', ['sent', 'delivered', 'read'])->default('sent');
            # $table->enum('type', ['text', 'image', 'video'])->default('text');
            $table->dateTime('seen_at')->nullable();
            $table->enum('is_deleted', ['yes', 'no'])->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
