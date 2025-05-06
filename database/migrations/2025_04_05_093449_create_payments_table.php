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
        Schema::create('payments', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('order_id');
            $table->foreignId('payment_method_id');
            $table->string('provider_transc_id')->nullable();
            $table->string('provider_intend_id')->nullable();
            $table->string('screenshot_path')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->decimal('amount', 10, 2)->nullable();
            $table->json('provider_response');
            $table->string('provider_response_code')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('refunded_at')->nullable();
            $table->dateTime('failed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
