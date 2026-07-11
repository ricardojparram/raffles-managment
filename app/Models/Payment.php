<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTeam;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    use BelongsToTeam;

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
        'img'
    ];

    protected $casts = [
        'amount' => 'integer',
        'payment_date' => 'datetime'
    ];

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
}
