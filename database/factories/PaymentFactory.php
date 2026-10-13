<?php

namespace Database\Factories;

use App\Enums\PaymentStatus;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Raffle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
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
            'team_id' => fn (array $attributes) => Raffle::query()->withoutGlobalScopes()->findOrFail($attributes['raffle_id'])->team_id,
            'customer_id' => fn (array $attributes) => Customer::factory()->state(['team_id' => $attributes['team_id']]),
            'payment_method_id' => fn (array $attributes) => PaymentMethod::factory()->state(['team_id' => $attributes['team_id']]),
            'amount' => 1000,
            'currency' => 'USD',
            'status' => PaymentStatus::Pending->value,
            'payment_date' => now(),
            'reference' => (string) fake()->unique()->numerify('########'),
            'img' => null,
        ];
    }

    /**
     * Indicate that the organizer confirmed the payment.
     */
    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PaymentStatus::Confirmed->value,
        ]);
    }
}
