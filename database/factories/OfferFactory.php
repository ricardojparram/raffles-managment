<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\Raffle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Offer>
 */
class OfferFactory extends Factory
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
            'ticket_amount' => 3,
            'price' => 2500,
        ];
    }
}
