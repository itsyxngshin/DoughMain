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
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('user_id');
            $table->foreignId('shop_id');
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['Pending', 'On Process', 'Out For Delivery', 'Completed', 'On Pick-Up', 'Cancelled'])->default('Pending');
            $table->string('delivery_address');
            $table->date('date_arrangement')->nullable()->default(date('Y-m-d'));
            $table->time('time_arrangement')->nullable()->default('00:00:00'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
