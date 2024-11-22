<?php

namespace Database\Factories;

use App\Models\Kitchen;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => User::inRandomOrder()->first()->id, // Random customer
            'kitchen_id' => Kitchen::inRandomOrder()->first()->id, // Random kitchen
            'message_subject' => $this->faker->sentence, // Random message subject
            'message_text' => $this->faker->sentence, // Random message text
        ];
    }
}
