<?php

namespace Tests\Feature;

use App\Models\Raffle;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicTeamPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_the_raffles_an_organizer_has_on_sale(): void
    {
        $team = Team::factory()->create(['name' => 'Rifas El Chamo']);
        $raffle = Raffle::factory()->create(['team_id' => $team->id, 'title' => 'Fortuner 2012']);

        $this->get('/r/rifas-el-chamo')
            ->assertOk()
            ->assertSee('Rifas El Chamo')
            ->assertSee('Fortuner 2012')
            ->assertSee($raffle->publicUrl());
    }

    public function test_it_hides_raffles_that_are_still_drafts(): void
    {
        $team = Team::factory()->create();
        Raffle::factory()->pending()->create(['team_id' => $team->id, 'title' => 'Rifa Secreta']);

        $this->get("/r/{$team->slug}")->assertOk()->assertDontSee('Rifa Secreta');
    }

    public function test_it_does_not_show_raffles_from_other_organizers(): void
    {
        $team = Team::factory()->create();
        Raffle::factory()->create(['title' => 'Rifa Ajena']);

        $this->get("/r/{$team->slug}")->assertOk()->assertDontSee('Rifa Ajena');
    }

    public function test_it_keeps_past_raffles_visible_below_the_ones_on_sale(): void
    {
        $team = Team::factory()->create();
        Raffle::factory()->finished()->create(['team_id' => $team->id, 'title' => 'Rifa Vieja']);
        Raffle::factory()->create(['team_id' => $team->id, 'title' => 'Rifa Nueva']);

        $this->get("/r/{$team->slug}")
            ->assertOk()
            ->assertSeeInOrder(['Rifa Nueva', 'Rifa Vieja']);
    }

    public function test_it_tells_visitors_when_there_is_nothing_on_sale(): void
    {
        $team = Team::factory()->create();

        $this->get("/r/{$team->slug}")->assertOk()->assertSee(__('No raffles on sale right now'));
    }

    public function test_an_unknown_organizer_is_not_found(): void
    {
        $this->get('/r/nobody')->assertNotFound();
    }
}
