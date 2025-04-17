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
            $table->string('attachment')->nullable();
            $table->string('attachment_type')->nullable();
            $table->string('attachment_size')->nullable();
            $table->string('attachment_name')->nullable();
            $table->string('attachment_path')->nullable();
            $table->dateTime('received_at')->nullable();
            $table->dateTime('sent_at')->nullable();  
            $table->dateTime('read_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
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
