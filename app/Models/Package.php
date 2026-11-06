<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'summary',
        'description',
        'image_path',
        'price',
        'benefits',
        'nights',
        'starts_at',
        'ends_at',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'benefits' => 'array',
        'nights' => 'integer',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function roomTypes(): BelongsToMany
    {
        return $this->belongsToMany(RoomType::class, 'package_room_types')->withTimestamps();
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
