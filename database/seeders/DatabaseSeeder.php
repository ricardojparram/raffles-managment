<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            TeamSeeder::class,
            RaffleSeeder::class,
            PaymentMethodsSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class
        ]);
    }
}
