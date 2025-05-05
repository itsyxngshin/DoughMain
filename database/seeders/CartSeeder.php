<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carts = [
        ['user_id' => '2',],
        ['user_id' => '5',],
        ['user_id' => '6',],
        ];
        
        DB::table('carts')->insert($carts);
    }
}
