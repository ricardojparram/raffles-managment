<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Raffle extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'date',
        'img',
        'ticket_price',
        'description'
    ];

    protected $casts = [
        'date' => 'datetime',
        'ticket_price' => 'decimal:2'
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
}
