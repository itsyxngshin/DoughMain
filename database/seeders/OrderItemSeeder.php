<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
         // Manually create 5 order items
         $orderItems = [
            [
                'order_id' => 1, // Assuming order with ID 1 exists
                'product_id' => 1, // Assuming product with ID 1 exists
                'quantity' => 2,
                'price' => 100.00,
                'subtotal' => 200.00,
            ],
            [
                'order_id' => 2,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 200.00,
                'subtotal' => 200.00,
            ],
            [
                'order_id' => 3,
                'product_id' => 3,
                'quantity' => 3,
                'price' => 50.00,
                'subtotal' => 150.00,
            ],
            [
                'order_id' => 4,
                'product_id' => 4,
                'quantity' => 4,
                'price' => 200.00,
                'subtotal' => 800.00,
            ],
            [
                'order_id' => 5,
                'product_id' => 5,
                'quantity' => 5,
                'price' => 240.00,
                'subtotal' => 1200.00,
            ],
        ];

        foreach ($orderItems as $item) {
            OrderItem::create($item);
        }
            */
    }
}
