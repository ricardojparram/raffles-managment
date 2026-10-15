<?php

namespace App\Models;

use App\Enums\PaymentMethodType;
use App\Models\Concerns\BelongsToTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PaymentMethod extends Model
{
    use BelongsToTeam;
    use HasFactory;

    protected $fillable = [
        'team_id',
        'type',
        'title',
        'description',
        'currency',
        'icon',
        'is_active',
    ];

    public function casts(): array
    {
        return [
            'description' => 'array',
            'type' => PaymentMethodType::class,
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function formattedDetails(): string
    {
        if (empty($this->description)) {
            return '';
        }

        return collect($this->description)
            ->map(fn ($val, $key) => "• {$key}: {$val}")
            ->join("\n");
    }

    public function bankKey(): ?string
    {
        $bank = strtolower(($this->description['Banco'] ?? '').' '.$this->title);
        if (str_contains($bank, '0102') || str_contains($bank, 'venezuela') || str_contains($bank, 'bdv')) {
            return 'bdv';
        }
        if (str_contains($bank, '0134') || str_contains($bank, 'banesco')) {
            return 'banesco';
        }
        if (str_contains($bank, '0105') || str_contains($bank, 'mercantil')) {
            return 'mercantil';
        }
        if (str_contains($bank, '0108') || str_contains($bank, 'provincial') || str_contains($bank, 'bbva')) {
            return 'provincial';
        }
        if (str_contains($bank, '0172') || str_contains($bank, 'bancamiga')) {
            return 'bancamiga';
        }
        if (str_contains($bank, '0191') || str_contains($bank, 'bnc') || str_contains($bank, 'nacional de credito')) {
            return 'bnc';
        }

        return null;
    }

    /**
     * Formats all payment details into a clean string ready for Venezuelan banking apps paste feature.
     */
    public function clipboardPayload(?string $amount = null): string
    {
        $lines = [];

        if (! empty($this->description)) {
            foreach ($this->description as $label => $value) {
                $lines[] = "{$label}: {$value}";
            }
        }

        if (filled($amount)) {
            $lines[] = "Monto: {$amount}";
        }

        return implode("\n", $lines);
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
