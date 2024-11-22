<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Owner>
 */
class OwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_name' => $this->faker->name(),
            'owner_email' => $this->faker->unique()->safeEmail(),
            'owner_password' => bcrypt('password'), // You can use any default password here
            'owner_address' => $this->faker->address(),
        ];
    }
}
