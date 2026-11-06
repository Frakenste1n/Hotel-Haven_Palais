@extends('backend.layouts.app')

@section('title', 'Resort Facilities')

@section('breadcrumb')
    <a href="{{ route('backend.dashboard') }}" class="hover:text-primary">Dashboard</a>
    <span class="mx-2 text-outline-variant">/</span>
    <span class="font-medium text-primary">Resort Facilities</span>
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
        'title' => 'Resort Facilities',
        'subtitle' => 'Kelola kategori dan fasilitas resort dalam satu halaman terpadu.',
    ])

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-2 border-b border-outline-variant/40 pb-1">
        <button onclick="switchTab('categories')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'categories' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">category</span>
            Categories
        </button>
        <button onclick="switchTab('facilities')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'facilities' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">pool</span>
            Facilities
        </button>
        <button type="button" onclick="switchTab('photos')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'photos' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">photo_library</span>
            Foto
        </button>
    </div>

    <!-- Categories Tab -->
    <div id="tab-categories" class="tab-content {{ $activeTab === 'categories' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Facility Categories</h3>
                <button type="button" data-fi-create data-modal="category-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Kategori
                </button>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Slug</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Fasilitas</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Urutan</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($categories as $category)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $category->name }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $category->slug }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $category->resort_facilities_count }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $category->sort_order }}</td>
                                <td class="px-4 py-3">
                                    @if($category->is_active)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="category-modal" data-action="{{ route('backend.resort-facilities.update-category', $category) }}" data-title="Edit Kategori Fasilitas" data-record='{!! json_encode(["name" => $category->name, "slug" => $category->slug, "description" => $category->description, "sort_order" => $category->sort_order, "is_active" => (bool) $category->is_active], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.resort-facilities.destroy-category', $category) }}" data-confirm="Kategori akan dihapus permanen." data-confirm-title="Hapus kategori?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada kategori fasilitas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($categories->hasPages())
                <div class="mt-4 flex justify-center">{{ $categories->links() }}</div>
            @endif
        </div>
    </div>

    <!-- Facilities Tab -->
    <div id="tab-facilities" class="tab-content {{ $activeTab === 'facilities' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Resort Facilities</h3>
                <button type="button" data-fi-create data-modal="facility-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Fasilitas
                </button>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Lokasi</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Jam Operasional</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Biaya</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($facilities as $facility)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $facility->name }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $facility->category->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $facility->location ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $facility->operating_hours ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface">
                                    @if($facility->is_chargeable)
                                        Rp {{ number_format($facility->fee, 0, ',', '.') }}
                                    @else
                                        Gratis
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($facility->is_active)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="facility-modal" data-action="{{ route('backend.resort-facilities.update-facility', $facility) }}" data-title="Edit Fasilitas Resort" data-record='{!! json_encode(["facility_category_id" => $facility->facility_category_id, "name" => $facility->name, "location" => $facility->location, "operating_hours" => $facility->operating_hours, "description" => $facility->description, "is_chargeable" => (bool) $facility->is_chargeable, "fee" => $facility->fee, "sort_order" => $facility->sort_order, "is_active" => (bool) $facility->is_active], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.resort-facilities.destroy-facility', $facility) }}" data-confirm="Fasilitas akan dihapus permanen." data-confirm-title="Hapus fasilitas?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="7" class="px-4 py-8 text-center text-on-surface-variant">Belum ada fasilitas resort.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($facilities->hasPages())
                <div class="mt-4 flex justify-center">{{ $facilities->links() }}</div>
            @endif
        </div>
    </div>
</div>

    <div id="tab-photos" class="tab-content {{ $activeTab === 'photos' ? 'active' : '' }}">
        <div class="fi-section">
            <div class="fi-section-head">
                <div>
                    <h3 class="text-lg font-semibold text-primary">Foto fasilitas</h3>
                    <p class="fi-help">Dokumentasi visual fasilitas resort.</p>
                </div>
                <button type="button" data-fi-create data-modal="facility-image-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white">
                    <span class="material-symbols-outlined text-[18px]">add</span> Tambah Foto
                </button>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                    <table class="w-full text-sm">
                        <thead><tr>
                            <th class="px-4 py-3 text-left">Foto</th>
                            <th class="px-4 py-3 text-left">Fasilitas</th>
                            <th class="px-4 py-3 text-left">Keterangan</th>
                            <th class="px-4 py-3 text-left">Utama</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr></thead>
                        <tbody>
                        @forelse($facilityImages as $image)
                            <tr>
                                <td class="px-4 py-3"><img src="{{ asset('storage/'.$image->image_path) }}" alt="" class="h-12 w-16 rounded-lg object-cover"></td>
                                <td class="px-4 py-3">{{ $image->resortFacility->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $image->caption ?: '-' }}</td>
                                <td class="px-4 py-3">{{ $image->is_primary ? 'Ya' : 'Tidak' }}</td>
                                <td class="px-4 py-3 text-right">
                                    <button type="button" data-fi-edit data-modal="facility-image-modal" data-title="Edit Foto" data-action="{{ route('backend.resort-facilities.update-image', $image) }}" data-record='{!! json_encode(["resort_facility_id" => $image->resort_facility_id, "caption" => $image->caption, "sort_order" => $image->sort_order, "is_primary" => (bool) $image->is_primary], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                    <form method="POST" action="{{ route('backend.resort-facilities.destroy-image', $image) }}" data-confirm="Foto akan dihapus." data-confirm-title="Hapus foto?" class="inline">@csrf @method('DELETE')<button class="rounded-lg p-2 text-error"><span class="material-symbols-outlined text-[18px]">delete</span></button></form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-8 text-center">Belum ada foto.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $facilityImages->links() }}</div>
            </div>
        </div>
    </div>
<div id="facility-image-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="w-full max-w-lg rounded-2xl bg-white p-6">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Foto Fasilitas</h3>
            <button type="button" data-fi-close class="rounded-lg p-2"><span class="material-symbols-outlined">close</span></button>
        </div>
        <form method="POST" action="{{ route('backend.resort-facilities.store-image') }}" enctype="multipart/form-data" data-loading>
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="fi-label">Fasilitas <span class="text-error">*</span></label>
                    <select name="resort_facility_id" required class="fi-input">
                        <option value="">Pilih fasilitas</option>
                        @foreach(\App\Models\ResortFacility::orderBy('name')->get() as $option)
                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fi-upload">
                    <label class="fi-label">Gambar</label>
                    <img data-fi-preview class="fi-upload-preview hidden" alt="">
                    <input type="file" name="image" data-fi-file data-required-on-create required accept="image/*" class="fi-input">
                </div>
                <div><label class="fi-label">Keterangan</label><input name="caption" class="fi-input"></div>
                <div class="grid grid-cols-2 gap-3">
                    <div><label class="fi-label">Urutan</label><input type="number" name="sort_order" value="0" min="0" class="fi-input"></div>
                    <label class="mt-7 flex items-center gap-2 text-sm"><input type="checkbox" name="is_primary"> Utama</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" data-fi-close class="rounded-xl border px-5 py-2.5 text-sm">Batal</button>
                <button class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Category Modal -->
<div id="category-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Kategori Fasilitas</h3>
            <button onclick="document.getElementById('category-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.resort-facilities.store-category') }}" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Nama <span class="text-error">*</span></label>
                    <input type="text" name="name" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Nama kategori">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Slug</label>
                    <input type="text" name="slug" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="URL-friendly slug">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Deskripsi kategori"></textarea>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Urutan</label>
                        <input type="number" name="sort_order" value="0" min="0" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="flex items-center gap-2 pt-6">
                        <input type="checkbox" name="is_active" id="cat_is_active" checked class="rounded border-outline-variant text-primary focus:ring-primary">
                        <label for="cat_is_active" class="text-sm font-medium text-on-surface">Aktif</label>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('category-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
                <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Facility Modal -->
<div id="facility-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Fasilitas Resort</h3>
            <button onclick="document.getElementById('facility-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.resort-facilities.store-facility') }}" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Kategori <span class="text-error">*</span></label>
                    <select name="facility_category_id" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Pilih kategori</option>
                        @foreach(\App\Models\FacilityCategory::where('is_active', true)->orderBy('name')->get() as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Nama <span class="text-error">*</span></label>
                    <input type="text" name="name" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Nama fasilitas">
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Lokasi</label>
                        <input type="text" name="location" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Lokasi fasilitas">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Jam Operasional</label>
                        <input type="text" name="operating_hours" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="08:00 - 22:00">
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Deskripsi fasilitas"></textarea>
                </div>
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_chargeable" id="is_chargeable" class="rounded border-outline-variant text-primary focus:ring-primary">
                        <label for="is_chargeable" class="text-sm font-medium text-on-surface">Berbayar</label>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Biaya</label>
                        <input type="number" name="fee" min="0" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="0">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Urutan</label>
                        <input type="number" name="sort_order" value="0" min="0" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="fac_is_active" checked class="rounded border-outline-variant text-primary focus:ring-primary">
                    <label for="fac_is_active" class="text-sm font-medium text-on-surface">Aktif</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('facility-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
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