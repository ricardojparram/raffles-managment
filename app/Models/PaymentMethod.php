<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTeam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class PaymentMethod extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    use BelongsToTeam;

    protected $fillable = [
        'title',
        'description',
        'icon'
    ];

    public function casts()
    {
        return [
            'description' => 'array'
        ];
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'payment_method_id');
    }
}
