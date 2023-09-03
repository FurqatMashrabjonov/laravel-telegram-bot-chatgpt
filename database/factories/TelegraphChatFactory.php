<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TelegraphChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chat_id' => (string)rand(1000000000, 9999999999),
            'name' => $this->faker->name,
            'telegraph_bot_id' => 1,
            'from' => null,
            'created_at' => $this->faker->dateTimeBetween(now()->subDays(240), now()),
        ];
    }
}
