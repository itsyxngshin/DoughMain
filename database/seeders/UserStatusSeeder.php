<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_statuses')->insert([
            ['name' => 'Active', 'description' => 'User is active and can access the system'],
            ['name' => 'Inactive', 'description' => 'User is inactive and cannot access the system'],
            ['name' => 'Suspended', 'description' => 'User is temporarily suspended from accessing the system'],
        ]);
    }
}
