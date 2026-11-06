@extends('backend.layouts.app')

@section('title', 'Reports & Analytics')

@section('breadcrumb')
    <a href="{{ route('backend.dashboard') }}" class="hover:text-primary">Dashboard</a>
    <span class="mx-2 text-outline-variant">/</span>
    <span class="font-medium text-primary">Reports & Analytics</span>
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
        'title' => 'Reports & Analytics',
        'subtitle' => 'Lihat laporan dan analisis data operasional hotel dalam satu halaman terpadu.',
    ])

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-2 border-b border-outline-variant/40 pb-1">
        @allows('reports.view')
        <button onclick="switchTab('overview')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'overview' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">dashboard</span>
            Overview
        </button>
        @endallows
        @allows('reservations.view')
        <button onclick="switchTab('reservations')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'reservations' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">event_available</span>
            Reservations
        </button>
        @endallows
        @allows('reports.view')
        <button onclick="switchTab('revenue')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'revenue' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">payments</span>
            Revenue
        </button>
        @endallows
        @allows('rooms.view')
        <button onclick="switchTab('occupancy')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'occupancy' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">hotel</span>
            Occupancy
        </button>
        @endallows
        @allows('payments.view')
        <button onclick="switchTab('payments')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'payments' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">receipt_long</span>
            Payments
        </button>
        @endallows
        @allows('activity_logs.view')
        <button onclick="switchTab('activity')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'activity' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">history</span>
            Activity Logs
        </button>
        @endallows
    </div>

    @allows('reports.view')
    <!-- Overview Tab -->
    <div id="tab-overview" class="tab-content {{ $activeTab === 'overview' ? 'active' : '' }}">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-on-surface-variant">Total Reservations</p>
                        <p class="mt-2 text-3xl font-bold text-primary">{{ $summary['total_reservations'] }}</p>
                    </div>
                    <span class="material-symbols-outlined text-[40px] text-primary-container">event_available</span>
                </div>
            </div>
            <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-on-surface-variant">Confirmed</p>
                        <p class="mt-2 text-3xl font-bold text-green-600">{{ $summary['confirmed_reservations'] }}</p>
                    </div>
                    <span class="material-symbols-outlined text-[40px] text-green-100">check_circle</span>
                </div>
            </div>
            <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-on-surface-variant">Total Revenue</p>
                        <p class="mt-2 text-3xl font-bold text-primary">Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</p>
                    </div>
                    <span class="material-symbols-outlined text-[40px] text-yellow-100">payments</span>
                </div>
            </div>
            <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-on-surface-variant">Occupancy Rate</p>
                        <p class="mt-2 text-3xl font-bold text-blue-600">{{ $summary['occupancy_rate'] }}%</p>
                    </div>
                    <span class="material-symbols-outlined text-[40px] text-blue-100">hotel</span>
                </div>
            </div>
        </div>
    </div>
    @endallows

    @allows('reservations.view')
    <!-- Reservations Tab -->
    <div id="tab-reservations" class="tab-content {{ $activeTab === 'reservations' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Reservation Report</h3>
                <form method="GET" action="{{ route('backend.reports-analytics.index') }}" class="flex items-center gap-2">
                    <input type="hidden" name="tab" value="reservations">
                    <input type="date" name="from" value="{{ request('from') }}" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <span class="text-on-surface-variant">to</span>
                    <input type="date" name="to" value="{{ request('to') }}" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <button type="submit" class="rounded-lg bg-primary-container px-4 py-2 text-sm font-semibold text-on-primary hover:bg-primary">Filter</button>
                </form>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Booking Code</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Customer</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Check-in</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Check-out</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Total</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($reservations as $reservation)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-mono font-medium text-primary">{{ $reservation->booking_code }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $reservation->user->name ?? $reservation->guest->full_name ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $reservation->check_in->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $reservation->check_out->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-on-surface">Rp {{ number_format($reservation->total_amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-800">{{ $reservation->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Tidak ada data reservasi.</td>
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
    @endallows

    @allows('reports.view')
    <!-- Revenue Tab -->
    <div id="tab-revenue" class="tab-content {{ $activeTab === 'revenue' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Revenue Report</h3>
                    <p class="text-sm text-on-surface-variant">Total Revenue: Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <form method="GET" action="{{ route('backend.reports-analytics.index') }}" class="flex items-center gap-2">
                    <input type="hidden" name="tab" value="revenue">
                    <input type="date" name="from" value="{{ request('from') }}" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <span class="text-on-surface-variant">to</span>
                    <input type="date" name="to" value="{{ request('to') }}" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <button type="submit" class="rounded-lg bg-primary-container px-4 py-2 text-sm font-semibold text-on-primary hover:bg-primary">Filter</button>
                </form>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Date</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($revenues as $revenue)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 text-on-surface">{{ $revenue->date }}</td>
                                <td class="px-4 py-3 text-right font-medium text-primary">Rp {{ number_format($revenue->total, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 py-8 text-center text-on-surface-variant">Tidak ada data revenue.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($revenues->hasPages())
                <div class="mt-4 flex justify-center">{{ $revenues->links() }}</div>
            @endif
        </div>
    </div>
    @endallows

    @allows('rooms.view')
    <!-- Occupancy Tab -->
    <div id="tab-occupancy" class="tab-content {{ $activeTab === 'occupancy' ? 'active' : '' }}">
        <div class="space-y-6">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                    <p class="text-sm text-on-surface-variant">Total Rooms</p>
                    <p class="mt-2 text-3xl font-bold text-primary">{{ $occupancyStats['total'] }}</p>
                </div>
                <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                    <p class="text-sm text-on-surface-variant">Available</p>
                    <p class="mt-2 text-3xl font-bold text-green-600">{{ $occupancyStats['available'] }}</p>
                </div>
                <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                    <p class="text-sm text-on-surface-variant">Occupied</p>
                    <p class="mt-2 text-3xl font-bold text-blue-600">{{ $occupancyStats['occupied'] }}</p>
                </div>
                <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                    <p class="text-sm text-on-surface-variant">Cleaning</p>
                    <p class="mt-2 text-3xl font-bold text-yellow-600">{{ $occupancyStats['cleaning'] }}</p>
                </div>
                <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                    <p class="text-sm text-on-surface-variant">Maintenance</p>
                    <p class="mt-2 text-3xl font-bold text-red-600">{{ $occupancyStats['maintenance'] }}</p>
                </div>
            </div>

            <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
                <h3 class="mb-4 text-lg font-semibold text-primary">Room Status</h3>
                <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                    <table class="w-full text-sm">
                        <thead class="bg-surface-container">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-on-surface">Room Number</th>
                                <th class="px-4 py-3 text-left font-semibold text-on-surface">Type</th>
                                <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/40">
                            @foreach($rooms as $room)
                                <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                    <td class="px-4 py-3 font-medium text-on-surface">{{ $room->room_number }}</td>
                                    <td class="px-4 py-3 text-on-surface-variant">{{ $room->roomType->name ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        @if($room->status === 'available')
                                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Available</span>
                                        @elseif($room->status === 'occupied')
                                            <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-800">Occupied</span>
                                        @elseif($room->status === 'cleaning')
                                            <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-semibold text-yellow-800">Cleaning</span>
                                        @else
                                            <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-800">{{ $room->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endallows

    @allows('payments.view')
    <!-- Payments Tab -->
    <div id="tab-payments" class="tab-content {{ $activeTab === 'payments' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Payment Report</h3>
                <select onchange="window.location.href='{{ route('backend.reports-analytics.index') }}?tab=payments&status='+this.value" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <option value="">Semua Status</option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="waiting_verification" {{ request('status') === 'waiting_verification' ? 'selected' : '' }}>Waiting Verification</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Invoice</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Booking</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Method</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Amount</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($payments as $payment)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-mono font-medium text-primary">{{ $payment->invoice_number }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $payment->reservation->booking_code ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $payment->paymentMethod->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-right text-on-surface">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-800">{{ $payment->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Tidak ada data pembayaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($payments->hasPages())
                <div class="mt-4 flex justify-center">{{ $payments->links() }}</div>
            @endif
        </div>
    </div>
    @endallows

    @allows('activity_logs.view')
    <!-- Activity Logs Tab -->
    <div id="tab-activity" class="tab-content {{ $activeTab === 'activity' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Activity Logs</h3>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">User</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Action</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Subject</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Time</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($activityLogs as $log)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 text-on-surface">{{ $log->user?->name ?? 'System' }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $log->action }}</td>
                                <td class="px-4 py-3 text-on-surface-variant text-xs">{{ $log->subject_type ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface-variant text-xs">{{ $log->created_at->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3 text-right">
                                    <button type="button" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary" data-fi-detail='{!! json_encode(["title" => $log->action, "rows" => [["label" => "User", "value" => $log->user?->name ?? "System"], ["label" => "Waktu", "value" => $log->created_at->format("d M Y H:i:s")], ["label" => "IP", "value" => $log->ip_address ?: "-"], ["label" => "Subject", "value" => trim(($log->subject_type ?? "-")." #".($log->subject_id ?? "-"))], ["label" => "Deskripsi", "value" => $log->description ?: "-"], ["label" => "Nilai lama", "value" => $log->old_values ? json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : "-", "pre" => true], ["label" => "Nilai baru", "value" => $log->new_values ? json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : "-", "pre" => true]]], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}'>
                                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Tidak ada activity log.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($activityLogs->hasPages())
                <div class="mt-4 flex justify-center">{{ $activityLogs->links() }}</div>
            @endif
        </div>
    </div>
    @endallows
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
</script>
@endpush
@endsection
