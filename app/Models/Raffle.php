<?php

namespace App\Models;

use App\Enums\SalesStatus;
use App\Enums\Status;
use App\Models\Concerns\BelongsToTeam;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Raffle extends Model
{
    use BelongsToTeam;
    use HasFactory;
    use HasSlug;

    /**
     * Upper bound of tickets a buyer can reserve in a single purchase.
     */
    public const MAX_TICKETS_PER_PURCHASE = 100;

    /**
     * Amount of numbers shown on each page of the public number board.
     */
    public const NUMBERS_PER_PAGE = 100;

    protected $fillable = [
        'team_id',
        'title',
        'date',
        'img',
        'currency',
        'ticket_price',
        'description',
        'ticket_amount',
        'minimum_tickets',
        'status',
        'conalot_permit',
    ];

    protected $casts = [
        'date' => 'datetime',
        'ticket_price' => 'integer',
        'ticket_amount' => 'integer',
        'minimum_tickets' => 'integer',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function raffle_prizes()
    {
        return $this->hasMany(RafflePrize::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate()
            ->slugsShouldBeNoLongerThan(60)
            ->extraScope(fn (Builder $query) => $query->where('team_id', $this->team_id));
    }

    public function publicUrl(): string
    {
        return route('raffles.show', ['team' => $this->team->slug, 'raffle' => $this->slug]);
    }

    public function imageUrl(): ?string
    {
        return filled($this->img) ? Storage::disk('public')->url($this->img) : null;
    }

    /**
     * Digits every ticket number is padded to, e.g. 2 for a 100 number raffle.
     */
    public function numberLength(): int
    {
        return max(2, strlen((string) max(0, $this->ticket_amount - 1)));
    }

    public function formatNumber(int $number): string
    {
        return str_pad((string) $number, $this->numberLength(), '0', STR_PAD_LEFT);
    }

    public function hasNumber(string $number): bool
    {
        return strlen($number) === $this->numberLength()
            && ctype_digit($number)
            && (int) $number < $this->ticket_amount;
    }

    /**
     * Cheapest price, in minor units, to buy exactly the given quantity combining offers.
     */
    public function priceForQuantity(int $quantity): int
    {
        return $this->priceTable($quantity)[max(0, $quantity)];
    }

    /**
     * Price in minor units for every quantity from zero up to the given maximum.
     *
     * @return list<int>
     */
    public function priceTable(int $maxQuantity): array
    {
        $bundles = $this->offers
            ->filter(fn (Offer $offer): bool => $offer->ticket_amount > 0 && $offer->price >= 0)
            ->map(fn (Offer $offer): array => [(int) $offer->ticket_amount, (int) $offer->price])
            ->values()
            ->all();

        $prices = [0];

        for ($quantity = 1; $quantity <= $maxQuantity; $quantity++) {
            $prices[$quantity] = $prices[$quantity - 1] + $this->ticket_price;

            foreach ($bundles as [$size, $price]) {
                if ($size <= $quantity) {
                    $prices[$quantity] = min($prices[$quantity], $prices[$quantity - $size] + $price);
                }
            }
        }

        return $prices;
    }

    /**
     * @return list<string>
     */
    public function takenNumbersBetween(int $from, int $to): array
    {
        return $this->tickets()
            ->whereBetween('number', [$this->formatNumber($from), $this->formatNumber($to)])
            ->pluck('number')
            ->all();
    }

    /**
     * @param  list<string>  $except
     * @return list<string>
     */
    public function randomAvailableNumbers(int $count, array $except = []): array
    {
        $unavailable = array_flip([...$this->tickets()->pluck('number')->all(), ...$except]);
        $pool = [];

        for ($number = 0; $number < $this->ticket_amount; $number++) {
            $formatted = $this->formatNumber($number);

            if (! isset($unavailable[$formatted])) {
                $pool[] = $formatted;
            }
        }

        if ($pool === [] || $count < 1) {
            return [];
        }

        return array_values(Arr::random($pool, min($count, count($pool))));
    }

    public function soldTicketsCount(): int
    {
        return (int) ($this->tickets_count ?? $this->tickets()->count());
    }

    public function availableTicketsCount(): int
    {
        return max(0, $this->ticket_amount - $this->soldTicketsCount());
    }

    public function soldPercentage(): int
    {
        if ($this->ticket_amount < 1) {
            return 0;
        }

        return (int) min(100, floor($this->soldTicketsCount() * 100 / $this->ticket_amount));
    }

    public function salesStatus(): SalesStatus
    {
        return match (true) {
            $this->status === Status::Pending->value => SalesStatus::Unpublished,
            $this->status === Status::Canceled->value => SalesStatus::Canceled,
            $this->status === Status::Finished->value => SalesStatus::Finished,
            $this->date->isPast() => SalesStatus::Closed,
            $this->availableTicketsCount() === 0 => SalesStatus::SoldOut,
            default => SalesStatus::Open,
        };
    }

    /**
     * Formats the raffle data ready to be copied and shared on WhatsApp, Telegram, etc.
     */
    public function toShareText(?Collection $paymentMethods = null): string
    {
        $shortDate = str_replace('.', '', $this->date->isoFormat('dddd D [de] MMMM, h:mm a'));
        $price = money($this->ticket_price, $this->currency)->format();

        $lines = [
            "🎟️ *{$this->title}*",
            "🏢 *Organiza:* {$this->team->name}",
        ];

        if (filled($this->conalot_permit)) {
            $lines[] = "⚖️ *Permiso CONALOT:* {$this->conalot_permit}";
        }

        if (filled($this->team->runlot_number)) {
            $lines[] = "📋 *RUNLOT:* {$this->team->runlot_number}";
        }

        $lines[] = '📅 *Fecha del sorteo:* '.ucfirst($shortDate);
        $lines[] = "💵 *Precio por boleto:* {$price}";

        if ($this->relationLoaded('offers') && $this->offers->isNotEmpty()) {
            $offerLines = [];
            foreach ($this->offers->sortBy('ticket_amount') as $offer) {
                $offerPrice = money($offer->price, $this->currency)->format();
                $offerLines[] = "  • {$offer->ticket_amount} boletos por {$offerPrice}";
            }
            $lines[] = "\n🔥 *PROMOCIONES:*\n".implode("\n", $offerLines);
        }

        if ($this->relationLoaded('raffle_prizes') && $this->raffle_prizes->isNotEmpty()) {
            $prizeLines = [];
            foreach ($this->raffle_prizes->sortBy('date') as $prize) {
                $prizeDate = $prize->date ? ' ('.str_replace('.', '', $prize->date->isoFormat('D MMM, h:mm a')).')' : '';
                $prizeLines[] = "  • {$prize->title}{$prizeDate}";
            }
            $lines[] = "\n🎁 *PREMIOS ADICIONALES:*\n".implode("\n", $prizeLines);
        }

        $methods = $paymentMethods ?? $this->team->paymentMethods()->active()->get();

        if ($methods->isNotEmpty()) {
            $lines[] = "\n💳 *MÉTODOS DE PAGO DISPONIBLES:*";
            foreach ($methods as $method) {
                $currencyBadge = $method->currency === 'VED' ? 'Bs.' : $method->currency;
                $lines[] = "\n👉 *{$method->title} ({$currencyBadge})*";
                foreach ($method->description ?? [] as $label => $val) {
                    $lines[] = "  • {$label}: {$val}";
                }
            }
        }

        $lines[] = "\n👉 *Elegí y comprá tus boletos acá:*\n".$this->publicUrl();
        $lines[] = "\n🔍 *Verificá tus números comprados:*\n".$this->publicUrl().'#mis-boletos';

        return trim(implode("\n", $lines));
    }
}
