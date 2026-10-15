<?php

namespace Tests\Feature;

use App\Actions\SeedTeamPaymentMethods;
use App\Enums\PaymentMethodType;
use App\Filament\Resources\PaymentMethodResource;
use App\Filament\Resources\PaymentMethodResource\Pages\EditPaymentMethod;
use App\Filament\Resources\PaymentMethodResource\Pages\ListPaymentMethods;
use App\Livewire\TicketPurchase;
use App\Models\PaymentMethod;
use App\Models\Raffle;
use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class PaymentMethodConfigurationTest extends TestCase
{
    use RefreshDatabase;

    protected Team $team;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        Http::fake(['*' => Http::response(['promedio' => 800.0])]);

        $this->team = Team::factory()->create(['name' => 'Rifas Caracas']);
        $this->user = User::factory()->create();
        $this->user->teams()->attach($this->team, ['role' => 'owner']);

        $this->actingAs($this->user);
        Filament::setTenant($this->team);
    }

    public function test_seed_team_payment_methods_creates_all_four_venezuelan_methods(): void
    {
        $newTeam = Team::factory()->create(['name' => 'Inversiones Maracaibo']);

        (new SeedTeamPaymentMethods)->execute($newTeam, defaultActive: false);

        $methods = $newTeam->paymentMethods()->withoutGlobalScope('team')->get();

        $this->assertCount(4, $methods);
        $this->assertTrue($methods->contains(fn ($m) => $m->type === PaymentMethodType::PagoMovil && $m->currency === 'VED'));
        $this->assertTrue($methods->contains(fn ($m) => $m->type === PaymentMethodType::Transferencia && $m->currency === 'VED'));
        $this->assertTrue($methods->contains(fn ($m) => $m->type === PaymentMethodType::Binance && $m->currency === 'USD'));
        $this->assertTrue($methods->contains(fn ($m) => $m->type === PaymentMethodType::Zelle && $m->currency === 'USD'));
        $this->assertFalse($methods->first()->is_active);
    }

    public function test_payment_method_resource_can_list_records(): void
    {
        $method = PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'type' => PaymentMethodType::PagoMovil,
            'title' => 'Pago Móvil BDV',
            'currency' => 'VED',
            'is_active' => true,
        ]);

        Livewire::test(ListPaymentMethods::class)
            ->assertCanSeeTableRecords([$method])
            ->assertTableColumnStateSet('is_active', true, $method);
    }

    public function test_payment_methods_use_authentic_svg_icons_for_zelle_and_binance(): void
    {
        $this->assertSame('pay-zelle', PaymentMethodType::Zelle->getIcon());
        $this->assertSame('pay-binance', PaymentMethodType::Binance->getIcon());
        $this->assertSame('pay-pago-movil', PaymentMethodType::PagoMovil->getIcon());
        $this->assertSame('pay-transferencia', PaymentMethodType::Transferencia->getIcon());

        $this->assertFileExists(resource_path('svg/zelle.svg'));
        $this->assertFileExists(resource_path('svg/binance.svg'));
        $this->assertFileExists(resource_path('svg/pago-movil.svg'));
        $this->assertFileExists(resource_path('svg/transferencia.svg'));

        $zelle = PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'type' => PaymentMethodType::Zelle,
            'title' => 'Zelle',
            'currency' => 'USD',
            'is_active' => true,
        ]);

        $binance = PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'type' => PaymentMethodType::Binance,
            'title' => 'Binance Pay',
            'currency' => 'USD',
            'is_active' => true,
        ]);

        Livewire::test(ListPaymentMethods::class)
            ->assertCanSeeTableRecords([$zelle, $binance]);
    }

    public function test_organizers_cannot_create_or_delete_payment_methods(): void
    {
        $method = PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'type' => PaymentMethodType::PagoMovil,
            'title' => 'Pago Móvil BDV',
            'currency' => 'VED',
            'is_active' => true,
        ]);

        $this->assertFalse(PaymentMethodResource::canCreate());
        $this->assertFalse(PaymentMethodResource::canDelete($method));
        $this->assertFalse(Gate::forUser($this->user)->allows('create', PaymentMethod::class));
        $this->assertFalse(Gate::forUser($this->user)->allows('delete', $method));

        Livewire::test(ListPaymentMethods::class)
            ->assertActionDoesNotExist('create');

        Livewire::test(EditPaymentMethod::class, ['record' => $method->getRouteKey()])
            ->assertActionDoesNotExist('delete');
    }

    public function test_payment_method_edit_disallows_modifying_type_title_and_currency_and_saves_details_and_active(): void
    {
        $method = PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'type' => PaymentMethodType::PagoMovil,
            'title' => 'Pago Móvil',
            'currency' => 'VED',
            'is_active' => true,
            'description' => [
                'Banco' => 'Banco de Venezuela (0102)',
                'Teléfono' => '0412-0000000',
                'Cédula' => 'V-00000000',
            ],
        ]);

        Livewire::test(EditPaymentMethod::class, ['record' => $method->getRouteKey()])
            ->assertFormFieldIsDisabled('type')
            ->assertFormFieldIsDisabled('title')
            ->assertFormFieldIsDisabled('currency')
            ->fillForm([
                'is_active' => false,
                'description' => [
                    'Banco' => 'Banesco (0134)',
                    'Teléfono' => '0414-1234567',
                    'Cédula' => 'V-19876543',
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $method->refresh();
        $this->assertSame(PaymentMethodType::PagoMovil, $method->type);
        $this->assertSame('Pago Móvil', $method->title);
        $this->assertSame('VED', $method->currency);
        $this->assertFalse($method->is_active);
        $this->assertSame('Banesco (0134)', $method->description['Banco']);
        $this->assertSame('0414-1234567', $method->description['Teléfono']);
        $this->assertSame('V-19876543', $method->description['Cédula']);
    }

    public function test_payment_method_edit_supports_transferencia_and_binance_details(): void
    {
        $transferencia = PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'type' => PaymentMethodType::Transferencia,
            'title' => 'Transferencia Bancaria',
            'currency' => 'VED',
            'is_active' => true,
            'description' => [],
        ]);

        Livewire::test(EditPaymentMethod::class, ['record' => $transferencia->getRouteKey()])
            ->fillForm([
                'description' => [
                    'Banco' => 'Mercantil (0105)',
                    'Número de Cuenta' => '01050000000000000000',
                    'Cédula / RIF' => 'J-12345678-0',
                    'Titular' => 'Rifas Caracas C.A.',
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $transferencia->refresh();
        $this->assertSame('01050000000000000000', $transferencia->description['Número de Cuenta']);
        $this->assertSame('Mercantil (0105)', $transferencia->description['Banco']);

        $binance = PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'type' => PaymentMethodType::Binance,
            'title' => 'Binance Pay',
            'currency' => 'USD',
            'is_active' => true,
            'description' => [],
        ]);

        Livewire::test(EditPaymentMethod::class, ['record' => $binance->getRouteKey()])
            ->fillForm([
                'description' => [
                    'Pay ID' => '99887766',
                    'Usuario' => 'rifas_ccs',
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $binance->refresh();
        $this->assertEquals('99887766', $binance->description['Pay ID']);
        $this->assertSame('rifas_ccs', $binance->description['Usuario']);
    }

    public function test_payment_method_can_be_edited_and_toggled(): void
    {
        $method = PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'type' => PaymentMethodType::Zelle,
            'title' => 'Zelle Principal',
            'currency' => 'USD',
            'is_active' => true,
            'description' => [
                'Correo' => 'viejo@correo.com',
                'Titular' => 'Pedro Perez',
            ],
        ]);

        Livewire::test(EditPaymentMethod::class, ['record' => $method->getRouteKey()])
            ->fillForm([
                'is_active' => false,
                'description' => [
                    'Correo' => 'nuevo@zelle.com',
                    'Titular' => 'Rifas Caracas LLC',
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $method->refresh();
        $this->assertFalse($method->is_active);
        $this->assertSame('nuevo@zelle.com', $method->description['Correo']);
        $this->assertSame('Rifas Caracas LLC', $method->description['Titular']);
    }

    public function test_inactive_payment_methods_are_not_shown_on_public_raffle_page(): void
    {
        $raffle = Raffle::factory()->create(['team_id' => $this->team->id]);

        PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'title' => 'Pago Móvil Activo',
            'is_active' => true,
        ]);

        PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'title' => 'Zelle Desactivado',
            'is_active' => false,
        ]);

        $this->get($raffle->publicUrl())
            ->assertOk()
            ->assertSee('Pago Móvil Activo')
            ->assertDontSee('Zelle Desactivado');
    }

    public function test_inactive_payment_methods_are_not_available_in_ticket_purchase(): void
    {
        $raffle = Raffle::factory()->create(['team_id' => $this->team->id, 'ticket_price' => 1000]);

        $active = PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'title' => 'Método Activo',
            'is_active' => true,
        ]);

        $inactive = PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'title' => 'Método Inactivo',
            'is_active' => false,
        ]);

        $component = Livewire::test(TicketPurchase::class, ['raffle' => $raffle]);
        $methods = $component->instance()->paymentMethods();

        $this->assertTrue($methods->contains('id', $active->id));
        $this->assertFalse($methods->contains('id', $inactive->id));
    }

    public function test_raffle_to_share_text_formats_complete_details_for_whatsapp(): void
    {
        $raffle = Raffle::factory()->create([
            'team_id' => $this->team->id,
            'title' => 'Toyota Hilux 2024',
            'conalot_permit' => 'CONALOT-2026-999',
            'ticket_price' => 1000,
            'currency' => 'USD',
            'date' => now()->addDays(5)->setTime(20, 0),
        ]);

        PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'type' => PaymentMethodType::PagoMovil,
            'title' => 'Pago Móvil BDV',
            'currency' => 'VED',
            'is_active' => true,
            'description' => [
                'Banco' => 'Banco de Venezuela (0102)',
                'Teléfono' => '0412-1112233',
                'Cédula' => 'V-20111222',
            ],
        ]);

        $text = $raffle->toShareText();

        $this->assertStringContainsString('Toyota Hilux 2024', $text);
        $this->assertStringContainsString('Rifas Caracas', $text);
        $this->assertStringContainsString('CONALOT-2026-999', $text);
        $this->assertStringContainsString('$10.00', $text);
        $this->assertStringContainsString('Pago Móvil BDV (Bs.)', $text);
        $this->assertStringContainsString('Banco de Venezuela (0102)', $text);
        $this->assertStringContainsString('0412-1112233', $text);
        $this->assertStringContainsString($raffle->publicUrl(), $text);
    }

    public function test_public_raffle_page_renders_share_modal_with_qr_and_social_links(): void
    {
        $raffle = Raffle::factory()->create(['team_id' => $this->team->id, 'title' => 'Moto Bera']);

        $response = $this->get($raffle->publicUrl());

        $response
            ->assertOk()
            ->assertDontSee(__('Copiar datos'))
            ->assertSee('x-on:click="shareModalOpen = true"', false)
            ->assertSee(__('Compartir rifa'))
            ->assertSee('data:image/svg+xml;base64,', false)
            ->assertSee('WhatsApp')
            ->assertSee('Telegram')
            ->assertSee('Facebook')
            ->assertSee(__('Copiar texto completo para WhatsApp'));
    }

    public function test_payment_method_bank_key_detects_venezuelan_banks(): void
    {
        $bdv = PaymentMethod::factory()->make([
            'title' => 'Pago Móvil BDV',
            'description' => ['Banco' => 'Banco de Venezuela (0102)'],
        ]);
        $this->assertSame('bdv', $bdv->bankKey());

        $banesco = PaymentMethod::factory()->make([
            'title' => 'Transferencia Banesco',
            'description' => ['Banco' => 'Banesco (0134)'],
        ]);
        $this->assertSame('banesco', $banesco->bankKey());

        $mercantil = PaymentMethod::factory()->make([
            'title' => 'Pago Móvil Mercantil',
            'description' => ['Banco' => '0105 - Banco Mercantil'],
        ]);
        $this->assertSame('mercantil', $mercantil->bankKey());

        $provincial = PaymentMethod::factory()->make([
            'title' => 'Provincial',
            'description' => ['Banco' => 'BBVA Provincial (0108)'],
        ]);
        $this->assertSame('provincial', $provincial->bankKey());

        $bancamiga = PaymentMethod::factory()->make([
            'title' => 'Bancamiga Móvil',
            'description' => ['Banco' => 'Bancamiga (0172)'],
        ]);
        $this->assertSame('bancamiga', $bancamiga->bankKey());

        $bnc = PaymentMethod::factory()->make([
            'title' => 'Cuenta BNC',
            'description' => ['Banco' => 'Banco Nacional de Crédito BNC (0191)'],
        ]);
        $this->assertSame('bnc', $bnc->bankKey());

        $zelle = PaymentMethod::factory()->make([
            'type' => PaymentMethodType::Zelle,
            'title' => 'Zelle',
            'description' => ['Correo' => 'zelle@empresa.com'],
        ]);
        $this->assertNull($zelle->bankKey());
    }

    public function test_payment_method_clipboard_payload_formats_structured_string_for_banking_apps(): void
    {
        $pagoMovil = PaymentMethod::factory()->make([
            'type' => PaymentMethodType::PagoMovil,
            'title' => 'Pago Móvil BDV',
            'currency' => 'VED',
            'description' => [
                'Banco' => 'Banco de Venezuela (0102)',
                'Teléfono' => '0412 1234567',
                'Cédula' => 'V-12345678',
            ],
        ]);

        $payload = $pagoMovil->clipboardPayload('150.00');

        $this->assertStringContainsString('Banco: Banco de Venezuela (0102)', $payload);
        $this->assertStringContainsString('Teléfono: 0412 1234567', $payload);
        $this->assertStringContainsString('Cédula: V-12345678', $payload);
        $this->assertStringContainsString('Monto: 150.00', $payload);
    }

    public function test_ticket_purchase_checkout_renders_copy_all_data_button_and_native_icons(): void
    {
        $raffle = Raffle::factory()->create([
            'team_id' => $this->team->id,
            'ticket_price' => 1000,
            'currency' => 'VED',
            'ticket_amount' => 100,
        ]);

        $method = PaymentMethod::factory()->create([
            'team_id' => $this->team->id,
            'type' => PaymentMethodType::PagoMovil,
            'title' => 'Pago Móvil BDV',
            'currency' => 'VED',
            'is_active' => true,
            'description' => [
                'Banco' => 'Banco de Venezuela (0102)',
                'Teléfono' => '0412 9998877',
                'Cédula' => 'V-30111222',
            ],
        ]);

        Livewire::test(TicketPurchase::class, ['raffle' => $raffle])
            ->set('selected', ['00'])
            ->call('checkout')
            ->assertSee(__('Copiar todos los datos'))
            ->assertSee(__('Copiar monto'))
            ->assertSee('BDV')
            ->assertSee('0412 9998877');
    }
}
