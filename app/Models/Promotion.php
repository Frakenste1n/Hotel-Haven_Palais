<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'summary',
        'description',
        'image_path',
        'discount_type',
        'discount_value',
        'min_nights',
        'min_amount',
        'max_uses',
        'used_count',
        'starts_at',
        'ends_at',
        'terms',
        'is_active',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_amount' => 'decimal:2',
        'min_nights' => 'integer',
        'max_uses' => 'integer',
        'used_count' => 'integer',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
