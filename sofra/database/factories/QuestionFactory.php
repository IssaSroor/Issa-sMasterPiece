<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_name' => $this->faker->name(),
            'client_email' => $this->faker->unique()->safeEmail(),
            'subject' => $this->faker->word(),
            'question' => $this->faker->sentence(),
            'resolved_by' => Admin::inRandomOrder()->first()->id ?? null, // Resolving by a random admin, or null if no admins
        ];
    }
}
