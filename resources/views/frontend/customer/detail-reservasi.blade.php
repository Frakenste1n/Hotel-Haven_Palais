
@extends('frontend.layouts.app')

@section('title', 'Detail Reservasi')

@section('content')
<div class="min-h-screen bg-surface px-6 py-12">
    <div class="max-w-6xl mx-auto">

        <a href="{{ route('customer.reservations.index') }}"
            class="inline-flex items-center gap-2 text-primary hover:text-secondary mb-8">
            <span class="material-symbols-outlined text-xl">arrow_back</span>
            Kembali ke Riwayat
        </a>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <p class="text-xs text-secondary tracking-widest uppercase mb-2">
                    Reservation Details
                </p>
                <h1 class="text-3xl font-headline text-primary">
                    Detail Reservasi
                </h1>
                <p class="text-on-surface-variant mt-2">
                    Kode Booking: {{ $reservation->booking_code }}
                </p>
            </div>

            <span class="w-fit px-4 py-2 rounded-full text-sm font-medium
                {{ $reservation->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                {{ $reservation->status === 'pending_payment' ? 'bg-yellow-100 text-yellow-800' : '' }}
                {{ $reservation->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                {{ $reservation->status === 'expired' ? 'bg-gray-100 text-gray-700' : '' }}
                {{ in_array($reservation->status, ['checked_in', 'checked_out']) ? 'bg-blue-100 text-blue-800' : '' }}">
                {{ ucwords(str_replace('_', ' ', $reservation->status)) }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 space-y-6">

                <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-6">
                    <h2 class="text-xl font-semibold text-primary mb-5">
                        Informasi Menginap
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs text-secondary mb-1">Check-in</p>
                            <p class="text-primary font-medium">
                                {{ $reservation->check_in->format('d F Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-secondary mb-1">Check-out</p>
                            <p class="text-primary font-medium">
                                {{ $reservation->check_out->format('d F Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-secondary mb-1">Jumlah Malam</p>
                            <p class="text-primary font-medium">
                                {{ $reservation->details->sum('nights') }} malam
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-secondary mb-1">Jumlah Tamu</p>
                            <p class="text-primary font-medium">
                                {{ $reservation->adults }} dewasa,
                                {{ $reservation->children }} anak
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-6">
                    <h2 class="text-xl font-semibold text-primary mb-5">
                        Informasi Tamu
                    </h2>

                    <p class="text-xs text-secondary mb-1">Nama Lengkap</p>
                    <p class="text-primary font-medium">
                        {{ $reservation->guest->full_name ?? '-' }}
                    </p>

                    <div class="mt-5">
                        <p class="text-xs text-secondary mb-1">Permintaan Khusus</p>
                        <p class="text-primary">
                            {{ $reservation->special_requests ?: 'Tidak ada permintaan khusus.' }}
                        </p>
                    </div>
                </div>

                <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-6">
                    <h2 class="text-xl font-semibold text-primary mb-5">
                        Detail Kamar
                    </h2>

                    @foreach ($reservation->details as $detail)
                        <div class="border-b border-outline-variant/30 last:border-0 py-4 first:pt-0 last:pb-0">
                            <p class="font-semibold text-primary">
                                {{ $detail->roomType->name ?? 'Tipe kamar tidak tersedia' }}
                            </p>

                            <div class="text-sm text-on-surface-variant mt-2 space-y-1">
                                <p>Nomor kamar: {{ $detail->room->room_number ?? 'Belum ditentukan' }}</p>
                                <p>Jumlah kamar: {{ $detail->quantity }}</p>
                                <p>Harga per malam: Rp {{ number_format($detail->price_per_night, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="space-y-6">

                <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-6">
                    <h2 class="text-xl font-semibold text-primary mb-5">
                        Rincian Biaya
                    </h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between gap-4">
                            <span class="text-on-surface-variant">Subtotal</span>
                            <span class="text-primary">
                                Rp {{ number_format($reservation->subtotal, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="text-on-surface-variant">Diskon</span>
                            <span class="text-primary">
                                - Rp {{ number_format($reservation->discount_amount, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="text-on-surface-variant">Pajak</span>
                            <span class="text-primary">
                                Rp {{ number_format($reservation->tax_amount, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="text-on-surface-variant">Biaya Tambahan</span>
                            <span class="text-primary">
                                Rp {{ number_format($reservation->extra_fee, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="border-t border-outline-variant/40 pt-4 flex justify-between gap-4">
                            <span class="font-semibold text-primary">Total</span>
                            <span class="font-bold text-primary">
                                Rp {{ number_format($reservation->total_amount, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-6">
                    <h2 class="text-xl font-semibold text-primary mb-5">
                        Riwayat Pembayaran
                    </h2>

                    @forelse ($reservation->payments as $payment)
                        <div class="border-b border-outline-variant/30 last:border-0 py-3 first:pt-0 last:pb-0">
                            <p class="font-medium text-primary">
                                {{ $payment->invoice_number ?? 'Pembayaran' }}
                            </p>

                            <p class="text-sm text-on-surface-variant mt-1">
                                {{ $payment->paymentMethod->name ?? 'Metode tidak tersedia' }}
                            </p>

                            <p class="text-sm text-primary mt-1">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </p>

                            <p class="text-xs text-secondary mt-1">
                                {{ ucwords(str_replace('_', ' ', $payment->status)) }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-on-surface-variant">
                            Belum ada transaksi pembayaran.
                        </p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
