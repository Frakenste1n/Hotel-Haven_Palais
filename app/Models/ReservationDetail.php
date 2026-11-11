<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'room_type_id',
        'room_id',
        'quantity',
        'nights',
        'price_per_night',
        'subtotal',
        'guests_count',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'nights' => 'integer',
        'price_per_night' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'guests_count' => 'integer',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
