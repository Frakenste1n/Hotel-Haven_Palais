@extends('backend.layouts.app')

@section('title', 'Promotions & Packages')

@section('breadcrumb')
    <a href="{{ route('backend.dashboard') }}" class="hover:text-primary">Dashboard</a>
    <span class="mx-2 text-outline-variant">/</span>
    <span class="font-medium text-primary">Promotions & Packages</span>
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
        'title' => 'Promotions & Packages',
        'subtitle' => 'Kelola promo kode dan paket menginap dalam satu halaman terpadu.',
    ])

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-2 border-b border-outline-variant/40 pb-1">
        <button onclick="switchTab('promotions')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'promotions' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">local_offer</span>
            Promotions
        </button>
        <button onclick="switchTab('packages')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'packages' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">card_giftcard</span>
            Packages
        </button>
    </div>

    <!-- Promotions Tab -->
    <div id="tab-promotions" class="tab-content {{ $activeTab === 'promotions' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Promo Codes</h3>
                <button type="button" data-fi-create data-modal="promotion-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Promo
                </button>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Kode</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Diskon</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Periode</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($promotions as $promotion)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-mono font-medium text-primary">{{ $promotion->code }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $promotion->name }}</td>
                                <td class="px-4 py-3 text-on-surface">
                                    @if($promotion->discount_type === 'percentage')
                                        {{ $promotion->discount_value }}%
                                    @else
                                        Rp {{ number_format($promotion->discount_value, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-on-surface-variant text-xs">
                                    {{ $promotion->starts_at?->format('d M Y') ?? '-' }} s/d {{ $promotion->ends_at?->format('d M Y') ?? '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    @if($promotion->is_active)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="promotion-modal" data-action="{{ route('backend.promotions-packages.update-promotion', $promotion) }}" data-title="Edit Promo" data-record='{!! json_encode(["code" => $promotion->code, "name" => $promotion->name, "summary" => $promotion->summary, "description" => $promotion->description, "discount_type" => $promotion->discount_type, "discount_value" => $promotion->discount_value, "min_nights" => $promotion->min_nights, "min_amount" => $promotion->min_amount, "max_uses" => $promotion->max_uses, "starts_at" => optional($promotion->starts_at)->format("Y-m-d"), "ends_at" => optional($promotion->ends_at)->format("Y-m-d"), "terms" => $promotion->terms, "is_active" => (bool) $promotion->is_active], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.promotions-packages.destroy-promotion', $promotion) }}" data-confirm="Promo akan dihapus permanen." data-confirm-title="Hapus promo?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada promo kode.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($promotions->hasPages())
                <div class="mt-4 flex justify-center">{{ $promotions->links() }}</div>
            @endif
        </div>
    </div>

    <!-- Packages Tab -->
    <div id="tab-packages" class="tab-content {{ $activeTab === 'packages' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Packages</h3>
                <button type="button" data-fi-create data-modal="package-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Paket
                </button>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Harga</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Malam</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Tipe Kamar</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Periode</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($packages as $package)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $package->name }}</td>
                                <td class="px-4 py-3 text-on-surface">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $package->nights ?? '-' }} Malam</td>
                                <td class="px-4 py-3 text-on-surface-variant text-xs">
                                    {{ $package->roomTypes->pluck('name')->join(', ') ?: '-' }}
                                </td>
                                <td class="px-4 py-3 text-on-surface-variant text-xs">
                                    {{ $package->starts_at?->format('d M Y') ?? '-' }} s/d {{ $package->ends_at?->format('d M Y') ?? '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    @if($package->is_active)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="package-modal" data-action="{{ route('backend.promotions-packages.update-package', $package) }}" data-title="Edit Paket" data-record='{!! json_encode(["name" => $package->name, "summary" => $package->summary, "description" => $package->description, "price" => $package->price, "nights" => $package->nights, "benefits" => is_array($package->benefits) ? implode("\n", $package->benefits) : $package->benefits, "starts_at" => optional($package->starts_at)->format("Y-m-d"), "ends_at" => optional($package->ends_at)->format("Y-m-d"), "is_active" => (bool) $package->is_active, "room_type_ids" => $package->roomTypes->pluck("id")], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.promotions-packages.destroy-package', $package) }}" data-confirm="Paket akan dihapus permanen." data-confirm-title="Hapus paket?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="7" class="px-4 py-8 text-center text-on-surface-variant">Belum ada paket menginap.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($packages->hasPages())
                <div class="mt-4 flex justify-center">{{ $packages->links() }}</div>
            @endif
        </div>
    </div>
</div>

<!-- Promotion Modal -->
<div id="promotion-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Promo Code</h3>
            <button onclick="document.getElementById('promotion-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.promotions-packages.store-promotion') }}" enctype="multipart/form-data" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Kode Promo <span class="text-error">*</span></label>
                        <input type="text" name="code" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface uppercase focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="SUMMER2024">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Nama Promo <span class="text-error">*</span></label>
                        <input type="text" name="name" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Summer Sale">
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Summary</label>
                    <input type="text" name="summary" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Ringkasan singkat">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Deskripsi lengkap promo"></textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Gambar</label>
                    <input type="file" name="image" accept="image/*" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface file:mr-3 file:rounded-lg file:border-0 file:bg-primary-container file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-on-primary focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Tipe Diskon <span class="text-error">*</span></label>
                        <select name="discount_type" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                            <option value="percentage">Persentase (%)</option>
                            <option value="fixed">Nominal Tetap</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Nilai Diskon <span class="text-error">*</span></label>
                        <input type="number" name="discount_value" required min="0" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="0">
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Minimal Malam</label>
                        <input type="number" name="min_nights" min="1" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Minimal Transaksi</label>
                        <input type="number" name="min_amount" min="0" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Maksimal Penggunaan</label>
                        <input type="number" name="max_uses" min="1" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Tanggal Mulai</label>
                        <input type="date" name="starts_at" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Tanggal Selesai</label>
                        <input type="date" name="ends_at" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Syarat & Ketentuan</label>
                    <textarea name="terms" rows="2" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Syarat dan ketentuan promo"></textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="promo_is_active" checked class="rounded border-outline-variant text-primary focus:ring-primary">
                    <label for="promo_is_active" class="text-sm font-medium text-on-surface">Aktif</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('promotion-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
                <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Package Modal -->
<div id="package-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Paket Menginap</h3>
            <button onclick="document.getElementById('package-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.promotions-packages.store-package') }}" enctype="multipart/form-data" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Nama Paket <span class="text-error">*</span></label>
                    <input type="text" name="name" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Romantic Getaway">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Summary</label>
                    <input type="text" name="summary" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Ringkasan singkat">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Deskripsi lengkap paket"></textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Gambar</label>
                    <input type="file" name="image" accept="image/*" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface file:mr-3 file:rounded-lg file:border-0 file:bg-primary-container file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-on-primary focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Harga <span class="text-error">*</span></label>
                        <input type="number" name="price" required min="0" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="0">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Jumlah Malam</label>
                        <input type="number" name="nights" min="1" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="2">
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Benefits (satu per baris)</label>
                    <textarea name="benefits" rows="3" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Sarapan gratis&#10;Spa voucher&#10;Late check-out"></textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Tipe Kamar Tersedia</label>
                    <div class="grid gap-2 sm:grid-cols-2">
                        @foreach(\App\Models\RoomType::where('is_active', true)->orderBy('name')->get() as $type)
                            <label class="flex items-center gap-2 rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 hover:bg-surface-container-low cursor-pointer">
                                <input type="checkbox" name="room_type_ids[]" value="{{ $type->id }}" class="rounded border-outline-variant text-primary focus:ring-primary">
                                <span class="text-sm text-on-surface">{{ $type->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Tanggal Mulai</label>
                        <input type="date" name="starts_at" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Tanggal Selesai</label>
                        <input type="date" name="ends_at" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="pkg_is_active" checked class="rounded border-outline-variant text-primary focus:ring-primary">
                    <label for="pkg_is_active" class="text-sm font-medium text-on-surface">Aktif</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('package-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
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
