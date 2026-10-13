<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Raffle;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
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
            'customer_id' => fn (array $attributes) => Customer::factory()->state([
                'team_id' => Raffle::query()->withoutGlobalScopes()->findOrFail($attributes['raffle_id'])->team_id,
            ]),
            'number' => fake()->unique()->numerify('##'),
        ];
    }
}
