<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'plan_id',
        'amount',
        'currency',
        'payment_method',
        'reference',
        'status',
        'receipt_image',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function plan()
    {
        return $this->belongsTo(\Revoltify\Subscriptionify\Models\Plan::class);
    }
}
