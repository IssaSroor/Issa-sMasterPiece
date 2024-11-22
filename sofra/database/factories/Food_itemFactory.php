<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Kitchen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food_item>
 */
class Food_itemFactory extends Factory
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
            'category_id' => Category::inRandomOrder()->first()->id, // Random category
            'item_name' => $this->faker->word(),
            'item_image' => $this->faker->imageUrl(),
            'item_description' => $this->faker->sentence(),
            'item_price' => $this->faker->randomFloat(2, 5, 50),
            'item_discount' => $this->faker->randomFloat(2, 0, 50),
            'item_availability' => $this->faker->randomElement(['available', 'Out of stock']),
        ];
    }
}
