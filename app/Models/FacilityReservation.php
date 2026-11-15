<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacilityReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'resort_facility_id',
        'user_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'reservation_date',
        'session',
        'guest_type',
        'special_requests',
        'status',
    ];

    protected $casts = [
        'reservation_date' => 'date',
    ];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(ResortFacility::class, 'resort_facility_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
