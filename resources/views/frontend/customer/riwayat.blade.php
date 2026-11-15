@extends('frontend.layouts.app')

@section('title', 'Riwayat Reservasi')

@section('content')
    <div class="min-h-screen bg-surface px-6 py-12">
        <div class="max-w-6xl mx-auto">

            <div class="mb-10">
                <p class="text-label-uppercase tracking-widest text-secondary mb-2">
                    CUSTOMER AREA
                </p>
                <h1 class="font-headline text-3xl md:text-4xl text-primary">
                    Riwayat Reservasi
                </h1>
                <p class="text-on-surface-variant mt-2">
                    Pantau semua reservasi yang pernah kamu buat di Haven Palais.
                </p>
            </div>

            @if ($reservations->isEmpty())
                <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-10 text-center">
                    <span class="material-symbols-outlined text-5xl text-secondary">
                        hotel
                    </span>
                    <h2 class="text-xl text-primary mt-4 mb-2">
                        Belum Ada Reservasi
                    </h2>
                    <p class="text-on-surface-variant mb-6">
                        Kamu belum memiliki riwayat reservasi.
                    </p>
                    <a href="{{ route('kamar.index') }}"
                        class="inline-block bg-primary text-white px-6 py-3 rounded-lg hover:opacity-90 transition">
                        Cari Kamar
                    </a>
                </div>
            @else
                <div class="space-y-5">
                    @foreach ($reservations as $reservation)
                        <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-6 shadow-sm">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">
                                <div>
                                    <p class="text-xs text-secondary tracking-wider uppercase">
                                        Kode Booking
                                    </p>
                                    <h2 class="text-lg font-semibold text-primary">
                                        {{ $reservation->booking_code }}
                                    </h2>
                                </div>

                                <span
                                    class="inline-block w-fit px-4 py-2 rounded-full text-sm font-medium
                                            {{ $reservation->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $reservation->status === 'pending_payment' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $reservation->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $reservation->status === 'expired' ? 'bg-gray-100 text-gray-700' : '' }}
                                            {{ in_array($reservation->status, ['checked_in', 'checked_out']) ? 'bg-blue-100 text-blue-800' : '' }}">
                                    {{ ucwords(str_replace('_', ' ', $reservation->status)) }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 border-t border-outline-variant/30 pt-5">
                                <div>
                                    <p class="text-xs text-secondary mb-1">Nama Tamu</p>
                                    <p class="text-primary font-medium">
                                        {{ $reservation->guest->full_name ?? '-' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs text-secondary mb-1">Check-in</p>
                                    <p class="text-primary font-medium">
                                        {{ $reservation->check_in->format('d M Y') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs text-secondary mb-1">Check-out</p>
                                    <p class="text-primary font-medium">
                                        {{ $reservation->check_out->format('d M Y') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs text-secondary mb-1">Kamar</p>
                                    @foreach ($reservation->details as $detail)
                                        <p class="text-primary font-medium">
                                            {{ $detail->roomType->name ?? 'Tipe kamar tidak tersedia' }}
                                            ({{ $detail->quantity }} kamar)
                                        </p>
                                    @endforeach
                                </div>

                                <div>
                                    <p class="text-xs text-secondary mb-1">Jumlah Tamu</p>
                                    <p class="text-primary font-medium">
                                        {{ $reservation->adults + $reservation->children }} orang
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs text-secondary mb-1">Total Pembayaran</p>
                                    <p class="text-primary font-semibold">
                                        Rp {{ number_format($reservation->total_amount, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="border-t border-outline-variant/30 mt-5 pt-5 flex justify-end">
                                <a href="{{ route('customer.reservations.show', $reservation->id) }}"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 text-white rounded-lg hover:opacity-90 transition">
                                    Lihat Detail
                                    <span class="material-symbols-outlined text-lg">
                                        arrow_forward
                                    </span>
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $reservations->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection