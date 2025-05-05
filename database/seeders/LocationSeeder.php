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
        $locations = [
            [
                'user_id' => 1,
                'shop_id' => null,
                'latitude' => 13.1391,
                'longitude' => 123.7438,
                'region' => 'Region V',
                'city' => 'Legazpi City',
                'province' => 'Albay',
                'barangay' => 'Barangay 1',
                'street' => 'Rizal Street',
                'landmark' => 'Near Embarcadero',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'shop_id' => null,
                'latitude' => 13.2866,
                'longitude' => 123.6828,
                'region' => 'Region V',
                'city' => 'Tabaco City',
                'province' => 'Albay',
                'barangay' => 'Barangay 2',
                'street' => 'Quezon Avenue',
                'landmark' => 'Near Tabaco Port',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'shop_id' => null,
                'latitude' => 13.1974,
                'longitude' => 123.7104,
                'region' => 'Region V',
                'city' => 'Daraga',
                'province' => 'Albay',
                'barangay' => 'Barangay 3',
                'street' => 'Daraga Market Road',
                'landmark' => 'Near Cagsawa Ruins',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'shop_id' => null,
                'latitude' => 13.1922,
                'longitude' => 123.5240,
                'region' => 'Region V',
                'city' => 'Libon',
                'province' => 'Albay',
                'barangay' => 'Barangay 4',
                'street' => 'San Jose St.',
                'landmark' => 'Beside Municipal Hall',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'shop_id' => null,
                'latitude' => 13.3487,
                'longitude' => 123.6053,
                'region' => 'Region V',
                'city' => 'Tiwi',
                'province' => 'Albay',
                'barangay' => 'Barangay 5',
                'street' => 'Hot Spring Road',
                'landmark' => 'Near Tiwi Geothermal Plant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('locations')->insert($locations);
    }
}
