<?php

namespace Database\Seeders;

use App\Actions\SeedTeamPaymentMethods;
use App\Models\Team;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $action = new SeedTeamPaymentMethods;
        $teams = Team::all();

        if ($teams->isEmpty()) {
            $teams = collect([Team::query()->firstOrCreate(['name' => 'Organización Demo'])]);
        }

        foreach ($teams as $team) {
            $action->execute($team, defaultActive: true, customDetails: [
                'pago_movil' => [
                    'Banco' => 'Banco de Venezuela (0102)',
                    'Teléfono' => '0412-0503888',
                    'Cédula' => 'V-30125380',
                ],
            ]);
        }
    }
}
