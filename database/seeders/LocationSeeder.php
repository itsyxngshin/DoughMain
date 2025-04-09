<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            'user_id' => 0, // Replace with the appropriate user ID
            'shop_id' => 0, // Replace with the appropriate shop ID
            // Assuming you have a user and shop with ID 1 for testing
            'latitude' => 13.1394,
            'longitude' => 123.7438,
            'region' => 'Bicol Region',
            'city' => 'Legazpi City',
            'province' => 'Albay',
            'barangay' => 'Barangay 1', // Replace with the appropriate barangay
            'street' => 'Main Street', // Replace with the appropriate street or null
            'landmark' => 'Near City Hall', // Replace with the appropriate landmark or null
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
