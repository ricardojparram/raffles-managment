<?php

namespace Database\Seeders;

use App\Models\Raffle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RaffleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $raffle = Raffle::create([
            'title' => 'La revancha de semana santa',
            'description' => '<p>Fortuner 2012 + combo playero.<br><br>Si lleva más de 5 números en la guantera le meto 2.000$ + un outlook 2025 para que pida perdón + iPhone 16 pro max.<br><br>La camioneta juega el sábado 12 de abril.<br><br>Premios anticipados a repartir<br>1.000$ 09/04/25<br>1.000$ 10/04/25<br>1.000$ 11/04/25<br><br>Valor del boleto 10 dolaritos&nbsp;<br>3 boletos x 25$&nbsp;<br><br>Todos los premios jugarán por la lotería motilón noche a las 10:00pm hora de venezuela.<br><br>BUENA SUERTEEEEE✌🏻💚</p>',
            'date' => '2025-04-12 20:00:00',
            'img' => '01JRQTETZM5NHTE6CK1KG7PCQX.jpg',
            'ticket_price' => '10',
            'status' => 'pending',
            'ticket_amount' => 100,
            'minimum_tickets' => 1,
            'team_id' => 1,
        ]);
        $raffle->raffle_prizes()->createMany([
            [
                'title' => '1000$',
                'date' => '2025-04-09 20:00:00'
            ],
            [
                'title' => '1000$',
                'date' => '2025-04-10 20:00:00'
            ],
            [
                'title' => '1000$',
                'date' => '2025-04-11 20:00:00'
            ]
        ]);
        $raffle->offers()->createMany([
            [
                'ticket_amount' => 3,
                'price' => 25.00
            ]
        ]);
    }
}
