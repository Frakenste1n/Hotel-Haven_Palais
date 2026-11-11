@props(['status'])

@php
    $map = [
        'available' => 'bg-emerald-100 text-emerald-800',
        'occupied' => 'bg-sky-100 text-sky-800',
        'cleaning' => 'bg-amber-100 text-amber-800',
        'maintenance' => 'bg-orange-100 text-orange-800',
        'out_of_order' => 'bg-rose-100 text-rose-800',
        'pending_payment' => 'bg-amber-100 text-amber-800',
        'confirmed' => 'bg-emerald-100 text-emerald-800',
        'checked_in' => 'bg-sky-100 text-sky-800',
        'checked_out' => 'bg-slate-200 text-slate-700',
        'cancelled' => 'bg-rose-100 text-rose-800',
        'expired' => 'bg-slate-200 text-slate-700',
        'unpaid' => 'bg-slate-200 text-slate-700',
        'waiting_verification' => 'bg-amber-100 text-amber-800',
        'paid' => 'bg-emerald-100 text-emerald-800',
        'rejected' => 'bg-rose-100 text-rose-800',
        'refunded' => 'bg-violet-100 text-violet-800',
        'pending' => 'bg-amber-100 text-amber-800',
        'approved' => 'bg-emerald-100 text-emerald-800',
        'in_progress' => 'bg-sky-100 text-sky-800',
        'completed' => 'bg-emerald-100 text-emerald-800',
        'verified' => 'bg-emerald-100 text-emerald-800',
        'new' => 'bg-sky-100 text-sky-800',
        'read' => 'bg-slate-200 text-slate-700',
        'followed_up' => 'bg-emerald-100 text-emerald-800',
        'active' => 'bg-emerald-100 text-emerald-800',
        'inactive' => 'bg-slate-200 text-slate-700',
    ];
    $class = $map[$status] ?? 'bg-surface-container-high text-on-surface-variant';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide {$class}"]) }}>
    {{ str_replace('_', ' ', $status) }}
</span>
