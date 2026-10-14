<?php

namespace App\Actions;

use App\Enums\PaymentMethodType;
use App\Models\PaymentMethod;
use App\Models\Team;

class SeedTeamPaymentMethods
{
    /**
     * Seeds the standard Venezuelan payment methods for a team.
     *
     * @param  array<string, array<string, string>>  $customDetails
     */
    public function execute(Team $team, bool $defaultActive = false, array $customDetails = []): void
    {
        $definitions = [
            PaymentMethodType::PagoMovil->value => [
                'type' => PaymentMethodType::PagoMovil,
                'title' => 'Pago Móvil',
                'currency' => 'VED',
                'description' => $customDetails['pago_movil'] ?? [
                    'Banco' => 'Banco de Venezuela (0102)',
                    'Teléfono' => '0412-0000000',
                    'Cédula' => 'V-00000000',
                ],
                'is_active' => $defaultActive,
            ],
            PaymentMethodType::Transferencia->value => [
                'type' => PaymentMethodType::Transferencia,
                'title' => 'Transferencia Bancaria',
                'currency' => 'VED',
                'description' => $customDetails['transferencia'] ?? [
                    'Banco' => 'Banesco (0134)',
                    'Número de Cuenta' => '01340000000000000000',
                    'Cédula / RIF' => 'J-00000000-0',
                    'Titular' => $team->name,
                ],
                'is_active' => $defaultActive,
            ],
            PaymentMethodType::Binance->value => [
                'type' => PaymentMethodType::Binance,
                'title' => 'Binance Pay',
                'currency' => 'USD',
                'description' => $customDetails['binance'] ?? [
                    'Pay ID' => '000000000',
                    'Usuario' => strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $team->slug ?? 'organizador')),
                ],
                'is_active' => $defaultActive,
            ],
            PaymentMethodType::Zelle->value => [
                'type' => PaymentMethodType::Zelle,
                'title' => 'Zelle',
                'currency' => 'USD',
                'description' => $customDetails['zelle'] ?? [
                    'Correo' => 'pagos@'.($team->slug ?? 'organizador').'.com',
                    'Titular' => $team->name,
                ],
                'is_active' => $defaultActive,
            ],
        ];

        foreach ($definitions as $type => $data) {
            PaymentMethod::query()->firstOrCreate(
                [
                    'team_id' => $team->id,
                    'type' => $type,
                ],
                $data,
            );
        }
    }
}
