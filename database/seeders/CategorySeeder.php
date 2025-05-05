<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // If you're using Carbon for date handling


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Breads',
                'description' => 'Freshly baked breads of all types.',
                'category_photo' => 'bread.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Pies & Tarts',
                'description' => 'Delicious pastries including croissants, danishes, and more.',
                'category_photo' => 'tart.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Cakes',
                'description' => 'Wide selection of cakes for all occasions.',
                'category_photo' => 'cake.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Cookies',
                'description' => 'Variety of cookies including chocolate chip, oatmeal, and more.',
                'category_photo' => 'kuki.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Cupcakes',
                'description' => 'Delicious cupcakes with a variety of flavors and frosting.',
                'category_photo' => 'cupcake.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
