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
        'exchange_rate' => 'float',
    ];

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
