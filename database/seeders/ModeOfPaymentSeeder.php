<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeOfPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mode_of_payments')->insert([
            ['payment_method' => 'GCash', 
            'description' => 'Pay via G-Exchange for your orders'],

            ['payment_method' => 'Maya', 
            'description' => 'Pay via Maya for your orders'],

            ['payment_method' => 'Cash on Delivery', 
            'description' => 'You can now pay upon delivery through the web'],

            ['payment_method' => 'Cash on Pick-Up', 
            'description' => 'You can now pay upon pick-up through the web'],

            
        ]);
    }
}
