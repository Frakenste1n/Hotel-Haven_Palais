<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(session('success'))
        <meta name="flash-success" content="{{ session('success') }}">
    @endif
    @if(session('error'))
        <meta name="flash-error" content="{{ session('error') }}">
    @endif
    @if(old('_fi_modal'))
        <meta name="fi-open-modal" content="{{ old('_fi_modal') }}">
    @endif
    <title>@yield('title', 'Admin') — {{ $site->site_name ?: 'Haven Palais' }}</title>
    @if($site->site_favicon)
        <link rel="icon" href="{{ $site->fileUrl('site_favicon') }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#06151d',
                        'primary-container': '#1b2a32',
                        'on-primary': '#ffffff',
                        secondary: '#725b38',
                        'secondary-container': '#fedeb2',
                        'on-secondary-container': '#78603e',
                        surface: '#faf9f7',
                        'surface-container': '#efeeec',
                        'surface-container-low': '#f4f3f1',
                        'surface-container-high': '#e9e8e6',
                        'surface-container-highest': '#e3e2e0',
                        'surface-container-lowest': '#ffffff',
                        'on-surface': '#1a1c1b',
                        'on-surface-variant': '#43474a',
                        outline: '#73787b',
                        'outline-variant': '#c3c7ca',
                        error: '#ba1a1a',
                        'error-container': '#ffdad6',
                        'on-error': '#ffffff',
                        'on-error-container': '#93000a',
                        background: '#faf9f7',
                    },
                    fontFamily: {
                        display: ['Playfair Display', 'serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    boxShadow: {
                        soft: '0 1px 8px rgba(0,0,0,0.04)',
                        card: '0 8px 24px rgba(6,21,29,0.06)',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
    @stack('styles')
    <style>
        .tab-btn.active { background: #fff !important; color: #06151d !important; border-bottom: 2px solid #725b38 !important; }
        .fi-modal:not(.hidden) { display: flex !important; align-items: center; justify-content: center; }
    </style>
</head>
<body class="bg-surface font-sans text-on-surface antialiased">
    <div class="min-h-screen lg:flex">
        @include('backend.partials.sidebar')

        <div class="flex min-h-screen flex-1 flex-col lg:pl-72">
            @include('backend.partials.navbar')

            <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
                @hasSection('breadcrumb')
                    <div class="mb-4 text-sm text-on-surface-variant">
                        @yield('breadcrumb')
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 rounded-xl border border-error/20 bg-error-container px-4 py-3 text-sm text-on-error-container">
                        <div class="mb-1 flex items-center gap-2 font-semibold">
                            <span class="material-symbols-outlined text-[18px]">error</span>
                            Periksa kembali formulir
                        </div>
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @include('backend.partials.confirm-modal')
    <div id="fi-detail-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
        <div class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white p-6 shadow-card">
            <div class="mb-4 flex items-center justify-between gap-3">
                <h3 id="fi-detail-title" class="font-display text-xl text-primary">Detail</h3>
                <button type="button" data-fi-close class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div id="fi-detail-body" class="space-y-3"></div>
        </div>
    </div>
    @if(old('_fi_modal'))
        <script type="application/json" id="fi-old-input">{!! json_encode(old(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}</script>
    @endif
    <div id="admin-toast-root" class="pointer-events-none fixed bottom-4 right-4 z-[80] flex flex-col gap-3"></div>
    <div id="admin-loading-overlay" class="admin-overlay fixed inset-0 z-[70] hidden items-center justify-center bg-primary/40">
        <div class="rounded-2xl bg-surface-container-lowest px-6 py-5 shadow-card">
            <div class="flex items-center gap-3 text-on-surface">
                <span class="material-symbols-outlined animate-spin">progress_activity</span>
                <span class="text-sm font-medium">Memproses...</span>
            </div>
        </div>
    </div>

    <form id="admin-logout-form" method="POST" action="{{ route('backend.logout') }}" class="hidden">
        @csrf
    </form>

    <script src="{{ asset('backend/js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
