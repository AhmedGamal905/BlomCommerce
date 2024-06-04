<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()->hasAttached(
            Product::factory()->count(3),
            ['quantity' => 10]
        )->create();
    }
}
