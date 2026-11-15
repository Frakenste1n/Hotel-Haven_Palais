<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CustomerReservationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user->hasRole('customer') || $user->isStaff()) {
            return redirect()
                ->route('home')
                ->with('error', 'Akses halaman tidak diizinkan.');
        }

        $reservations = Reservation::query()
            ->where('user_id', $user->id)
            ->with([
                'guest',
                'details.roomType',
                'details.room',
                'payments',
            ])
            ->latest()
            ->paginate(10);

        return view('frontend.customer.riwayat', compact('reservations'));
    }

    public function show(Reservation $reservation)
{
    $user = auth()->user();

    if (! $user->hasRole('customer') || $user->isStaff()) {
        return redirect()
            ->route('home')
            ->with('error', 'Akses halaman tidak diizinkan.');
    }

    // Pastikan reservasi milik customer yang sedang login
    abort_unless($reservation->user_id === $user->id, 404);

    $reservation->load([
        'guest',
        'details.roomType',
        'details.room',
        'payments.paymentMethod',
    ]);

    return view('frontend.customer.detail-reservasi', compact('reservation'));
}
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'room_type_id' => ['required', 'integer', 'exists:room_types,id'],
            'check_in' => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'guests_count' => ['required', 'integer', 'min:1', 'max:255'],
            'guest_name' => ['required', 'string', 'max:255'],
            'special_requests' => ['nullable', 'string', 'max:2000'],

        ]);
        // Jika belum login, simpan data booking ke session
        if (!$user) {
            return redirect()
                ->route('customer.login')
                ->with('info', 'Silakan login terlebih dahulu untuk melakukan reservasi.');
        }

        // Pastikan akun yang login adalah customer
        if (!$user->hasRole('customer') || $user->isStaff()) {
            return redirect()
                ->route('home')
                ->with('error', 'Akun ini tidak dapat melakukan reservasi.');
        }

        $roomType = RoomType::query()
            ->where('is_active', true)
            ->findOrFail($data['room_type_id']);

        if ((int) $data['guests_count'] > (int) $roomType->max_occupancy) {
            throw ValidationException::withMessages([
                'guests_count' => 'Jumlah tamu melebihi kapasitas kamar.',
            ]);
        }

        $checkIn = Carbon::parse($data['check_in']);
        $checkOut = Carbon::parse($data['check_out']);
        $nights = $checkIn->diffInDays($checkOut);

        $bookingCode = DB::transaction(function () use ($data, $user, $roomType, $checkIn, $checkOut, $nights) {
            // Kunci baris kamar agar tidak dialokasikan bersamaan
            $rooms = Room::query()
                ->where('room_type_id', $roomType->id)
                ->where('is_active', true)
                ->whereNotIn('status', ['maintenance', 'out_of_order'])
                ->orderBy('room_number')
                ->lockForUpdate()
                ->get();

            // Cari kamar yang tidak sedang dipesan
            $availableRoom = $rooms->first(function (Room $room) use ($checkIn, $checkOut) {
                return !$this->roomIsBlocked(
                    $room->id,
                    $checkIn->toDateString(),
                    $checkOut->toDateString()
                );
            });

            if (!$availableRoom) {
                throw ValidationException::withMessages([
                    'room_type_id' => 'Maaf, kamar tidak tersedia pada tanggal tersebut.',
                ]);
            }

            // Simpan data tamu
            $guest = Guest::create([
                'user_id' => $user->id,
                'full_name' => $data['guest_name'],
                'email' => $user->email,
            ]);

            // Hitung harga dari database
            $price = (float) $roomType->base_price;
            $subtotal = round($price * $nights, 2);

            // Buat kode booking unik
            do {
                $code = 'RSV-' . now()->format('Ymd') . '-' . Str::upper(Str::random(4));
            } while (Reservation::withTrashed()->where('booking_code', $code)->exists());

            // Simpan reservasi
            $reservation = Reservation::create([
                'booking_code' => $code,
                'user_id' => $user->id,
                'guest_id' => $guest->id,
                'check_in' => $checkIn->toDateString(),
                'check_out' => $checkOut->toDateString(),
                'adults' => $data['guests_count'],
                'children' => 0,
                'rooms_count' => 1,
                'subtotal' => $subtotal,
                'discount_amount' => 0,
                'tax_amount' => 0,
                'extra_fee' => 0,
                'total_amount' => $subtotal,
                'status' => 'pending_payment',
                'special_requests' => $data['special_requests'] ?? null,
            ]);

            // Simpan detail kamar beserta alokasi kamar fisik
            $reservation->details()->create([
                'room_type_id' => $roomType->id,
                'room_id' => $availableRoom->id,
                'quantity' => 1,
                'nights' => $nights,
                'price_per_night' => $price,
                'subtotal' => $subtotal,
                'guests_count' => $data['guests_count'],
            ]);

            return $code;
        });

        return redirect()->route('kamar.index')->with(
            'success',
            'Reservasi berhasil dibuat. Kode booking: ' . $bookingCode
        );
    }
    private function roomIsBlocked(
        int $roomId,
        string $checkIn,
        string $checkOut
    ): bool {
        return ReservationDetail::query()
            ->where('room_id', $roomId)
            ->whereHas('reservation', function ($query) use ($checkIn, $checkOut) {
                $query->whereNotIn('status', ['cancelled', 'expired'])
                    ->where('check_in', '<', $checkOut)
                    ->where('check_out', '>', $checkIn);
            })
            ->exists();
    }
}