<?php

namespace App\Http\Controllers\Backend;

use App\Models\CustomerProfile;
use App\Models\Guest;
use App\Models\HousekeepingTask;
use App\Models\Package;
use App\Models\Promotion;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\Role;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BookingManagementController extends Controller
{
    public function index(Request $request): View
    {
        $activeTab = $this->allowedTab($request, [
            'reservations' => 'reservations.view',
            'customers' => 'customers.view',
            'guests' => 'guests.view',
            'front-desk' => 'front_desk.view',
        ], 'reservations');
        $user = $request->user();

        $reservations = ! $user->allows('reservations.view')
            ? $this->emptyPage()
            : Reservation::with(['user', 'guest', 'details.roomType'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = '%' . $request->q . '%';
                $q->where(function ($inner) use ($term) {
                    $inner->where('booking_code', 'like', $term)
                        ->orWhereHas('user', fn ($user) => $user->where('name', 'like', $term)->orWhere('email', 'like', $term))
                        ->orWhereHas('guest', fn ($guest) => $guest->where('full_name', 'like', $term));
                });
            })
            ->latest()
            ->paginate(10);

        $customers = $user->allows('customers.view')
            ? User::whereHas('roles', fn ($q) => $q->where('slug', 'customer'))
                ->with('customerProfile')
                ->latest()
                ->paginate(10)
            : $this->emptyPage();

        $guests = $user->allows('guests.view')
            ? Guest::latest()->paginate(10)
            : $this->emptyPage();

        $arrivals = $user->allows('front_desk.view')
            ? Reservation::with(['user', 'guest', 'details.roomType'])
                ->whereDate('check_in', today())
                ->where('status', 'confirmed')
                ->latest()
                ->get()
            : collect();

        $departures = $user->allows('front_desk.view')
            ? Reservation::with(['user', 'guest', 'details.room'])
                ->whereDate('check_out', today())
                ->where('status', 'checked_in')
                ->latest()
                ->get()
            : collect();

        $inHouse = $user->allows('front_desk.view')
            ? Reservation::with(['user', 'guest', 'details.room'])
                ->where('status', 'checked_in')
                ->latest()
                ->paginate(10)
            : $this->emptyPage();

        $canEditReservations = $user->allows('reservations.create', 'reservations.update');
        $guestOptions = $canEditReservations ? Guest::orderBy('full_name')->get(['id', 'full_name']) : collect();
        $userOptions = $canEditReservations ? User::orderBy('name')->get(['id', 'name', 'email']) : collect();
        $promotionOptions = $canEditReservations ? Promotion::orderBy('name')->get(['id', 'code', 'name']) : collect();
        $packageOptions = $canEditReservations ? Package::orderBy('name')->get(['id', 'name']) : collect();
        $roomTypeOptions = $canEditReservations ? RoomType::orderBy('name')->get(['id', 'name', 'base_price']) : collect();

        return view('backend.booking-management.index', compact(
            'activeTab', 'reservations', 'customers', 'guests', 'arrivals', 'departures', 'inHouse',
            'guestOptions', 'userOptions', 'promotionOptions', 'packageOptions', 'roomTypeOptions'
        ));
    }

    // Reservations
    public function storeReservation(Request $request): RedirectResponse
    {
        $data = $this->validatedReservation($request);
        $stay = $this->buildStay($data);

        DB::transaction(function () use ($stay) {
            $reservation = Reservation::create([
                'booking_code' => $this->generateBookingCode(),
                ...$stay['reservation'],
            ]);

            foreach ($stay['details'] as $row) {
                $reservation->details()->create($row);
            }

            if (in_array($reservation->status, ['pending_payment', 'confirmed'], true)) {
                $reservation->syncPaymentConfirmation();
            }
        });

        return redirect()
            ->route('backend.booking-management.index', ['tab' => 'reservations'])
            ->with('success', 'Reservasi berhasil dibuat.');
    }

    public function updateReservation(Request $request, Reservation $reservation): RedirectResponse
    {
        $data = $this->validatedReservation($request, true);
        $previousStatus = $reservation->status;
        $previousRoomIds = $reservation->details()->pluck('room_id')->filter()->all();
        $stay = $this->buildStay($data, $reservation);

        DB::transaction(function () use ($reservation, $stay, $previousStatus, $previousRoomIds) {
            $reservation->update($stay['reservation']);
            $reservation->details()->delete();
            foreach ($stay['details'] as $row) {
                $reservation->details()->create($row);
            }

            if ($previousStatus === 'checked_in' && $reservation->status !== 'checked_in') {
                $this->releaseRooms($previousRoomIds, $reservation);
            }

            if ($reservation->status === 'checked_in') {
                $this->occupyStay($reservation);
                $currentRoomIds = $reservation->details()->pluck('room_id')->filter()->all();
                $this->releaseRooms(array_diff($previousRoomIds, $currentRoomIds), $reservation);
            }

            if (in_array($reservation->status, ['pending_payment', 'confirmed'], true)) {
                $reservation->syncPaymentConfirmation();
            }
        });

        return redirect()
            ->route('backend.booking-management.index', ['tab' => 'reservations'])
            ->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function destroyReservation(Reservation $reservation): RedirectResponse
    {
        if (in_array($reservation->status, ['checked_in', 'checked_out'], true)) {
            return back()->with('error', 'Reservasi yang sudah check-in/out tidak dapat dihapus.');
        }

        $reservation->delete();

        return redirect()
            ->route('backend.booking-management.index', ['tab' => 'reservations'])
            ->with('success', 'Reservasi berhasil dihapus.');
    }

    // Customers
    public function storeCustomer(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'id_type' => ['nullable', 'string', 'max:50'],
            'id_number' => ['nullable', 'string', 'max:100'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $role = Role::where('slug', 'customer')->firstOrFail();

        DB::transaction(function () use ($data, $request, $role) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'password' => Hash::make($data['password']),
                'is_active' => $request->boolean('is_active', true),
            ]);

            $user->roles()->sync([$role->id]);

            CustomerProfile::create([
                'user_id' => $user->id,
                'address' => $data['address'] ?? null,
                'city' => $data['city'] ?? null,
                'country' => $data['country'] ?? null,
                'id_type' => $data['id_type'] ?? null,
                'id_number' => $data['id_number'] ?? null,
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'gender' => $data['gender'] ?? null,
            ]);
        });

        return redirect()
            ->route('backend.booking-management.index', ['tab' => 'customers'])
            ->with('success', 'Pelanggan berhasil dibuat.');
    }

    public function updateCustomer(Request $request, User $customer): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($customer->id)],
            'phone' => ['nullable', 'string', 'max:30', Rule::unique('users', 'phone')->ignore($customer->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'id_type' => ['nullable', 'string', 'max:50'],
            'id_number' => ['nullable', 'string', 'max:100'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'is_active' => ['nullable', 'boolean'],
        ]);

        DB::transaction(function () use ($data, $request, $customer) {
            $customer->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'is_active' => $request->boolean('is_active', true),
            ]);

            if (! empty($data['password'])) {
                $customer->update(['password' => Hash::make($data['password'])]);
            }

            CustomerProfile::updateOrCreate(
                ['user_id' => $customer->id],
                [
                    'address' => $data['address'] ?? null,
                    'city' => $data['city'] ?? null,
                    'country' => $data['country'] ?? null,
                    'id_type' => $data['id_type'] ?? null,
                    'id_number' => $data['id_number'] ?? null,
                    'date_of_birth' => $data['date_of_birth'] ?? null,
                    'gender' => $data['gender'] ?? null,
                ]
            );
        });

        return redirect()
            ->route('backend.booking-management.index', ['tab' => 'customers'])
            ->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroyCustomer(User $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()
            ->route('backend.booking-management.index', ['tab' => 'customers'])
            ->with('success', 'Pelanggan berhasil dihapus.');
    }

    public function storeGuest(Request $request): RedirectResponse
    {
        $data = $this->validatedGuest($request);
        Guest::create($data);

        return redirect()
            ->route('backend.booking-management.index', ['tab' => 'guests'])
            ->with('success', 'Data tamu berhasil dibuat.');
    }

    public function updateGuest(Request $request, Guest $guest): RedirectResponse
    {
        $guest->update($this->validatedGuest($request));

        return redirect()
            ->route('backend.booking-management.index', ['tab' => 'guests'])
            ->with('success', 'Data tamu berhasil diperbarui.');
    }

    public function destroyGuest(Guest $guest): RedirectResponse
    {
        if ($guest->reservations()->exists()) {
            return back()->with('error', 'Tamu masih terkait reservasi.');
        }

        $guest->delete();

        return redirect()
            ->route('backend.booking-management.index', ['tab' => 'guests'])
            ->with('success', 'Data tamu berhasil dihapus.');
    }

    // Front Desk - Check-in/Check-out
    public function checkIn(Request $request, Reservation $reservation): RedirectResponse
    {
        if ($reservation->status !== 'confirmed') {
            return back()->with('error', 'Hanya reservasi yang sudah dikonfirmasi dan lunas yang dapat di-check-in.');
        }

        DB::transaction(function () use ($reservation) {
            $this->occupyStay($reservation);
            $reservation->update([
                'status' => 'checked_in',
                'checked_in_at' => $reservation->checked_in_at ?? now(),
            ]);
        });

        return redirect()
            ->route('backend.booking-management.index', ['tab' => 'front-desk'])
            ->with('success', 'Check-in berhasil.');
    }

    public function checkOut(Request $request, Reservation $reservation): RedirectResponse
    {
        if ($reservation->status !== 'checked_in') {
            return back()->with('error', 'Hanya reservasi checked-in yang dapat di-check-out.');
        }

        DB::transaction(function () use ($reservation) {
            $reservation->load('details.room');

            foreach ($reservation->details as $detail) {
                if (! $detail->room) {
                    continue;
                }

                $detail->room->update(['status' => 'cleaning']);

                $exists = HousekeepingTask::query()
                    ->where('room_id', $detail->room->id)
                    ->where('reservation_id', $reservation->id)
                    ->where('task_type', 'turnover')
                    ->whereIn('status', ['pending', 'in_progress'])
                    ->exists();

                if (! $exists) {
                    HousekeepingTask::create([
                        'room_id' => $detail->room->id,
                        'reservation_id' => $reservation->id,
                        'task_type' => 'turnover',
                        'status' => 'pending',
                        'priority' => 'high',
                        'notes' => 'Dibuat otomatis setelah check-out.',
                        'scheduled_at' => now(),
                    ]);
                }
            }

            $reservation->update([
                'status' => 'checked_out',
                'checked_out_at' => now(),
            ]);
        });

        return redirect()
            ->route('backend.booking-management.index', ['tab' => 'front-desk'])
            ->with('success', 'Check-out berhasil.');
    }

    private function validatedReservation(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'guest_id' => ['nullable', 'exists:guests,id'],
            'promotion_id' => ['nullable', 'exists:promotions,id'],
            'package_id' => ['nullable', 'exists:packages,id'],
            'check_in' => ['required', 'date'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'adults' => ['required', 'integer', 'min:1'],
            'children' => ['nullable', 'integer', 'min:0'],
            'discount_amount' => ['nullable', 'numeric', 'min:0'],
            'tax_amount' => ['nullable', 'numeric', 'min:0'],
            'extra_fee' => ['nullable', 'numeric', 'min:0'],
            'status' => ['nullable', Rule::in([
                'pending_payment', 'confirmed', 'checked_in', 'checked_out', 'cancelled', 'expired',
            ])],
            'special_requests' => ['nullable', 'string'],
            'details' => ['required', 'array', 'min:1'],
            'details.*.room_type_id' => ['required', 'exists:room_types,id'],
            'details.*.room_id' => ['nullable', 'exists:rooms,id'],
            'details.*.quantity' => ['required', 'integer', 'min:1', 'max:1'],
            'details.*.price_per_night' => ['required', 'numeric', 'min:0'],
            'details.*.guests_count' => ['nullable', 'integer', 'min:1'],
        ], [
            'details.*.quantity.max' => 'Setiap baris hanya untuk satu kamar. Tambah baris bila perlu kamar lain.',
        ]);
    }

    private function validatedGuest(Request $request): array
    {
        return $request->validate([
            'user_id' => ['nullable', 'exists:users,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'id_type' => ['nullable', 'string', 'max:50'],
            'id_number' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'notes' => ['nullable', 'string'],
        ]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array{reservation: array<string, mixed>, details: array<int, array<string, mixed>>}
     */
    private function buildStay(array $data, ?Reservation $existing = null): array
    {
        $checkIn = Carbon::parse($data['check_in'])->startOfDay();
        $checkOut = Carbon::parse($data['check_out'])->startOfDay();
        $nights = max(1, (int) abs($checkIn->diffInDays($checkOut)));
        $status = $data['status'] ?? $existing?->status ?? 'pending_payment';
        $this->assertStatusTransition($existing?->status, $status);
        $this->assertRoomsAvailable($data['details'], $checkIn->toDateString(), $checkOut->toDateString(), $existing?->id);

        $previous = $existing ? $existing->details()->get() : collect();
        $usedPrevious = [];
        $subtotal = 0;
        $detailRows = [];

        foreach ($data['details'] as $detail) {
            $lineSubtotal = $detail['quantity'] * $detail['price_per_night'] * $nights;
            $subtotal += $lineSubtotal;
            $roomId = $detail['room_id'] ?? null;

            if (! $roomId && $existing) {
                $match = $previous->first(function ($row) use ($detail, $usedPrevious) {
                    return ! in_array($row->id, $usedPrevious, true)
                        && (int) $row->room_type_id === (int) $detail['room_type_id']
                        && $row->room_id;
                });
                if ($match) {
                    $roomId = $match->room_id;
                    $usedPrevious[] = $match->id;
                }
            }

            $detailRows[] = [
                'room_type_id' => $detail['room_type_id'],
                'room_id' => $roomId,
                'quantity' => $detail['quantity'],
                'nights' => $nights,
                'price_per_night' => $detail['price_per_night'],
                'subtotal' => $lineSubtotal,
                'guests_count' => $detail['guests_count'] ?? 1,
            ];
        }

        $discount = $this->resolveDiscount($data, $subtotal, $nights, $checkIn, $existing?->id);
        $packagePrice = $this->resolvePackagePrice($data, $nights, $checkIn, collect($data['details'])->pluck('room_type_id')->all());
        $tax = (float) ($data['tax_amount'] ?? 0);
        $extra = (float) ($data['extra_fee'] ?? 0);

        return [
            'reservation' => [
                'user_id' => $data['user_id'],
                'guest_id' => $data['guest_id'] ?? null,
                'promotion_id' => $data['promotion_id'] ?? null,
                'package_id' => $data['package_id'] ?? null,
                'check_in' => $checkIn->toDateString(),
                'check_out' => $checkOut->toDateString(),
                'adults' => $data['adults'],
                'children' => $data['children'] ?? 0,
                'rooms_count' => collect($data['details'])->sum('quantity'),
                'subtotal' => $subtotal,
                'discount_amount' => $discount,
                'tax_amount' => $tax,
                'extra_fee' => $extra,
                'total_amount' => max(0, $subtotal - $discount + $tax + $extra + $packagePrice),
                'status' => $status,
                'special_requests' => $data['special_requests'] ?? null,
            ],
            'details' => $detailRows,
        ];
    }

    private function assertStatusTransition(?string $from, string $to): void
    {
        if (in_array($to, ['checked_in', 'checked_out'], true) && $to !== $from) {
            throw ValidationException::withMessages([
                'status' => 'Check-in dan check-out dilakukan dari Front Desk.',
            ]);
        }

        if ($from === 'checked_out' && $to !== 'checked_out') {
            throw ValidationException::withMessages([
                'status' => 'Reservasi yang sudah check-out tidak dapat diubah statusnya.',
            ]);
        }
    }

    /**
     * @param  array<int, array<string, mixed>>  $details
     */
    private function assertRoomsAvailable(array $details, string $checkIn, string $checkOut, ?int $ignoreReservationId): void
    {
        $taken = [];

        foreach ($details as $index => $detail) {
            if (! empty($detail['room_id'])) {
                $room = Room::find($detail['room_id']);
                if (! $room || ! $room->is_active || (int) $room->room_type_id !== (int) $detail['room_type_id'] || in_array($room->status, ['maintenance', 'out_of_order'], true)) {
                    throw ValidationException::withMessages([
                        "details.$index.room_type_id" => 'Kamar yang dipilih tidak tersedia untuk tipe ini.',
                    ]);
                }
                if (in_array($room->id, $taken, true) || $this->roomIsBlocked($room->id, $checkIn, $checkOut, $ignoreReservationId)) {
                    throw ValidationException::withMessages([
                        "details.$index.room_type_id" => 'Kamar sudah terpakai pada tanggal tersebut.',
                    ]);
                }
                $taken[] = $room->id;
                continue;
            }

            $free = $this->freeRooms((int) $detail['room_type_id'], $checkIn, $checkOut, $ignoreReservationId)
                ->reject(fn (Room $room) => in_array($room->id, $taken, true));

            if ($free->count() < (int) $detail['quantity']) {
                throw ValidationException::withMessages([
                    "details.$index.room_type_id" => 'Jumlah kamar untuk tipe ini tidak cukup pada tanggal tersebut.',
                ]);
            }

            foreach ($free->take((int) $detail['quantity']) as $room) {
                $taken[] = $room->id;
            }
        }
    }

    private function roomIsBlocked(int $roomId, string $checkIn, string $checkOut, ?int $ignoreReservationId): bool
    {
        return ReservationDetail::query()
            ->where('room_id', $roomId)
            ->whereHas('reservation', function ($query) use ($checkIn, $checkOut, $ignoreReservationId) {
                $query->whereNotIn('status', ['cancelled', 'expired'])
                    ->where('check_in', '<', $checkOut)
                    ->where('check_out', '>', $checkIn)
                    ->when($ignoreReservationId, fn ($inner) => $inner->whereKeyNot($ignoreReservationId));
            })
            ->exists();
    }

    private function freeRooms(int $roomTypeId, string $checkIn, string $checkOut, ?int $ignoreReservationId)
    {
        return Room::query()
            ->where('room_type_id', $roomTypeId)
            ->where('is_active', true)
            ->whereNotIn('status', ['maintenance', 'out_of_order'])
            ->orderBy('room_number')
            ->get()
            ->reject(fn (Room $room) => $this->roomIsBlocked($room->id, $checkIn, $checkOut, $ignoreReservationId))
            ->values();
    }

    private function occupyStay(Reservation $reservation): void
    {
        $reservation->load('details');
        if ($reservation->details->isEmpty()) {
            throw ValidationException::withMessages([
                'status' => 'Reservasi belum memiliki kamar.',
            ]);
        }

        $checkIn = $reservation->check_in->toDateString();
        $checkOut = $reservation->check_out->toDateString();
        $taken = [];

        foreach ($reservation->details as $detail) {
            $room = $detail->room_id ? Room::lockForUpdate()->find($detail->room_id) : null;
            $usable = $room
                && $room->is_active
                && (int) $room->room_type_id === (int) $detail->room_type_id
                && ! in_array($room->status, ['maintenance', 'out_of_order'], true)
                && ! in_array($room->id, $taken, true)
                && ! $this->roomIsBlocked($room->id, $checkIn, $checkOut, $reservation->id);

            if (! $usable) {
                $room = $this->freeRooms((int) $detail->room_type_id, $checkIn, $checkOut, $reservation->id)
                    ->first(fn (Room $candidate) => ! in_array($candidate->id, $taken, true));
            }

            if (! $room) {
                throw ValidationException::withMessages([
                    'status' => 'Tidak ada kamar kosong untuk check-in.',
                ]);
            }

            $detail->update(['room_id' => $room->id]);
            $room->update(['status' => 'occupied']);
            $taken[] = $room->id;
        }
    }

    /**
     * @param  array<int, int>  $roomIds
     */
    private function releaseRooms(array $roomIds, Reservation $reservation): void
    {
        foreach (Room::whereIn('id', $roomIds)->get() as $room) {
            $stillInHouse = ReservationDetail::query()
                ->where('room_id', $room->id)
                ->whereHas('reservation', fn ($query) => $query->where('status', 'checked_in')->whereKeyNot($reservation->id))
                ->exists();

            if (! $stillInHouse && $room->status === 'occupied') {
                $room->update(['status' => 'available']);
            }
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function resolveDiscount(array $data, float $subtotal, int $nights, Carbon $checkIn, ?int $ignoreReservationId): float
    {
        $manual = (float) ($data['discount_amount'] ?? 0);

        if (empty($data['promotion_id'])) {
            if ($manual - $subtotal > 0.009) {
                throw ValidationException::withMessages([
                    'discount_amount' => 'Diskon tidak boleh lebih besar dari subtotal kamar.',
                ]);
            }

            return $manual;
        }

        $promotion = Promotion::find($data['promotion_id']);
        if (! $promotion || ! $promotion->is_active) {
            throw ValidationException::withMessages([
                'promotion_id' => 'Promo tidak aktif.',
            ]);
        }

        if (($promotion->starts_at && $checkIn->lt($promotion->starts_at->copy()->startOfDay()))
            || ($promotion->ends_at && $checkIn->gt($promotion->ends_at->copy()->endOfDay()))) {
            throw ValidationException::withMessages([
                'promotion_id' => 'Promo tidak berlaku pada tanggal check-in.',
            ]);
        }

        if ($promotion->min_nights && $nights < $promotion->min_nights) {
            throw ValidationException::withMessages([
                'promotion_id' => 'Promo membutuhkan minimal '.$promotion->min_nights.' malam.',
            ]);
        }

        if ($promotion->min_amount && $subtotal + 0.009 < (float) $promotion->min_amount) {
            throw ValidationException::withMessages([
                'promotion_id' => 'Subtotal belum mencapai syarat minimal promo.',
            ]);
        }

        if ($promotion->max_uses !== null) {
            $uses = Reservation::query()
                ->where('promotion_id', $promotion->id)
                ->whereNotIn('status', ['cancelled', 'expired'])
                ->when($ignoreReservationId, fn ($query) => $query->whereKeyNot($ignoreReservationId))
                ->count();

            if ($uses >= $promotion->max_uses) {
                throw ValidationException::withMessages([
                    'promotion_id' => 'Kuota promo sudah habis.',
                ]);
            }
        }

        $promoDiscount = $promotion->discount_type === 'percentage'
            ? round($subtotal * ((float) $promotion->discount_value / 100), 2)
            : (float) $promotion->discount_value;
        $promoDiscount = min($promoDiscount, $subtotal);

        if ($manual - $promoDiscount > 0.009) {
            throw ValidationException::withMessages([
                'discount_amount' => 'Diskon tidak boleh lebih besar dari nilai promo.',
            ]);
        }

        return $manual > 0 ? $manual : $promoDiscount;
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<int, mixed>  $roomTypeIds
     */
    private function resolvePackagePrice(array $data, int $nights, Carbon $checkIn, array $roomTypeIds): float
    {
        if (empty($data['package_id'])) {
            return 0;
        }

        $package = Package::with('roomTypes')->find($data['package_id']);
        if (! $package || ! $package->is_active) {
            throw ValidationException::withMessages([
                'package_id' => 'Paket tidak aktif.',
            ]);
        }

        if (($package->starts_at && $checkIn->lt($package->starts_at->copy()->startOfDay()))
            || ($package->ends_at && $checkIn->gt($package->ends_at->copy()->endOfDay()))) {
            throw ValidationException::withMessages([
                'package_id' => 'Paket tidak berlaku pada tanggal check-in.',
            ]);
        }

        if ($package->nights && $nights !== (int) $package->nights) {
            throw ValidationException::withMessages([
                'package_id' => 'Paket ini berlaku untuk '.$package->nights.' malam.',
            ]);
        }

        $allowed = $package->roomTypes->pluck('id')->map(fn ($id) => (int) $id);
        if ($allowed->isNotEmpty()) {
            foreach ($roomTypeIds as $roomTypeId) {
                if (! $allowed->contains((int) $roomTypeId)) {
                    throw ValidationException::withMessages([
                        'package_id' => 'Tipe kamar tidak termasuk dalam paket.',
                    ]);
                }
            }
        }

        return (float) $package->price;
    }

    private function generateBookingCode(): string
    {
        do {
            $code = 'RSV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
        } while (Reservation::withTrashed()->where('booking_code', $code)->exists());

        return $code;
    }
}
