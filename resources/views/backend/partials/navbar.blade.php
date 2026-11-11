<header class="sticky top-0 z-30 border-b border-outline-variant/40 bg-surface/90 backdrop-blur-xl">
    <div class="flex h-16 items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <button id="admin-sidebar-open" type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-surface-container-low text-primary hover:bg-surface-container lg:hidden"
                aria-label="Buka menu">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-secondary">Admin Panel</p>
                <h1 class="font-display text-lg leading-tight text-primary sm:text-xl">@yield('title', 'Dashboard')</h1>
            </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-3">
            <a href="{{ route('backend.notifications-settings.index') }}"
                class="relative inline-flex h-10 w-10 items-center justify-center rounded-lg bg-surface-container-low text-on-surface-variant hover:bg-surface-container hover:text-primary">
                <span class="material-symbols-outlined text-[20px]">notifications</span>
                @php $unread = auth()->user()?->unreadNotifications?->count() ?? 0; @endphp
                @if($unread > 0)
                    <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-secondary"></span>
                @endif
            </a>

            <div class="relative">
                <button id="admin-avatar-trigger" type="button"
                    class="flex items-center gap-2 rounded-xl bg-surface-container-low px-2.5 py-1.5 hover:bg-surface-container">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-primary-container text-xs font-semibold text-on-primary">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </span>
                    <span class="hidden text-left sm:block">
                        <span class="block text-sm font-semibold text-primary">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <span class="block text-[11px] text-on-surface-variant">{{ auth()->user()->roles->first()->name ?? 'Staff' }}</span>
                    </span>
                    <span class="material-symbols-outlined text-[18px] text-on-surface-variant">expand_more</span>
                </button>

                <div id="admin-avatar-menu"
                    class="absolute right-0 mt-2 hidden w-56 overflow-hidden rounded-xl border border-outline-variant/50 bg-surface-container-lowest shadow-card">
                    <div class="border-b border-outline-variant/40 px-4 py-3">
                        <p class="text-sm font-semibold text-primary">{{ auth()->user()->name }}</p>
                        <p class="truncate text-xs text-on-surface-variant">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ route('backend.notifications-settings.index') }}"
                        class="flex items-center gap-2 px-4 py-2.5 text-sm text-on-surface-variant hover:bg-surface-container-low hover:text-primary">
                        <span class="material-symbols-outlined text-[18px]">person</span>
                        Profil
                    </a>
                    <button type="button" data-logout
                        class="flex w-full items-center gap-2 px-4 py-2.5 text-left text-sm text-error hover:bg-error-container">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
