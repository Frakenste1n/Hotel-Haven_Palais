<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResortFacility extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'facility_category_id',
        'name',
        'slug',
        'description',
        'location',
        'operating_hours',
        'is_chargeable',
        'fee',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_chargeable' => 'boolean',
        'fee' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(FacilityCategory::class, 'facility_category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(FacilityImage::class);
    }
}
