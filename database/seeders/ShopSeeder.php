<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $shops = [
            [
                'manage_id' => 1,
                'shop_name' => 'Bakery Delight',
                'shop_description' => 'A shop offering fresh and delicious bakery products.',
                'shop_logo_id' => 1,
                'shop_address_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'manage_id' => 2,
                'shop_name' => 'The Cake Factory',
                'shop_description' => 'Where every cake is made with love and perfection.',
                'shop_logo_id' => 2,
                'shop_address_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'manage_id' => 3,
                'shop_name' => 'Pastry Paradise',
                'shop_description' => 'Delightful pastries for every occasion.',
                'shop_logo_id' => 3,
                'shop_address_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'manage_id' => 4,
                'shop_name' => 'Cupcake Heaven',
                'shop_description' => 'A cupcake shop offering unique and flavorful cupcakes.',
                'shop_logo_id' => 4,
                'shop_address_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'manage_id' => 5,
                'shop_name' => 'Bread Basket',
                'shop_description' => 'Serving the freshest bread and baked goods daily.',
                'shop_logo_id' => 5,
                'shop_address_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('shops')->insert($shops);
    }
}

