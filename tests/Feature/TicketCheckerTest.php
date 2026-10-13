<?php

namespace Tests\Feature;

use App\Enums\PaymentStatus;
use App\Livewire\TicketChecker;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Raffle;
use App\Models\Team;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Tests\TestCase;

class TicketCheckerTest extends TestCase
{
    use RefreshDatabase;

    protected Team $team;

    protected Raffle $raffle;

    protected Customer $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::factory()->create();
        $this->raffle = Raffle::factory()->create(['team_id' => $this->team->id]);
        $this->customer = Customer::factory()->create([
            'team_id' => $this->team->id,
            'dni' => '12345678',
            'name' => 'María',
            'lastname' => 'Pérez',
        ]);
    }

    public function test_it_lists_the_tickets_of_a_buyer_with_their_status(): void
    {
        $this->buy(['42'], PaymentStatus::Pending);
        $this->buy(['07'], PaymentStatus::Confirmed);

        $this->checker()
            ->set('dni', '12345678')
            ->call('check')
            ->assertHasNoErrors()
            ->assertSet('result.tickets', [
                ['number' => '07', 'confirmed' => true],
                ['number' => '42', 'confirmed' => false],
            ])
            ->assertSee(__('Confirmed'))
            ->assertSee(__('Awaiting confirmation'));
    }

    public function test_tickets_handed_out_without_a_payment_count_as_confirmed(): void
    {
        Ticket::factory()->create(['raffle_id' => $this->raffle->id, 'customer_id' => $this->customer->id, 'number' => '15']);

        $this->checker()
            ->set('dni', '12345678')
            ->call('check')
            ->assertSet('result.tickets', [['number' => '15', 'confirmed' => true]]);
    }

    public function test_it_accepts_the_id_however_it_is_typed(): void
    {
        $this->buy(['07'], PaymentStatus::Confirmed);

        $this->checker()
            ->set('dni', 'V-12.345.678')
            ->call('check')
            ->assertSet('dni', '12345678')
            ->assertSet('result.tickets', [['number' => '07', 'confirmed' => true]]);
    }

    public function test_it_shows_the_name_masked(): void
    {
        $this->buy(['07'], PaymentStatus::Confirmed);

        $this->checker()
            ->set('dni', '12345678')
            ->call('check')
            ->assertSet('result.name', 'M•••• P••••')
            ->assertDontSee('María')
            ->assertDontSee('Pérez');
    }

    public function test_it_says_when_an_id_has_no_tickets(): void
    {
        $this->checker()
            ->set('dni', '99999999')
            ->call('check')
            ->assertHasNoErrors()
            ->assertSet('result.tickets', [])
            ->assertSee(__('We found no tickets for this ID in this raffle.'));
    }

    public function test_it_ignores_tickets_from_other_raffles(): void
    {
        $other = Raffle::factory()->create(['team_id' => $this->team->id]);
        Ticket::factory()->create(['raffle_id' => $other->id, 'customer_id' => $this->customer->id, 'number' => '33']);

        $this->checker()
            ->set('dni', '12345678')
            ->call('check')
            ->assertSet('result.tickets', []);
    }

    public function test_it_ignores_buyers_of_other_organizers_with_the_same_id(): void
    {
        $foreignRaffle = Raffle::factory()->create();
        $foreignCustomer = Customer::factory()->create(['team_id' => $foreignRaffle->team_id, 'dni' => '55555555']);
        Ticket::factory()->create(['raffle_id' => $foreignRaffle->id, 'customer_id' => $foreignCustomer->id, 'number' => '33']);

        $this->checker()
            ->set('dni', '55555555')
            ->call('check')
            ->assertSet('result.tickets', []);
    }

    public function test_it_tells_the_buyer_about_rejected_payments(): void
    {
        $this->buy(['07'], PaymentStatus::Pending, reference: 'ABC12345')
            ->update(['status' => PaymentStatus::Rejected->value]);

        $this->checker()
            ->set('dni', '12345678')
            ->call('check')
            ->assertSet('result.tickets', [])
            ->assertSet('result.rejected', ['•••• 2345'])
            ->assertSee(__('The organizer rejected a payment you reported.'));
    }

    public function test_it_requires_a_valid_id(): void
    {
        $this->checker()->set('dni', '')->call('check')->assertHasErrors('dni');
        $this->checker()->set('dni', '12')->call('check')->assertHasErrors('dni');
        $this->checker()->set('dni', 'abcdefgh')->call('check')->assertHasErrors('dni');
    }

    public function test_lookups_are_throttled(): void
    {
        $checker = $this->checker()->set('dni', '12345678');

        foreach (range(1, TicketChecker::MAX_ATTEMPTS) as $attempt) {
            $checker->call('check')->assertHasNoErrors();
        }

        $checker->call('check')->assertHasErrors('dni');
    }

    protected function checker(): Testable
    {
        return Livewire::test(TicketChecker::class, ['raffle' => $this->raffle]);
    }

    /**
     * @param  list<string>  $numbers
     */
    protected function buy(array $numbers, PaymentStatus $status, ?string $reference = null): Payment
    {
        $payment = Payment::factory()->create([
            'raffle_id' => $this->raffle->id,
            'customer_id' => $this->customer->id,
            'status' => $status->value,
            ...($reference ? ['reference' => $reference] : []),
        ]);

        foreach ($numbers as $number) {
            Ticket::factory()->create([
                'raffle_id' => $this->raffle->id,
                'customer_id' => $this->customer->id,
                'payment_id' => $payment->id,
                'number' => $number,
            ]);
        }

        return $payment;
    }
}
