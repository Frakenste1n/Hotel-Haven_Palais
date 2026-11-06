<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_code',
        'user_id',
        'guest_id',
        'promotion_id',
        'package_id',
        'check_in',
        'check_out',
        'adults',
        'children',
        'rooms_count',
        'subtotal',
        'discount_amount',
        'tax_amount',
        'extra_fee',
        'total_amount',
        'status',
        'special_requests',
        'cancelled_at',
        'cancellation_reason',
        'checked_in_at',
        'checked_out_at',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'adults' => 'integer',
        'children' => 'integer',
        'rooms_count' => 'integer',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'extra_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'cancelled_at' => 'datetime',
        'checked_in_at' => 'datetime',
        'checked_out_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(ReservationDetail::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function syncPaymentConfirmation(): void
    {
        if (! in_array($this->status, ['pending_payment', 'confirmed'], true)) {
            return;
        }

        $paid = (string) $this->payments()->where('status', 'paid')->sum('amount');
        $total = (string) $this->total_amount;
        $covered = bccomp($total, '0', 2) === 1 && bccomp($paid, $total, 2) >= 0;

        if ($covered && $this->status === 'pending_payment') {
            $this->update(['status' => 'confirmed']);
        } elseif (! $covered && $this->status === 'confirmed') {
            $this->update(['status' => 'pending_payment']);
        }
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function housekeepingTasks(): HasMany
    {
        return $this->hasMany(HousekeepingTask::class);
    }
}
