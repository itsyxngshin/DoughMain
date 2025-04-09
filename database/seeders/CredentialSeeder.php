<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $credentials = [
            [
                'username' => 'its_yxngshinn',
                'email' => 'yxngshinn@gmail.com',
                'password' => bcrypt('adminShin'),
                'phone_number' => '09123456789',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'username' => 'itxme_elle',
                'email' => 'daniellerubis@example.com',
                'password' => bcrypt('adminElle'),
                'phone_number' => '09112223344',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'username' => 'jane_smith',
                'email' => 'jane.smith@example.com',
                'password' => bcrypt('securePass456'),
                'phone_number' => '09223334455',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'username' => 'michael_brown',
                'email' => 'michael.brown@example.com',
                'password' => bcrypt('mikeBrown789'),
                'phone_number' => '09334445566',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'username' => 'emily_white',
                'email' => 'emily.white@example.com',
                'password' => bcrypt('emilyWhite321'),
                'phone_number' => '09445556677',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],


        ];

        DB::table('credentials')->insert($credentials);
    }
}
