<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'title' => 'Pago movil',
            'team_id' => 1,
            'description' => [
                'Cédula' => '30125380',
                'Teléfono' => '04120503888',
                'Banco' => 'BDV',
            ],
            'currency' => 'VED',
            'icon' => '01JRRWSH0K8HNQ2R74HJ4FGMHK.png',
        ]);
    }
}
