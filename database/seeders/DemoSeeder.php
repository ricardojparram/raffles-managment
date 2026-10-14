<?php

namespace Database\Seeders;

use App\Enums\PaymentMethodType;
use App\Models\Customer;
use App\Models\Offer;
use App\Models\PaymentMethod;
use App\Models\Raffle;
use App\Models\RafflePrize;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Sample organizer with raffles in every public state, for demos and browser checks.
 *
 * Not part of DatabaseSeeder. Run it with: php artisan db:seed --class=DemoSeeder
 */
class DemoSeeder extends Seeder
{
    public const TEAM_SLUG = 'rifas-el-chamo';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team = Team::query()->firstOrCreate(['slug' => self::TEAM_SLUG], [
            'name' => 'Rifas El Chamo',
            'runlot_number' => 'RUNLOT-2026-0412',
        ]);

        if ($team->raffles()->exists()) {
            return;
        }

        if ($owner = User::query()->first()) {
            $team->users()->syncWithoutDetaching([$owner->id => ['role' => 'owner']]);
        }

        $this->seedPaymentMethods($team);

        $buyer = Customer::query()->create([
            'team_id' => $team->id,
            'dni' => '20111222',
            'name' => 'Carlos',
            'lastname' => 'Mendoza',
            'phone' => '+584141112233',
        ]);

        $car = Raffle::query()->create([
            'team_id' => $team->id,
            'title' => 'Toyota Fortuner 2012 + combo playero',
            'conalot_permit' => 'CONALOT-RIFA-2026-089',
            'date' => now()->addDays(6)->setTime(22, 0),
            'img' => $this->image("tenant-{$team->id}/raffles/fortuner.jpg", 1200, 900, [234, 88, 12], [120, 28, 10]),
            'currency' => 'USD',
            'ticket_price' => 1000,
            'status' => 'active',
            'ticket_amount' => 1000,
            'minimum_tickets' => 1,
            'description' => '<p><strong>Fortuner 2012 full equipo</strong> + combo playero para que la estrenes en Semana Santa.</p><p>Si llevas más de 5 números, en la guantera te metemos <strong>2.000$</strong> y un iPhone 16 Pro Max.</p><ul><li>La camioneta juega el sábado por el Triple Táchira de las 10:00 p. m.</li><li>Premios anticipados de 1.000$ los tres días previos.</li><li>Entrega inmediata en cualquier parte de Venezuela.</li></ul><p>Todos los premios juegan con los tres últimos dígitos del resultado. Si el número ganador no fue vendido, se juega de nuevo al día siguiente a la misma hora.</p><p>¡Mucha suerte!</p>',
        ]);

        foreach ([['1.000$ en efectivo', 3], ['iPhone 16 Pro Max', 4], ['Moto Bera SBR 2025', 5]] as [$title, $days]) {
            RafflePrize::query()->create([
                'raffle_id' => $car->id,
                'title' => $title,
                'date' => now()->addDays($days)->setTime(22, 0),
            ]);
        }

        Offer::query()->create(['raffle_id' => $car->id, 'ticket_amount' => 3, 'price' => 2500]);
        Offer::query()->create(['raffle_id' => $car->id, 'ticket_amount' => 10, 'price' => 7000]);

        $this->sell($car, $buyer, 640, seed: 7);

        $phone = Raffle::query()->create([
            'team_id' => $team->id,
            'title' => 'iPhone 16 Pro Max 256GB',
            'date' => now()->addDays(2)->setTime(20, 0),
            'img' => $this->image("tenant-{$team->id}/raffles/iphone.jpg", 1200, 900, [30, 41, 59], [15, 118, 110]),
            'currency' => 'USD',
            'ticket_price' => 500,
            'status' => 'active',
            'ticket_amount' => 100,
            'minimum_tickets' => 2,
            'description' => '<p>Nuevo, sellado y con factura. Juega por el Triple Zulia de las 8:00 p. m.</p>',
        ]);

        $this->sell($phone, $buyer, 88, seed: 11);

        Raffle::query()->create([
            'team_id' => $team->id,
            'title' => 'Moto Empire Keeway Horse 150',
            'date' => now()->subDays(20),
            'img' => $this->image("tenant-{$team->id}/raffles/moto.jpg", 1200, 900, [71, 85, 105], [30, 41, 59]),
            'currency' => 'USD',
            'ticket_price' => 300,
            'status' => 'finished',
            'ticket_amount' => 100,
            'minimum_tickets' => 1,
            'description' => '<p>Rifa finalizada.</p>',
        ]);

        Raffle::query()->create([
            'team_id' => $team->id,
            'title' => 'Combo navideño 500$',
            'date' => now()->subDays(45),
            'img' => null,
            'currency' => 'USD',
            'ticket_price' => 200,
            'status' => 'canceled',
            'ticket_amount' => 100,
            'minimum_tickets' => 1,
            'description' => '<p>Rifa cancelada.</p>',
        ]);
    }

    private function seedPaymentMethods(Team $team): void
    {
        $methods = [
            [PaymentMethodType::PagoMovil, 'Pago Móvil', 'VED', ['Banco' => 'Banco de Venezuela (0102)', 'Cédula' => 'V-18.456.321', 'Teléfono' => '0412-555-0142'], [220, 38, 38]],
            [PaymentMethodType::Transferencia, 'Transferencia Bancaria', 'VED', ['Banco' => 'Banesco (0134)', 'Número de Cuenta' => '0134-1029-44-0001234567', 'Cédula / RIF' => 'J-40123456-7', 'Titular' => 'Rifas El Chamo C.A.'], [37, 99, 235]],
            [PaymentMethodType::Zelle, 'Zelle', 'USD', ['Correo' => 'pagos@rifaselchamo.com', 'Titular' => 'Rifas El Chamo LLC'], [109, 40, 217]],
            [PaymentMethodType::Binance, 'Binance Pay', 'USD', ['Pay ID' => '284 551 903', 'Usuario' => 'rifaselchamo'], [234, 179, 8]],
        ];

        foreach ($methods as $index => [$type, $title, $currency, $details, $color]) {
            PaymentMethod::query()->create([
                'team_id' => $team->id,
                'type' => $type,
                'title' => $title,
                'description' => $details,
                'currency' => $currency,
                'is_active' => true,
                'icon' => $this->image("payment-methods/demo-{$index}.jpg", 160, 160, $color, array_map(fn (int $channel): int => (int) ($channel * 0.7), $color)),
            ]);
        }
    }

    /**
     * Mark a deterministic set of numbers as already sold.
     */
    private function sell(Raffle $raffle, Customer $buyer, int $quantity, int $seed): void
    {
        mt_srand($seed);
        $numbers = [];

        while (count($numbers) < $quantity) {
            $numbers[$raffle->formatNumber(mt_rand(0, $raffle->ticket_amount - 1))] = true;
        }

        mt_srand();

        foreach (array_keys($numbers) as $number) {
            Ticket::query()->create(['raffle_id' => $raffle->id, 'customer_id' => $buyer->id, 'number' => $number]);
        }
    }

    /**
     * Draw a simple gradient placeholder on the public disk, or skip it when GD is missing.
     *
     * @param  array{int, int, int}  $from
     * @param  array{int, int, int}  $to
     */
    private function image(string $path, int $width, int $height, array $from, array $to): ?string
    {
        if (! function_exists('imagecreatetruecolor')) {
            return null;
        }

        $image = imagecreatetruecolor($width, $height);

        for ($y = 0; $y < $height; $y++) {
            $ratio = $y / $height;
            $color = imagecolorallocate(
                $image,
                (int) ($from[0] + ($to[0] - $from[0]) * $ratio),
                (int) ($from[1] + ($to[1] - $from[1]) * $ratio),
                (int) ($from[2] + ($to[2] - $from[2]) * $ratio),
            );
            imageline($image, 0, $y, $width, $y, $color);
        }

        $highlight = imagecolorallocatealpha($image, 255, 255, 255, 95);
        imagefilledellipse($image, (int) ($width * 0.78), (int) ($height * 0.3), (int) ($width * 0.7), (int) ($width * 0.7), $highlight);
        imagefilledellipse($image, (int) ($width * 0.2), (int) ($height * 0.85), (int) ($width * 0.5), (int) ($width * 0.5), $highlight);

        ob_start();
        imagejpeg($image, null, 88);

        Storage::disk('public')->put($path, (string) ob_get_clean());

        return $path;
    }
}
