<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Shop;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Manually create 5 orders
       $orders = [
        [
            'user_id' => 1, // Assuming user with ID 1 exists
            'total_amount' => 500.00,
            'status' => 'Pending',
            'payment_method' => 'Online Banking',
            'delivery_address' => '123 Main St, Cityville',
            'date_arrangement' => '2025-05-01',
            'time_arrangement' => '10:00:00',
        ],
        [
            'user_id' => 2,
            'total_amount' => 200.00,
            'status' => 'Completed',
            'payment_method' => 'On-Pickup',
            'delivery_address' => '456 Oak Ave, Townsville',
            'date_arrangement' => '2025-05-02',
            'time_arrangement' => '12:00:00',
        ],
        [
            'user_id' => 3,
            'total_amount' => 150.00,
            'status' => 'Cancelled',
            'payment_method' => 'Online Banking',
            'delivery_address' => '789 Pine Rd, Villageville',
            'date_arrangement' => '2025-05-03',
            'time_arrangement' => '14:00:00',
        ],
        [
            'user_id' => 1,
            'total_amount' => 800.00,
            'status' => 'Out For Delivery',
            'payment_method' => 'On-Pickup',
            'delivery_address' => '123 Main St, Cityville',
            'date_arrangement' => '2025-05-04',
            'time_arrangement' => '16:00:00',
        ],
        [
            'user_id' => 2,
            'total_amount' => 1200.00,
            'status' => 'Completed',
            'payment_method' => 'Online Banking',
            'delivery_address' => '456 Oak Ave, Townsville',
            'date_arrangement' => '2025-05-05',
            'time_arrangement' => '18:00:00',
        ],
    ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
