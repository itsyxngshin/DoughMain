<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['role_name' => 'user', 'description' => 'Regular user with limited access', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'seller', 'description' => 'User with permissions to sell products', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'admin', 'description' => 'Administrator with full access', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
