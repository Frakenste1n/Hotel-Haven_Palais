@props([
    'label',
    'value',
    'icon' => 'analytics',
    'tone' => 'primary',
    'hint' => null,
])

@php
    $tones = [
        'primary' => 'bg-primary-container text-on-primary',
        'secondary' => 'bg-secondary-container text-on-secondary-container',
        'surface' => 'bg-surface-container-high text-primary',
        'danger' => 'bg-error-container text-on-error-container',
    ];
@endphp

<div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-5 shadow-soft">
    <div class="flex items-start justify-between gap-3">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.12em] text-on-surface-variant">{{ $label }}</p>
            <p class="mt-2 font-display text-3xl text-primary">{{ $value }}</p>
            @if($hint)
                <p class="mt-2 text-xs text-on-surface-variant">{{ $hint }}</p>
            @endif
        </div>
        <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl {{ $tones[$tone] ?? $tones['primary'] }}">
            <span class="material-symbols-outlined">{{ $icon }}</span>
        </span>
    </div>
</div>
