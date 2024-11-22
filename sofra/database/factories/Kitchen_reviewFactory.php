<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Kitchen;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kitchen_review>
 */
class Kitchen_reviewFactory extends Factory
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
            'customer_id' => User::inRandomOrder()->first()->id, // Random customer
            'review_text' => $this->faker->sentence, // Random review text
            'review_rating' => $this->faker->numberBetween(1, 5), // Random rating from 1 to 5
            'accepted_by' => Admin::inRandomOrder()->first()->id ?? null, // Random admin, or null if no admin is assigned
            'review_status' => $this->faker->randomElement(['pending', 'approved', 'rejected']), // Random review status
        ];
    }
}
