@extends('backend.layouts.app')

@section('title', 'Notifications & Settings')

@section('breadcrumb')
    <a href="{{ route('backend.dashboard') }}" class="hover:text-primary">Dashboard</a>
    <span class="mx-2 text-outline-variant">/</span>
    <span class="font-medium text-primary">Notifications & Settings</span>
@endsection

@section('content')
<div class="space-y-6">
    @include('backend.components.page-header', [
        'title' => 'Notifications & Settings',
        'subtitle' => 'Notifikasi akun dan pengaturan profil admin dalam satu halaman.',
    ])

    <div class="grid gap-6 xl:grid-cols-5">
        <section class="fi-section xl:col-span-3">
            <div class="fi-section-head">
                <div>
                    <h3 class="font-display text-xl text-primary">Notifikasi</h3>
                    <p class="fi-help">Pemberitahuan untuk akun yang sedang login.</p>
                </div>
                <form method="POST" action="{{ route('backend.notifications-settings.read-all') }}">
                    @csrf
                    <button class="rounded-xl border border-outline-variant px-4 py-2 text-sm font-semibold">Tandai semua dibaca</button>
                </form>
            </div>
            <div class="divide-y divide-outline-variant/40">
                @forelse($notifications as $notification)
                    <div class="flex flex-col gap-3 px-5 py-4 sm:flex-row sm:items-start sm:justify-between {{ $notification->read_at ? '' : 'bg-secondary-container/40' }}">
                        <div>
                            <p class="text-sm font-semibold text-primary">{{ $notification->data['title'] ?? 'Notifikasi' }}</p>
                            <p class="mt-1 text-sm text-on-surface-variant">{{ $notification->data['message'] ?? $notification->data['body'] ?? 'Tidak ada detail.' }}</p>
                            <p class="mt-1 text-xs text-outline">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        @if(! $notification->read_at)
                            <form method="POST" action="{{ route('backend.notifications-settings.read', $notification->id) }}">
                                @csrf
                                <button class="rounded-lg bg-primary px-3 py-1.5 text-xs font-semibold text-white">Tandai dibaca</button>
                            </form>
                        @endif
                    </div>
                @empty
                    <div class="px-5 py-10 text-center text-sm text-on-surface-variant">Tidak ada notifikasi.</div>
                @endforelse
            </div>
            <div class="border-t border-outline-variant/40 p-4">{{ $notifications->links() }}</div>
        </section>

        <section class="fi-section xl:col-span-2">
            <div class="fi-section-head">
                <div>
                    <h3 class="font-display text-xl text-primary">Profil akun</h3>
                    <p class="fi-help">Email tidak diubah dari halaman ini.</p>
                </div>
            </div>
            <form method="POST" action="{{ route('backend.notifications-settings.profile') }}" data-loading class="space-y-4 p-5">
                @csrf
                @method('PUT')
                <div>
                    <label class="fi-label">Nama</label>
                    <input name="name" value="{{ old('name', $user->name) }}" required class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Email</label>
                    <input value="{{ $user->email }}" disabled class="fi-input bg-surface-container-low">
                </div>
                <div>
                    <label class="fi-label">Telepon</label>
                    <input name="phone" value="{{ old('phone', $user->phone) }}" class="fi-input">
                </div>
                <div>
                    <label class="fi-label">Password baru</label>
                    <input type="password" name="password" class="fi-input" placeholder="Kosongkan jika tidak diubah">
                </div>
                <div>
                    <label class="fi-label">Konfirmasi password</label>
                    <input type="password" name="password_confirmation" class="fi-input">
                </div>
                <button class="w-full rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white">Simpan profil</button>
            </form>
        </section>
    </div>
</div>
@endsection
