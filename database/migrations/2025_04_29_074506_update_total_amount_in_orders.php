<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            UPDATE orders o
            JOIN (
                SELECT order_id, SUM(price * quantity) AS total
                FROM order_items
                GROUP BY order_id
            ) oi ON o.id = oi.order_id
            SET o.total_amount = oi.total;
        ");
    }

    public function down(): void
    {
        // Optionally, you can reset the total_amount to null or 0 if needed
        DB::statement("UPDATE orders SET total_amount = 0");
    }
};
