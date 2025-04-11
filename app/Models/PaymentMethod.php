<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;

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
