<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTeam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Raffle extends Model
{
    use HasFactory;
    use BelongsToTeam;


    protected $fillable = [
        'title',
        'date',
        'img',
        'currency',
        'ticket_price',
        'description'
    ];

    protected $casts = [
        'date' => 'datetime',
        'ticket_price' => 'integer'
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
