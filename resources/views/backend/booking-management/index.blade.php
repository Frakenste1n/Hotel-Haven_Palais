@extends('backend.layouts.app')

@section('title', 'Booking Management')

@section('breadcrumb')
    <a href="{{ route('backend.dashboard') }}" class="hover:text-primary">Dashboard</a>
    <span class="mx-2 text-outline-variant">/</span>
    <span class="font-medium text-primary">Booking Management</span>
@endsection

@push('styles')
<style>
    .tab-btn.active {
        background-color: #1b2a32;
        color: white;
    }
    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    @include('backend.components.page-header', [
        'title' => 'Booking Management',
        'subtitle' => 'Kelola reservasi, pelanggan, tamu, dan operasi front desk dalam satu halaman terpadu.',
    ])

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-2 border-b border-outline-variant/40 pb-1">
        @allows('reservations.view')
        <button onclick="switchTab('reservations')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'reservations' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">event_available</span>
            Reservations
        </button>
        @endallows
        @allows('customers.view')
        <button onclick="switchTab('customers')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'customers' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">people</span>
            Customers
        </button>
        @endallows
        @allows('guests.view')
        <button onclick="switchTab('guests')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'guests' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">person</span>
            Guests
        </button>
        @endallows
        @allows('front_desk.view')
        <button onclick="switchTab('front-desk')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'front-desk' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">room_service</span>
            Front Desk
        </button>
        @endallows
    </div>

    <!-- Reservations Tab -->
    <div id="tab-reservations" class="tab-content {{ $activeTab === 'reservations' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Reservations</h3>
                <button type="button" data-fi-create data-modal="reservation-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Reservasi
                </button>
            </div>

            <div class="mb-4 flex flex-wrap gap-3">
                <form method="GET" action="{{ route('backend.booking-management.index') }}" class="flex flex-1 items-center gap-2">
                    <input type="hidden" name="tab" value="reservations">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari booking code, nama..." class="flex-1 rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <button type="submit" class="rounded-lg bg-primary-container px-4 py-2 text-sm font-semibold text-on-primary hover:bg-primary">Cari</button>
                </form>
                <select onchange="window.location.href='{{ route('backend.booking-management.index') }}?tab=reservations&status='+this.value" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <option value="">Semua Status</option>
                    <option value="pending_payment" {{ request('status') === 'pending_payment' ? 'selected' : '' }}>Pending Payment</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="checked_in" {{ request('status') === 'checked_in' ? 'selected' : '' }}>Checked In</option>
                    <option value="checked_out" {{ request('status') === 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Booking Code</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Customer</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Check-in/Out</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Total</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($reservations as $reservation)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-mono font-medium text-primary">{{ $reservation->booking_code }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $reservation->user->name ?? $reservation->guest->full_name ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface-variant text-xs">
                                    {{ $reservation->check_in->format('d M') }} - {{ $reservation->check_out->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3 text-on-surface">Rp {{ number_format($reservation->total_amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusColors = [
                                            'pending_payment' => 'bg-yellow-100 text-yellow-800',
                                            'confirmed' => 'bg-blue-100 text-blue-800',
                                            'checked_in' => 'bg-green-100 text-green-800',
                                            'checked_out' => 'bg-gray-100 text-gray-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                            'expired' => 'bg-orange-100 text-orange-800',
                                        ];
                                        $statusLabel = [
                                            'pending_payment' => 'Pending Payment',
                                            'confirmed' => 'Confirmed',
                                            'checked_in' => 'Checked In',
                                            'checked_out' => 'Checked Out',
                                            'cancelled' => 'Cancelled',
                                            'expired' => 'Expired',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center gap-1 rounded-full {{ $statusColors[$reservation->status] ?? 'bg-gray-100 text-gray-800' }} px-2.5 py-1 text-xs font-semibold">
                                        {{ $statusLabel[$reservation->status] ?? $reservation->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary">
                                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        </button>
                                        <button type="button" data-fi-edit data-modal="reservation-modal" data-action="{{ route('backend.booking-management.update-reservation', $reservation) }}" data-title="Edit Reservasi" data-record='{!! json_encode(["user_id" => $reservation->user_id, "guest_id" => $reservation->guest_id, "promotion_id" => $reservation->promotion_id, "package_id" => $reservation->package_id, "check_in" => optional($reservation->check_in)->format("Y-m-d"), "check_out" => optional($reservation->check_out)->format("Y-m-d"), "adults" => $reservation->adults, "children" => $reservation->children, "discount_amount" => $reservation->discount_amount, "tax_amount" => $reservation->tax_amount, "extra_fee" => $reservation->extra_fee, "status" => $reservation->status, "special_requests" => $reservation->special_requests, "details" => $reservation->details->map(fn ($detail) => ["room_type_id" => $detail->room_type_id, "quantity" => $detail->quantity, "price_per_night" => $detail->price_per_night, "guests_count" => $detail->guests_count])->values()], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.booking-management.destroy-reservation', $reservation) }}" data-confirm="Reservasi akan dihapus permanen." data-confirm-title="Hapus reservasi?" data-confirm-text="Hapus" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg p-2 text-error hover:bg-error-container">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada reservasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($reservations->hasPages())
                <div class="mt-4 flex justify-center">{{ $reservations->links() }}</div>
            @endif
        </div>
    </div>

    <!-- Customers Tab -->
    <div id="tab-customers" class="tab-content {{ $activeTab === 'customers' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Customers</h3>
                <button type="button" data-fi-create data-modal="customer-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Customer
                </button>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Email</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Telepon</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Kota</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($customers as $customer)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $customer->name }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $customer->email }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $customer->phone ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $customer->customerProfile->city ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @if($customer->is_active)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="customer-modal" data-action="{{ route('backend.booking-management.update-customer', $customer) }}" data-title="Edit Customer" data-record='{!! json_encode(["name" => $customer->name, "email" => $customer->email, "phone" => $customer->phone, "address" => $customer->customerProfile->address ?? null, "city" => $customer->customerProfile->city ?? null, "country" => $customer->customerProfile->country ?? null, "is_active" => (bool) $customer->is_active], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.booking-management.destroy-customer', $customer) }}" data-confirm="Customer akan dihapus permanen." data-confirm-title="Hapus customer?" data-confirm-text="Hapus" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg p-2 text-error hover:bg-error-container">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada customer.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($customers->hasPages())
                <div class="mt-4 flex justify-center">{{ $customers->links() }}</div>
            @endif
        </div>
    </div>

    <!-- Guests Tab -->
    <div id="tab-guests" class="tab-content {{ $activeTab === 'guests' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Guests</h3>
                <button type="button" data-fi-create data-modal="guest-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Guest
                </button>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama Lengkap</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Email</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Telepon</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">ID Number</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($guests as $guest)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $guest->full_name }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $guest->email ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $guest->phone ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $guest->id_number ?? '-' }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="guest-modal" data-action="{{ route('backend.booking-management.update-guest', $guest) }}" data-title="Edit Tamu" data-record='{!! json_encode(["user_id" => $guest->user_id, "full_name" => $guest->full_name, "email" => $guest->email, "phone" => $guest->phone, "id_type" => $guest->id_type, "id_number" => $guest->id_number, "address" => $guest->address, "nationality" => $guest->nationality, "date_of_birth" => optional($guest->date_of_birth)->format("Y-m-d"), "gender" => $guest->gender, "notes" => $guest->notes], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.booking-management.destroy-guest', $guest) }}" data-confirm="Data tamu akan dihapus." data-confirm-title="Hapus tamu?" data-confirm-text="Hapus" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg p-2 text-error hover:bg-error-container">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Belum ada guest.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($guests->hasPages())
                <div class="mt-4 flex justify-center">{{ $guests->links() }}</div>
            @endif
        </div>
    </div>

    <!-- Front Desk Tab -->
    <div id="tab-front-desk" class="tab-content {{ $activeTab === 'front-desk' ? 'active' : '' }}">
        <div class="space-y-6">
            <!-- Arrivals Today -->
            <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                <h3 class="mb-4 text-lg font-semibold text-primary">Arrivals Today ({{ $arrivals->count() }})</h3>
                @if($arrivals->isEmpty())
                    <p class="text-center text-on-surface-variant">Tidak ada check-in hari ini.</p>
                @else
                    <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                        <table class="w-full text-sm">
                            <thead class="bg-surface-container">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-on-surface">Booking Code</th>
                                    <th class="px-4 py-3 text-left font-semibold text-on-surface">Customer</th>
                                    <th class="px-4 py-3 text-left font-semibold text-on-surface">Room Type</th>
                                    <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                                    <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/40">
                                @foreach($arrivals as $reservation)
                                    <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                        <td class="px-4 py-3 font-mono font-medium text-primary">{{ $reservation->booking_code }}</td>
                                        <td class="px-4 py-3 text-on-surface">{{ $reservation->user->name ?? $reservation->guest->full_name }}</td>
                                        <td class="px-4 py-3 text-on-surface-variant">{{ $reservation->details->first()->roomType->name ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-800">{{ $reservation->status }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <form method="POST" action="{{ route('backend.booking-management.check-in', $reservation) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="rounded-lg bg-green-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-green-700">Check-in</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- In-House -->
            <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                <h3 class="mb-4 text-lg font-semibold text-primary">In-House Guests ({{ $inHouse->count() }})</h3>
                @if($inHouse->isEmpty())
                    <p class="text-center text-on-surface-variant">Tidak ada tamu in-house.</p>
                @else
                    <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                        <table class="w-full text-sm">
                            <thead class="bg-surface-container">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-on-surface">Booking Code</th>
                                    <th class="px-4 py-3 text-left font-semibold text-on-surface">Customer</th>
                                    <th class="px-4 py-3 text-left font-semibold text-on-surface">Room</th>
                                    <th class="px-4 py-3 text-left font-semibold text-on-surface">Check-in</th>
                                    <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/40">
                                @foreach($inHouse as $reservation)
                                    <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                        <td class="px-4 py-3 font-mono font-medium text-primary">{{ $reservation->booking_code }}</td>
                                        <td class="px-4 py-3 text-on-surface">{{ $reservation->user->name ?? $reservation->guest->full_name }}</td>
                                        <td class="px-4 py-3 text-on-surface-variant">{{ $reservation->details->first()->room->room_number ?? '-' }}</td>
                                        <td class="px-4 py-3 text-on-surface">{{ $reservation->checked_in_at?->format('d M Y H:i') }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <form method="POST" action="{{ route('backend.booking-management.check-out', $reservation) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="rounded-lg bg-orange-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-orange-700">Check-out</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($inHouse->hasPages())
                        <div class="mt-4 flex justify-center">{{ $inHouse->links() }}</div>
                    @endif
                @endif
            </div>

            <!-- Departures Today -->
            <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                <h3 class="mb-4 text-lg font-semibold text-primary">Departures Today ({{ $departures->count() }})</h3>
                @if($departures->isEmpty())
                    <p class="text-center text-on-surface-variant">Tidak ada check-out hari ini.</p>
                @else
                    <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                        <table class="w-full text-sm">
                            <thead class="bg-surface-container">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-on-surface">Booking Code</th>
                                    <th class="px-4 py-3 text-left font-semibold text-on-surface">Customer</th>
                                    <th class="px-4 py-3 text-left font-semibold text-on-surface">Room</th>
                                    <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/40">
                                @foreach($departures as $reservation)
                                    <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                        <td class="px-4 py-3 font-mono font-medium text-primary">{{ $reservation->booking_code }}</td>
                                        <td class="px-4 py-3 text-on-surface">{{ $reservation->user->name ?? $reservation->guest->full_name }}</td>
                                        <td class="px-4 py-3 text-on-surface-variant">{{ $reservation->details->first()->room->room_number ?? '-' }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <form method="POST" action="{{ route('backend.booking-management.check-out', $reservation) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="rounded-lg bg-orange-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-orange-700">Check-out</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Reservation Modal -->
<div id="reservation-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="max-h-[90vh] w-full max-w-3xl overflow-y-auto rounded-2xl bg-white p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Reservasi</h3>
            <button type="button" data-fi-close class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container"><span class="material-symbols-outlined">close</span></button>
        </div>
        <form id="reservation-form" method="POST" action="{{ route('backend.booking-management.store-reservation') }}" data-loading>
            @csrf
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="fi-label">Pemesan <span class="text-error">*</span></label>
                    <select name="user_id" required class="fi-input">
                        <option value="">Pilih user</option>
                        @foreach($userOptions as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} — {{ $user->email }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="fi-label">Tamu</label>
                    <select name="guest_id" class="fi-input">
                        <option value="">Opsional</option>
                        @foreach($guestOptions as $guestOption)
                            <option value="{{ $guestOption->id }}">{{ $guestOption->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="fi-label">Check-in <span class="text-error">*</span></label>
                    <input type="date" name="check_in" required class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Check-out <span class="text-error">*</span></label>
                    <input type="date" name="check_out" required class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Dewasa <span class="text-error">*</span></label>
                    <input type="number" name="adults" min="1" value="1" required class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Anak</label>
                    <input type="number" name="children" min="0" value="0" class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Promo</label>
                    <select name="promotion_id" class="fi-input">
                        <option value="">Tidak ada</option>
                        @foreach($promotionOptions as $promotion)
                            <option value="{{ $promotion->id }}">{{ $promotion->code }} — {{ $promotion->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="fi-label">Paket</label>
                    <select name="package_id" class="fi-input">
                        <option value="">Tidak ada</option>
                        @foreach($packageOptions as $package)
                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="fi-label">Diskon</label>
                    <input type="number" name="discount_amount" min="0" value="0" class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Pajak</label>
                    <input type="number" name="tax_amount" min="0" value="0" class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Biaya tambahan</label>
                    <input type="number" name="extra_fee" min="0" value="0" class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Status</label>
                    <select name="status" class="fi-input">
                        @foreach(['pending_payment','confirmed','checked_in','checked_out','cancelled','expired'] as $status)
                            <option value="{{ $status }}">{{ str_replace('_', ' ', $status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="fi-label">Permintaan khusus</label>
                    <textarea name="special_requests" rows="2" class="fi-input"></textarea>
                </div>
            </div>
            <div class="mt-4 rounded-xl border border-outline-variant/50 p-4">
                <div class="mb-3 flex items-center justify-between">
                    <h4 class="text-sm font-semibold text-primary">Detail kamar</h4>
                    <button type="button" id="add-reservation-detail" class="text-sm font-semibold text-secondary">Tambah baris</button>
                </div>
                <div id="reservation-details" class="space-y-3"></div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" data-fi-close class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold">Batal</button>
                <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>
<template id="reservation-detail-template">
    <div class="detail-row grid gap-3 rounded-lg bg-surface-container-low p-3 md:grid-cols-4">
        <div class="md:col-span-2">
            <label class="fi-label">Tipe kamar</label>
            <select data-name="room_type_id" required class="fi-input">
                <option value="">Pilih tipe</option>
                @foreach($roomTypeOptions as $roomType)
                    <option value="{{ $roomType->id }}" data-price="{{ $roomType->base_price }}">{{ $roomType->name }} — Rp {{ number_format($roomType->base_price, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="fi-label">Qty</label>
            <input data-name="quantity" type="number" min="1" value="1" required class="fi-input">
        </div>
        <div>
            <label class="fi-label">Harga / malam</label>
            <input data-name="price_per_night" type="number" min="0" step="0.01" required class="fi-input">
        </div>
        <div>
            <label class="fi-label">Jumlah tamu</label>
            <input data-name="guests_count" type="number" min="1" value="1" class="fi-input">
        </div>
    </div>
</template>

<!-- Guest Modal -->
<div id="guest-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Tamu</h3>
            <button type="button" data-fi-close class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container"><span class="material-symbols-outlined">close</span></button>
        </div>
        <form method="POST" action="{{ route('backend.booking-management.store-guest') }}" data-loading>
            @csrf
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="fi-label">Nama lengkap <span class="text-error">*</span></label>
                    <input type="text" name="full_name" required class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Email</label>
                    <input type="email" name="email" class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Telepon</label>
                    <input type="text" name="phone" class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Jenis identitas</label>
                    <input type="text" name="id_type" class="fi-input" placeholder="KTP / Paspor">
                </div>
                <div>
                    <label class="fi-label">Nomor identitas</label>
                    <input type="text" name="id_number" class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Kewarganegaraan</label>
                    <input type="text" name="nationality" class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Tanggal lahir</label>
                    <input type="date" name="date_of_birth" class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Gender</label>
                    <select name="gender" class="fi-input">
                        <option value="">Tidak diisi</option>
                        <option value="male">Laki-laki</option>
                        <option value="female">Perempuan</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="fi-label">Akun terkait</label>
                    <select name="user_id" class="fi-input">
                        <option value="">Tidak ada</option>
                        @foreach($userOptions as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="fi-label">Alamat</label>
                    <input type="text" name="address" class="fi-input">
                </div>
                <div class="sm:col-span-2">
                    <label class="fi-label">Catatan</label>
                    <textarea name="notes" rows="2" class="fi-input"></textarea>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" data-fi-close class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold">Batal</button>
                <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Customer Modal -->
<div id="customer-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Customer</h3>
            <button onclick="document.getElementById('customer-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.booking-management.store-customer') }}" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Nama <span class="text-error">*</span></label>
                        <input type="text" name="name" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Email <span class="text-error">*</span></label>
                        <input type="email" name="email" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Telepon</label>
                        <input type="text" name="phone" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Password <span class="text-error">*</span></label>
                        <input type="password" name="password" data-required-on-create required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <p class="fi-help">Saat edit, kosongkan jika password tidak diubah.</p>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Konfirmasi password</label>
                        <input type="password" name="password_confirmation" data-required-on-create required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Alamat</label>
                    <input type="text" name="address" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Kota</label>
                        <input type="text" name="city" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Negara</label>
                        <input type="text" name="country" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="cust_is_active" checked class="rounded border-outline-variant text-primary focus:ring-primary">
                    <label for="cust_is_active" class="text-sm font-medium text-on-surface">Aktif</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('customer-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
                <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function switchTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.classList.add('text-on-surface-variant', 'hover:bg-surface-container-low');
    });
    
    document.getElementById('tab-' + tabName).classList.add('active');
    const activeBtn = document.querySelector(`button[onclick="switchTab('${tabName}')"]`);
    if (activeBtn) {
        activeBtn.classList.add('active');
        activeBtn.classList.remove('text-on-surface-variant', 'hover:bg-surface-container-low');
    }
    
    const url = new URL(window.location);
    url.searchParams.set('tab', tabName);
    window.history.replaceState({}, '', url);
}

const detailRoot = document.getElementById('reservation-details');
const detailTemplate = document.getElementById('reservation-detail-template');

function renderReservationDetails(rows) {
    if (!detailRoot || !detailTemplate) return;
    detailRoot.innerHTML = '';
    (rows.length ? rows : [{}]).forEach((row, index) => {
        const node = detailTemplate.content.firstElementChild.cloneNode(true);
        node.querySelectorAll('[data-name]').forEach((field) => {
            const key = field.dataset.name;
            field.name = `details[${index}][${key}]`;
            if (row[key] !== undefined && row[key] !== null) field.value = row[key];
        });
        const typeSelect = node.querySelector('[data-name="room_type_id"]');
        typeSelect?.addEventListener('change', () => {
            const price = typeSelect.selectedOptions[0]?.dataset.price;
            const priceInput = node.querySelector('[data-name="price_per_night"]');
            if (price && priceInput && !priceInput.value) priceInput.value = price;
        });
        detailRoot.appendChild(node);
    });
}

document.getElementById('add-reservation-detail')?.addEventListener('click', () => {
    const current = [...detailRoot.querySelectorAll('.detail-row')].map((row) => {
        const data = {};
        row.querySelectorAll('[data-name]').forEach((field) => { data[field.dataset.name] = field.value; });
        return data;
    });
    current.push({});
    renderReservationDetails(current);
});

document.getElementById('reservation-form')?.addEventListener('fi:filled', (event) => {
    renderReservationDetails(event.detail.details || [{}]);
});
document.getElementById('reservation-form')?.addEventListener('fi:reset', () => renderReservationDetails([{}]));
renderReservationDetails([{}]);
</script>
@endpush
@endsection
