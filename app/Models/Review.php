<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'reservation_id',
        'rating',
        'comment',
        'photo_path',
        'status',
        'moderated_by',
        'moderated_at',
    ];

    protected $casts = [
        'rating' => 'integer',
        'moderated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function moderator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'moderated_by');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public static function submit(User $user, string $bookingCode, int $rating, ?string $comment = null, ?UploadedFile $photo = null): self
    {
        if (! $user->is_active) {
            throw ValidationException::withMessages([
                'auth' => 'Akun Anda tidak aktif.',
            ]);
        }

        if (! $user->hasRole('customer')) {
            throw ValidationException::withMessages([
                'auth' => 'Hanya akun customer yang dapat mengirim ulasan.',
            ]);
        }

        return DB::transaction(function () use ($user, $bookingCode, $rating, $comment, $photo) {
            $reservation = Reservation::query()
                ->where('booking_code', $bookingCode)
                ->lockForUpdate()
                ->first();

            if (! $reservation || (int) $reservation->user_id !== (int) $user->id) {
                throw ValidationException::withMessages([
                    'booking_code' => 'Reservasi tidak ditemukan.',
                ]);
            }

            if ($reservation->status !== 'checked_out') {
                throw ValidationException::withMessages([
                    'booking_code' => 'Ulasan hanya bisa diberikan setelah check-out.',
                ]);
            }

            if (static::withTrashed()->where('reservation_id', $reservation->id)->exists()) {
                throw ValidationException::withMessages([
                    'booking_code' => 'Reservasi ini sudah memiliki ulasan.',
                ]);
            }

            $photoPath = $photo?->store('reviews', 'public');

            try {
                return static::create([
                    'user_id' => $user->id,
                    'reservation_id' => $reservation->id,
                    'rating' => $rating,
                    'comment' => $comment,
                    'photo_path' => $photoPath,
                    'status' => 'pending',
                ]);
            } catch (QueryException $exception) {
                if ($photoPath) {
                    Storage::disk('public')->delete($photoPath);
                }

                if (static::isUniqueReservationViolation($exception)) {
                    throw ValidationException::withMessages([
                        'booking_code' => 'Reservasi ini sudah memiliki ulasan.',
                    ]);
                }

                throw $exception;
            }
        });
    }

    private static function isUniqueReservationViolation(QueryException $exception): bool
    {
        $message = $exception->getMessage();

        return str_contains($message, 'reviews.reservation_id')
            || str_contains($message, 'reviews_reservation_id_unique');
    }
}
