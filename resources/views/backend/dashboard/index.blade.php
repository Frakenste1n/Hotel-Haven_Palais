@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <span class="text-primary font-medium">Dashboard</span>
@endsection

@section('content')
    <div class="mb-6">
        <h2 class="font-display text-3xl text-primary">Selamat datang, {{ auth()->user()->name }}</h2>
        <p class="mt-1 text-sm text-on-surface-variant">Ringkasan operasional {{ $site->site_name ?: 'Haven Palais' }} hari ini.</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @include('backend.components.stat-card', ['label' => 'Reservasi Hari Ini', 'value' => $stats['reservations_today'], 'icon' => 'event', 'tone' => 'primary'])
        @include('backend.components.stat-card', ['label' => 'Kedatangan Hari Ini', 'value' => $stats['arrivals_today'], 'icon' => 'flight_land', 'tone' => 'secondary'])
        @include('backend.components.stat-card', ['label' => 'Tamu In-House', 'value' => $stats['in_house'], 'icon' => 'hotel', 'tone' => 'surface'])
        @include('backend.components.stat-card', ['label' => 'Pendapatan Hari Ini', 'value' => 'Rp ' . number_format($stats['revenue_today'], 0, ',', '.'), 'icon' => 'payments', 'tone' => 'secondary', 'hint' => 'Bulan ini: Rp ' . number_format($monthlyRevenue, 0, ',', '.')])
        @include('backend.components.stat-card', ['label' => 'Kamar Tersedia', 'value' => $stats['rooms_available'], 'icon' => 'door_front', 'tone' => 'surface'])
        @include('backend.components.stat-card', ['label' => 'Kamar Terisi', 'value' => $stats['rooms_occupied'], 'icon' => 'bed', 'tone' => 'primary'])
        @include('backend.components.stat-card', ['label' => 'Menunggu Verifikasi', 'value' => $stats['pending_payments'], 'icon' => 'pending_actions', 'tone' => 'danger'])
        @include('backend.components.stat-card', ['label' => 'Pesan Baru', 'value' => $stats['new_messages'], 'icon' => 'mail', 'tone' => 'danger', 'hint' => $stats['pending_reviews'] . ' ulasan menunggu moderasi'])
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-3">
        <div class="chart-card rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-5 shadow-soft xl:col-span-2">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="font-display text-xl text-primary">Pendapatan 7 Hari</h3>
                    <p class="text-xs text-on-surface-variant">Total pembayaran berstatus paid</p>
                </div>
                <a href="{{ route('backend.reports-analytics.index', ['tab' => 'revenue']) }}" class="text-sm font-semibold text-secondary hover:underline">Lihat laporan</a>
            </div>
            <canvas id="revenueChart" height="120"></canvas>
        </div>

        <div class="chart-card rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-5 shadow-soft">
            <h3 class="font-display text-xl text-primary">Status Okupansi</h3>
            <p class="mb-4 text-xs text-on-surface-variant">Distribusi status unit kamar</p>
            <canvas id="occupancyChart" height="180"></canvas>
        </div>
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-2">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-5 shadow-soft">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="font-display text-xl text-primary">Reservasi Terbaru</h3>
                <a href="{{ route('backend.booking-management.index', ['tab' => 'reservations']) }}" class="text-sm font-semibold text-secondary hover:underline">Semua</a>
            </div>
            @if($recentReservations->isEmpty())
                @include('backend.components.empty-state', ['title' => 'Belum ada reservasi', 'description' => 'Reservasi baru akan muncul di sini.', 'icon' => 'event_busy'])
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-outline-variant/50 text-left text-xs uppercase tracking-wide text-on-surface-variant">
                                <th class="py-2 pr-3">Kode</th>
                                <th class="py-2 pr-3">Tamu</th>
                                <th class="py-2 pr-3">Check-in</th>
                                <th class="py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentReservations as $reservation)
                                <tr class="border-b border-outline-variant/30">
                                    <td class="py-3 pr-3 font-semibold text-primary">
                                        <a href="{{ route('backend.booking-management.index', ['tab' => 'reservations', 'q' => $reservation->booking_code]) }}" class="hover:underline">{{ $reservation->booking_code }}</a>
                                    </td>
                                    <td class="py-3 pr-3">{{ $reservation->guest?->full_name ?? $reservation->user?->name }}</td>
                                    <td class="py-3 pr-3">{{ $reservation->check_in?->format('d M Y') }}</td>
                                    <td class="py-3">@include('backend.components.status-badge', ['status' => $reservation->status])</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-5 shadow-soft">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="font-display text-xl text-primary">Transaksi Terbaru</h3>
                <a href="{{ route('backend.payment-management.index', ['tab' => 'transactions']) }}" class="text-sm font-semibold text-secondary hover:underline">Semua</a>
            </div>
            @if($recentPayments->isEmpty())
                @include('backend.components.empty-state', ['title' => 'Belum ada transaksi', 'description' => 'Pembayaran akan muncul di sini.', 'icon' => 'receipt_long'])
            @else
                <div class="space-y-3">
                    @foreach($recentPayments as $payment)
                        <a href="{{ route('backend.payment-management.index', ['tab' => 'transactions', 'q' => $payment->invoice_number]) }}"
                            class="flex items-center justify-between rounded-xl border border-outline-variant/40 px-3 py-3 hover:bg-surface-container-low">
                            <div>
                                <p class="text-sm font-semibold text-primary">{{ $payment->invoice_number }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $payment->paymentMethod?->name }} · {{ $payment->reservation?->booking_code }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                                @include('backend.components.status-badge', ['status' => $payment->status])
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    const revenueLabels = {!! json_encode($revenueChart->pluck('label'), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!};
    const revenueValues = {!! json_encode($revenueChart->pluck('total'), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!};
    const occupancy = {!! json_encode($occupancy, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!};

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: revenueLabels,
            datasets: [{
                label: 'Pendapatan',
                data: revenueValues,
                borderColor: '#725b38',
                backgroundColor: 'rgba(114,91,56,0.12)',
                fill: true,
                tension: 0.35,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { ticks: { callback: (v) => 'Rp ' + new Intl.NumberFormat('id-ID').format(v) } }
            }
        }
    });

    new Chart(document.getElementById('occupancyChart'), {
        type: 'doughnut',
        data: {
            labels: ['Available', 'Occupied', 'Cleaning', 'Maintenance'],
            datasets: [{
                data: [occupancy.available, occupancy.occupied, occupancy.cleaning, occupancy.maintenance],
                backgroundColor: ['#1b2a32', '#725b38', '#fedeb2', '#ffdad6'],
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endpush
