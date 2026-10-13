<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Raffle;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Raffle>
 */
class RaffleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),
            'title' => fake()->unique()->sentence(3),
            'date' => now()->addWeek(),
            'img' => null,
            'currency' => 'USD',
            'ticket_price' => 1000,
            'description' => '<p>'.fake()->paragraph().'</p>',
            'status' => Status::Active->value,
            'ticket_amount' => 100,
            'minimum_tickets' => 1,
        ];
    }

    /**
     * Indicate that the raffle is still a draft.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Status::Pending->value,
        ]);
    }

    /**
     * Indicate that the raffle has already been drawn.
     */
    public function finished(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Status::Finished->value,
            'date' => now()->subDay(),
        ]);
    }

    /**
     * Indicate that the raffle was canceled.
     */
    public function canceled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Status::Canceled->value,
        ]);
    }

    /**
     * Indicate that the draw date has already passed.
     */
    public function drawn(): static
    {
        return $this->state(fn (array $attributes) => [
            'date' => now()->subHour(),
        ]);
    }
}
