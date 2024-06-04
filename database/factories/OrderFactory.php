<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'email' => $this->faker->email,
            'name' => $this->faker->name,
            'building_number' => $this->faker->buildingNumber,
            'street_name' => $this->faker->streetName,
            'city' => $this->faker->city,
            'postcode' => $this->faker->postcode,
            'phone' => $this->faker->phoneNumber,
            'total' => $this->faker->randomFloat(2, 0, 1000),
            'payment_gateway' => 'cash',
            'status' => OrderStatus::PROCESSING,
        ];
    }
}
