@extends('backend.layouts.app')

@section('title', 'Payment Management')

@section('breadcrumb')
    <a href="{{ route('backend.dashboard') }}" class="hover:text-primary">Dashboard</a>
    <span class="mx-2 text-outline-variant">/</span>
    <span class="font-medium text-primary">Payment Management</span>
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
        'title' => 'Payment Management',
        'subtitle' => 'Kelola metode pembayaran dan transaksi pembayaran dalam satu halaman terpadu.',
    ])

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-2 border-b border-outline-variant/40 pb-1">
        @allows('payment_methods.view')
        <button onclick="switchTab('methods')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'methods' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">payment</span>
            Payment Methods
        </button>
        @endallows
        @allows('payments.view')
        <button onclick="switchTab('transactions')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'transactions' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">receipt_long</span>
            Transactions
        </button>
        @endallows
    </div>

    <!-- Payment Methods Tab -->
    <div id="tab-methods" class="tab-content {{ $activeTab === 'methods' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Payment Methods</h3>
                <button type="button" data-fi-create data-modal="method-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Metode
                </button>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Logo</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Tipe</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">No. Rekening</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($paymentMethods as $method)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3">
                                    @if($method->logo_path)
                                        <img src="{{ asset('storage/' . $method->logo_path) }}" alt="{{ $method->name }}" class="h-10 w-10 rounded-lg object-contain">
                                    @else
                                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-surface-container text-primary">
                                            <span class="material-symbols-outlined text-[24px]">account_balance</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $method->name }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $typeLabels = [
                                            'bank_transfer' => 'Bank Transfer',
                                            'cash' => 'Cash',
                                            'ewallet' => 'E-Wallet',
                                            'credit_card' => 'Credit Card',
                                            'other' => 'Other',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-800">{{ $typeLabels[$method->type] ?? $method->type }}</span>
                                </td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $method->account_number ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @if($method->is_active)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="method-modal" data-action="{{ route('backend.payment-management.update-payment-method', $method) }}" data-title="Edit Metode Pembayaran" data-record='{!! json_encode(["name" => $method->name, "code" => $method->code, "type" => $method->type, "account_number" => $method->account_number, "account_name" => $method->account_name, "instructions" => $method->instructions, "sort_order" => $method->sort_order, "is_active" => (bool) $method->is_active], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.payment-management.destroy-payment-method', $method) }}" data-confirm="Metode pembayaran akan dihapus permanen." data-confirm-title="Hapus metode?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada metode pembayaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($paymentMethods->hasPages())
                <div class="mt-4 flex justify-center">{{ $paymentMethods->links() }}</div>
            @endif
        </div>
    </div>

    <!-- Transactions Tab -->
    <div id="tab-transactions" class="tab-content {{ $activeTab === 'transactions' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Payment Transactions</h3>
                <button type="button" data-fi-create data-modal="payment-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Pembayaran
                </button>
            </div>

            <div class="mb-4 flex flex-wrap gap-3">
                <form method="GET" action="{{ route('backend.payment-management.index') }}" class="flex flex-1 items-center gap-2">
                    <input type="hidden" name="tab" value="transactions">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari invoice, booking code..." class="flex-1 rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <button type="submit" class="rounded-lg bg-primary-container px-4 py-2 text-sm font-semibold text-on-primary hover:bg-primary">Cari</button>
                </form>
                <select onchange="window.location.href='{{ route('backend.payment-management.index') }}?tab=transactions&q={{ urlencode(request('q')) }}&status='+this.value" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <option value="">Semua Status</option>
                    <option value="unpaid" {{ request('status') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="waiting_verification" {{ request('status') === 'waiting_verification' ? 'selected' : '' }}>Waiting Verification</option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="refunded" {{ request('status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Invoice</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Booking</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Metode</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Jumlah</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($payments as $payment)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-mono font-medium text-primary">{{ $payment->invoice_number }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $payment->reservation->booking_code ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $payment->paymentMethod->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusColors = [
                                            'unpaid' => 'bg-red-100 text-red-800',
                                            'waiting_verification' => 'bg-yellow-100 text-yellow-800',
                                            'paid' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            'refunded' => 'bg-gray-100 text-gray-800',
                                        ];
                                        $statusLabel = [
                                            'unpaid' => 'Unpaid',
                                            'waiting_verification' => 'Waiting Verification',
                                            'paid' => 'Paid',
                                            'rejected' => 'Rejected',
                                            'refunded' => 'Refunded',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center gap-1 rounded-full {{ $statusColors[$payment->status] ?? 'bg-gray-100 text-gray-800' }} px-2.5 py-1 text-xs font-semibold">
                                        {{ $statusLabel[$payment->status] ?? $payment->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        @if($payment->status === 'waiting_verification')
                                            <form method="POST" action="{{ route('backend.payment-management.verify-payment', $payment) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="rounded-lg bg-green-600 px-2 py-1 text-xs font-semibold text-white hover:bg-green-700">Verify</button>
                                            </form>
                                        @endif
                                        @if($payment->status === 'paid')
                                            <form method="POST" action="{{ route('backend.payment-management.refund-payment', $payment) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="rounded-lg bg-orange-600 px-2 py-1 text-xs font-semibold text-white hover:bg-orange-700">Refund</button>
                                            </form>
                                        @endif
                                        <button type="button" data-fi-edit data-modal="payment-modal" data-title="Edit Pembayaran" data-action="{{ route('backend.payment-management.update-payment', $payment) }}" data-record='{!! json_encode(["reservation_id" => $payment->reservation_id, "payment_method_id" => $payment->payment_method_id, "amount" => $payment->amount, "status" => $payment->status, "reference_code" => $payment->reference_code, "notes" => $payment->notes], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </button>
                                        <form method="POST" action="{{ route('backend.payment-management.destroy-payment', $payment) }}" data-confirm="Pembayaran akan dihapus permanen." data-confirm-title="Hapus pembayaran?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada transaksi pembayaran.</td>
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
</div>

<!-- Payment Method Modal -->
<div id="method-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Metode Pembayaran</h3>
            <button onclick="document.getElementById('method-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.payment-management.store-payment-method') }}" enctype="multipart/form-data" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Nama <span class="text-error">*</span></label>
                    <input type="text" name="name" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Bank BCA">
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Kode</label>
                        <input type="text" name="code" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface uppercase focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="BCA">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Tipe <span class="text-error">*</span></label>
                        <select name="type" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cash">Cash</option>
                            <option value="ewallet">E-Wallet</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">No. Rekening</label>
                        <input type="text" name="account_number" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Nama Akun</label>
                        <input type="text" name="account_name" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Instruksi</label>
                    <textarea name="instructions" rows="2" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Instruksi pembayaran"></textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Logo</label>
                    <input type="file" name="logo" accept="image/*" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface file:mr-3 file:rounded-lg file:border-0 file:bg-primary-container file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-on-primary focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Urutan</label>
                        <input type="number" name="sort_order" value="0" min="0" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="flex items-center gap-2 pt-6">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="method_is_active" value="1" checked class="rounded border-outline-variant text-primary focus:ring-primary">
                        <label for="method_is_active" class="text-sm font-medium text-on-surface">Aktif</label>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('method-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
                <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Payment Modal -->
<div id="payment-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Pembayaran</h3>
            <button onclick="document.getElementById('payment-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.payment-management.store-payment') }}" enctype="multipart/form-data" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Reservasi <span class="text-error">*</span></label>
                    <select name="reservation_id" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Pilih reservasi</option>
                        @foreach(\App\Models\Reservation::query()->where(function ($query) { $query->whereNotIn('status', ['cancelled', 'expired'])->orWhereHas('payments'); })->latest()->get() as $reservation)
                            <option value="{{ $reservation->id }}">{{ $reservation->booking_code }} - Rp {{ number_format($reservation->total_amount, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Metode Pembayaran <span class="text-error">*</span></label>
                    <select name="payment_method_id" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Pilih metode</option>
                        @foreach(\App\Models\PaymentMethod::orderBy('sort_order')->orderBy('name')->get() as $method)
                            <option value="{{ $method->id }}">{{ $method->name }}{{ $method->is_active ? '' : ' (nonaktif)' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Jumlah <span class="text-error">*</span></label>
                    <input type="number" name="amount" required min="0.01" step="0.01" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="0">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Status <span class="text-error">*</span></label>
                    <select name="status" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="unpaid">Unpaid</option>
                        <option value="waiting_verification">Waiting Verification</option>
                        <option value="paid">Paid</option>
                        <option value="rejected">Rejected</option>
                        <option value="refunded">Refunded</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Bukti Pembayaran</label>
                    <input type="file" name="proof" accept="image/*" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface file:mr-3 file:rounded-lg file:border-0 file:bg-primary-container file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-on-primary focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Reference Code</label>
                    <input type="text" name="reference_code" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Catatan</label>
                    <textarea name="notes" rows="2" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"></textarea>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('payment-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
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
</script>
@endpush
@endsection
