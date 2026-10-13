<?php

namespace Tests\Feature;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_method_in_the_same_currency_charges_the_total_as_is(): void
    {
        $method = PaymentMethod::factory()->make(['currency' => 'USD']);

        $this->assertSame(
            ['amount' => 2500, 'currency' => 'USD', 'exchange_rate' => null],
            $method->quoteFor(2500, 'USD', 876.7976),
        );
    }

    public function test_a_bolivar_method_converts_a_dollar_total_at_the_given_rate(): void
    {
        $method = PaymentMethod::factory()->bolivars()->make();

        $this->assertSame(
            ['amount' => 2191994, 'currency' => 'VED', 'exchange_rate' => 876.7976],
            $method->quoteFor(2500, 'USD', 876.7976),
        );
    }

    public function test_a_dollar_method_converts_a_bolivar_total_at_the_given_rate(): void
    {
        $method = PaymentMethod::factory()->make(['currency' => 'USD']);

        $this->assertSame(
            ['amount' => 1000, 'currency' => 'USD', 'exchange_rate' => 800.0],
            $method->quoteFor(800000, 'VED', 800.0),
        );
    }

    public function test_without_a_rate_the_total_stays_in_its_own_currency(): void
    {
        $method = PaymentMethod::factory()->bolivars()->make();

        $this->assertSame(
            ['amount' => 2500, 'currency' => 'USD', 'exchange_rate' => null],
            $method->quoteFor(2500, 'USD', null),
        );
    }
}
