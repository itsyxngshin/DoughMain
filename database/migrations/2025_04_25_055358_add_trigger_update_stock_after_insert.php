<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER trg_update_stock_after_insert
            AFTER INSERT ON stock_movements
            FOR EACH ROW
            BEGIN
                IF NEW.movement_type = 'IN' OR NEW.movement_type = 'OUT' THEN
                    UPDATE stocks
                    SET quantity = (
                        SELECT 
                            COALESCE(SUM(CASE WHEN movement_type = 'IN' THEN quantity ELSE 0 END), 0) -
                            COALESCE(SUM(CASE WHEN movement_type = 'OUT' THEN quantity ELSE 0 END), 0)
                        FROM stock_movements
                        WHERE product_id = NEW.product_id
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
