<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'description' => [
                "Cédula" => "30125380",
                "Teléfono" => "04120503888",
                "Banco" => "BDV"
            ],
            'icon' => '01JRRWSH0K8HNQ2R74HJ4FGMHK.png'
        ]);
    }
}
