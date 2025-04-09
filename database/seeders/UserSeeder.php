<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Adornado',
                'last_name' => 'Cabalbag',
                'credential_id' => '0',
                'profile_photo' => '1000071957-01.jpg',
                'role_id' => 0,
                'status_id' => 0,
                'location_id' => 0,
                'nationality' => 'Filipino',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                
            ],
        ];

        DB::table('users')->insert($users);
    }
}
