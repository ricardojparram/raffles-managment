<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'dni' => '30125380',
            'name' => 'Ricardo',
            'lastname' => 'Parra',
            'phone' => '+584120503888',
        ]);
        Customer::factory(20)->create();
    }
}
