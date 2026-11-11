@extends('backend.layouts.app')

@section('title', 'Website Management')

@section('breadcrumb')
    <a href="{{ route('backend.dashboard') }}" class="hover:text-primary">Dashboard</a>
    <span class="mx-2 text-outline-variant">/</span>
    <span class="font-medium text-primary">Website Management</span>
@endsection

@section('content')
<div class="space-y-6">
    @include('backend.components.page-header', [
        'title' => 'Website Management',
        'subtitle' => 'Identitas, kontak, hero, tentang resort, media sosial, banner, dan konten halaman dalam satu halaman.',
    ])

    <nav class="fi-tabs sticky top-16 z-20 bg-surface/95 py-2 backdrop-blur">
        @foreach(['identitas' => 'Identitas', 'kontak' => 'Kontak', 'hero' => 'Hero', 'tentang' => 'Tentang', 'sosial' => 'Media Sosial', 'banner' => 'Banner', 'konten' => 'Konten Halaman'] as $id => $label)
            <a href="#{{ $id }}" class="tab-btn">{{ $label }}</a>
        @endforeach
    </nav>

    <form id="pengaturan" method="POST" action="{{ route('backend.website-management.store-settings') }}" enctype="multipart/form-data" data-loading class="space-y-5">
        @csrf
        @foreach(\App\Models\Setting::formSections() as $key => $section)
            <section id="{{ $key === 'identitas' ? 'identitas' : ($key === 'kontak' ? 'kontak' : ($key === 'hero' ? 'hero' : ($key === 'tentang' ? 'tentang' : 'sosial'))) }}" class="fi-section">
                <div class="fi-section-head">
                    <div>
                        <h3 class="font-display text-xl text-primary">{{ $section['title'] }}</h3>
                        <p class="fi-help">Perubahan tersimpan bersama seluruh pengaturan website.</p>
                    </div>
                </div>
                <div class="grid gap-4 p-5 sm:grid-cols-2">
                    @foreach($section['fields'] as $field)
                        <div class="{{ $field['type'] === 'textarea' || $field['name'] === 'site_maps_url' ? 'sm:col-span-2' : '' }}">
                            <label class="fi-label" for="field-{{ $field['name'] }}">
                                {{ $field['label'] }}
                                @if(!empty($field['required'])) <span class="text-error">*</span> @endif
                            </label>
                            @if($field['type'] === 'textarea')
                                <textarea id="field-{{ $field['name'] }}" name="{{ $field['name'] }}" rows="4" class="fi-input" placeholder="{{ $field['label'] }}">{{ old($field['name'], $setting->{$field['name']}) }}</textarea>
                            @elseif($field['type'] === 'image')
                                <div class="fi-upload space-y-2">
                                    @if($setting->{$field['name']})
                                        <img src="{{ $setting->fileUrl($field['name']) }}" alt="{{ $field['label'] }}" class="fi-upload-preview">
                                    @endif
                                    <img data-fi-preview alt="" class="fi-upload-preview hidden">
                                    <input id="field-{{ $field['name'] }}" data-fi-file type="file" name="{{ $field['name'] }}" accept="image/*" class="fi-input">
                                    @if($setting->{$field['name']})
                                        <label class="flex items-center gap-2 text-sm text-on-surface-variant">
                                            <input type="checkbox" name="remove[{{ $field['name'] }}]" value="1"> Hapus gambar saat ini
                                        </label>
                                    @endif
                                    <p class="fi-help">Pratinjau muncul setelah file dipilih. Maksimal 4 MB.</p>
                                </div>
                            @elseif($field['name'] === 'site_maps_url')
                                <input id="field-{{ $field['name'] }}" data-maps-url type="url" name="{{ $field['name'] }}" value="{{ old($field['name'], $setting->{$field['name']}) }}" class="fi-input" placeholder="https://maps.google.com/?q=Haven+Palais">
                                <div data-maps-preview class="mt-3 hidden overflow-hidden rounded-xl border border-outline-variant/50 bg-surface-container-low">
                                    <iframe data-maps-frame title="Pratinjau Google Maps" class="h-64 w-full" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                                </div>
                                <p class="fi-help">Tempel tautan Google Maps atau alamat src dari kode embed. Peta muncul di bawah field setelah URL terisi.</p>
                            @elseif($field['type'] === 'email')
                                <input id="field-{{ $field['name'] }}" type="email" name="{{ $field['name'] }}" value="{{ old($field['name'], $setting->{$field['name']}) }}" class="fi-input" placeholder="nama@havenpalais.com">
                            @else
                                <input id="field-{{ $field['name'] }}" type="text" name="{{ $field['name'] }}" value="{{ old($field['name'], $setting->{$field['name']}) }}" class="fi-input" @if(!empty($field['required'])) required @endif placeholder="{{ $field['label'] }}">
                            @endif
                            @error($field['name'])
                                <p class="mt-1 text-xs text-error">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach
        <div class="flex justify-end border-t border-outline-variant/40 pt-4">
            <button type="submit" class="rounded-xl bg-primary px-5 py-3 text-sm font-semibold text-white shadow-card">Simpan pengaturan website</button>
        </div>
    </form>

    <section id="banner" class="fi-section">
        <div class="fi-section-head">
            <div>
                <h3 class="font-display text-xl text-primary">Hero banner</h3>
                <p class="fi-help">Beberapa slide hero. Bukan halaman terpisah.</p>
            </div>
            <button type="button" data-fi-create data-modal="banner-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white">
                <span class="material-symbols-outlined text-[18px]">add</span> Tambah banner
            </button>
        </div>
        <div class="p-4">
            <input data-table-filter="#banner-table" type="search" placeholder="Cari judul banner" class="fi-input mb-4 max-w-sm">
            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table id="banner-table" class="w-full text-sm">
                    <thead><tr>
                        <th class="px-4 py-3 text-left">Gambar</th>
                        <th class="px-4 py-3 text-left">Judul</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Urutan</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr></thead>
                    <tbody>
                    @forelse($banners as $banner)
                        <tr>
                            <td class="px-4 py-3"><img src="{{ asset('storage/'.$banner->image_path) }}" alt="" class="h-12 w-20 rounded-lg object-cover"></td>
                            <td class="px-4 py-3">
                                <p class="font-medium">{{ $banner->title }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $banner->subtitle }}</p>
                            </td>
                            <td class="px-4 py-3">{{ $banner->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                            <td class="px-4 py-3">{{ $banner->sort_order }}</td>
                            <td class="px-4 py-3 text-right">
                                <button type="button" data-fi-edit data-modal="banner-modal" data-title="Edit Banner" data-action="{{ route('backend.website-management.update-banner', $banner) }}" data-record='{!! json_encode(["title" => $banner->title, "subtitle" => $banner->subtitle, "description" => $banner->description, "cta_text" => $banner->cta_text, "cta_url" => $banner->cta_url, "sort_order" => $banner->sort_order, "is_active" => (bool) $banner->is_active, "starts_at" => optional($banner->starts_at)->format("Y-m-d"), "ends_at" => optional($banner->ends_at)->format("Y-m-d")], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                <form method="POST" action="{{ route('backend.website-management.destroy-banner', $banner) }}" data-confirm="Banner akan dihapus." data-confirm-title="Hapus banner?" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="rounded-lg p-2 text-error"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Belum ada banner.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $banners->links() }}</div>
        </div>
    </section>

    <section id="konten" class="fi-section">
        <div class="fi-section-head">
            <div>
                <h3 class="font-display text-xl text-primary">Konten halaman</h3>
                <p class="fi-help">Section tambahan seperti visi, misi, atau blok tentang.</p>
            </div>
            <button type="button" data-fi-create data-modal="content-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white">
                <span class="material-symbols-outlined text-[18px]">add</span> Tambah konten
            </button>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead><tr>
                        <th class="px-4 py-3 text-left">Halaman</th>
                        <th class="px-4 py-3 text-left">Section</th>
                        <th class="px-4 py-3 text-left">Judul</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr></thead>
                    <tbody>
                    @forelse($pageContents as $content)
                        <tr>
                            <td class="px-4 py-3">{{ $content->page_key }}</td>
                            <td class="px-4 py-3">{{ $content->section_key }}</td>
                            <td class="px-4 py-3">{{ $content->title ?: '-' }}</td>
                            <td class="px-4 py-3">{{ $content->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                            <td class="px-4 py-3 text-right">
                                <button type="button" data-fi-edit data-modal="content-modal" data-title="Edit Konten" data-action="{{ route('backend.website-management.update-page-content', $content) }}" data-record='{!! json_encode(["page_key" => $content->page_key, "section_key" => $content->section_key, "title" => $content->title, "content" => $content->content, "sort_order" => $content->sort_order, "is_active" => (bool) $content->is_active], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                <form method="POST" action="{{ route('backend.website-management.destroy-page-content', $content) }}" data-confirm="Konten akan dihapus." data-confirm-title="Hapus konten?" class="inline">@csrf @method('DELETE')<button class="rounded-lg p-2 text-error"><span class="material-symbols-outlined text-[18px]">delete</span></button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-8 text-center">Belum ada konten halaman.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $pageContents->links() }}</div>
        </div>
    </section>
</div>

<div id="banner-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white p-6">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Banner</h3>
            <button type="button" data-fi-close class="rounded-lg p-2"><span class="material-symbols-outlined">close</span></button>
        </div>
        <form method="POST" action="{{ route('backend.website-management.store-banner') }}" enctype="multipart/form-data" data-loading class="space-y-4">
            @csrf
            <div><label class="fi-label">Judul <span class="text-error">*</span></label><input name="title" required class="fi-input"></div>
            <div><label class="fi-label">Subjudul</label><input name="subtitle" class="fi-input"></div>
            <div><label class="fi-label">Deskripsi</label><textarea name="description" rows="3" class="fi-input"></textarea></div>
            <div class="fi-upload">
                <label class="fi-label">Gambar</label>
                <img data-fi-preview class="fi-upload-preview hidden" alt="">
                <input type="file" name="image" data-fi-file data-required-on-create required accept="image/*" class="fi-input">
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div><label class="fi-label">Teks tombol</label><input name="cta_text" class="fi-input"></div>
                <div><label class="fi-label">URL tombol</label><input name="cta_url" class="fi-input" placeholder="/reservasi"></div>
            </div>
            <div class="grid gap-4 sm:grid-cols-3">
                <div><label class="fi-label">Urutan</label><input type="number" name="sort_order" value="0" min="0" class="fi-input"></div>
                <div><label class="fi-label">Mulai</label><input type="date" name="starts_at" class="fi-input"></div>
                <div><label class="fi-label">Selesai</label><input type="date" name="ends_at" class="fi-input"></div>
            </div>
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" checked data-default-checked> Aktif</label>
            <div class="flex justify-end gap-3">
                <button type="button" data-fi-close class="rounded-xl border px-5 py-2.5 text-sm">Batal</button>
                <button class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="content-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white p-6">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Konten</h3>
            <button type="button" data-fi-close class="rounded-lg p-2"><span class="material-symbols-outlined">close</span></button>
        </div>
        <form method="POST" action="{{ route('backend.website-management.store-page-content') }}" enctype="multipart/form-data" data-loading class="space-y-4">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2">
                <div><label class="fi-label">Page key <span class="text-error">*</span></label><input name="page_key" required class="fi-input" placeholder="about"></div>
                <div><label class="fi-label">Section key <span class="text-error">*</span></label><input name="section_key" required class="fi-input" placeholder="visi"></div>
            </div>
            <div><label class="fi-label">Judul</label><input name="title" class="fi-input"></div>
            <div><label class="fi-label">Isi</label><textarea name="content" rows="5" class="fi-input"></textarea></div>
            <div class="fi-upload">
                <label class="fi-label">Gambar</label>
                <img data-fi-preview class="fi-upload-preview hidden" alt="">
                <input type="file" name="image" data-fi-file accept="image/*" class="fi-input">
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div><label class="fi-label">Urutan</label><input type="number" name="sort_order" value="0" min="0" class="fi-input"></div>
                <label class="mt-7 flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" checked data-default-checked> Aktif</label>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" data-fi-close class="rounded-xl border px-5 py-2.5 text-sm">Batal</button>
                <button class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function mapsEmbedUrl(value) {
    const raw = (value || '').trim();
    if (!raw) return '';

    const embedMatch = raw.match(/src=["']([^"']+)["']/i);
    const candidate = embedMatch ? embedMatch[1] : raw;

    let parsed;
    try {
        parsed = new URL(candidate);
    } catch (error) {
        return '';
    }

    const host = parsed.hostname.toLowerCase();
    const allowed = host === 'google.com'
        || host.endsWith('.google.com')
        || host === 'google.co.id'
        || host.endsWith('.google.co.id')
        || host === 'goo.gl'
        || host.endsWith('.goo.gl');
    if (!allowed) return '';

    if (parsed.pathname.includes('/maps/embed') || parsed.searchParams.get('output') === 'embed') {
        return parsed.toString();
    }

    return 'https://maps.google.com/maps?q=' + encodeURIComponent(candidate) + '&output=embed';
}

function syncMapsPreview() {
    const input = document.querySelector('[data-maps-url]');
    const frame = document.querySelector('[data-maps-frame]');
    const wrap = document.querySelector('[data-maps-preview]');
    if (!input || !frame || !wrap) return;

    const src = mapsEmbedUrl(input.value);
    if (!src) {
        wrap.classList.add('hidden');
        frame.removeAttribute('src');
        return;
    }

    if (frame.getAttribute('src') !== src) frame.src = src;
    wrap.classList.remove('hidden');
}

document.querySelector('[data-maps-url]')?.addEventListener('input', syncMapsPreview);
syncMapsPreview();
</script>
@endpush
@endsection
