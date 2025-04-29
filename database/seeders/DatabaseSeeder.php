<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Ensure necessary data is seeded in the right order
    $this->call([
        LocationSeeder::class,
        RoleSeeder::class,
        UserStatusSeeder::class,
        UserSeeder::class,
        CategorySeeder::class,
        ProductSeeder::class,            // Insert products first
        StockSeeder::class,              // Insert stock after products
        StockMovementSeeder::class,      // Insert stock movements after stock is in place
        OrderItemSeeder::class,
        OrderSeeder::class,
        ShopLogoSeeder::class,
        ShopSeeder::class
        
    ]);
}

}
