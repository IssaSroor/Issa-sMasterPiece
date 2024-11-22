<?php

namespace Database\Factories;

use App\Models\Food_item;
use App\Models\Kitchen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kitchen_food_item>
 */
class Kitchen_food_itemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kitchen_id' => Kitchen::inRandomOrder()->first()->id, // Random kitchen
            'item_id' => Food_item::inRandomOrder()->first()->id,  // Random food item
        ];
    }
}
