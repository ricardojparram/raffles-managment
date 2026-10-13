<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'raffle_id',
        'customer_id',
        'payment_id',
        'number',
        'status'
    ];

    public function raffles()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
