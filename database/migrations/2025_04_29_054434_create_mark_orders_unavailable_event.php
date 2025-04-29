<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Enable MySQL event scheduler
        DB::statement("SET GLOBAL event_scheduler = ON");

        // Create the scheduled event
        DB::statement("
            CREATE EVENT IF NOT EXISTS mark_orders_unavailable
            ON SCHEDULE EVERY 1 DAY
            STARTS CURRENT_DATE + INTERVAL 1 DAY
            DO
            BEGIN
                UPDATE orders
                SET status = 'unavailable'
                WHERE status = 'available';
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the event on rollback
        DB::statement("DROP EVENT IF EXISTS mark_orders_unavailable");
    }
};
