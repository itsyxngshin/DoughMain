<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUpdateCartTotalTrigger extends Migration
{
    public function up()
{
    // Trigger for AFTER INSERT
    DB::unprepared('
    CREATE TRIGGER update_cart_total_after_insert
    AFTER INSERT ON cart_items
    FOR EACH ROW
    BEGIN
        DECLARE total DECIMAL(10,2);

        -- Calculate the total amount for the cart after an item is added
        SELECT SUM(sub_total) 
        INTO total
        FROM cart_items
        WHERE cart_id = NEW.cart_id;

        -- Update the total_amount field in the carts table
        UPDATE carts
        SET total_amount = total
        WHERE id = NEW.cart_id;
    END;
');

// Trigger for AFTER UPDATE
DB::unprepared('
    CREATE TRIGGER update_cart_total_after_update
    AFTER UPDATE ON cart_items
    FOR EACH ROW
    BEGIN
        DECLARE total DECIMAL(10,2);

        -- Calculate the total amount for the cart after an item is updated
        SELECT SUM(sub_total) 
        INTO total
        FROM cart_items
        WHERE cart_id = NEW.cart_id;

        -- Update the total_amount field in the carts table
        UPDATE carts
        SET total_amount = total
        WHERE id = NEW.cart_id;
    END;
');

// Trigger for AFTER DELETE
DB::unprepared('
    CREATE TRIGGER update_cart_total_after_delete
    AFTER DELETE ON cart_items
    FOR EACH ROW
    BEGIN
        DECLARE total DECIMAL(10,2);

        -- Calculate the total amount for the cart after an item is deleted
        SELECT SUM(sub_total) 
        INTO total
        FROM cart_items
        WHERE cart_id = OLD.cart_id;

        -- Update the total_amount field in the carts table
        UPDATE carts
        SET total_amount = total
        WHERE id = OLD.cart_id;
    END;
');
}


    public function down()
    {
        // Dropping the triggers if the migration is rolled back
        DB::unprepared('
            DROP TRIGGER IF EXISTS update_cart_total_after_insert;
            DROP TRIGGER IF EXISTS update_cart_total_after_update;
            DROP TRIGGER IF EXISTS update_cart_total_after_delete;
        ');
    }
}