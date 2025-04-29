<?php

namespace Database\Seeders;

// database/seeders/ProductSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
   
    public function run(): void
{
    $now = Carbon::now();

    DB::table('products')->insert([
        [
            'id' => 1,
            'product_name' => 'Bread',
            'product_price' => 50,
            'category_id' => 1,
            'shop_id' => 1,  // Add shop_id here
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'id' => 2,
            'product_name' => 'Cake',
            'product_price' => 100,
            'category_id' => 2,
            'shop_id' => 2,  // Add shop_id here
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'id' => 3,
            'product_name' => 'Cookies',
            'product_price' => 30,
            'category_id' => 3,
            'shop_id' => 3,  // Add shop_id here
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'id' => 4,
            'product_name' => 'Donut',
            'product_price' => 25,
            'category_id' => 4,
            'shop_id' => 4,  // Add shop_id here
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'id' => 5,
            'product_name' => 'Brownies',
            'product_price' => 45,
            'category_id' => 5,
            'shop_id' => 5,  // Add shop_id here
            'created_at' => $now,
            'updated_at' => $now,
        ],
    ]);
}


}
