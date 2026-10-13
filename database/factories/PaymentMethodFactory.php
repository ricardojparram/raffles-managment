<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PaymentMethod>
 */
class PaymentMethodFactory extends Factory
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
            'title' => 'Zelle',
            'description' => ['Correo' => fake()->safeEmail()],
            'currency' => 'USD',
            'icon' => 'payment-methods/zelle.png',
        ];
    }

    /**
     * Indicate that the method is paid in bolivars.
     */
    public function bolivars(): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => 'Pago Móvil',
            'description' => [
                'Banco' => 'Banco de Venezuela',
                'Cédula' => '12345678',
                'Teléfono' => '04121234567',
            ],
            'currency' => 'VED',
        ]);
    }
}
