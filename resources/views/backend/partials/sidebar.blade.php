@php
    $groups = [
        ['label' => 'Utama', 'items' => [
            ['label' => 'Dashboard', 'icon' => 'dashboard', 'route' => 'backend.dashboard', 'can' => ['dashboard.view']],
        ]],
        ['label' => 'Konten Website', 'items' => [
            ['label' => 'Website Management', 'icon' => 'language', 'route' => 'backend.website-management.index', 'match' => 'backend.website-management.*', 'can' => ['website_cms.view', 'settings.view', 'banners.view', 'page_contents.view']],
            ['label' => 'Gallery', 'icon' => 'photo_library', 'route' => 'backend.gallery.index', 'match' => 'backend.gallery.*', 'can' => ['gallery_categories.view', 'galleries.view']],
        ]],
        ['label' => 'Properti', 'items' => [
            ['label' => 'Room Management', 'icon' => 'king_bed', 'route' => 'backend.room-management.index', 'match' => 'backend.room-management.*', 'can' => ['room_categories.view', 'room_types.view', 'rooms.view', 'room_facilities.view']],
            ['label' => 'Resort Facilities', 'icon' => 'pool', 'route' => 'backend.resort-facilities.index', 'match' => 'backend.resort-facilities.*', 'can' => ['facility_categories.view', 'resort_facilities.view']],
            ['label' => 'Promotions & Packages', 'icon' => 'local_offer', 'route' => 'backend.promotions-packages.index', 'match' => 'backend.promotions-packages.*', 'can' => ['promotions.view', 'packages.view']],
        ]],
        ['label' => 'Operasional', 'items' => [
            ['label' => 'Booking Management', 'icon' => 'event_available', 'route' => 'backend.booking-management.index', 'match' => 'backend.booking-management.*', 'can' => ['reservations.view', 'customers.view', 'guests.view', 'front_desk.view']],
            ['label' => 'Payment Management', 'icon' => 'payments', 'route' => 'backend.payment-management.index', 'match' => 'backend.payment-management.*', 'can' => ['payment_methods.view', 'payments.view']],
            ['label' => 'Housekeeping', 'icon' => 'cleaning_services', 'route' => 'backend.housekeeping.index', 'match' => 'backend.housekeeping.*', 'can' => ['housekeeping.view']],
        ]],
        ['label' => 'Tamu', 'items' => [
            ['label' => 'Reviews & Messages', 'icon' => 'forum', 'route' => 'backend.reviews-messages.index', 'match' => 'backend.reviews-messages.*', 'can' => ['reviews.view', 'contact_messages.view']],
        ]],
        ['label' => 'Sistem', 'items' => [
            ['label' => 'Staff & Access', 'icon' => 'manage_accounts', 'route' => 'backend.staff-access.index', 'match' => 'backend.staff-access.*', 'can' => ['users.view', 'roles.view', 'permissions.view']],
            ['label' => 'Reports & Analytics', 'icon' => 'analytics', 'route' => 'backend.reports-analytics.index', 'match' => 'backend.reports-analytics.*', 'can' => ['reports.view', 'activity_logs.view']],
            ['label' => 'Notifications & Settings', 'icon' => 'settings', 'route' => 'backend.notifications-settings.index', 'match' => 'backend.notifications-settings.*', 'can' => ['notifications.view']],
        ]],
    ];
    $groups = array_values(array_filter(array_map(function (array $group) {
        $group['items'] = array_values(array_filter(
            $group['items'],
            fn (array $item) => auth()->user()->allows(...$item['can'])
        ));

        return $group['items'] === [] ? null : $group;
    }, $groups)));
    $siteName = $site->site_name ?: 'Haven Palais';
    $siteTagline = $site->site_tagline ?: 'Admin Console';
    $siteLogo = $site->fileUrl('site_logo');
    $isActive = function ($item) {
        if (!empty($item['match'])) {
            return request()->routeIs($item['match']);
        }
        if (!empty($item['route'])) {
            return request()->routeIs($item['route']);
        }
        return false;
    };
@endphp

<div id="admin-sidebar-overlay" class="admin-overlay fixed inset-0 z-40 hidden bg-primary/50 lg:hidden"></div>

<aside id="admin-sidebar"
    class="admin-scrollbar fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col border-r border-outline-variant/40 bg-surface-container-lowest transition-transform duration-300 lg:translate-x-0">
    <div class="flex h-16 items-center justify-between border-b border-outline-variant/40 px-5">
        <a href="{{ auth()->user()->staffHome() }}" class="flex min-w-0 items-center gap-3">
            @if($siteLogo)
                <img src="{{ $siteLogo }}" alt="{{ $siteName }}" class="h-9 w-9 shrink-0 rounded-lg object-cover">
            @else
                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-primary-container text-on-primary">
                    <span class="material-symbols-outlined text-[20px]">apartment</span>
                </span>
            @endif
            <span class="min-w-0">
                <span class="block truncate font-display text-base leading-none text-primary">{{ $siteName }}</span>
                <span class="mt-1 block truncate text-[10px] font-semibold uppercase tracking-[0.16em] text-secondary">{{ $siteTagline }}</span>
            </span>
        </a>
        <button id="admin-sidebar-close" type="button" class="rounded-lg p-1.5 text-on-surface-variant hover:bg-surface-container lg:hidden">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <nav class="admin-scrollbar flex-1 overflow-y-auto px-3 py-3">
        @foreach($groups as $group)
            <p class="admin-sidebar-label">{{ $group['label'] }}</p>
            <div class="space-y-1">
                @foreach($group['items'] as $item)
                    @php $active = $isActive($item); @endphp
                    <a href="{{ route($item['route']) }}"
                        class="admin-sidebar-link flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
                        {{ $active ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-primary' }}">
                        <span class="material-symbols-outlined text-[20px]">{{ $item['icon'] }}</span>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        @endforeach
    </nav>

    <div class="border-t border-outline-variant/40 p-4">
        <a href="{{ url('/') }}" target="_blank"
            class="flex items-center gap-2 rounded-xl bg-secondary-container px-3 py-2.5 text-sm font-semibold text-on-secondary-container hover:opacity-90">
            <span class="material-symbols-outlined text-[18px]">open_in_new</span>
            Lihat Website
        </a>
    </div>
</aside>
