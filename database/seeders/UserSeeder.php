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
            'first_name' => 'DoughMain',
            'last_name' => 'Admin',
            'username' => 'doughmain_official',
            'email' => 'admin@doughmain.shop',
            'password' => bcrypt('admin123'),
            'phone_number' => '+639123456789',
            'profile_photo' => '1000071957-01.jpg',
            'role_id' => 3,
            'user_status_id' => 1,
            'nationality' => 'Filipino',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
    ];

    DB::table('users')->insert($users);
}

}
