<!DOCTYPE html>

<html lang="id">
@extends('frontend.layouts.app')

@section('title', 'Ulasan')

@section('content')

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
                <!-- BREADCRUMB & INTRO SCENIC HEADER -->
                <section class="relative px-6 lg:px-16 pt-8 pb-12 overflow-hidden bg-surface">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-6">
                        <!-- Breadcrumb -->
                        <nav aria-label="Breadcrumb"
                            class="flex items-center gap-2 text-on-surface-variant font-label-uppercase text-label-uppercase">
                            <a class="hover:text-primary transition-colors flex items-center gap-1.5" href="/">
                                <span class="material-symbols-outlined text-[16px]">home</span>
                                <span>Home</span>
                            </a>
                            <span class="text-outline-variant font-normal">/</span>
                            <span class="text-secondary font-bold tracking-widest">Ulasan Tamu</span>
                        </nav>
                        <!-- Editorial Title & Narrative -->
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end pt-4">
                            <div class="lg:col-span-8 flex flex-col gap-4">
                                <div
                                    class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-secondary-fixed/40 w-fit">
                                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                    <span
                                        class="font-label-uppercase text-label-uppercase tracking-widest text-on-secondary-container">Refleksi
                                        Pengalaman Tamu</span>
                                </div>
                                <h1 class="font-headline-lg text-headline-lg text-primary tracking-tight">
                                    Kisah Otentik &amp; Kesan dari Para Tamu Terhormat
                                </h1>
                            </div>
                            <div class="lg:col-span-4 flex flex-col justify-end">
                                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                    Menangkap detik-detik magis ketika deburan Samudra Hindia membasuh kepenatan,
                                    dilayani dengan kesantunan tanpa cela, dan terukir abadi dalam kenangan para
                                    pelancong dunia di tebing Uluwatu.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- OVERALL SCORECARD & ACCREDITATIONS -->
                <section class="px-6 lg:px-16 pb-16 bg-surface">
                    <div class="max-w-[1320px] mx-auto">
                        <div
                            class="bg-surface-container-low rounded-xl p-8 lg:p-12 shadow-[0_12px_32px_-4px_rgba(27,42,50,0.04)]">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                                <!-- Score Block -->
                                <div
                                    class="lg:col-span-4 flex flex-col items-center lg:items-start text-center lg:text-left gap-4 bg-surface-container-lowest p-8 rounded-xl shadow-sm">
                                    <div class="flex items-center gap-1 text-secondary">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="material-symbols-outlined text-[26px]"
                                                style="font-variation-settings: 'FILL' {{ $i <= round($averageRating) ? 1 : 0 }};">
                                                star
                                            </span>
                                        @endfor
                                    </div>
                                    <div class="flex items-baseline gap-2">
                                        <span
                                            class="font-headline-lg text-display-hero leading-none text-primary font-serif">{{ number_format($averageRating, 1) }}</span>
                                        <span
                                            class="font-title-editorial text-title-editorial text-on-surface-variant">/
                                            5.0</span>
                                    </div>
                                    <p
                                        class="font-label-uppercase text-label-uppercase tracking-wider text-on-surface-variant">
                                        Berdasarkan <span class="text-primary font-bold">
                                            {{ number_format($reviewCount, 0, ',', '.') }} Ulasan Terverifikasi
                                        </span>
                                    </p>
                                    <!-- Recognition Badges -->
                                    <div class="w-full flex flex-col gap-2.5 pt-4 mt-2">
                                        <div
                                            class="flex items-center gap-3 px-3 py-2 rounded-lg bg-surface-container-high/60">
                                            <span
                                                class="material-symbols-outlined text-secondary text-[22px]">workspace_premium</span>
                                            <span
                                                class="font-label-uppercase text-[11px] text-primary tracking-wide">Condé
                                                Nast Traveler Readers' Choice 2024</span>
                                        </div>
                                        <div
                                            class="flex items-center gap-3 px-3 py-2 rounded-lg bg-surface-container-high/60">
                                            <span
                                                class="material-symbols-outlined text-secondary text-[22px]">hotel_class</span>
                                            <span
                                                class="font-label-uppercase text-[11px] text-primary tracking-wide">Tripadvisor
                                                Best of the Best Luxury Resort</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Breakdown Progress Rings & Aspect Bars -->
                                <div class="lg:col-span-8 flex flex-col gap-5">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
                                        <div>
                                            <span
                                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest block">Metrik
                                                Keunggulan</span>
                                            <h2 class="font-headline-sm text-headline-sm text-primary">Penilaian
                                                Kategori Layanan</h2>
                                        </div>
                                        <!-- Filter Dropdown & Write CTA -->
                                        <div class="flex flex-wrap items-center gap-3">
                                            <div class="relative inline-block">
                                                <select
                                                    class="appearance-none bg-surface-container-lowest text-primary font-label-md text-label-md px-4 py-2.5 pr-9 rounded-lg shadow-sm focus:outline-none cursor-pointer"
                                                    id="traveler-filter">
                                                    <option value="all">Semua Tipe Tamu</option>
                                                    <option value="honeymoon">Pasangan &amp; Bulan Madu</option>
                                                    <option value="family">Keluarga</option>
                                                    <option value="solo">Solo Retreat</option>
                                                    <option value="business">Tamu Eksekutif</option>
                                                </select>
                                                <span
                                                    class="material-symbols-outlined absolute right-2.5 top-2.5 text-[20px] pointer-events-none text-on-surface-variant">expand_more</span>
                                            </div>
                                            @if (auth()->check() && $eligibleReservations->isNotEmpty())
                                                <button type="button"
                                                    class="bg-primary-container hover:bg-primary text-on-primary px-5 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-widest transition-all shadow-sm flex items-center gap-2"
                                                    onclick="document.getElementById('review-form-modal').classList.remove('hidden')">
                                                    <span class="material-symbols-outlined text-[16px]">edit_note</span>
                                                    <span>Tulis Ulasan</span>
                                                </button>
                                            @elseif (!auth()->check())
                                                <a href="{{ route('login') }}"
                                                    class="bg-primary-container hover:bg-primary text-on-primary px-5 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-widest transition-all shadow-sm flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-[16px]">login</span>
                                                    <span>Masuk untuk Mengulas</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Aspect Bars -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 pt-2">
                                        <!-- Item 1 -->
                                        <div class="flex flex-col gap-1.5">
                                            <div class="flex justify-between items-center font-label-md text-label-md">
                                                <span class="text-primary font-medium flex items-center gap-2">
                                                    <span
                                                        class="material-symbols-outlined text-[18px] text-secondary">room_service</span>
                                                    Keramahan &amp; Dedicated Butler
                                                </span>
                                                <span class="text-primary font-bold">5.0 / 5.0</span>
                                            </div>
                                            <div
                                                class="w-full h-2 rounded-full bg-surface-container-highest overflow-hidden">
                                                <div
                                                    class="h-full bg-secondary rounded-full w-full transition-all duration-700">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Item 2 -->
                                        <div class="flex flex-col gap-1.5">
                                            <div class="flex justify-between items-center font-label-md text-label-md">
                                                <span class="text-primary font-medium flex items-center gap-2">
                                                    <span
                                                        class="material-symbols-outlined text-[18px] text-secondary">bed</span>
                                                    Kebersihan &amp; Kenyamanan Villa
                                                </span>
                                                <span class="text-primary font-bold">4.9 / 5.0</span>
                                            </div>
                                            <div
                                                class="w-full h-2 rounded-full bg-surface-container-highest overflow-hidden">
                                                <div
                                                    class="h-full bg-secondary rounded-full w-[98%] transition-all duration-700">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Item 3 -->
                                        <div class="flex flex-col gap-1.5">
                                            <div class="flex justify-between items-center font-label-md text-label-md">
                                                <span class="text-primary font-medium flex items-center gap-2">
                                                    <span
                                                        class="material-symbols-outlined text-[18px] text-secondary">restaurant</span>
                                                    Cita Rasa Gastronomi &amp; Kuliner
                                                </span>
                                                <span class="text-primary font-bold">4.9 / 5.0</span>
                                            </div>
                                            <div
                                                class="w-full h-2 rounded-full bg-surface-container-highest overflow-hidden">
                                                <div
                                                    class="h-full bg-secondary rounded-full w-[98%] transition-all duration-700">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Item 4 -->
                                        <div class="flex flex-col gap-1.5">
                                            <div class="flex justify-between items-center font-label-md text-label-md">
                                                <span class="text-primary font-medium flex items-center gap-2">
                                                    <span
                                                        class="material-symbols-outlined text-[18px] text-secondary">landscape</span>
                                                    Pemandangan &amp; Lokasi Tebing
                                                </span>
                                                <span class="text-primary font-bold">5.0 / 5.0</span>
                                            </div>
                                            <div
                                                class="w-full h-2 rounded-full bg-surface-container-highest overflow-hidden">
                                                <div
                                                    class="h-full bg-secondary rounded-full w-full transition-all duration-700">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Item 5 -->
                                        <div class="flex flex-col gap-1.5 md:col-span-2">
                                            <div class="flex justify-between items-center font-label-md text-label-md">
                                                <span class="text-primary font-medium flex items-center gap-2">
                                                    <span
                                                        class="material-symbols-outlined text-[18px] text-secondary">spa</span>
                                                    Fasilitas Resor &amp; Spa Thalasso
                                                </span>
                                                <span class="text-primary font-bold">4.9 / 5.0</span>
                                            </div>
                                            <div
                                                class="w-full h-2 rounded-full bg-surface-container-highest overflow-hidden">
                                                <div
                                                    class="h-full bg-secondary rounded-full w-[98%] transition-all duration-700">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- GUEST MOMENTS PHOTO MASONRY (#HavenMoments) -->
                <section class="px-6 lg:px-16 py-16 bg-surface-container-low">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-10">
                        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                            <div>
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest block">#HavenMoments
                                    Community</span>
                                <h2 class="font-headline-md text-headline-md text-primary mt-1">Momen Magis Lensa Tamu
                                </h2>
                            </div>
                            <p class="font-body-md text-body-md text-on-surface-variant max-w-md">
                                Potret kejernihan momen yang diabadikan langsung oleh para tamu di sekeliling tebing,
                                infinity pool, dan santapan senja Haven Palais.
                            </p>
                        </div>
                        <!-- Masonry Grid Layout -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-stretch">
                            <!-- Large Featured Image 1 -->
                            <div
                                class="md:col-span-7 group relative h-96 md:h-[460px] rounded-xl overflow-hidden shadow-sm bg-surface-container">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                    data-alt="A luxury floating champagne breakfast on a serene private infinity pool at Haven Palais Uluwatu perched high on a rugged limestone cliff overlooking the vast deep blue Indian Ocean. Warm morning sunlight casts a gentle glow over crystal clear turquoise water, tropical fruits on a woven tray, and high-end coastal resort architecture."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCI5QzxLZDtTBdHh5LHMt1OpXrSOFgXWSGBW7-kCFJgBVVlp8dOLdIbC-toER0oJH2lF7nPEM-NNpaiiyDBekkW1UqLKMpZfZ21sVRGBKgrXSuuNjGofmum65gJCSDsCHV0ogHOC55D7MBjhlAf38SeL7c8sSfZaVUrpK0BbFr_XsMI_3YA2tdaey917h3LFQ7U7WhSy7YNTTOgkZgiH6xWAq38KTNEJx--iQaLXJ4" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent flex flex-col justify-end p-6 md:p-8 text-on-primary">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span
                                                class="font-label-uppercase text-[11px] text-secondary-fixed tracking-wider block">Sarapan
                                                Terapung &amp; Champagne</span>
                                            <p class="font-title-editorial text-title-editorial font-medium">
                                                @claire_beauchamp</p>
                                            <span class="font-body-sm text-body-sm text-surface-variant">Royal Ocean
                                                Penthouse Villa</span>
                                        </div>
                                        <div
                                            class="flex items-center gap-1.5 bg-surface-container-lowest/20 backdrop-blur-md px-3 py-1.5 rounded-full">
                                            <span class="material-symbols-outlined text-[16px] text-secondary"
                                                style="font-variation-settings: 'FILL' 1;">favorite</span>
                                            <span class="font-label-uppercase text-[12px]">342</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Image 2 -->
                            <div
                                class="md:col-span-5 group relative h-96 md:h-[460px] rounded-xl overflow-hidden shadow-sm bg-surface-container">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                    data-alt="A tranquil guest practicing sunset meditation yoga on the edge of a dramatic limestone cliff terrace at Haven Palais resort in Bali. The vibrant golden amber and lavender sky reflects over the open horizon of the ocean, with warm subtle stone lanterns softly glowing in an understated luxury atmosphere."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBYbmervOT-x85rX1Kglzu3IW32woi6OfDsPp64DTST2Vr2xKK12MD_CuHa9L25TBK62vEfuveNDARam_IgbKZod0DcP5mJfMpIyLZ6WNwdnjKcMTG1bfBEsGrlaySZOVqFyjIILJ79wFsqIl9u_mfvsDiyC02r9gIJCb0TgJl-782ohpjk62U1_esLnC4n3L2Q-LdBfQr9Y41nyPFO-KyHHcads2GFYILFvg0wG94" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent flex flex-col justify-end p-6 md:p-8 text-on-primary">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span
                                                class="font-label-uppercase text-[11px] text-secondary-fixed tracking-wider block">Yoga
                                                Senja di Puncak Tebing</span>
                                            <p class="font-title-editorial text-title-editorial font-medium">
                                                @sophie.montgomery</p>
                                            <span class="font-body-sm text-body-sm text-surface-variant">Grand Sunset
                                                Horizon Suite</span>
                                        </div>
                                        <div
                                            class="flex items-center gap-1.5 bg-surface-container-lowest/20 backdrop-blur-md px-3 py-1.5 rounded-full">
                                            <span class="material-symbols-outlined text-[16px] text-secondary"
                                                style="font-variation-settings: 'FILL' 1;">favorite</span>
                                            <span class="font-label-uppercase text-[12px]">289</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Image 3 -->
                            <div
                                class="md:col-span-4 group relative h-80 rounded-xl overflow-hidden shadow-sm bg-surface-container">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                    data-alt="An intimate candlelit dinner set within a private wooden oceanfront cabana at Haven Palais luxury resort in Uluwatu. Warm flickering candlelight illuminates white linen tablecloths, sparkling crystal wine glasses, and fine dining plates with the twilight sea in the background."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDRzGgsXvR3xkTUnz4czdjxrKWWE08k6HRwWPyKwjQPnSfDdWdVlCsz13vTnrU-ZjZESHV9JSZk_jqzP9vS-s-olKEBEtnlEPc1W5dBW7wyHupdfH4vRTi2zj1JODPyAOkNf5324M1amiIGCgg5v972N0C2Gc9Fnmbh_vj-lvNLLvDhk2oZlsgCQtrIckDjEYbGvt9xss0UG18BwPB1HCmbeybGKE9NIZvcygp7mGo" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent flex flex-col justify-end p-6 text-on-primary">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span
                                                class="font-label-uppercase text-[10px] text-secondary-fixed tracking-wider block">Makan
                                                Malam Romantis Cabana</span>
                                            <p class="font-title-editorial text-body-lg font-medium">@raden_arya</p>
                                        </div>
                                        <div
                                            class="flex items-center gap-1.5 bg-surface-container-lowest/20 backdrop-blur-md px-2.5 py-1 rounded-full">
                                            <span class="material-symbols-outlined text-[14px] text-secondary"
                                                style="font-variation-settings: 'FILL' 1;">favorite</span>
                                            <span class="font-label-uppercase text-[11px]">415</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Image 4 -->
                            <div
                                class="md:col-span-4 group relative h-80 rounded-xl overflow-hidden shadow-sm bg-surface-container">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                    data-alt="A serene open-air Thalassotherapy hydrotherapy spa pool at Haven Palais resort with natural stone water jets, lush coastal greenery, and minimalist bamboo architecture in soft daylight, creating a soothing sanctuary of wellness and tactile elegance."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuB4fUqRzKJ0uDIEWNCVJYgRkLWXWEey9kAq2uX76Oj3sTI6DIX89lF0DbIM--0m5tFghYzoODxe8iQKTS_3VzTsHA2BYDhvc6gjtu4kRTIdGfCmoD_DGMaKD0Xw-khYKaa_mCIHuHLfvqG2TdEPGKub3CxRuScTVh_9NCUcxexMODSZZgXC5IzySbQhhnIetqCAcjrApQi5kAkZ4mUOHyKEGCn1n6gNyDDC8m58rNY" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent flex flex-col justify-end p-6 text-on-primary">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span
                                                class="font-label-uppercase text-[10px] text-secondary-fixed tracking-wider block">Thalassotherapy
                                                &amp; Herbal Bath</span>
                                            <p class="font-title-editorial text-body-lg font-medium">@hiroshi_t</p>
                                        </div>
                                        <div
                                            class="flex items-center gap-1.5 bg-surface-container-lowest/20 backdrop-blur-md px-2.5 py-1 rounded-full">
                                            <span class="material-symbols-outlined text-[14px] text-secondary"
                                                style="font-variation-settings: 'FILL' 1;">favorite</span>
                                            <span class="font-label-uppercase text-[11px]">198</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Image 5 -->
                            <div
                                class="md:col-span-4 group relative h-80 rounded-xl overflow-hidden shadow-sm bg-surface-container">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                    data-alt="An expansive luxury resort master bedroom suite with expansive floor-to-ceiling glass doors opening onto a panoramic ocean terrace. Crisp white linen sheets, warm teakwood timber floors, and custom coastal minimalist furniture bathed in warm afternoon natural light."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuD4_6gW94uzWUlcCFrDacaqqsFV0dh0zNTCTZtgH5uASDaLadAAPqhWuV5eUUmytZxmTeKw7Krmtf1X0vPejdwRlQvNtlX1F4Bz4qDVsn9DKS7JhJGMk0w52caXZb4NNjdjd4Oc4Gr2psQaVI4OmXtij2N2VBe8YB2jw6rowLmZo0mHsVqDZSGIKCibNstteZrdW-x2T-r7Iq35XCK4gER7dqb3f3YHK-R68YAQkWM" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent flex flex-col justify-end p-6 text-on-primary">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span
                                                class="font-label-uppercase text-[10px] text-secondary-fixed tracking-wider block">Panorama
                                                Pagi Kamar Tidur</span>
                                            <p class="font-title-editorial text-body-lg font-medium">@beatrice_v</p>
                                        </div>
                                        <div
                                            class="flex items-center gap-1.5 bg-surface-container-lowest/20 backdrop-blur-md px-2.5 py-1 rounded-full">
                                            <span class="material-symbols-outlined text-[14px] text-secondary"
                                                style="font-variation-settings: 'FILL' 1;">favorite</span>
                                            <span class="font-label-uppercase text-[11px]">321</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- CURATED DETAILED GUEST REVIEWS -->
                <section class="px-6 lg:px-16 py-20 bg-surface">
                    <!-- Category Tabs & Counter -->
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-4">
                        <div>
                            <span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest block">Kesaksian
                                Berharga</span>
                            <h2 class="font-headline-md text-headline-md text-primary mt-1">Ulasan Pilihan Tamu Kami
                            </h2>
                        </div>
                        <!-- Category Pills -->
<div class="flex flex-wrap items-center gap-2" id="filter-pill-container">
    <button
        class="review-tab-btn active px-4 py-2 rounded-full font-label-uppercase text-[11px] tracking-wider transition-all bg-primary text-on-primary shadow-sm"
        data-category="all">
        Semua ({{ $reviewCount }})
    </button>
</div>
                    </div>
                    @forelse ($approvedReviews as $review)
                        <div class="review-card">
                            <div class="flex items-center gap-1 text-secondary">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="material-symbols-outlined"
                                        style="font-variation-settings: 'FILL' {{ $i <= $review->rating ? 1 : 0 }};">
                                        star
                                    </span>
                                @endfor
                            </div>

                            <p class="mt-3">
                                {{ $review->comment ?: 'Tidak ada komentar.' }}
                            </p>

                            @if ($review->photo_path)
                                <img src="{{ asset('storage/' . $review->photo_path) }}" alt="Foto ulasan"
                                    class="mt-3 w-full rounded-xl object-cover">
                            @endif

                            <div class="mt-4">
                                <p class="font-semibold">
                                    {{ $review->user->name ?? 'Customer' }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $review->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-500 py-10">
                            Belum ada ulasan yang dipublikasikan.
                        </p>
                    @endforelse
                    <!-- Elegant Pagination -->
<div class="flex items-center justify-center gap-2 pt-6">
    @if ($approvedReviews->onFirstPage())
        <span class="w-10 h-10 rounded-full bg-surface-container-low text-gray-400 flex items-center justify-center">
            <span class="material-symbols-outlined text-[20px]">chevron_left</span>
        </span>
    @else
        <a href="{{ $approvedReviews->previousPageUrl() }}"
            class="w-10 h-10 rounded-full bg-surface-container-low hover:bg-surface-container text-primary flex items-center justify-center transition-colors">
            <span class="material-symbols-outlined text-[20px]">chevron_left</span>
        </a>
    @endif

    <span class="w-10 h-10 rounded-full bg-primary text-on-primary font-bold flex items-center justify-center shadow-sm">
        {{ $approvedReviews->currentPage() }}
    </span>

    @if ($approvedReviews->hasMorePages())
        <a href="{{ $approvedReviews->nextPageUrl() }}"
            class="w-10 h-10 rounded-full bg-surface-container-low hover:bg-surface-container text-primary flex items-center justify-center transition-colors">
            <span class="material-symbols-outlined text-[20px]">chevron_right</span>
        </a>
    @else
        <span class="w-10 h-10 rounded-full bg-surface-container-low text-gray-400 flex items-center justify-center">
            <span class="material-symbols-outlined text-[20px]">chevron_right</span>
        </span>
    @endif
</div>
            </div>
            </section>
            <!-- SHARE YOUR STORY REWARD CALLOUT (Haven Privilege) -->
            <section class="px-6 lg:px-16 py-12 bg-surface">
                <div class="max-w-[1320px] mx-auto">
                </div>
            </section>
            <!-- DIRECT CONCIERGE & BOOKING ASSISTANCE FOOTNOTE -->
            <section class="px-6 lg:px-16 py-16 bg-surface-container-low">
                <div class="max-w-[1320px] mx-auto text-center flex flex-col items-center gap-6">
                    <span class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Wujudkan
                        Kenangan Anda</span>
                    <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-primary max-w-2xl">
                        Ingin Merasakan Pengalaman Serupa di Puncak Tebing Uluwatu?
                    </h2>
                    <p class="font-body-md text-body-md text-on-surface-variant max-w-xl">
                        Konsultasikan preferensi villa, penjemputan VIP helipad, serta perayaan pribadi Anda bersama
                        staf Concierge berdedikasi kami kapan saja.
                    </p>
                    <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                        <a class="bg-primary text-on-primary px-8 py-3.5 rounded font-label-uppercase text-label-uppercase tracking-widest hover:bg-primary-container transition-all flex items-center gap-2.5 shadow-md"
                            href="/kamar">
                            <span>Pesan Kamar Sekarang</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                        <a class="bg-surface-container-lowest hover:bg-surface-container text-primary px-7 py-3.5 rounded font-label-uppercase text-label-uppercase tracking-widest transition-all flex items-center gap-2.5 shadow-sm"
                            href="https://wa.me/6281386932586" rel="noopener noreferrer" target="_blank">
                            <span class="material-symbols-outlined text-secondary text-[20px]">chat</span>
                            <span>Konsultasi via WhatsApp</span>
                        </a>
                    </div>
                </div>
            </section>
            <!-- REVIEW SUBMISSION POPUP MODAL -->
            <div class="hidden fixed inset-0 z-50 bg-primary/80 backdrop-blur-md flex items-center justify-center p-4"
                id="review-form-modal">
                <div
                    class="bg-surface-container-lowest w-full max-w-xl rounded-xl p-8 shadow-2xl relative max-h-[921px] overflow-y-auto">
                    <!-- Close button -->
                    <button aria-label="Tutup Formulir"
                        class="absolute top-6 right-6 w-9 h-9 rounded-full bg-surface-container-low text-primary flex items-center justify-center hover:bg-surface-container transition-colors"
                        onclick="document.getElementById('review-form-modal').classList.add('hidden')">
                        <span class="material-symbols-outlined text-[20px]">close</span>
                    </button>
                    <div class="flex flex-col gap-2 mb-6">
                        <span class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Haven
                            Privilege Reward</span>
                        <h3 class="font-headline-sm text-headline-sm text-primary">Tulis Ulasan &amp; Cerita Anda
                        </h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Bagikan pengalaman otentik Anda
                            untuk menginspirasi sesama pelancong dan dapatkan 1.000 Privilege Points.</p>
                    </div>
                    <form class="flex flex-col gap-4" id="reviewForm" action="{{ route('reviews.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label
                                class="font-label-uppercase text-label-uppercase text-on-surface-variant block mb-1.5">
                                Rating Keseluruhan
                            </label>

                            <div class="flex items-center gap-1.5 text-secondary" id="modal-star-picker">
                                <input type="hidden" name="rating" id="rating-value" value="0">

                                <span class="material-symbols-outlined text-[28px] cursor-pointer"
                                    data-rating="1">star</span>
                                <span class="material-symbols-outlined text-[28px] cursor-pointer"
                                    data-rating="2">star</span>
                                <span class="material-symbols-outlined text-[28px] cursor-pointer"
                                    data-rating="3">star</span>
                                <span class="material-symbols-outlined text-[28px] cursor-pointer"
                                    data-rating="4">star</span>
                                <span class="material-symbols-outlined text-[28px] cursor-pointer"
                                    data-rating="5">star</span>
                            </div>

                            <p class="text-xs text-on-surface-variant mt-1" id="rating-description">
                                Pilih rating 1–5 bintang
                            </p>
                        </div>

                        <div>
                            <label class="font-label-uppercase text-label-uppercase text-on-surface-variant block mb-1">
                                Nomor Konfirmasi Reservasi
                            </label>

                            <select name="booking_code" required
                                class="w-full bg-surface-container-low rounded p-3 font-body-sm text-body-sm text-primary focus:outline-none focus:bg-surface-container-lowest focus:ring-1 focus:ring-primary">
                                <option value="">Pilih Nomor Reservasi</option>

                                @foreach ($eligibleReservations as $reservation)
                                    <option value="{{ $reservation->booking_code }}">
                                        {{ $reservation->booking_code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="font-label-uppercase text-label-uppercase text-on-surface-variant block mb-1">
                                Detail Kisah Menginap
                            </label>

                            <textarea
                                class="w-full bg-surface-container-low rounded p-3 font-body-sm text-body-sm text-primary focus:outline-none focus:bg-surface-container-lowest focus:ring-1 focus:ring-primary resize-none"
                                name="comment" placeholder="Ceritakan pengalaman menginap Anda..." rows="4"
                                maxlength="2000"></textarea>
                        </div>

                        <div class="p-4 rounded-lg bg-surface-container-low flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-[24px] text-secondary">image</span>

                                <div class="flex flex-col">
                                    <span class="font-label-md text-label-md text-primary font-medium">
                                        Unggah Foto Momen Liburan
                                    </span>

                                    <span class="font-body-sm text-[12px] text-on-surface-variant">
                                        Format JPG, JPEG, PNG, WEBP hingga 4MB
                                    </span>
                                </div>
                            </div>

                            <label for="review-photo"
                                class="bg-surface-container-lowest text-primary font-label-uppercase text-[11px] px-3 py-1.5 rounded shadow-sm hover:bg-surface-container cursor-pointer">
                                Pilih File
                            </label>

                            <input type="file" name="photo" id="review-photo" accept=".jpg,.jpeg,.png,.webp"
                                class="hidden" />
                            <span id="review-photo-name" class="text-xs text-on-surface-variant mt-2">
                            </span>
                        </div>

                        <div class="pt-2 flex items-center justify-end gap-3">
                            <button
                                class="px-5 py-2.5 rounded font-label-uppercase text-label-uppercase text-on-surface-variant hover:text-primary"
                                onclick="document.getElementById('review-form-modal').classList.add('hidden')"
                                type="button">
                                Batal
                            </button>

                            <button
                                class="bg-primary hover:bg-primary-container text-on-primary px-6 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-widest transition-colors shadow-sm"
                                type="submit">
                                Kirim Ulasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- INTERACTIVE FILTER LOGIC SCRIPT -->
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const tabBtns = document.querySelectorAll('.review-tab-btn');
                    const reviewCards = document.querySelectorAll('.review-card');

                    tabBtns.forEach(btn => {
                        btn.addEventListener('click', () => {
                            tabBtns.forEach(b => {
                                b.classList.remove('bg-primary', 'text-on-primary', 'shadow-sm');
                                b.classList.add('bg-surface-container-low', 'text-on-surface-variant');
                            });
                            btn.classList.remove('bg-surface-container-low', 'text-on-surface-variant');
                            btn.classList.add('bg-primary', 'text-on-primary', 'shadow-sm');

                            const category = btn.getAttribute('data-category');

                            reviewCards.forEach(card => {
                                const cardCategories = card.getAttribute('data-category') || '';
                                if (category === 'all' || cardCategories.includes(category)) {
                                    card.style.display = 'flex';
                                } else {
                                    card.style.display = 'none';
                                }
                            });
                        });
                    });
                });
                document.addEventListener('DOMContentLoaded', function () {
                    const starPicker = document.getElementById('modal-star-picker');

                    if (!starPicker) return;

                    const stars = starPicker.querySelectorAll('[data-rating]');
                    const ratingValue = document.getElementById('rating-value');
                    const ratingDescription = document.getElementById('rating-description');
                    const photoInput = document.getElementById('review-photo');
                    const photoName = document.getElementById('review-photo-name');

                    if (photoInput && photoName) {
                        photoInput.addEventListener('change', function () {
                            photoName.textContent = this.files.length > 0
                                ? this.files[0].name
                                : '';
                        });
                    }

                    const descriptions = {
                        1: 'Sangat Buruk',
                        2: 'Buruk',
                        3: 'Cukup',
                        4: 'Bagus',
                        5: 'Sangat Bagus'
                    };

                    function updateStars(rating) {
                        stars.forEach(star => {
                            const value = Number(star.dataset.rating);

                            star.classList.toggle('active', value <= rating);
                        });

                        ratingValue.value = rating;

                        ratingDescription.textContent = rating > 0
                            ? `${rating} dari 5 bintang - ${descriptions[rating]}`
                            : 'Pilih rating 1–5 bintang';
                    }

                    stars.forEach(star => {
                        star.addEventListener('click', function () {
                            updateStars(Number(this.dataset.rating));
                        });
                    });
                    const reviewForm = document.getElementById('reviewForm');

                    if (reviewForm) {
                        reviewForm.addEventListener('submit', function (event) {
                            if (Number(ratingValue.value) < 1 || Number(ratingValue.value) > 5) {
                                event.preventDefault();

                                ratingDescription.textContent = 'Silakan pilih rating terlebih dahulu.';
                                ratingDescription.classList.add('text-red-600');

                                return;
                            }
                        });
                    }
                });
            </script>
    </div>
    </main>
    </div>
</body>

</html>