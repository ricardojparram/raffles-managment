<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use BelongsToTeam;
    use HasFactory;

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

    /**
     * Normalize a phone to E.164, or null when it is not a number we can reach.
     *
     * Numbers without a country code are read as Venezuelan mobiles. Buyers abroad
     * must type theirs starting with "+".
     */
    public static function normalizePhone(string $phone): ?string
    {
        $phone = trim($phone);
        $digits = preg_replace('/\D/', '', $phone);

        if (str_starts_with($phone, '+') || str_starts_with($digits, '00')) {
            $digits = str_starts_with($phone, '+') ? $digits : substr($digits, 2);

            if (! str_starts_with($digits, '58')) {
                return preg_match('/^[1-9]\d{7,14}$/', $digits) ? '+'.$digits : null;
            }
        }

        $national = preg_replace('/^(58)?0?/', '', $digits, 1);

        return preg_match('/^4(12|14|16|22|24|26)\d{7}$/', $national) ? '+58'.$national : null;
    }
}
