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
            'username' => 'its_yxngshinn',
            'email' => 'yxngshinn@gmail.com',
            'password' => bcrypt('adminShin'),
            'phone_number' => '+639123456789',
            'profile_photo' => '1000071957-01.jpg',
            'role_id' => 2,
            'status_id' => 0,
            'location_id' => 0,
            'nationality' => 'Filipino',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'username' => 'janedoe123',
            'email' => 'jane.doe@example.com',
            'password' => bcrypt('password123'),
            'phone_number' => '+639876543210',
            'profile_photo' => 'profile_photo_01.jpg',
            'role_id' => 1,
            'status_id' => 1,
            'location_id' => 1,
            'nationality' => 'Filipino',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'first_name' => 'John',
            'last_name' => 'Smith',
            'username' => 'johnsmith456',
            'email' => 'john.smith@example.com',
            'password' => bcrypt('password456'),
            'phone_number' => '+639345678901',
            'profile_photo' => 'profile_photo_02.jpg',
            'role_id' => 3,
            'status_id' => 0,
            'location_id' => 2,
            'nationality' => 'American',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'first_name' => 'Emily',
            'last_name' => 'Brown',
            'username' => 'emilybrown789',
            'email' => 'emily.brown@example.com',
            'password' => bcrypt('password789'),
            'phone_number' => '+639543210987',
            'profile_photo' => 'profile_photo_03.jpg',
            'role_id' => 2,
            'status_id' => 1,
            'location_id' => 3,
            'nationality' => 'Canadian',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'first_name' => 'Michael',
            'last_name' => 'Clark',
            'username' => 'michaelclark321',
            'email' => 'michael.clark@example.com',
            'password' => bcrypt('password321'),
            'phone_number' => '+639765432109',
            'profile_photo' => 'profile_photo_04.jpg',
            'role_id' => 1,
            'status_id' => 0,
            'location_id' => 4,
            'nationality' => 'Australian',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
    ];

    DB::table('users')->insert($users);
}

}
