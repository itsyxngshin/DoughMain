<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Your table creation here, if any...

        DB::unprepared("
            CREATE TRIGGER trg_update_stock_after_insert
            AFTER INSERT ON stock_movements
            FOR EACH ROW
            BEGIN
                IF NEW.movement_type = 'IN' THEN
                    UPDATE stocks
                    SET quantity = (
                        SELECT COALESCE(SUM(quantity), 0)
                        FROM stock_movements
                        WHERE product_id = NEW.product_id AND movement_type = 'IN'
                    )
                    WHERE product_id = NEW.product_id;
                END IF;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_update_stock_after_insert');
    }

};
