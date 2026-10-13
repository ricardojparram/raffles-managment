<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PaymentMethod extends Model
{
    use BelongsToTeam;
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'currency',
        'icon',
    ];

    public function casts()
    {
        return [
            'description' => 'array',
        ];
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'payment_method_id');
    }

    public function iconUrl(): ?string
    {
        return filled($this->icon) ? Storage::disk('public')->url($this->icon) : null;
    }

    /**
     * Amount a buyer sends through this method to cover a total priced in the given currency.
     *
     * Without a rate the total cannot be converted, so it stays in its own currency.
     *
     * @return array{amount: int, currency: string, exchange_rate: float|null}
     */
    public function quoteFor(int $total, string $currency, ?float $usdToVedRate): array
    {
        if ($this->currency === $currency || $usdToVedRate === null) {
            return ['amount' => $total, 'currency' => $currency, 'exchange_rate' => null];
        }

        $amount = $this->currency === 'VED' ? $total * $usdToVedRate : $total / $usdToVedRate;

        return ['amount' => (int) round($amount), 'currency' => $this->currency, 'exchange_rate' => $usdToVedRate];
    }
}
