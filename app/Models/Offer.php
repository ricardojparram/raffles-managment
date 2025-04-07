<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'raffle_id',
        'ticket_amount',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }
}
