<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacilityImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'resort_facility_id',
        'image_path',
        'caption',
        'sort_order',
        'is_primary',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_primary' => 'boolean',
    ];

    public function resortFacility(): BelongsTo
    {
        return $this->belongsTo(ResortFacility::class);
    }
}
