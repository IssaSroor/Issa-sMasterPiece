<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Kitchen;
use App\Models\User;
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
            'kitchen_id' => Kitchen::inRandomOrder()->first()->id,  // Random kitchen
            'customer_id' => User::inRandomOrder()->first()->id,    // Random customer
            'managed_by' => Admin::inRandomOrder()->first()->id,    // Random admin
            'order_address' => $this->faker->address,
            'order_total_amount' => $this->faker->randomFloat(2, 10, 100),  // Random total amount
            'order_status' => $this->faker->randomElement(['confirmed', 'prepared', 'on delivery']),
            'order_payment_status' => $this->faker->randomElement(['paid', 'unpaid']),
        ];
    }
}
