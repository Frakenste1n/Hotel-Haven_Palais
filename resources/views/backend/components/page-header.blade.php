@props([
    'title',
    'subtitle' => null,
    'createUrl' => null,
    'createLabel' => 'Tambah Data',
])

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <h2 class="font-display text-2xl text-primary sm:text-3xl">{{ $title }}</h2>
        @if($subtitle)
            <p class="mt-1 text-sm text-on-surface-variant">{{ $subtitle }}</p>
        @endif
    </div>
    <div class="flex flex-wrap items-center gap-2">
        {{ $actions ?? '' }}
        @if($createUrl)
            <a href="{{ $createUrl }}"
                class="inline-flex items-center gap-2 rounded-lg bg-primary-container px-4 py-2.5 text-sm font-semibold text-on-primary shadow-soft transition hover:bg-primary">
                <span class="material-symbols-outlined text-[18px]">add</span>
                {{ $createLabel }}
            </a>
        @endif
    </div>
</div>
