<?php

namespace Database\Seeders;

use App\Models\Raffle;
use Illuminate\Database\Seeder;

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
            'date' => now()->addDays(10)->setTime(20, 0),
            'img' => '01K7TCF3MR48YRB7TDFGQD44K9.jpg',
            'ticket_price' => 1000,
            'status' => 'active',
            'ticket_amount' => 100,
            'minimum_tickets' => 1,
            'team_id' => 1,
        ]);
        $raffle->raffle_prizes()->createMany([
            [
                'title' => '1000$',
                'date' => now()->addDays(7)->setTime(20, 0),
            ],
            [
                'title' => '1000$',
                'date' => now()->addDays(8)->setTime(20, 0),
            ],
            [
                'title' => '1000$',
                'date' => now()->addDays(9)->setTime(20, 0),
            ],
        ]);
        $raffle->offers()->createMany([
            [
                'ticket_amount' => 3,
                'price' => 2500,
            ],
        ]);
    }
}
