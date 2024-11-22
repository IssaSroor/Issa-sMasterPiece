<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kitchen>
 */
class KitchenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => Owner::inRandomOrder()->first()->id, // Assigning a random owner
            'kitchen_name' => $this->faker->company,
            'kitchen_short_desc' => $this->faker->sentence,
            'kitchen_description' => $this->faker->sentence,
            'kitchen_phone' => $this->faker->phoneNumber,
            'kitchen_address' => $this->faker->address,
            'kitchen_image' => $this->faker->imageUrl(640, 480, 'food'), // Random image URL for kitchen image
            'free_delivery' => $this->faker->boolean, // Random true or false for free delivery
            'time_for_delivery' => $this->faker->numberBetween(15, 60), // Random delivery time between 15 and 60 minutes
            'kitchen_status' => $this->faker->randomElement(['opened', 'closed', 'busy']),
            'kitchen_state' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'kitchen_rating' => $this->faker->numberBetween(1, 5), // Random rating from 1 to 5
            'accepted_by' => Admin::inRandomOrder()->first()->id ?? null, // Random admin, or null if no admin is assigned
        ];
    }
}
