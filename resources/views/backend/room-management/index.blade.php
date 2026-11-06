@extends('backend.layouts.app')

@section('title', 'Room Management')

@section('breadcrumb')
    <a href="{{ route('backend.dashboard') }}" class="hover:text-primary">Dashboard</a>
    <span class="mx-2 text-outline-variant">/</span>
    <span class="font-medium text-primary">Room Management</span>
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
        'title' => 'Room Management',
        'subtitle' => 'Kelola kategori, tipe, unit kamar, dan fasilitas dalam satu halaman terpadu.',
    ])

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-2 border-b border-outline-variant/40 pb-1">
        @allows('room_categories.view')
        <button onclick="switchTab('categories')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'categories' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">category</span>
            Categories
        </button>
        @endallows
        @allows('room_types.view')
        <button onclick="switchTab('types')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'types' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">bed</span>
            Room Types
        </button>
        @endallows
        @allows('rooms.view')
        <button onclick="switchTab('units')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'units' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">meeting_room</span>
            Room Units
        </button>
        @endallows
        @allows('room_facilities.view')
        <button onclick="switchTab('facilities')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'facilities' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">kitchen</span>
            Facilities
        </button>
        @endallows
        @allows('room_types.view')
        <button type="button" onclick="switchTab('photos')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'photos' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">photo_library</span>
            Foto Kamar
        </button>
        @endallows
    </div>

    @allows('room_categories.view')
    <!-- Categories Tab -->
    <div id="tab-categories" class="tab-content {{ $activeTab === 'categories' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Room Categories</h3>
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
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Tipe Kamar</th>
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
                                <td class="px-4 py-3 text-on-surface">{{ $category->room_types_count }}</td>
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
                                        <button type="button" data-fi-edit data-modal="category-modal" data-action="{{ route('backend.room-management.update-category', $category) }}" data-title="Edit Kategori Kamar" data-record='{!! json_encode(["name" => $category->name, "slug" => $category->slug, "description" => $category->description, "sort_order" => $category->sort_order, "is_active" => (bool) $category->is_active], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.room-management.destroy-category', $category) }}" data-confirm="Kategori akan dihapus permanen." data-confirm-title="Hapus kategori?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada kategori kamar.</td>
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
    @endallows

    @allows('room_types.view')
    <!-- Room Types Tab -->
    <div id="tab-types" class="tab-content {{ $activeTab === 'types' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Room Types</h3>
                <button type="button" data-fi-create data-modal="type-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Tipe Kamar
                </button>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Harga Dasar</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Kapasitas</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Unit</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($roomTypes as $type)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3">
                                    <p class="font-medium text-on-surface">{{ $type->name }}</p>
                                    @if($type->is_featured)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-secondary-container px-2 py-0.5 text-[10px] font-semibold text-on-secondary-container">Featured</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $type->category->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface">Rp {{ number_format($type->base_price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $type->capacity_adults }} Dewasa, {{ $type->capacity_children }} Anak</td>
                                <td class="px-4 py-3 text-on-surface">{{ $type->rooms_count }}</td>
                                <td class="px-4 py-3">
                                    @if($type->is_active)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="type-modal" data-action="{{ route('backend.room-management.update-type', $type) }}" data-title="Edit Tipe Kamar" data-record='{!! json_encode(["room_category_id" => $type->room_category_id, "name" => $type->name, "slug" => $type->slug, "base_price" => $type->base_price, "capacity_adults" => $type->capacity_adults, "capacity_children" => $type->capacity_children, "bed_type" => $type->bed_type, "room_size" => $type->room_size, "max_occupancy" => $type->max_occupancy, "description" => $type->description, "summary" => $type->summary, "is_featured" => (bool) $type->is_featured, "is_active" => (bool) $type->is_active, "facility_ids" => $type->facilities->pluck("id")], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.room-management.destroy-type', $type) }}" data-confirm="Tipe kamar akan dihapus permanen." data-confirm-title="Hapus tipe kamar?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="7" class="px-4 py-8 text-center text-on-surface-variant">Belum ada tipe kamar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($roomTypes->hasPages())
                <div class="mt-4 flex justify-center">{{ $roomTypes->links() }}</div>
            @endif
        </div>
    </div>
    @endallows

    @allows('rooms.view')
    <!-- Room Units Tab -->
    <div id="tab-units" class="tab-content {{ $activeTab === 'units' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Room Units</h3>
                <button type="button" data-fi-create data-modal="room-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Unit Kamar
                </button>
            </div>

            <div class="mb-4 flex flex-wrap gap-3">
                <form method="GET" action="{{ route('backend.room-management.index') }}" class="flex flex-1 items-center gap-2">
                    <input type="hidden" name="tab" value="units">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nomor kamar..." class="flex-1 rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <button type="submit" class="rounded-lg bg-primary-container px-4 py-2 text-sm font-semibold text-on-primary hover:bg-primary">Cari</button>
                </form>
                <select onchange="window.location.href='{{ route('backend.room-management.index') }}?tab=units&status='+this.value" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <option value="">Semua Status</option>
                    <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ request('status') === 'occupied' ? 'selected' : '' }}>Occupied</option>
                    <option value="maintenance" {{ request('status') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="cleaning" {{ request('status') === 'cleaning' ? 'selected' : '' }}>Cleaning</option>
                </select>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nomor Kamar</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Tipe</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Lantai</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($rooms as $room)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $room->room_number }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $room->roomType->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $room->floor ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusColors = [
                                            'available' => 'bg-green-100 text-green-800',
                                            'occupied' => 'bg-red-100 text-red-800',
                                            'maintenance' => 'bg-orange-100 text-orange-800',
                                            'out_of_order' => 'bg-gray-100 text-gray-800',
                                            'cleaning' => 'bg-blue-100 text-blue-800',
                                        ];
                                        $statusLabel = [
                                            'available' => 'Available',
                                            'occupied' => 'Occupied',
                                            'maintenance' => 'Maintenance',
                                            'out_of_order' => 'Out of Order',
                                            'cleaning' => 'Cleaning',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center gap-1 rounded-full {{ $statusColors[$room->status] ?? 'bg-gray-100 text-gray-800' }} px-2.5 py-1 text-xs font-semibold">
                                        {{ $statusLabel[$room->status] ?? $room->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="room-modal" data-action="{{ route('backend.room-management.update-room', $room) }}" data-title="Edit Unit Kamar" data-record='{!! json_encode(["room_type_id" => $room->room_type_id, "room_number" => $room->room_number, "floor" => $room->floor, "status" => $room->status, "notes" => $room->notes, "is_active" => (bool) $room->is_active], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.room-management.destroy-room', $room) }}" data-confirm="Unit kamar akan dihapus permanen." data-confirm-title="Hapus unit kamar?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Belum ada unit kamar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($rooms->hasPages())
                <div class="mt-4 flex justify-center">{{ $rooms->links() }}</div>
            @endif
        </div>
    </div>
    @endallows

    @allows('room_facilities.view')
    <!-- Facilities Tab -->
    <div id="tab-facilities" class="tab-content {{ $activeTab === 'facilities' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Room Facilities</h3>
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
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Icon</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Deskripsi</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($facilities as $facility)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $facility->name }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $facility->icon ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $facility->description ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @if($facility->is_active)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="facility-modal" data-action="{{ route('backend.room-management.update-facility', $facility) }}" data-title="Edit Fasilitas Kamar" data-record='{!! json_encode(["name" => $facility->name, "icon" => $facility->icon, "description" => $facility->description, "is_active" => (bool) $facility->is_active], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.room-management.destroy-facility', $facility) }}" data-confirm="Fasilitas akan dihapus permanen." data-confirm-title="Hapus fasilitas?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Belum ada fasilitas kamar.</td>
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
    @endallows
</div>

    @allows('room_types.view')
    <div id="tab-photos" class="tab-content {{ $activeTab === 'photos' ? 'active' : '' }}">
        <div class="fi-section">
            <div class="fi-section-head">
                <div>
                    <h3 class="text-lg font-semibold text-primary">Foto tipe kamar</h3>
                    <p class="fi-help">Unggah galeri untuk setiap tipe kamar. Tetap di halaman ini.</p>
                </div>
                <button type="button" data-fi-create data-modal="room-image-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white">
                    <span class="material-symbols-outlined text-[18px]">add</span> Tambah Foto
                </button>
            </div>
            <div class="p-4">
                <input data-table-filter="#room-image-table" type="search" placeholder="Cari tipe atau keterangan" class="fi-input mb-4 max-w-sm">
                <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                    <table id="room-image-table" class="w-full text-sm">
                        <thead><tr>
                            <th class="px-4 py-3 text-left">Foto</th>
                            <th class="px-4 py-3 text-left">Tipe</th>
                            <th class="px-4 py-3 text-left">Keterangan</th>
                            <th class="px-4 py-3 text-left">Utama</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr></thead>
                        <tbody>
                        @forelse($roomImages as $image)
                            <tr>
                                <td class="px-4 py-3"><img src="{{ asset('storage/'.$image->image_path) }}" alt="" class="h-12 w-16 rounded-lg object-cover"></td>
                                <td class="px-4 py-3">{{ $image->roomType->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $image->caption ?: '-' }}</td>
                                <td class="px-4 py-3">{{ $image->is_primary ? 'Ya' : 'Tidak' }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="room-image-modal" data-title="Edit Foto Kamar" data-action="{{ route('backend.room-management.update-image', $image) }}" data-record='{!! json_encode(["room_type_id" => $image->room_type_id, "caption" => $image->caption, "sort_order" => $image->sort_order, "is_primary" => (bool) $image->is_primary], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.room-management.destroy-image', $image) }}" data-confirm="Foto akan dihapus." data-confirm-title="Hapus foto?" class="inline">@csrf @method('DELETE')<button class="rounded-lg p-2 text-error"><span class="material-symbols-outlined text-[18px]">delete</span></button></form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Belum ada foto kamar.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $roomImages->links() }}</div>
            </div>
        </div>
    </div>
    @endallows

@allows('room_types.view')
<div id="room-image-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Foto Kamar</h3>
            <button type="button" data-fi-close class="rounded-lg p-2"><span class="material-symbols-outlined">close</span></button>
        </div>
        <form method="POST" action="{{ route('backend.room-management.store-image') }}" enctype="multipart/form-data" data-loading>
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="fi-label">Tipe kamar <span class="text-error">*</span></label>
                    <select name="room_type_id" required class="fi-input">
                        <option value="">Pilih tipe</option>
                        @foreach(\App\Models\RoomType::orderBy('name')->get() as $typeOption)
                            <option value="{{ $typeOption->id }}">{{ $typeOption->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fi-upload space-y-2">
                    <label class="fi-label">Gambar</label>
                    <img data-fi-preview alt="" class="fi-upload-preview hidden">
                    <input type="file" name="image" data-fi-file data-required-on-create required accept="image/*" class="fi-input">
                    <p class="fi-help">JPG, PNG, atau WEBP. Maksimal 4 MB.</p>
                </div>
                <div>
                    <label class="fi-label">Keterangan</label>
                    <input type="text" name="caption" class="fi-input">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="fi-label">Urutan</label>
                        <input type="number" name="sort_order" value="0" min="0" class="fi-input">
                    </div>
                    <label class="mt-7 flex items-center gap-2 text-sm"><input type="checkbox" name="is_primary" class="rounded"> Foto utama</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" data-fi-close class="rounded-xl border px-5 py-2.5 text-sm">Batal</button>
                <button class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endallows

@allows('room_categories.view')
<!-- Category Modal -->
<div id="category-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Kategori Kamar</h3>
            <button onclick="document.getElementById('category-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.room-management.store-category') }}" data-loading>
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
@endallows

@allows('room_types.view')
<!-- Type Modal -->
<div id="type-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Tipe Kamar</h3>
            <button onclick="document.getElementById('type-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.room-management.store-type') }}" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Kategori <span class="text-error">*</span></label>
                    <select name="room_category_id" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Pilih kategori</option>
                        @allows('room_categories.view')
                        @foreach(\App\Models\RoomCategory::where('is_active', true)->orderBy('name')->get() as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                        @endallows
                    </select>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="fi-label">Nama <span class="text-error">*</span></label>
                        <input type="text" name="name" required class="fi-input" placeholder="Nama tipe kamar">
                    </div>
                    <div class="space-y-1.5">
                        <label class="fi-label">Slug</label>
                        <input type="text" name="slug" class="fi-input" placeholder="Kosongkan untuk dibuat otomatis">
                        <p class="fi-help">Dipakai sebagai alamat ramah di halaman publik.</p>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Harga Dasar <span class="text-error">*</span></label>
                        <input type="number" name="base_price" required min="0" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="0">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Kapasitas Dewasa <span class="text-error">*</span></label>
                        <input type="number" name="capacity_adults" required min="1" value="2" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Kapasitas Anak</label>
                        <input type="number" name="capacity_children" min="0" value="0" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Tipe Bed</label>
                        <input type="text" name="bed_type" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="King, Queen, Twin">
                    </div>
                    <div class="space-y-1.5">
                        <label class="fi-label">Ukuran (m²)</label>
                        <input type="number" name="room_size" min="0" step="0.1" class="fi-input">
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="fi-label">Maksimal okupansi</label>
                    <input type="number" name="max_occupancy" min="1" class="fi-input" placeholder="Total tamu">
                </div>
                <div class="space-y-1.5">
                    <label class="fi-label">Fasilitas kamar</label>
                    <div class="grid gap-2 sm:grid-cols-2">
                        @allows('room_facilities.view')
                        @foreach(\App\Models\RoomFacility::orderBy('name')->get() as $facilityOption)
                            <label class="flex items-center gap-2 rounded-lg border border-outline-variant px-3 py-2 text-sm">
                                <input type="checkbox" name="facility_ids[]" value="{{ $facilityOption->id }}" class="rounded border-outline-variant text-primary focus:ring-primary">
                                <span>{{ $facilityOption->name }}</span>
                            </label>
                        @endforeach
                        @endallows
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Deskripsi tipe kamar"></textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Summary</label>
                    <textarea name="summary" rows="2" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Ringkasan singkat"></textarea>
                </div>
                <div class="flex items-center gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" class="rounded border-outline-variant text-primary focus:ring-primary">
                        <span class="text-sm font-medium text-on-surface">Featured</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" checked class="rounded border-outline-variant text-primary focus:ring-primary">
                        <span class="text-sm font-medium text-on-surface">Aktif</span>
                    </label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('type-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
                <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endallows

@allows('rooms.view')
<!-- Room Modal -->
<div id="room-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Unit Kamar</h3>
            <button onclick="document.getElementById('room-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.room-management.store-room') }}" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Tipe Kamar <span class="text-error">*</span></label>
                    <select name="room_type_id" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Pilih tipe kamar</option>
                        @foreach(\App\Models\RoomType::where('is_active', true)->orderBy('name')->get() as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Nomor Kamar <span class="text-error">*</span></label>
                    <input type="text" name="room_number" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="101, 201, A1">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Lantai</label>
                    <input type="text" name="floor" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="1, 2, Ground">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Status <span class="text-error">*</span></label>
                    <select name="status" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="available">Available</option>
                        <option value="occupied">Occupied</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="out_of_order">Out of Order</option>
                        <option value="cleaning">Cleaning</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Catatan</label>
                    <textarea name="notes" rows="2" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Catatan tambahan"></textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="room_is_active" checked class="rounded border-outline-variant text-primary focus:ring-primary">
                    <label for="room_is_active" class="text-sm font-medium text-on-surface">Aktif</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('room-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
                <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endallows

@allows('room_facilities.view')
<!-- Facility Modal -->
<div id="facility-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Fasilitas Kamar</h3>
            <button onclick="document.getElementById('facility-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.room-management.store-facility') }}" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Nama <span class="text-error">*</span></label>
                    <input type="text" name="name" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Nama fasilitas">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Icon</label>
                    <input type="text" name="icon" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Material Icons name">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Deskripsi fasilitas"></textarea>
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
@endallows

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
