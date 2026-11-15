<!DOCTYPE html>

<html lang="id">

@extends('frontend.layouts.app')

@section('title', 'Fasilitas')

@section('content')

@if (session('success'))
    <div id="success-notification"
        class="fixed top-24 right-6 z-[100] bg-green-600 text-white px-6 py-4 rounded-lg shadow-lg">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const notification = document.getElementById('success-notification');

            if (notification) {
                notification.style.transition = 'opacity 0.5s ease';
                notification.style.opacity = '0';

                setTimeout(() => notification.remove(), 500);
            }
        }, 3000);
    </script>
@endif

@endsection

<head>
    <meta charset="utf-8" />
    @if($site->site_favicon)
        <link rel="icon" href="{{ $site->fileUrl('site_favicon') }}">
    @endif
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="web_dashboard" name="shell-type" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <style>
        @layer base {

            html,
            body {
                margin: 0;
                padding: 0;
            }

            body {
                overscroll-behavior: none;
            }

            main>:first-child {
                margin-top: 0 !important;
            }

            main>:last-child {
                margin-bottom: 0 !important;
            }
        }

        ::-webkit-scrollbar {
            display: none;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script
        id="tailwind-config">tailwind.config = { "darkMode": "class", "theme": { "extend": { "colors": { "surface-variant": "#e3e2e0", "primary": "#06151d", "error-container": "#ffdad6", "on-tertiary-fixed-variant": "#394857", "primary-fixed": "#d5e5f0", "on-tertiary": "#ffffff", "tertiary": "#051522", "on-error": "#ffffff", "on-error-container": "#93000a", "surface-container-high": "#e9e8e6", "surface": "#faf9f7", "secondary-fixed-dim": "#e0c298", "on-primary-fixed-variant": "#3a4951", "on-secondary": "#ffffff", "on-primary": "#ffffff", "surface-bright": "#faf9f7", "on-primary-fixed": "#0e1d25", "inverse-primary": "#b9c9d3", "on-surface-variant": "#43474a", "tertiary-container": "#1a2a37", "error": "#ba1a1a", "secondary-fixed": "#fedeb2", "outline": "#73787b", "on-primary-container": "#82919b", "inverse-on-surface": "#f1f1ef", "primary-container": "#1b2a32", "on-tertiary-container": "#8191a2", "surface-container-low": "#f4f3f1", "outline-variant": "#c3c7ca", "surface-container": "#efeeec", "on-secondary-container": "#78603e", "surface-tint": "#51616a", "surface-container-highest": "#e3e2e0", "inverse-surface": "#2f3130", "on-background": "#1a1c1b", "secondary-container": "#fedeb2", "secondary": "#725b38", "surface-dim": "#dadad8", "on-tertiary-fixed": "#0d1d2a", "on-secondary-fixed-variant": "#584323", "background": "#faf9f7", "surface-container-lowest": "#ffffff", "on-secondary-fixed": "#281800", "tertiary-fixed-dim": "#b8c8da", "on-surface": "#1a1c1b", "tertiary-fixed": "#d4e4f6", "primary-fixed-dim": "#b9c9d3" }, "borderRadius": { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" }, "spacing": { "margin": "4rem", "space-2xl": "4rem", "space-sm": "0.5rem", "space-xl": "2.5rem", "space-lg": "1.5rem", "margin-mobile": "1.5rem", "space-md": "1rem", "gutter-mobile": "1rem", "space-3xl": "6rem", "gutter": "2rem", "space-xs": "0.25rem" }, "fontFamily": { "body-lg": ["Plus Jakarta Sans"], "title-editorial": ["Playfair Display"], "label-md": ["Plus Jakarta Sans"], "label-uppercase": ["Plus Jakarta Sans"], "headline-lg": ["Playfair Display"], "display-hero": ["Playfair Display"], "display-hero-mobile": ["Playfair Display"], "headline-lg-mobile": ["Playfair Display"], "headline-sm": ["Playfair Display"], "body-md": ["Plus Jakarta Sans"], "headline-md": ["Playfair Display"], "body-sm": ["Plus Jakarta Sans"] }, "fontSize": { "body-lg": ["1.125rem", { "lineHeight": "1.875rem", "fontWeight": "400" }], "title-editorial": ["1.25rem", { "lineHeight": "1.75rem", "letterSpacing": "0.01em", "fontWeight": "500" }], "label-md": ["0.875rem", { "lineHeight": "1.25rem", "fontWeight": "500" }], "label-uppercase": ["0.75rem", { "lineHeight": "1rem", "letterSpacing": "0.12em", "fontWeight": "600" }], "headline-lg": ["3rem", { "lineHeight": "3.5rem", "letterSpacing": "-0.01em", "fontWeight": "400" }], "display-hero": ["4.5rem", { "lineHeight": "5rem", "letterSpacing": "-0.02em", "fontWeight": "400" }], "display-hero-mobile": ["2.75rem", { "lineHeight": "3.25rem", "letterSpacing": "-0.01em", "fontWeight": "400" }], "headline-lg-mobile": ["2rem", { "lineHeight": "2.5rem", "letterSpacing": "0em", "fontWeight": "400" }], "headline-sm": ["1.5rem", { "lineHeight": "2rem", "fontWeight": "600" }], "body-md": ["1rem", { "lineHeight": "1.625rem", "fontWeight": "400" }], "headline-md": ["2.25rem", { "lineHeight": "2.75rem", "fontWeight": "500" }], "body-sm": ["0.875rem", { "lineHeight": "1.375rem", "fontWeight": "400" }] } } } }</script>
</head>

<body class="bg-surface font-body-md text-on-surface antialiased">
    <div class="">
        <main class="relative pt-20 bg-surface min-h-screen">
            <div class="flex flex-col w-full">
                <!-- Top Breadcrumb & Hero Scrim Banner -->
                <section class="relative w-full -mt-20 overflow-hidden bg-primary">
                    <div class="w-full min-h-[640px] lg:min-h-[720px] bg-cover bg-center flex flex-col justify-between pt-28 pb-16 px-6 lg:px-16 relative"
                        data-alt="Stunning aerial view of Haven Palais luxury coastal resort on a majestic cliff overlooking turquoise Indian Ocean waves, architectural infinity pools, lush tropical flora, warm natural sunlight and limestone formations in Bali. Cinematic, ultra-luxurious, serene atmosphere."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAaMxvIPfYn2E_ZfJ1mjWgwbT6IZNCK9QFr3lU6PwcmQVmvI67dKLhxtd9P3Ii8nCgwR5qRcE5gYZUhz0H99BtnfeeyZn2URRoGAw19JumhoBwCnEsjQlLIL4x9WhNqLWcQUXLNDP1eoSwdsBPcme-weLM8fQNBoF_IULqZOPOC-GvKjXCnevfmsgHZZgju0zc8gF7N-r4lppofTleLeQsCefhlaIaDED3s5O7aE-s')">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/60 to-primary/40"></div>
                        <!-- Content Container -->
                        <div
                            class="relative z-10 max-w-[1320px] mx-auto w-full flex flex-col justify-between h-full flex-grow">
                            <!-- Breadcrumb -->
                            <nav aria-label="Breadcrumb" class="flex items-center gap-2 mb-8">
                                <a class="font-label-uppercase text-label-uppercase text-on-primary/70 hover:text-on-primary transition-colors flex items-center gap-1.5"
                                    href="/">
                                    <span class="material-symbols-outlined text-[16px]">cottage</span>
                                    Home
                                </a>
                                <span class="text-on-primary/40 text-xs">/</span>
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary-fixed tracking-wider">Fasilitas
                                    Resor</span>
                            </nav>
                            <!-- Main Hero Title & Lead -->
                            <div class="max-w-3xl space-y-5 my-auto">
                                <div
                                    class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-surface-container-lowest/15 backdrop-blur-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-secondary-fixed"></span>
                                    <span
                                        class="font-label-uppercase text-label-uppercase text-secondary-fixed tracking-widest text-[11px]">Santuari
                                        Kemewahan Tropis</span>
                                </div>
                                <h1
                                    class="font-display-hero text-headline-lg lg:text-display-hero text-on-primary tracking-tight leading-none">
                                    Oase Kemewahan &amp; Pengalaman Tanpa Batas
                                </h1>
                                <p
                                    class="font-body-lg text-body-lg text-on-primary/85 leading-relaxed max-w-2xl font-light">
                                    Temukan harmoni sempurna antara ketenangan alam pesisir, relaksasi berkelas dunia,
                                    dan keajaiban rasa di setiap sudut Haven Palais Resort &amp; Spa.
                                </p>
                            </div>
                            <!-- Quick Highlight Badges Strip -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-10">
                                <div
                                    class="p-4 rounded-lg bg-surface-container-lowest/10 backdrop-blur-md flex items-center gap-3.5">
                                    <div
                                        class="w-10 h-10 rounded-full bg-secondary-fixed/20 flex items-center justify-center text-secondary-fixed shrink-0">
                                        <span class="material-symbols-outlined text-[20px]">hotel_class</span>
                                    </div>
                                    <div>
                                        <p
                                            class="font-headline-sm text-title-editorial text-on-primary leading-tight font-semibold">
                                            12+ Fasilitas</p>
                                        <p class="font-label-uppercase text-[10px] text-on-primary/70 tracking-wider">
                                            Bintang Lima</p>
                                    </div>
                                </div>
                                <div
                                    class="p-4 rounded-lg bg-surface-container-lowest/10 backdrop-blur-md flex items-center gap-3.5">
                                    <div
                                        class="w-10 h-10 rounded-full bg-secondary-fixed/20 flex items-center justify-center text-secondary-fixed shrink-0">
                                        <span class="material-symbols-outlined text-[20px]">beach_access</span>
                                    </div>
                                    <div>
                                        <p
                                            class="font-headline-sm text-title-editorial text-on-primary leading-tight font-semibold">
                                            Pantai Privat</p>
                                        <p class="font-label-uppercase text-[10px] text-on-primary/70 tracking-wider">
                                            Akses 24 Jam</p>
                                    </div>
                                </div>
                                <div
                                    class="p-4 rounded-lg bg-surface-container-lowest/10 backdrop-blur-md flex items-center gap-3.5">
                                    <div
                                        class="w-10 h-10 rounded-full bg-secondary-fixed/20 flex items-center justify-center text-secondary-fixed shrink-0">
                                        <span class="material-symbols-outlined text-[20px]">room_service</span>
                                    </div>
                                    <div>
                                        <p
                                            class="font-headline-sm text-title-editorial text-on-primary leading-tight font-semibold">
                                            Dedicated Butler</p>
                                        <p class="font-label-uppercase text-[10px] text-on-primary/70 tracking-wider">
                                            Layanan Pribadi</p>
                                    </div>
                                </div>
                                <div
                                    class="p-4 rounded-lg bg-surface-container-lowest/10 backdrop-blur-md flex items-center gap-3.5">
                                    <div
                                        class="w-10 h-10 rounded-full bg-secondary-fixed/20 flex items-center justify-center text-secondary-fixed shrink-0">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </div>
                                    <div>
                                        <p
                                            class="font-headline-sm text-title-editorial text-on-primary leading-tight font-semibold">
                                            180° Samudra</p>
                                        <p class="font-label-uppercase text-[10px] text-on-primary/70 tracking-wider">
                                            Panorama Hindia</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Filosofi Resor Section -->
                <section class="w-full py-20 lg:py-28 px-6 lg:px-16 bg-surface">
                    <div class="max-w-[1320px] mx-auto">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                            <!-- Text Column -->
                            <div class="lg:col-span-6 space-y-6">
                                <div class="flex items-center gap-2">
                                    <span class="h-px w-8 bg-secondary"></span>
                                    <span
                                        class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Filosofi
                                        &amp; Dedikasi</span>
                                </div>
                                <h2
                                    class="font-headline-lg text-headline-md lg:text-headline-lg text-primary tracking-tight">
                                    Diciptakan untuk Memanjakan Setiap Indera
                                </h2>
                                <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                                    Di Haven Palais, setiap fasilitas bukan sekadar pelengkap liburan, melainkan
                                    panggung kurasi di mana ketenangan batin, estetika arsitektur tebing kapur, dan
                                    kemewahan alami berpadu dalam keheningan sempurna.
                                </p>
                                <p class="font-body-md text-body-md text-on-surface leading-relaxed">
                                    Terinspirasi oleh warisan maritim Nusantara dan presisi kenyamanan modern Eropa,
                                    kami memadukan keramahan tanpa cela dengan komitmen pelestarian ekosistem terumbu
                                    karang Uluwatu. Setiap detail dirancang untuk memberikan privasi absolut tanpa
                                    memutus keterhubungan Anda dengan deburan ombak samudra.
                                </p>
                                <div class="pt-4 grid grid-cols-2 gap-6">
                                    <div class="space-y-1">
                                        <p class="font-title-editorial text-headline-sm text-primary">100%</p>
                                        <p
                                            class="font-label-uppercase text-[11px] text-on-surface-variant tracking-wider">
                                            Bahan Alami &amp; Organik Spa</p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="font-title-editorial text-headline-sm text-primary">Les Clefs d'Or</p>
                                        <p
                                            class="font-label-uppercase text-[11px] text-on-surface-variant tracking-wider">
                                            Sertifikasi Concierge Global</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Asymmetric Visual Showcase Column -->
                            <div class="lg:col-span-6 relative">
                                <div class="relative w-full h-[460px] rounded-lg overflow-hidden shadow-2xl">
                                    <img alt="Arsitektur Haven Palais" class="w-full h-full object-cover"
                                        data-alt="Serene architectural pavilion of Haven Palais Resort with reflection pool, minimalist teak wood deck, white stone colonnades overlooking the ocean horizon at morning light. Quiet, zen-like luxury resort ambiance in Bali."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBf_83hlkgTDjtHbu-TUE2Uyr49Aea5399rN138uPuAxMYpWULSgTelPKHrDWRWxinOC51vrfXpgGfjkCa6pm6y8PvHUb-KOEYynFf-fr2gVws94DX-C1BilJDngUG9ESYIhCUB6fGgZPWAbssJTp3uccZFxhanqRa17mX8ylt17c9upmqGq7AW_x65lh7q10Cynz7E0m4djKYnPFt_PqzeOSluQjXwBYKHiehbsx4" />
                                </div>
                                <!-- Overlapping Ambient Card -->
                                <div
                                    class="absolute -bottom-8 -left-4 md:-left-8 max-w-xs p-6 bg-surface-container-lowest rounded-lg shadow-xl hidden sm:block">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="material-symbols-outlined text-secondary text-[24px]">eco</span>
                                        <span
                                            class="font-label-uppercase text-[11px] text-primary tracking-wider font-semibold">Eco-Conscious
                                            Haven</span>
                                    </div>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant leading-snug">
                                        Desain bioklimatik dengan sirkulasi udara alami samudra, bebas plastik sekali
                                        pakai, dan nol limbah cair ke laut.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Interactive Facilities Filter & Rich Showcase Cards -->
                <section class="w-full py-16 lg:py-24 px-6 lg:px-16 bg-surface-container-low" id="fasilitas-showcase">
                    <div class="max-w-[1320px] mx-auto space-y-12">
                        <!-- Section Header -->
                        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                            <div>
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest block mb-2">Koleksi
                                    Terkurasi</span>
                                <h2
                                    class="font-headline-lg text-headline-md lg:text-headline-lg text-primary tracking-tight">
                                    Eksplorasi Fasilitas Resor
                                </h2>
                            </div>
                            <p class="font-body-md text-body-md text-on-surface-variant max-w-md">
                                Pilihlah pengalaman yang sesuai dengan ritme liburan Anda, mulai dari relaksasi holistik
                                hingga eksplorasi cita rasa mewah.
                            </p>
                        </div>
                        <!-- Filter Tabs Container -->
                        <div class="flex flex-wrap items-center gap-2 p-1.5 bg-surface-container-high rounded-lg max-w-full overflow-x-auto"
                            id="facility-tabs">
                            <button
                                class="facility-tab-btn active px-5 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-wider transition-all bg-primary-container text-on-primary shadow-sm"
                                data-filter="all" onclick="filterFacilities('all')">
                                Semua Fasilitas
                            </button>
                            <button
                                class="facility-tab-btn px-5 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-wider transition-all text-on-surface-variant hover:text-primary"
                                data-filter="wellness" onclick="filterFacilities('wellness')">
                                Rekreasi &amp; Kebugaran
                            </button>
                            <button
                                class="facility-tab-btn px-5 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-wider transition-all text-on-surface-variant hover:text-primary"
                                data-filter="gastronomy" onclick="filterFacilities('gastronomy')">
                                Santapan &amp; Fine Dining
                            </button>
                            <button
                                class="facility-tab-btn px-5 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-wider transition-all text-on-surface-variant hover:text-primary"
                                data-filter="experiences" onclick="filterFacilities('experiences')">
                                Hiburan &amp; Pengalaman
                            </button>
                            <button
                                class="facility-tab-btn px-5 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-wider transition-all text-on-surface-variant hover:text-primary"
                                data-filter="vip" onclick="filterFacilities('vip')">
                                Eksklusif &amp; VIP
                            </button>
                        </div>
                        <!-- Facilities Bento Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="facility-grid">

                            @php
                                $facilityMeta = [
                                    'infinity-horizon-cliff-pool' => [
                                        'icon' => 'schedule',
                                        'label' => 'Tersedia untuk Tamu Resor',
                                    ],
                                    'serenity-spa-thalassotherapy' => [
                                        'icon' => 'spa',
                                        'label' => 'Perlu Reservasi Awal',
                                    ],
                                    'yoga-pavilion-fitness-sanctuary' => [
                                        'icon' => 'fitness_center',
                                        'label' => 'Termasuk Daily Class',
                                    ],
                                    'palais-haute-cuisine-degustation' => [
                                        'icon' => 'restaurant',
                                        'label' => 'Dress Code: Resort Chic',
                                    ],
                                    'oceanfront-starlight-cabana' => [
                                        'icon' => 'favorite',
                                        'label' => 'Slot Terbatas (2 Pasang/Malam)',
                                    ],
                                    'horizon-sunset-cocktail-lounge' => [
                                        'icon' => 'wine_bar',
                                        'label' => 'Live Saxophone Sunset',
                                    ],
                                    'private-open-air-amphitheatre' => [
                                        'icon' => 'theater_comedy',
                                        'label' => 'Tamu Menginap Gratis',
                                    ],
                                    'private-cove-beach-club-yacht' => [
                                        'icon' => 'sailing',
                                        'label' => 'Lift Akses Tebing Khusus',
                                    ],
                                    'cinepalais-private-cinema' => [
                                        'icon' => 'movie',
                                        'label' => 'Tersedia Private Screening',
                                    ],
                                    'private-helipad-fleet-maybach' => [
                                        'icon' => 'flight_land',
                                        'label' => 'Protokol Keamanan Ketat',
                                    ],
                                    'dedicated-butler-concierge' => [
                                        'icon' => 'key',
                                        'label' => 'Tersedia di Seluruh Suite & Villa',
                                    ],
                                ];
                            @endphp

                            @forelse ($facilities as $facility)
                                @php
                                    $meta = $facilityMeta[$facility->slug] ?? [
                                        'icon' => 'schedule',
                                        'label' => 'Tersedia untuk Tamu Resor',
                                    ];

                                    $primaryImage = $facility->images->first();

                                    $filterCategory = match ($facility->category->slug) {
                                        'rekreasi' => 'wellness',
                                        'gastronomy' => 'gastronomy',
                                        'hiburan-budaya' => 'experiences',
                                        'vip-service' => 'vip',
                                        default => $facility->category->slug,
                                    };
                                @endphp

                                <article
                                    class="facility-card flex flex-col bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group"
                                    data-category="{{ $filterCategory }}">

                                    <div class="relative h-64 overflow-hidden">
                                        @if ($primaryImage)
                                            <img alt="{{ $primaryImage->caption ?? $facility->name }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                                src="{{ $primaryImage->image_path }}" />
                                        @endif

                                        <div
                                            class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1 rounded">
                                            <span
                                                class="font-label-uppercase text-[10px] text-primary font-bold tracking-wider">
                                                {{ $facility->category->name }}
                                            </span>
                                        </div>

                                        <div
                                            class="absolute bottom-4 right-4 bg-primary-container/85 backdrop-blur-md text-on-primary px-3 py-1 rounded text-xs flex items-center gap-1.5 font-label-md">
                                            <span class="material-symbols-outlined text-[14px] text-secondary-fixed">
                                                {{ $meta['icon'] }}
                                            </span>
                                            {{ $facility->operating_hours }}
                                        </div>
                                    </div>

                                    <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                                        <div>
                                            <h3
                                                class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors">
                                                {{ $facility->name }}
                                            </h3>

                                            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                                {{ $facility->description }}
                                            </p>
                                        </div>

                                        <div
                                            class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                            <span class="font-label-uppercase text-[11px] text-secondary font-semibold">
                                                {{ $meta['label'] }}
                                            </span>

                                            <button
                                                class="flex items-center gap-1 font-label-uppercase text-label-uppercase text-primary hover:text-secondary transition-colors"
                                                onclick="openBookingModal({{ $facility->id }}, @js($facility->name))">
                                                Detail
                                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                            </button>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <p class="col-span-full text-center text-on-surface-variant py-10">
                                    Belum ada fasilitas yang tersedia.
                                </p>
                            @endforelse

                        </div>
                    </div>
                </section>
                <!-- Curated Experiences (Paket Pengalaman Kurasi Khusus) -->
                <section class="w-full py-20 lg:py-28 px-6 lg:px-16 bg-surface">
                    <div class="max-w-[1320px] mx-auto space-y-16">
                        <div class="text-center max-w-2xl mx-auto space-y-3">
                            <span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Penawaran
                                Eksklusif</span>
                            <h2
                                class="font-headline-lg text-headline-md lg:text-headline-lg text-primary tracking-tight">
                                Paket Pengalaman Kurasi Khusus
                            </h2>
                            <p class="font-body-md text-body-md text-on-surface-variant">
                                Rangkaian program terpadu yang memadukan fasilitas unggulan resor untuk menciptakan
                                momen yang bermakna dan abadi.
                            </p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- Package 1 -->
                            <div
                                class="bg-surface-container-lowest rounded-lg p-8 shadow-sm flex flex-col justify-between hover:shadow-xl transition-all duration-300 relative group">
                                <div class="space-y-6">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-surface-container-high flex items-center justify-center text-secondary">
                                        <span class="material-symbols-outlined text-[28px]">wb_twilight</span>
                                    </div>
                                    <div>
                                        <span
                                            class="font-label-uppercase text-[10px] text-secondary tracking-widest font-semibold block mb-1">Eksplorasi
                                            Bahari Romantis</span>
                                        <h3 class="font-headline-sm text-headline-sm text-primary mb-2">Romantic Sunset
                                            Voyage</h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Pelayaran 3 jam menelusuri pesisir Uluwatu dengan private catamaran yacht,
                                            disusul makan malam 4-course di Oceanfront Starlight Cabana.
                                        </p>
                                    </div>
                                    <div
                                        class="space-y-2 pt-4 border-t border-outline-variant/30 text-body-sm text-on-surface">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">schedule</span>
                                            <span class="text-xs">Durasi: 4.5 Jam (16:30 - 21:00)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">check_circle</span>
                                            <span class="text-xs">Free-flow Vintage Champagne &amp; Caviar</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">check_circle</span>
                                            <span class="text-xs">Dokumentasi Fotografer Resor Pribadi</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-8 mt-6">
                                    <button
                                        class="w-full bg-primary-container text-on-primary py-3 px-4 rounded font-label-uppercase text-label-uppercase tracking-wider hover:bg-primary transition-all flex items-center justify-center gap-2"
                                        onclick="openBookingModal('Paket: Romantic Sunset Voyage')">
                                        <span>Reservasi Slot</span>
                                        <span class="material-symbols-outlined text-[16px]">north_east</span>
                                    </button>
                                </div>
                            </div>
                            <!-- Package 2 (Featured Accent) -->
                            <div
                                class="bg-primary text-on-primary rounded-lg p-8 shadow-xl flex flex-col justify-between relative transform md:-translate-y-3">
                                <div
                                    class="absolute -top-3 right-6 bg-secondary-fixed text-on-secondary-fixed px-3 py-1 rounded font-label-uppercase text-[10px] font-bold tracking-widest shadow-md">
                                    Paling Diminati
                                </div>
                                <div class="space-y-6">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-surface-container-lowest/15 backdrop-blur-md flex items-center justify-center text-secondary-fixed">
                                        <span class="material-symbols-outlined text-[28px]">self_improvement</span>
                                    </div>
                                    <div>
                                        <span
                                            class="font-label-uppercase text-[10px] text-secondary-fixed tracking-widest font-semibold block mb-1">Peremajaan
                                            Tubuh &amp; Jiwa</span>
                                        <h3 class="font-headline-sm text-headline-sm text-on-primary mb-2">Holistic
                                            Rejuvenation</h3>
                                        <p class="font-body-sm text-body-sm text-on-primary/80 leading-relaxed">
                                            Hari penuh pemulihan diri dimulai dengan Sunrise Pranayama, 150 menit
                                            Thalassotherapy &amp; herbal scrub, serta santap siang nutrisi organik.
                                        </p>
                                    </div>
                                    <div
                                        class="space-y-2 pt-4 border-t border-on-primary/15 text-body-sm text-on-primary/90">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary-fixed">schedule</span>
                                            <span class="text-xs">Durasi: 1 Hari Penuh (07:00 - 17:00)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary-fixed">check_circle</span>
                                            <span class="text-xs">Konsultasi Praktisi Ayurveda Tersertifikasi</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary-fixed">check_circle</span>
                                            <span class="text-xs">Akses Penuh Seluruh Vitality Thermal Pools</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-8 mt-6">
                                    <button
                                        class="w-full bg-secondary text-on-secondary py-3 px-4 rounded font-label-uppercase text-label-uppercase tracking-wider hover:bg-secondary-fixed hover:text-on-secondary-fixed transition-all flex items-center justify-center gap-2 shadow-sm"
                                        onclick="openBookingModal('Paket: Full-Day Holistic Rejuvenation')">
                                        <span>Reservasi Slot</span>
                                        <span class="material-symbols-outlined text-[16px]">north_east</span>
                                    </button>
                                </div>
                            </div>
                            <!-- Package 3 -->
                            <div
                                class="bg-surface-container-lowest rounded-lg p-8 shadow-sm flex flex-col justify-between hover:shadow-xl transition-all duration-300 relative group">
                                <div class="space-y-6">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-surface-container-high flex items-center justify-center text-secondary">
                                        <span class="material-symbols-outlined text-[28px]">local_bar</span>
                                    </div>
                                    <div>
                                        <span
                                            class="font-label-uppercase text-[10px] text-secondary tracking-widest font-semibold block mb-1">Kurasi
                                            Rasa &amp; Sommelier</span>
                                        <h3 class="font-headline-sm text-headline-sm text-primary mb-2">Masterclass
                                            Sommelier</h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Eksplorasi sensorik ruang gudang anggur privat Haven Palais bersama Head
                                            Sommelier, diikuti 6-course degustation menu kreasi Executive Chef.
                                        </p>
                                    </div>
                                    <div
                                        class="space-y-2 pt-4 border-t border-outline-variant/30 text-body-sm text-on-surface">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">schedule</span>
                                            <span class="text-xs">Durasi: 3.5 Jam (17:30 - 21:00)</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">check_circle</span>
                                            <span class="text-xs">Pairing 6 Label Vintage Wine Langka</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">check_circle</span>
                                            <span class="text-xs">Sertifikat Apresiasi &amp; Hadiah Kurasi Botol</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-8 mt-6">
                                    <button
                                        class="w-full bg-primary-container text-on-primary py-3 px-4 rounded font-label-uppercase text-label-uppercase tracking-wider hover:bg-primary transition-all flex items-center justify-center gap-2"
                                        onclick="openBookingModal('Paket: Masterclass Sommelier &amp; Haute Cuisine')">
                                        <span>Reservasi Slot</span>
                                        <span class="material-symbols-outlined text-[16px]">north_east</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Section Call-to-Action & Reservasi Fasilitas -->
                <section class="w-full py-16 lg:py-24 px-6 lg:px-16 bg-surface-container">
                    <div class="max-w-[1320px] mx-auto bg-surface-container-lowest rounded-xl p-8 lg:p-14 shadow-lg">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                            <!-- Left Text -->
                            <div class="lg:col-span-7 space-y-4">
                                <div
                                    class="inline-flex items-center gap-2 px-3 py-1 rounded bg-secondary-fixed/40 text-on-secondary-container">
                                    <span class="material-symbols-outlined text-[16px]">stars</span>
                                    <span class="font-label-uppercase text-[11px] font-bold tracking-wider">Akses Tamu
                                        Harian &amp; Penginap</span>
                                </div>
                                <h2
                                    class="font-headline-lg text-headline-md lg:text-headline-lg text-primary tracking-tight">
                                    Rencanakan Momen Istimewa Anda Bersama Kami
                                </h2>
                                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                    Fasilitas kami menerima reservasi eksklusif untuk tamu menginap maupun tamu harian
                                    (Day Guest). Alokasi tempat dijaga terbatas setiap harinya guna memastikan
                                    ketenangan absolut dan privasi yang tak terganggu.
                                </p>
                                <div class="pt-4 flex flex-wrap items-center gap-4">
                                    <button
                                        class="bg-primary-container text-on-primary px-8 py-3.5 rounded font-label-uppercase text-label-uppercase tracking-widest hover:bg-primary transition-all shadow-sm flex items-center gap-2"
                                        onclick="openBookingModal('Semua Fasilitas')">
                                        <span>Reservasi Fasilitas &amp; Meja</span>
                                        <span class="material-symbols-outlined text-[18px]">calendar_add_on</span>
                                    </button>
                                    <a class="bg-surface-container text-primary hover:bg-surface-container-high px-6 py-3.5 rounded font-label-uppercase text-label-uppercase tracking-widest transition-all flex items-center gap-2"
                                        href="https://wa.me/628118800900" rel="noopener noreferrer" target="_blank">
                                        <span class="material-symbols-outlined text-[18px] text-secondary">chat</span>
                                        <span>WhatsApp Concierge</span>
                                    </a>
                                </div>
                            </div>
                            <!-- Right Quick Info Card -->
                            <div class="lg:col-span-5 bg-surface-container-low p-6 lg:p-8 rounded-lg space-y-5">
                                <h4 class="font-title-editorial text-title-editorial text-primary font-semibold">
                                    Bantuan Hotline Reservasi VIP
                                </h4>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Untuk pengaturan acara privat, resepsi pernikahan, helikopter charter, atau
                                    kebutuhan diet khusus, silakan hubungi tim concierge kami langsung.
                                </p>
                                <div class="space-y-3 pt-2">
                                    <a class="flex items-center gap-3 p-3 bg-surface-container-lowest rounded-lg hover:bg-surface transition-colors"
                                        href="tel:+623618800900">
                                        <span
                                            class="material-symbols-outlined text-secondary text-[22px]">phone_in_talk</span>
                                        <div>
                                            <p class="font-label-uppercase text-[10px] text-on-surface-variant">Hotline
                                                Resor (24 Jam)</p>
                                            <p class="font-label-md text-label-md font-semibold text-primary">+62 (361)
                                                8800 900</p>
                                        </div>
                                    </a>
                                    <div class="flex items-center gap-3 p-3 bg-surface-container-lowest rounded-lg">
                                        <span
                                            class="material-symbols-outlined text-secondary text-[22px]">verified_user</span>
                                        <div>
                                            <p class="font-label-uppercase text-[10px] text-on-surface-variant">
                                                Kebijakan Privasi Tamu</p>
                                            <p class="font-body-sm text-xs text-on-surface">Area bebas drone &amp; akses
                                                fotografi terproteksi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Complete Luxury Footer -->
                <footer class="w-full bg-primary text-on-primary pt-16 pb-12 px-6 lg:px-16 mt-8">
                    <div class="max-w-[1320px] mx-auto space-y-16">
                        <!-- Main Grid Columns -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">
                            <!-- Brand Philosophy Column (4 cols) -->
                            <div class="lg:col-span-4 space-y-5">
                                <div class="flex items-center gap-3">
                                    <img alt="Haven Palais Luxury Hotel Logo Crest"
                                        class="h-9 w-auto brightness-0 invert object-contain"
                                        src="{{ $site->fileUrl('site_logo', \App\Models\Setting::DEFAULT_LOGO) }}" />
                                    <div>
                                        <p
                                            class="font-headline-sm text-headline-sm text-on-primary tracking-tight leading-none">
                                            Haven Palais</p>
                                        <p
                                            class="font-label-uppercase text-label-uppercase text-secondary-fixed tracking-widest text-[9px]">
                                            Resort &amp; Spa • Bali</p>
                                    </div>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-primary/70 leading-relaxed">
                                    Menghadirkan perpaduan keindahan alam Uluwatu yang tak tertandingi dengan standar
                                    pelayanan ultra-luxury. Santuari ketenangan jiwa di mana kemewahan berbisik lembut
                                    di telinga Anda.
                                </p>
                                <div class="flex items-center gap-4 text-on-primary/80 pt-2">
                                    <a aria-label="Instagram"
                                        class="w-8 h-8 rounded-full bg-surface-container-lowest/10 flex items-center justify-center hover:bg-secondary transition-colors"
                                        href="#">
                                        <span class="material-symbols-outlined text-[16px]">photo_camera</span>
                                    </a>
                                    <a aria-label="TripAdvisor"
                                        class="w-8 h-8 rounded-full bg-surface-container-lowest/10 flex items-center justify-center hover:bg-secondary transition-colors"
                                        href="#">
                                        <span class="material-symbols-outlined text-[16px]">travel_explore</span>
                                    </a>
                                    <a aria-label="Email"
                                        class="w-8 h-8 rounded-full bg-surface-container-lowest/10 flex items-center justify-center hover:bg-secondary transition-colors"
                                        href="#">
                                        <span class="material-symbols-outlined text-[16px]">mail</span>
                                    </a>
                                </div>
                            </div>
                            <!-- Quick Navigation (2 cols) -->
                            <div class="lg:col-span-2 space-y-4">
                                <p
                                    class="font-label-uppercase text-label-uppercase text-secondary-fixed tracking-wider">
                                    Navigasi</p>
                                <ul class="space-y-2.5 font-body-sm text-body-sm text-on-primary/75">
                                    <li><a class="hover:text-on-primary transition-colors" href="/">Beranda Resor</a>
                                    </li>
                                    <li><a class="hover:text-on-primary transition-colors" href="/kamar">Kamar
                                            &amp; Suites</a></li>
                                    <li><a class="hover:text-on-primary transition-colors text-secondary-fixed font-medium"
                                            href="#">Fasilitas Lengkap</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="#">Galeri Foto</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="/ulasan">Ulasan
                                            Tamu</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="/tentang">Tentang
                                            Kami</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Experiences (3 cols) -->
                            <div class="lg:col-span-3 space-y-4">
                                <p
                                    class="font-label-uppercase text-label-uppercase text-secondary-fixed tracking-wider">
                                    Pengalaman</p>
                                <ul class="space-y-2.5 font-body-sm text-body-sm text-on-primary/75">
                                    <li><a class="hover:text-on-primary transition-colors" href="#">Serenity Thalasso
                                            Spa</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="#">Palais Haute
                                            Cuisine</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="#">Oceanfront Starlight
                                            Cabana</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="#">Private Cove Beach
                                            Club</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="#">Helipad &amp; VIP
                                            Chauffeur</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="#">Pernikahan &amp;
                                            Acara Privat</a></li>
                                </ul>
                            </div>
                            <!-- Newsletter & Contact (3 cols) -->
                            <div class="lg:col-span-3 space-y-4">
                                <p
                                    class="font-label-uppercase text-label-uppercase text-secondary-fixed tracking-wider">
                                    Haven Privilege Club</p>
                                <p class="font-body-sm text-xs text-on-primary/70 leading-relaxed">
                                    Daftarkan email Anda untuk menerima undangan degustation privat dan penawaran
                                    musiman eksklusif.
                                </p>
                                <form class="space-y-2"
                                    onsubmit="event.preventDefault(); alert('Terima kasih telah bergabung dengan Haven Privilege Club.');">
                                    <div class="relative">
                                        <input
                                            class="w-full bg-surface-container-lowest/10 text-on-primary text-xs px-3.5 py-2.5 rounded focus:outline-none focus:ring-1 focus:ring-secondary-fixed placeholder:text-on-primary/40"
                                            placeholder="Alamat email Anda..." required="" type="email" />
                                    </div>
                                    <button
                                        class="w-full bg-secondary-fixed text-on-secondary-fixed py-2 rounded font-label-uppercase text-[11px] font-bold tracking-wider hover:bg-secondary hover:text-on-secondary transition-all"
                                        type="submit">
                                        Daftar Sekarang
                                    </button>
                                </form>
                                <div class="pt-2 text-on-primary/60 text-[11px] space-y-1">
                                    <p>Jl. Tebing Surga No. 88, Uluwatu, Bali 80364</p>
                                    <p>concierge@havenpalais.com • +62 (361) 8800 900</p>
                                </div>
                            </div>
                        </div>
                        <!-- Legal Notice & Copyright -->
                        <div
                            class="pt-8 border-t border-on-primary/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-on-primary/50 font-label-uppercase text-[10px] tracking-wider">
                            <p>© 2025 Haven Palais Resort &amp; Spa. Seluruh Hak Cipta Dilindungi Undang-Undang.</p>
                            <div class="flex items-center gap-6">
                                <a class="hover:text-on-primary transition-colors" href="#">Kebijakan Privasi</a>
                                <a class="hover:text-on-primary transition-colors" href="#">Syarat &amp; Ketentuan</a>
                                <a class="hover:text-on-primary transition-colors" href="#">Aksesibilitas</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- Modal Booking Fasilitas Interaktif -->
                <div class="fixed inset-0 z-50 bg-primary/80 backdrop-blur-md hidden flex items-center justify-center p-4"
                    id="booking-modal">
                    <div
                        class="bg-surface-container-lowest rounded-lg max-w-lg w-full p-8 shadow-2xl space-y-6 relative overflow-y-auto max-h-[921px]">
                        <div class="flex items-center justify-between pb-4 border-b border-outline-variant/30">
                            <div>
                                <span
                                    class="font-label-uppercase text-[10px] text-secondary tracking-widest font-semibold">Reservasi
                                    Khusus</span>
                                <h3 class="font-headline-sm text-title-editorial text-primary"
                                    id="modal-facility-title">Reservasi Fasilitas</h3>
                            </div>
                            <button
                                class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary hover:bg-surface-variant transition-colors"
                                onclick="closeBookingModal()">
                                <span class="material-symbols-outlined text-[18px]">close</span>
                            </button>
                        </div>
                        <form class="space-y-4" action="{{ route('customer.facility-reservations.store') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="resort_facility_id" id="booking-facility-id">
                            <div>
                                <label class="block font-label-uppercase text-[11px] text-on-surface-variant mb-1">Nama
                                    Lengkap Tamu</label>
                                <input
                                    class="w-full bg-surface-container-low px-3.5 py-2 rounded text-sm text-primary focus:outline-none focus:ring-1 focus:ring-primary"
                                    type="text" name="guest_name" placeholder="Contoh: Zidane Ramdhani" required />
                            </div>
                            <div>
                                <label class="block font-label-uppercase text-[11px] text-on-surface-variant mb-1">
                                    Email Tamu
                                </label>
                                <input
                                    class="w-full bg-surface-container-low px-3.5 py-2 rounded text-sm text-primary focus:outline-none focus:ring-1 focus:ring-primary"
                                    type="email" name="guest_email" placeholder="nama@email.com" required />
                            </div>

                            <div>
                                <label class="block font-label-uppercase text-[11px] text-on-surface-variant mb-1">
                                    Nomor Telepon
                                </label>
                                <input
                                    class="w-full bg-surface-container-low px-3.5 py-2 rounded text-sm text-primary focus:outline-none focus:ring-1 focus:ring-primary"
                                    type="tel" name="guest_phone" placeholder="08xxxxxxxxxx" required />
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label
                                        class="block font-label-uppercase text-[11px] text-on-surface-variant mb-1">Tanggal</label>
                                    <input
                                        class="w-full bg-surface-container-low px-3 py-2 rounded text-xs text-primary focus:outline-none focus:ring-1 focus:ring-primary"
                                        type="date" name="reservation_date" min="{{ date('Y-m-d') }}" required />
                                </div>
                                <div>
                                    <label
                                        class="block font-label-uppercase text-[11px] text-on-surface-variant mb-1">Waktu
                                        / Sesi</label>
                                    <select
                                        class="w-full bg-surface-container-low px-3 py-2 rounded text-xs text-primary focus:outline-none focus:ring-1 focus:ring-primary"
                                        name="session" required>
                                        <option value="Pagi (08:00 - 11:00)">Pagi (08:00 - 11:00)</option>
                                        <option value="Siang (12:00 - 15:00)">Siang (12:00 - 15:00)</option>
                                        <option value="Sunset (16:30 - 19:00)">Sunset (16:30 - 19:00)</option>
                                        <option value="Malam (19:30 - 22:00)">Malam (19:30 - 22:00)</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block font-label-uppercase text-[11px] text-on-surface-variant mb-1">Status
                                    Tamu</label>
                                <div class="flex items-center gap-4 text-xs text-on-surface pt-1">
                                    <label class="flex items-center gap-1.5 cursor-pointer">
                                        <input checked class="text-primary" name="guest_type" type="radio"
                                            value="villa" />
                                        Tamu Menginap di Villa
                                    </label>

                                    <label class="flex items-center gap-1.5 cursor-pointer">
                                        <input class="text-primary" name="guest_type" type="radio" value="day_guest" />
                                        Tamu Harian (Day Guest)
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block font-label-uppercase text-[11px] text-on-surface-variant mb-1">Permintaan
                                    Khusus / Alergi</label>
                                <textarea
                                    class="w-full bg-surface-container-low px-3.5 py-2 rounded text-xs text-primary focus:outline-none focus:ring-1 focus:ring-primary"
                                    name="special_requests"
                                    placeholder="Informasi diet khusus, perayaan ulang tahun/anniversary..."
                                    rows="3"></textarea>
                            </div>
                            <div class="pt-3">
                                <button
                                    class="w-full bg-primary text-on-primary py-3 rounded font-label-uppercase text-label-uppercase tracking-wider hover:bg-primary-container transition-all flex items-center justify-center gap-2"
                                    type="submit">
                                    <span>Kirim Permintaan Reservasi</span>
                                    <span class="material-symbols-outlined text-[16px]">send</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Micro-interactions Javascript -->
                <script>
                    function filterFacilities(category) {
                        const buttons = document.querySelectorAll('.facility-tab-btn');
                        buttons.forEach(btn => {
                            if (btn.getAttribute('data-filter') === category) {
                                btn.className = 'facility-tab-btn active px-5 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-wider transition-all bg-primary-container text-on-primary shadow-sm';
                            } else {
                                btn.className = 'facility-tab-btn px-5 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-wider transition-all text-on-surface-variant hover:text-primary';
                            }
                        });

                        const cards = document.querySelectorAll('.facility-card');
                        cards.forEach(card => {
                            if (category === 'all' || card.getAttribute('data-category') === category) {
                                card.classList.remove('hidden');
                            } else {
                                card.classList.add('hidden');
                            }
                        });
                    }

                    function openBookingModal(facilityId, facilityName) {
                        document.getElementById('modal-facility-title').innerText = facilityName;
                        document.getElementById('booking-facility-id').value = facilityId;
                        document.getElementById('booking-modal').classList.remove('hidden');
                    }

                    function closeBookingModal() {
                        document.getElementById('booking-modal').classList.add('hidden');
                    }

                    function handleReservationSubmit(e) {
                        e.preventDefault();
                        alert('Permintaan reservasi Anda telah diterima. Tim Concierge Haven Palais akan mengonfirmasi detail Anda via telepon dan email.');
                        closeBookingModal();
                    }
                </script>
            </div>
        </main>
    </div>
</body>

</html>