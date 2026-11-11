@props([
    'title' => 'Belum ada data',
    'description' => 'Data yang Anda cari belum tersedia.',
    'icon' => 'inbox',
    'actionUrl' => null,
    'actionLabel' => 'Tambah Data',
])

<div class="rounded-2xl border border-dashed border-outline-variant bg-surface-container-low px-6 py-14 text-center">
    <span class="mx-auto mb-3 inline-flex h-14 w-14 items-center justify-center rounded-full bg-surface-container-highest text-secondary">
        <span class="material-symbols-outlined text-[28px]">{{ $icon }}</span>
    </span>
    <h3 class="font-display text-xl text-primary">{{ $title }}</h3>
    <p class="mx-auto mt-2 max-w-md text-sm text-on-surface-variant">{{ $description }}</p>
    @if($actionUrl)
        <a href="{{ $actionUrl }}"
            class="mt-5 inline-flex items-center gap-2 rounded-lg bg-primary-container px-4 py-2.5 text-sm font-semibold text-on-primary hover:bg-primary">
            <span class="material-symbols-outlined text-[18px]">add</span>
            {{ $actionLabel }}
        </a>
    @endif
</div>
