<?php

namespace Tests\Feature;

use App\Enums\SalesStatus;
use App\Models\Offer;
use App\Models\Raffle;
use App\Models\Team;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RaffleTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_generates_a_slug_from_the_title(): void
    {
        $raffle = Raffle::factory()->create(['title' => 'Fortuner 2012 Full Equipo']);

        $this->assertSame('fortuner-2012-full-equipo', $raffle->slug);
    }

    public function test_slugs_are_unique_within_a_team(): void
    {
        $team = Team::factory()->create();

        $first = Raffle::factory()->create(['team_id' => $team->id, 'title' => 'Moto Nueva']);
        $second = Raffle::factory()->create(['team_id' => $team->id, 'title' => 'Moto Nueva']);

        $this->assertSame('moto-nueva', $first->slug);
        $this->assertSame('moto-nueva-1', $second->slug);
    }

    public function test_two_teams_can_use_the_same_slug(): void
    {
        $first = Raffle::factory()->create(['title' => 'Moto Nueva']);
        $second = Raffle::factory()->create(['title' => 'Moto Nueva']);

        $this->assertSame($first->slug, $second->slug);
    }

    public function test_the_slug_stays_stable_when_the_title_changes(): void
    {
        $raffle = Raffle::factory()->create(['title' => 'Moto Nueva']);

        $raffle->update(['title' => 'Moto Usada']);

        $this->assertSame('moto-nueva', $raffle->refresh()->slug);
    }

    public function test_numbers_are_zero_padded_to_the_size_of_the_raffle(): void
    {
        $this->assertSame('07', Raffle::factory()->make(['ticket_amount' => 100])->formatNumber(7));
        $this->assertSame('007', Raffle::factory()->make(['ticket_amount' => 1000])->formatNumber(7));
        $this->assertSame('0007', Raffle::factory()->make(['ticket_amount' => 10000])->formatNumber(7));
        $this->assertSame('007', Raffle::factory()->make(['ticket_amount' => 500])->formatNumber(7));
        $this->assertSame('07', Raffle::factory()->make(['ticket_amount' => 10])->formatNumber(7));
    }

    public function test_it_knows_which_numbers_belong_to_the_raffle(): void
    {
        $raffle = Raffle::factory()->make(['ticket_amount' => 100]);

        $this->assertTrue($raffle->hasNumber('00'));
        $this->assertTrue($raffle->hasNumber('99'));
        $this->assertFalse($raffle->hasNumber('100'));
        $this->assertFalse($raffle->hasNumber('7'));
        $this->assertFalse($raffle->hasNumber('-1'));
        $this->assertFalse($raffle->hasNumber('ab'));
    }

    public function test_price_without_offers_is_the_ticket_price_times_the_quantity(): void
    {
        $raffle = Raffle::factory()->create(['ticket_price' => 1000]);

        $this->assertSame(0, $raffle->priceForQuantity(0));
        $this->assertSame(1000, $raffle->priceForQuantity(1));
        $this->assertSame(4000, $raffle->priceForQuantity(4));
    }

    public function test_price_applies_the_cheapest_combination_of_offers(): void
    {
        $raffle = Raffle::factory()->create(['ticket_price' => 1000]);
        Offer::factory()->create(['raffle_id' => $raffle->id, 'ticket_amount' => 3, 'price' => 2500]);
        Offer::factory()->create(['raffle_id' => $raffle->id, 'ticket_amount' => 10, 'price' => 7000]);

        $this->assertSame(2000, $raffle->priceForQuantity(2));
        $this->assertSame(2500, $raffle->priceForQuantity(3));
        $this->assertSame(3500, $raffle->priceForQuantity(4));
        $this->assertSame(5000, $raffle->priceForQuantity(6));
        $this->assertSame(7000, $raffle->priceForQuantity(10));
        $this->assertSame(9500, $raffle->priceForQuantity(13));
    }

    public function test_price_ignores_offers_without_a_valid_quantity(): void
    {
        $raffle = Raffle::factory()->create(['ticket_price' => 1000]);
        Offer::factory()->create(['raffle_id' => $raffle->id, 'ticket_amount' => 0, 'price' => 100]);

        $this->assertSame(2000, $raffle->priceForQuantity(2));
    }

    public function test_it_lists_taken_numbers_within_a_range(): void
    {
        $raffle = Raffle::factory()->create(['ticket_amount' => 1000]);
        foreach (['005', '099', '100', '250'] as $number) {
            Ticket::factory()->create(['raffle_id' => $raffle->id, 'number' => $number]);
        }

        $this->assertEqualsCanonicalizing(['005', '099'], $raffle->takenNumbersBetween(0, 99));
        $this->assertEqualsCanonicalizing(['100'], $raffle->takenNumbersBetween(100, 199));
    }

    public function test_random_numbers_are_available_and_skip_excluded_ones(): void
    {
        $raffle = Raffle::factory()->create(['ticket_amount' => 10]);
        foreach (['00', '01', '02', '03', '04', '05'] as $number) {
            Ticket::factory()->create(['raffle_id' => $raffle->id, 'number' => $number]);
        }

        $numbers = $raffle->randomAvailableNumbers(3, except: ['06']);

        $this->assertCount(3, $numbers);
        $this->assertEqualsCanonicalizing(['07', '08', '09'], $numbers);
    }

    public function test_random_numbers_never_exceed_what_is_left(): void
    {
        $raffle = Raffle::factory()->create(['ticket_amount' => 10]);
        foreach (['00', '01', '02', '03', '04', '05', '06', '07'] as $number) {
            Ticket::factory()->create(['raffle_id' => $raffle->id, 'number' => $number]);
        }

        $this->assertEqualsCanonicalizing(['08', '09'], $raffle->randomAvailableNumbers(5));
    }

    public function test_sold_percentage_counts_reserved_tickets(): void
    {
        $raffle = Raffle::factory()->create(['ticket_amount' => 10]);
        Ticket::factory()->create(['raffle_id' => $raffle->id, 'number' => '00']);
        Ticket::factory()->create(['raffle_id' => $raffle->id, 'number' => '01']);
        Ticket::factory()->create(['raffle_id' => $raffle->id, 'number' => '02']);

        $this->assertSame(7, $raffle->availableTicketsCount());
        $this->assertSame(30, $raffle->soldPercentage());
    }

    public function test_an_active_raffle_with_a_future_date_is_open_for_sales(): void
    {
        $raffle = Raffle::factory()->create();

        $this->assertSame(SalesStatus::Open, $raffle->salesStatus());
    }

    public function test_sales_close_once_the_draw_date_passes(): void
    {
        $raffle = Raffle::factory()->drawn()->create();

        $this->assertSame(SalesStatus::Closed, $raffle->salesStatus());
    }

    public function test_sales_close_when_every_number_is_taken(): void
    {
        $raffle = Raffle::factory()->create(['ticket_amount' => 2]);
        Ticket::factory()->create(['raffle_id' => $raffle->id, 'number' => '00']);
        Ticket::factory()->create(['raffle_id' => $raffle->id, 'number' => '01']);

        $this->assertSame(SalesStatus::SoldOut, $raffle->salesStatus());
    }

    public function test_finished_canceled_and_draft_raffles_are_not_for_sale(): void
    {
        $this->assertSame(SalesStatus::Finished, Raffle::factory()->finished()->create()->salesStatus());
        $this->assertSame(SalesStatus::Canceled, Raffle::factory()->canceled()->create()->salesStatus());
        $this->assertSame(SalesStatus::Unpublished, Raffle::factory()->pending()->create()->salesStatus());
    }
}
