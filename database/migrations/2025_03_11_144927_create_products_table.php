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
    Schema::create('products', function (Blueprint $table) {
        $table->id()->autoIncrement();
        $table->foreignId('category_id')->index(); // Assuming 'categories' table has an 'id' field
        $table->foreignId('shop_id')->index(); // Assuming 'shops' table has an 'id' field
        $table->string('product_name');
        $table->string('product_description')->nullable();
        $table->string('product_image')->nullable();
        $table->decimal('product_price', 10, 2);
        $table->enum('product_status', ['available', 'unavailable'])->default('available');
        $table->foreignId('stock_id')->nullable()->index(); // Allow null values for stock_id
        $table->timestamps();
        $table->timestamp('deleted_at')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
