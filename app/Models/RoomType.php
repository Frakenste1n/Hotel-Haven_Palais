<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'room_category_id',
        'name',
        'slug',
        'description',
        'summary',
        'base_price',
        'capacity_adults',
        'capacity_children',
        'bed_type',
        'room_size',
        'max_occupancy',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'room_size' => 'decimal:2',
        'capacity_adults' => 'integer',
        'capacity_children' => 'integer',
        'max_occupancy' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(RoomImage::class);
    }

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(RoomFacility::class, 'room_type_facilities')->withTimestamps();
    }

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'package_room_types')->withTimestamps();
    }

    public function reservationDetails(): HasMany
    {
        return $this->hasMany(ReservationDetail::class);
    }
}
