<?php

namespace Tests\Feature;

use App\Filament\Resources\PaymentResource\Pages\EditPayment;
use App\Filament\Resources\PaymentResource\Pages\ListPayments;
use App\Models\Payment;
use App\Models\Raffle;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    public function test_the_list_shows_the_numbers_reserved_by_each_payment(): void
    {
        $payment = $this->createPayment();
        foreach (['07', '42'] as $number) {
            Ticket::factory()->create([
                'raffle_id' => $payment->raffle_id,
                'customer_id' => $payment->customer_id,
                'payment_id' => $payment->id,
                'number' => $number,
            ]);
        }

        Livewire::test(ListPayments::class)
            ->assertCanSeeTableRecords([$payment])
            ->assertTableColumnStateSet('tickets.number', ['07', '42'], $payment);
    }

    public function test_a_new_proof_image_stays_on_the_private_disk(): void
    {
        Storage::fake('public');
        Storage::fake('local');
        $payment = $this->createPayment();

        Livewire::test(EditPayment::class, ['record' => $payment->getRouteKey()])
            ->fillForm(['img' => [UploadedFile::fake()->image('capture.jpg')]])
            ->call('save')
            ->assertHasNoFormErrors();

        $path = $payment->refresh()->img;

        Storage::disk('local')->assertExists($path);
        Storage::disk('public')->assertMissing($path);
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
