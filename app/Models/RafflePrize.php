<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RafflePrize extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'img',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }

    public function imageUrl(): ?string
    {
        return filled($this->img) ? Storage::disk('public')->url($this->img) : null;
    }
}
