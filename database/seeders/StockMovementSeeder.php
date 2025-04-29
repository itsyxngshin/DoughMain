<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StockMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stockMovements = [
            [
                'product_id' => 1, // Refer to a valid product ID from your database
                'quantity' => 50,
                'movement_type' => 'in', // Product stock added
                'remarks' => 'Stock Restock',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 2, // Refer to a valid product ID from your database
                'quantity' => 30,
                'movement_type' => 'out', // Product stock removed
                'remarks' => 'Customer Purchase',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 3, // Refer to a valid product ID from your database
                'quantity' => 20,
                'movement_type' => 'in', // Product stock added
                'remarks' => 'Stock Restock',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 4, // Refer to a valid product ID from your database
                'quantity' => 15,
                'movement_type' => 'out', // Product stock removed
                'remarks' => 'Stock Defect',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 5, // Refer to a valid product ID from your database
                'quantity' => 100,
                'movement_type' => 'in', // Product stock added
                'remarks' => 'Stock Restock',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('stock_movements')->insert($stockMovements);
    }
}
