<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Kitchen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kitchen_category>
 */
class Kitchen_categoryFactory extends Factory
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
        ];
    }
}
