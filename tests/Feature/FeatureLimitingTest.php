<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use App\Models\Raffle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FeatureLimitingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed the plans so that when we register a team, we have features
        $this->artisan('db:seed', ['--class' => 'PlanSeeder']);
    }

    public function test_individual_user_cannot_create_more_than_three_raffles(): void
    {
        $user = User::factory()->create();
        $team = Team::create([
            'name' => $user->name,
            'type' => 'individual',
            'country' => 'VE',
        ]);
        $user->teams()->attach($team, ['role' => 'admin']);
        $freePlan = \Revoltify\Subscriptionify\Models\Plan::where('slug', 'free')->first();
        $team->subscribe($freePlan); // Subscribe to free plan (has 3 raffles)

        $this->actingAs($user);
        
        // Assert can create initially
        $this->assertTrue($team->canConsume('raffles_created'));

        // Consume 3 raffles
        for ($i = 0; $i < 3; $i++) {
            $raffle = Raffle::create([
                'team_id' => $team->id,
                'title' => 'Raffle ' . $i,
                'description' => 'Test',
                'ticket_price' => 10,
                'date' => now()->addDays(10),
            ]);
            // Force Observer trigger because we are testing Model events directly.
            // When creating via UI or factory, observers run normally.
        }

        // Now they should not be able to create a 4th
        $team->refresh();
        $this->assertFalse($team->canConsume('raffles_created'));
    }
}
