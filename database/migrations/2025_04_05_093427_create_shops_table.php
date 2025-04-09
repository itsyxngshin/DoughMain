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
        Schema::create('shops', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('manage_id'); 
            $table->string('shop_name')->unique();
            $table->string('shop_description')->nullable();
            $table->foreignId('shop_logo_id')->nullable()->constrained('shop_logos')->onDelete('set null');
            $table->string('shop_address_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
