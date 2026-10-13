<?php

namespace Tests\Feature;

use App\Filament\Resources\PaymentResource\Pages\EditPayment;
use App\Models\Payment;
use App\Models\Raffle;
use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PaymentResourceTest extends TestCase
{
    use RefreshDatabase;

    protected Team $team;

    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::factory()->create();
        $user = User::factory()->create();
        $user->teams()->attach($this->team, ['role' => 'admin']);

        $this->actingAs($user);
        Filament::setTenant($this->team);
    }

    public function test_edit_form_shows_the_amount_in_major_units(): void
    {
        $payment = $this->createPayment(['amount' => 2550]);

        Livewire::test(EditPayment::class, ['record' => $payment->getRouteKey()])
            ->assertSchemaStateSet(['amount' => '25.50']);
    }

    public function test_saving_the_form_stores_the_amount_in_cents(): void
    {
        $payment = $this->createPayment(['amount' => 1000]);

        Livewire::test(EditPayment::class, ['record' => $payment->getRouteKey()])
            ->fillForm(['amount' => '30.00'])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame(3000, $payment->refresh()->amount);
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    protected function createPayment(array $attributes = []): Payment
    {
        $raffle = Raffle::factory()->create(['team_id' => $this->team->id]);

        return Payment::factory()->create([
            'raffle_id' => $raffle->id,
            ...$attributes,
        ]);
    }
}
