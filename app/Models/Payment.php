<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'amount',
        'status',
        'payment_date',
        'raffle_id',
        'payment_method_id',
        'reference',
        'img'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
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
