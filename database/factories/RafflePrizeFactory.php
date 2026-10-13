<?php

namespace Database\Factories;

use App\Models\Raffle;
use App\Models\RafflePrize;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RafflePrize>
 */
class RafflePrizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'raffle_id' => Raffle::factory(),
            'title' => '$'.fake()->numberBetween(1, 10).'00',
            'img' => null,
            'date' => now()->addDays(3),
        ];
    }
}
