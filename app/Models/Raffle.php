<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTeam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Raffle extends Model
{
    use HasFactory;
    use BelongsToTeam;
    use \Spatie\Sluggable\HasSlug;


    protected $fillable = [
        'team_id',
        'title',
        'slug',
        'date',
        'img',
        'currency',
        'ticket_price',
        'description',
        'total_tickets'
    ];

    protected $casts = [
        'date' => 'datetime',
        'ticket_price' => 'integer'
    ];

    public function getSlugOptions(): \Spatie\Sluggable\SlugOptions
    {
        return \Spatie\Sluggable\SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate()
            ->slugsShouldBeNoLongerThan(50);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

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
