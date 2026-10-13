<?php

namespace Tests\Feature;

use App\Filament\Pages\Auth\Register;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Revoltify\Subscriptionify\Models\Plan;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Ensure roles exist for test
        \App\Models\Role::create(['name' => 'super_admin']);
        \App\Models\Role::create(['name' => 'admin']);
        \App\Models\Role::create(['name' => 'seller']);
        
        // Ensure there is a free plan for registration
        Plan::create([
            'name' => 'Free Plan',
            'slug' => 'free',
            'price' => 0.00,
            'signup_fee' => 0.00,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'is_active' => true,
        ]);
    }

    public function test_can_render_register_page(): void
    {
        $this->get('/admin/register')->assertSuccessful();
    }

    public function test_can_register_as_individual(): void
    {
        Livewire::test(Register::class)
            ->fillForm([
                'team_type' => 'individual',
                'name' => 'Ricardo Parra',
                'email' => 'ricardo@example.com',
                'country' => 'VE',
                'password' => 'password123',
                'passwordConfirmation' => 'password123',
            ])
            ->call('register')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('users', [
            'email' => 'ricardo@example.com',
        ]);

        $this->assertDatabaseHas('teams', [
            'name' => 'Ricardo Parra',
            'type' => 'individual',
            'country' => 'VE',
        ]);
        
        $user = User::where('email', 'ricardo@example.com')->first();
        $this->assertTrue($user->hasRole('admin'));
    }

    public function test_can_register_as_organization(): void
    {
        Livewire::test(Register::class)
            ->fillForm([
                'team_type' => 'organization',
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'country' => 'VE',
                'password' => 'password123',
                'passwordConfirmation' => 'password123',
                'team_name' => 'My Awesome Corp',
            ])
            ->call('register')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);

        $this->assertDatabaseHas('teams', [
            'name' => 'My Awesome Corp',
            'type' => 'organization',
            'country' => 'VE',
        ]);
    }
}
