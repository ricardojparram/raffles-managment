<?php

namespace Tests\Feature;

use App\Enums\PaymentStatus;
use App\Livewire\TicketPurchase;
use App\Models\Customer;
use App\Models\Offer;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Raffle;
use App\Models\Team;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportLockedProperties\CannotUpdateLockedPropertyException;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Tests\TestCase;

class TicketPurchaseTest extends TestCase
{
    use RefreshDatabase;

    protected Team $team;

    protected Raffle $raffle;

    protected PaymentMethod $zelle;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
        Http::fake(['*' => Http::response(['promedio' => 800.0])]);

        $this->team = Team::factory()->create();
        $this->raffle = Raffle::factory()->create(['team_id' => $this->team->id, 'ticket_price' => 1000]);
        $this->zelle = PaymentMethod::factory()->create(['team_id' => $this->team->id]);
    }

    public function test_the_board_shows_the_first_page_and_marks_taken_numbers(): void
    {
        $this->take('07');

        $this->purchase()->assertViewHas('numbers', function (array $numbers): bool {
            return count($numbers) === 100
                && $numbers[0] === ['number' => '00', 'taken' => false]
                && $numbers[7] === ['number' => '07', 'taken' => true]
                && $numbers[99] === ['number' => '99', 'taken' => false];
        });
    }

    public function test_large_raffles_are_split_into_pages(): void
    {
        $this->raffle->update(['ticket_amount' => 250]);

        $this->purchase()
            ->assertViewHas('pageCount', 3)
            ->call('showPage', 2)
            ->assertViewHas('numbers', fn (array $numbers): bool => count($numbers) === 50
                && $numbers[0]['number'] === '200'
                && $numbers[49]['number'] === '249');
    }

    public function test_an_out_of_range_page_falls_back_to_the_nearest_one(): void
    {
        $this->raffle->update(['ticket_amount' => 250]);

        $this->purchase()
            ->call('showPage', 99)->assertSet('page', 2)
            ->call('showPage', -5)->assertSet('page', 0);
    }

    public function test_it_adds_random_numbers_that_are_still_available(): void
    {
        $this->raffle->update(['ticket_amount' => 10]);
        foreach (['00', '01', '02', '03', '04', '05', '06'] as $number) {
            $this->take($number);
        }

        $component = $this->purchase()->call('addRandom', 2);

        $selected = $component->get('selected');
        $this->assertCount(2, $selected);
        $this->assertSame([], array_diff($selected, ['07', '08', '09']));
    }

    public function test_random_numbers_do_not_repeat_the_current_selection(): void
    {
        $this->raffle->update(['ticket_amount' => 10]);

        $component = $this->purchase()->set('selected', ['00', '01', '02', '03', '04'])->call('addRandom', 5);

        $this->assertEqualsCanonicalizing(
            ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09'],
            $component->get('selected'),
        );
    }

    public function test_random_numbers_stop_at_the_purchase_limit(): void
    {
        $this->raffle->update(['ticket_amount' => 1000]);

        $component = $this->purchase()->call('addRandom', 500);

        $this->assertCount(Raffle::MAX_TICKETS_PER_PURCHASE, $component->get('selected'));
    }

    public function test_it_finds_a_number_and_selects_it(): void
    {
        $this->purchase()
            ->set('search', '7')
            ->call('findNumber')
            ->assertHasNoErrors()
            ->assertSet('selected', ['07'])
            ->assertSet('search', '');
    }

    public function test_finding_a_number_jumps_to_its_page(): void
    {
        $this->raffle->update(['ticket_amount' => 1000]);

        $this->purchase()
            ->set('search', '457')
            ->call('findNumber')
            ->assertSet('page', 4)
            ->assertSet('selected', ['457']);
    }

    public function test_finding_a_taken_number_says_so(): void
    {
        $this->take('07');

        $this->purchase()
            ->set('search', '07')
            ->call('findNumber')
            ->assertHasErrors('search')
            ->assertSet('selected', []);
    }

    public function test_finding_a_number_outside_the_raffle_says_so(): void
    {
        $this->purchase()
            ->set('search', '150')
            ->call('findNumber')
            ->assertHasErrors('search')
            ->assertSet('selected', []);
    }

    public function test_checkout_opens_the_payment_step(): void
    {
        $this->purchase()
            ->set('selected', ['07', '42'])
            ->call('checkout')
            ->assertHasNoErrors()
            ->assertSet('step', 'pay')
            ->assertSee('$20.00');
    }

    public function test_checkout_preselects_the_only_payment_method(): void
    {
        $this->purchase()
            ->set('selected', ['07'])
            ->call('checkout')
            ->assertSet('paymentMethodId', $this->zelle->id);
    }

    public function test_checkout_requires_the_minimum_tickets(): void
    {
        $this->raffle->update(['minimum_tickets' => 3]);

        $this->purchase()
            ->set('selected', ['07', '42'])
            ->call('checkout')
            ->assertHasErrors('selected')
            ->assertSet('step', 'pick');
    }

    public function test_checkout_drops_numbers_someone_else_took_meanwhile(): void
    {
        $component = $this->purchase()->set('selected', ['07', '42']);

        $this->take('07');

        $component->call('checkout')
            ->assertHasErrors('selected')
            ->assertSet('selected', ['42'])
            ->assertSet('step', 'pick');
    }

    public function test_checkout_discards_numbers_that_do_not_belong_to_the_raffle(): void
    {
        $this->purchase()
            ->set('selected', ['07', '999', 'abc', '07'])
            ->call('checkout')
            ->assertSet('selected', ['07'])
            ->assertSet('step', 'pay');
    }

    public function test_the_payment_step_applies_offers(): void
    {
        Offer::factory()->create(['raffle_id' => $this->raffle->id, 'ticket_amount' => 3, 'price' => 2500]);

        $this->purchase()
            ->set('selected', ['01', '02', '03'])
            ->call('checkout')
            ->assertSee('$25.00');
    }

    public function test_the_payment_step_quotes_bolivars_at_the_official_rate(): void
    {
        $pagoMovil = PaymentMethod::factory()->bolivars()->create(['team_id' => $this->team->id]);

        $this->purchase()
            ->set('selected', ['07', '42'])
            ->call('checkout')
            ->set('paymentMethodId', $pagoMovil->id)
            ->assertSee('Bs.16.000,00')
            ->assertSee('Banco de Venezuela');
    }

    public function test_without_a_rate_the_buyer_is_told_to_pay_the_equivalent(): void
    {
        config(['services.exchange_rate.url' => null]);
        $pagoMovil = PaymentMethod::factory()->bolivars()->create(['team_id' => $this->team->id]);

        $this->purchase()
            ->set('selected', ['07'])
            ->call('checkout')
            ->set('paymentMethodId', $pagoMovil->id)
            ->assertSee('$10.00')
            ->assertSee(__('Pay the equivalent in bolivars at the official BCV rate of the day.'));
    }

    public function test_the_buyer_can_go_back_to_the_board(): void
    {
        $this->purchase()
            ->set('selected', ['07'])
            ->call('checkout')
            ->call('backToNumbers')
            ->assertSet('step', 'pick')
            ->assertSet('selected', ['07']);
    }

    public function test_reporting_a_payment_requires_every_field(): void
    {
        PaymentMethod::factory()->create(['team_id' => $this->team->id]);

        $this->purchase()
            ->set('selected', ['07'])
            ->call('checkout')
            ->call('submit')
            ->assertHasErrors(['dni', 'name', 'lastname', 'phone', 'paymentMethodId', 'reference', 'proof', 'is_adult'])
            ->assertSet('step', 'pay');

        $this->assertSame(0, Payment::query()->count());
    }

    public function test_reporting_a_payment_requires_adult_confirmation(): void
    {
        $this->readyToPay()
            ->set('is_adult', false)
            ->call('submit')
            ->assertHasErrors(['is_adult']);
    }

    public function test_reporting_a_payment_rejects_malformed_data(): void
    {
        $this->readyToPay()
            ->set('dni', '12')
            ->set('name', 'M4ría')
            ->set('phone', '0212 555')
            ->set('reference', '12')
            ->set('proof', UploadedFile::fake()->create('capture.pdf', 100, 'application/pdf'))
            ->call('submit')
            ->assertHasErrors(['dni', 'name', 'phone', 'reference', 'proof']);
    }

    public function test_fields_are_not_judged_before_the_first_attempt(): void
    {
        $this->purchase()
            ->set('selected', ['07'])
            ->call('checkout')
            ->set('dni', '12')
            ->assertHasNoErrors('dni');
    }

    public function test_fixing_a_field_clears_its_error_right_away(): void
    {
        $this->purchase()
            ->set('selected', ['07'])
            ->call('checkout')
            ->call('submit')
            ->assertHasErrors(['dni', 'name'])
            ->set('dni', '12345678')
            ->assertHasNoErrors('dni')
            ->assertHasErrors('name');
    }

    public function test_a_field_that_is_still_wrong_keeps_its_error(): void
    {
        $this->purchase()
            ->set('selected', ['07'])
            ->call('checkout')
            ->call('submit')
            ->set('dni', '12')
            ->assertHasErrors('dni');
    }

    public function test_details_are_tidied_as_the_buyer_moves_on(): void
    {
        $this->purchase()
            ->set('selected', ['07'])
            ->call('checkout')
            ->set('dni', 'V-12.345.678')
            ->assertSet('dni', '12345678')
            ->set('name', ' maría josé ')
            ->assertSet('name', 'María José')
            ->set('reference', ' ab 123456 ')
            ->assertSet('reference', 'AB123456');
    }

    public function test_a_file_that_is_not_an_image_is_refused_as_soon_as_it_is_uploaded(): void
    {
        $this->purchase()
            ->set('selected', ['07'])
            ->call('checkout')
            ->set('proof', UploadedFile::fake()->create('capture.pdf', 100, 'application/pdf'))
            ->assertHasErrors('proof');
    }

    public function test_the_board_page_cannot_be_forced_from_the_browser(): void
    {
        $this->expectException(CannotUpdateLockedPropertyException::class);

        $this->purchase()->set('page', 5000);
    }

    public function test_the_board_marks_the_numbers_already_picked(): void
    {
        $this->purchase()
            ->set('selected', ['07'])
            ->call('showPage', 0)
            ->assertSeeHtml('data-number="07" aria-pressed="true"')
            ->assertSeeHtml('data-number="08" aria-pressed="false"');
    }

    public function test_reporting_a_payment_reserves_the_numbers(): void
    {
        $this->readyToPay(['07', '42'])
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('step', 'done')
            ->assertSee('07')
            ->assertSee('42');

        $payment = Payment::query()->sole();

        $this->assertSame(PaymentStatus::Pending->value, $payment->status);
        $this->assertSame(2000, $payment->amount);
        $this->assertSame($this->zelle->id, $payment->payment_method_id);
        $this->assertEqualsCanonicalizing(['07', '42'], $payment->tickets()->pluck('number')->all());
        Storage::disk('local')->assertExists($payment->img);
    }

    public function test_the_temporary_upload_is_discarded_once_the_proof_is_stored(): void
    {
        $component = $this->readyToPay();
        $temporary = $component->get('proof');

        $this->assertTrue($temporary->exists());

        $component->call('submit')->assertHasNoErrors();

        $this->assertFalse($temporary->exists());
        Storage::disk('local')->assertExists(Payment::query()->sole()->img);
    }

    public function test_removing_the_capture_discards_the_temporary_upload(): void
    {
        $component = $this->readyToPay();
        $temporary = $component->get('proof');

        $component->call('removeProof')->assertSet('proof', null);

        $this->assertFalse($temporary->exists());
    }

    public function test_reporting_a_payment_cleans_up_what_the_buyer_typed(): void
    {
        $this->readyToPay()
            ->set('dni', 'V-12.345.678')
            ->set('name', '  maría josé ')
            ->set('phone', '0412-123 45 67')
            ->set('reference', ' ab 123456 ')
            ->call('submit')
            ->assertHasNoErrors();

        $customer = Customer::query()->sole();

        $this->assertSame('12345678', $customer->dni);
        $this->assertSame('María José', $customer->name);
        $this->assertSame('+584121234567', $customer->phone);
        $this->assertSame('AB123456', Payment::query()->sole()->reference);
    }

    public function test_buyers_abroad_can_use_an_international_phone(): void
    {
        $this->readyToPay()
            ->set('phone', '+1 (305) 555-0199')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertSame('+13055550199', Customer::query()->sole()->phone);
    }

    public function test_reporting_a_payment_stores_the_rate_used_for_bolivars(): void
    {
        $pagoMovil = PaymentMethod::factory()->bolivars()->create(['team_id' => $this->team->id]);

        $this->readyToPay(['07', '42'])
            ->set('paymentMethodId', $pagoMovil->id)
            ->call('submit')
            ->assertHasNoErrors();

        $payment = Payment::query()->sole();

        $this->assertSame(1600000, $payment->amount);
        $this->assertSame('VED', $payment->currency);
        $this->assertEquals(800.0, $payment->exchange_rate);
    }

    public function test_a_number_taken_during_checkout_sends_the_buyer_back_to_the_board(): void
    {
        $component = $this->readyToPay(['07', '42']);

        $this->take('07');

        $component->call('submit')
            ->assertHasErrors('selected')
            ->assertSet('step', 'pick')
            ->assertSet('selected', ['42']);

        $this->assertSame(0, Payment::query()->count());
    }

    public function test_a_reference_reported_twice_is_refused(): void
    {
        $this->readyToPay(['07'])->call('submit')->assertHasNoErrors();

        $this->readyToPay(['42'])
            ->set('dni', '87654321')
            ->call('submit')
            ->assertHasErrors('reference')
            ->assertSet('step', 'pay');

        $this->assertSame(1, Payment::query()->count());
    }

    public function test_a_payment_method_of_another_organizer_is_refused(): void
    {
        $foreign = PaymentMethod::factory()->create();

        $this->readyToPay()
            ->set('paymentMethodId', $foreign->id)
            ->call('submit')
            ->assertHasErrors('paymentMethodId');

        $this->assertSame(0, Payment::query()->count());
    }

    public function test_too_many_reports_from_the_same_visitor_are_throttled(): void
    {
        $this->raffle->update(['ticket_amount' => 1000]);

        foreach (range(1, TicketPurchase::MAX_ATTEMPTS) as $attempt) {
            $this->readyToPay([$this->raffle->formatNumber($attempt)])
                ->set('reference', 'REF'.str_pad((string) $attempt, 6, '0', STR_PAD_LEFT))
                ->call('submit')
                ->assertHasNoErrors();
        }

        $this->readyToPay(['999'])
            ->set('reference', 'REF999999')
            ->call('submit')
            ->assertHasErrors('throttle');

        $this->assertSame(TicketPurchase::MAX_ATTEMPTS, Payment::query()->count());
    }

    public function test_finishing_clears_the_purchase_for_a_new_one(): void
    {
        $this->readyToPay(['07'])
            ->call('submit')
            ->call('finish')
            ->assertSet('step', 'pick')
            ->assertSet('selected', [])
            ->assertSet('reference', '')
            ->assertSet('dni', '12345678');
    }

    public function test_the_purchase_in_progress_survives_a_page_reload(): void
    {
        $this->purchase()
            ->set('selected', ['07', '42'])
            ->set('dni', '12345678')
            ->call('checkout');

        $this->purchase()
            ->assertSet('selected', ['07', '42'])
            ->assertSet('dni', '12345678')
            ->assertSet('step', 'pay');
    }

    public function test_a_reload_after_finishing_starts_clean(): void
    {
        $this->readyToPay(['07'])->call('submit')->assertSet('step', 'done');

        $this->purchase()
            ->assertSet('step', 'pick')
            ->assertSet('selected', []);
    }

    public function test_nothing_can_be_bought_once_sales_close(): void
    {
        $component = $this->readyToPay(['07']);

        $this->raffle->forceFill(['date' => now()->subMinute()])->save();

        $component->call('submit')->assertHasErrors('selected')->assertSet('step', 'pick');

        $this->assertSame(0, Payment::query()->count());
    }

    protected function purchase(): Testable
    {
        return Livewire::test(TicketPurchase::class, ['raffle' => $this->raffle->fresh()]);
    }

    /**
     * @param  list<string>  $numbers
     */
    protected function readyToPay(array $numbers = ['07']): Testable
    {
        return $this->purchase()
            ->call('finish')
            ->set('selected', $numbers)
            ->call('checkout')
            ->set('dni', '12345678')
            ->set('name', 'María')
            ->set('lastname', 'Pérez')
            ->set('phone', '0412 1234567')
            ->set('paymentMethodId', $this->zelle->id)
            ->set('reference', 'ABC12345')
            ->set('proof', UploadedFile::fake()->image('capture.jpg'))
            ->set('is_adult', true);
    }

    protected function take(string $number): Ticket
    {
        return Ticket::factory()->create(['raffle_id' => $this->raffle->id, 'number' => $number]);
    }
}
