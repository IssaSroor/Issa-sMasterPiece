<?php

namespace Database\Factories;

use App\Models\Food_item;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order_item>
 */
class Order_itemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first()->id,  // Random order
            'item_id' => Food_item::inRandomOrder()->first()->id, // Random food item
            'quantity' => $this->faker->numberBetween(1, 5),     // Random quantity between 1 and 5
            'price' => $this->faker->randomFloat(2, 5, 50),       // Random price between 5 and 50
        ];
    }
}
