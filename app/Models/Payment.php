<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use BelongsToTeam;
    use HasFactory;

    protected $fillable = [
        'team_id',
        'customer_id',
        'amount',
        'currency',
        'status',
        'reviewed_by',
        'reviewed_at',
        'payment_date',
        'raffle_id',
        'payment_method_id',
        'reference',
        'img',
        'exchange_rate',
    ];

    protected $casts = [
        'amount' => 'integer',
        'payment_date' => 'datetime',
        'reviewed_at' => 'datetime',
        'exchange_rate' => 'float',
    ];

    public function confirm(User $reviewer): void
    {
        $this->update([
            'status' => self::CONFIRMED_STATUS,
            'reviewed_by' => $reviewer->id,
            'reviewed_at' => now(),
        ]);
    }

    public function reject(User $reviewer): void
    {
        $this->update([
            'status' => self::REJECTED_STATUS,
            'reviewed_by' => $reviewer->id,
            'reviewed_at' => now(),
        ]);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    protected static function booted(): void
    {
        static::updated(function (Payment $payment): void {
            if ($payment->wasChanged('status') && $payment->status === self::REJECTED_STATUS) {
                $payment->tickets()->delete();
            }
        });
    }

    public const PENDING_STATUS = 'pending';

    public const CONFIRMED_STATUS = 'confirmed';

    public const REJECTED_STATUS = 'rejected';

    public static function statusOptions()
    {
        return [
            self::PENDING_STATUS => 'Pendiente',
            self::CONFIRMED_STATUS => 'Confirmado',
            self::REJECTED_STATUS => 'Rechazado',
        ];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
