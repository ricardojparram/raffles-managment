<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTeam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Customer extends Model
{
    use UsesTenantConnection;
    use HasFactory;
    use BelongsToTeam;

    protected $fillable = [
        'dni',
        'name',
        'lastname',
        'phone',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
