<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTeam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;
    use BelongsToTeam;

    protected $fillable = [
        'title',
        'description',
        'currency',
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
