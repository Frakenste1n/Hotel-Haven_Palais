@extends('backend.layouts.app')

@section('title', 'Gallery')

@section('breadcrumb')
    <a href="{{ route('backend.dashboard') }}" class="hover:text-primary">Dashboard</a>
    <span class="mx-2 text-outline-variant">/</span>
    <span class="font-medium text-primary">Gallery</span>
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
        'title' => 'Gallery',
        'subtitle' => 'Kelola kategori dan item galeri foto/video dalam satu halaman terpadu.',
    ])

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-2 border-b border-outline-variant/40 pb-1">
        <button onclick="switchTab('categories')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'categories' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">category</span>
            Categories
        </button>
        <button onclick="switchTab('galleries')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'galleries' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">photo_library</span>
            Gallery Items
        </button>
    </div>

    <!-- Categories Tab -->
    <div id="tab-categories" class="tab-content {{ $activeTab === 'categories' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Gallery Categories</h3>
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
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Item</th>
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
                                <td class="px-4 py-3 text-on-surface">{{ $category->galleries_count }}</td>
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
                                        <button type="button" data-fi-edit data-modal="category-modal" data-action="{{ route('backend.gallery.update-category', $category) }}" data-title="Edit Kategori Galeri" data-record='{!! json_encode(["name" => $category->name, "slug" => $category->slug, "description" => $category->description, "sort_order" => $category->sort_order, "is_active" => (bool) $category->is_active], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.gallery.destroy-category', $category) }}" data-confirm="Kategori akan dihapus permanen." data-confirm-title="Hapus kategori?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada kategori galeri.</td>
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

    <!-- Gallery Items Tab -->
    <div id="tab-galleries" class="tab-content {{ $activeTab === 'galleries' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Gallery Items</h3>
                <button type="button" data-fi-create data-modal="gallery-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Item
                </button>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Preview</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Judul</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Tipe</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($galleries as $gallery)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3">
                                    @if($gallery->file_type === 'image')
                                        <img src="{{ asset('storage/' . $gallery->file_path) }}" alt="{{ $gallery->title }}" class="h-12 w-12 rounded-lg object-cover">
                                    @else
                                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-surface-container text-primary">
                                            <span class="material-symbols-outlined text-[24px]">videocam</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $gallery->title }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $gallery->category->name ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @if($gallery->file_type === 'image')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-800">Image</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-purple-100 px-2.5 py-1 text-xs font-semibold text-purple-800">Video</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($gallery->is_published)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Published</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">Draft</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="gallery-modal" data-action="{{ route('backend.gallery.update-gallery', $gallery) }}" data-title="Edit Item Galeri" data-record='{!! json_encode(["gallery_category_id" => $gallery->gallery_category_id, "title" => $gallery->title, "description" => $gallery->description, "file_type" => $gallery->file_type, "sort_order" => $gallery->sort_order, "is_published" => (bool) $gallery->is_published], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.gallery.destroy-gallery', $gallery) }}" data-confirm="Item galeri akan dihapus permanen." data-confirm-title="Hapus item?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada item galeri.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($galleries->hasPages())
                <div class="mt-4 flex justify-center">{{ $galleries->links() }}</div>
            @endif
        </div>
    </div>
</div>

<!-- Category Modal -->
<div id="category-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Kategori Galeri</h3>
            <button onclick="document.getElementById('category-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.gallery.store-category') }}" data-loading>
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

<!-- Gallery Modal -->
<div id="gallery-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Item Galeri</h3>
            <button onclick="document.getElementById('gallery-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.gallery.store-gallery') }}" enctype="multipart/form-data" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Kategori <span class="text-error">*</span></label>
                    <select name="gallery_category_id" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Pilih kategori</option>
                        @foreach(\App\Models\GalleryCategory::where('is_active', true)->orderBy('name')->get() as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Judul <span class="text-error">*</span></label>
                    <input type="text" name="title" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Judul item">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Deskripsi</label>
                    <textarea name="description" rows="2" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Deskripsi item"></textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">File <span class="text-error">*</span></label>
                    <input type="file" name="file" data-required-on-create required accept="image/*,video/*" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface file:mr-3 file:rounded-lg file:border-0 file:bg-primary-container file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-on-primary focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <p class="mt-1 text-xs text-on-surface-variant">Maksimal 10MB. Format: JPG, PNG, WEBP, GIF, MP4, WEBM</p>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Tipe File <span class="text-error">*</span></label>
                    <select name="file_type" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                    </select>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Urutan</label>
                        <input type="number" name="sort_order" value="0" min="0" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="flex items-center gap-2 pt-6">
                        <input type="checkbox" name="is_published" id="gal_is_published" checked class="rounded border-outline-variant text-primary focus:ring-primary">
                        <label for="gal_is_published" class="text-sm font-medium text-on-surface">Published</label>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('gallery-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
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
