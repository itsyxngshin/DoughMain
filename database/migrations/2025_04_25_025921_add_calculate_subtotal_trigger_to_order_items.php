<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddCalculateSubtotalTriggerToOrderItems extends Migration
{
    public function up()
    {
        // BEFORE INSERT trigger
        DB::unprepared('
            CREATE TRIGGER calculate_subtotal_before_insert
            BEFORE INSERT ON order_items
            FOR EACH ROW
            BEGIN
                SET NEW.subtotal = NEW.price * NEW.quantity;
            END
        ');

        // BEFORE UPDATE trigger
        DB::unprepared('
            CREATE TRIGGER calculate_subtotal_before_update
            BEFORE UPDATE ON order_items
            FOR EACH ROW
            BEGIN
                SET NEW.subtotal = NEW.price * NEW.quantity;
            END
        ');
    }

    public function down()
    {
        // Drop the triggers on rollback
        DB::unprepared('DROP TRIGGER IF EXISTS calculate_subtotal_before_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS calculate_subtotal_before_update');
    }
}
