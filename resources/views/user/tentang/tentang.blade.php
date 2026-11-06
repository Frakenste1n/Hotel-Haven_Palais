<!DOCTYPE html>

<html lang="id">
@extends('user.layouts.app')

@section('title', 'Tentang')

@section('content')

    <h1>Selamat Datang di Haven Palais</h1>

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
        id="tailwind-config">tailwind.config = { "darkMode": "class", "theme": { "extend": { "colors": { "on-primary": "#ffffff", "error-container": "#ffdad6", "on-error": "#ffffff", "primary-fixed": "#d5e5f0", "tertiary-container": "#1a2a37", "background": "#faf9f7", "on-surface": "#1a1c1b", "on-tertiary-container": "#8191a2", "on-tertiary-fixed": "#0d1d2a", "on-primary-fixed-variant": "#3a4951", "on-secondary-fixed": "#281800", "on-secondary-container": "#78603e", "surface-dim": "#dadad8", "on-secondary-fixed-variant": "#584323", "error": "#ba1a1a", "secondary-fixed-dim": "#e0c298", "inverse-surface": "#2f3130", "on-secondary": "#ffffff", "surface-container-low": "#f4f3f1", "surface-bright": "#faf9f7", "secondary-fixed": "#fedeb2", "secondary-container": "#fedeb2", "inverse-primary": "#b9c9d3", "on-tertiary-fixed-variant": "#394857", "on-surface-variant": "#43474a", "surface-container": "#efeeec", "surface": "#faf9f7", "on-background": "#1a1c1b", "tertiary-fixed": "#d4e4f6", "outline-variant": "#c3c7ca", "surface-variant": "#e3e2e0", "tertiary-fixed-dim": "#b8c8da", "surface-container-highest": "#e3e2e0", "surface-container-high": "#e9e8e6", "on-error-container": "#93000a", "on-primary-container": "#82919b", "primary": "#06151d", "on-tertiary": "#ffffff", "on-primary-fixed": "#0e1d25", "tertiary": "#051522", "secondary": "#725b38", "primary-fixed-dim": "#b9c9d3", "surface-tint": "#51616a", "primary-container": "#1b2a32", "inverse-on-surface": "#f1f1ef", "outline": "#73787b", "surface-container-lowest": "#ffffff" }, "borderRadius": { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" }, "spacing": { "space-sm": "0.5rem", "space-xl": "2.5rem", "space-md": "1rem", "space-lg": "1.5rem", "gutter": "2rem", "space-3xl": "6rem", "space-xs": "0.25rem", "gutter-mobile": "1rem", "space-2xl": "4rem", "margin-mobile": "1.5rem", "margin": "4rem" }, "fontFamily": { "title-editorial": ["Playfair Display"], "body-sm": ["Plus Jakarta Sans"], "display-hero": ["Playfair Display"], "headline-lg-mobile": ["Playfair Display"], "body-md": ["Plus Jakarta Sans"], "headline-sm": ["Playfair Display"], "body-lg": ["Plus Jakarta Sans"], "label-md": ["Plus Jakarta Sans"], "label-uppercase": ["Plus Jakarta Sans"], "headline-lg": ["Playfair Display"], "display-hero-mobile": ["Playfair Display"], "headline-md": ["Playfair Display"] }, "fontSize": { "title-editorial": ["1.25rem", { "lineHeight": "1.75rem", "letterSpacing": "0.01em", "fontWeight": "500" }], "body-sm": ["0.875rem", { "lineHeight": "1.375rem", "fontWeight": "400" }], "display-hero": ["4.5rem", { "lineHeight": "5rem", "letterSpacing": "-0.02em", "fontWeight": "400" }], "headline-lg-mobile": ["2rem", { "lineHeight": "2.5rem", "letterSpacing": "0em", "fontWeight": "400" }], "body-md": ["1rem", { "lineHeight": "1.625rem", "fontWeight": "400" }], "headline-sm": ["1.5rem", { "lineHeight": "2rem", "fontWeight": "600" }], "body-lg": ["1.125rem", { "lineHeight": "1.875rem", "fontWeight": "400" }], "label-md": ["0.875rem", { "lineHeight": "1.25rem", "fontWeight": "500" }], "label-uppercase": ["0.75rem", { "lineHeight": "1rem", "letterSpacing": "0.12em", "fontWeight": "600" }], "headline-lg": ["3rem", { "lineHeight": "3.5rem", "letterSpacing": "-0.01em", "fontWeight": "400" }], "display-hero-mobile": ["2.75rem", { "lineHeight": "3.25rem", "letterSpacing": "-0.01em", "fontWeight": "400" }], "headline-md": ["2.25rem", { "lineHeight": "2.75rem", "fontWeight": "500" }] } } } }</script>
</head>

<body class="bg-surface font-body-md text-on-surface antialiased">
    <div>
<<<<<<< HEAD:resources/views/user/tentang/tentang.blade.php
=======
        <header
            class="fixed top-0 right-0 h-20 bg-surface/85 backdrop-blur-xl z-40 shadow-[0_1px_8px_rgba(0,0,0,0.04)] left-0">
            <div class="w-full h-full px-8 flex items-center justify-between">
                <div class="flex items-center gap-6"><button aria-label="Menu Navigasi"
                        class="flex items-center gap-2.5 px-3.5 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-primary transition-colors cursor-pointer group"
                        onclick="document.getElementById('mobile-drawer-menu').classList.remove('hidden')"><span
                            class="material-symbols-outlined text-[22px] group-hover:scale-105 transition-transform">menu</span><span
                            class="font-label-uppercase text-label-uppercase tracking-widest text-primary">Menu</span></button><a
                        class="flex items-center gap-3" href="#"><img alt="Haven Palais Luxury Hotel Logo"
                            class="h-8 w-auto object-contain"
                            src="{{ $site->fileUrl('site_logo', \App\Models\Setting::DEFAULT_LOGO) }}" />
                        <div class="flex flex-col"><span
                                class="font-headline-sm text-headline-sm text-primary tracking-tight leading-none">{{ $site->site_name ?: 'Haven Palais' }}</span><span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest text-[10px] mt-0.5">{{ $site->site_tagline ?: 'Resort & Spa' }}</span></div>
                    </a></div>
                <div class="flex items-center gap-8">
                    <nav class="hidden lg:flex items-center gap-6"
                        data-active-classes="text-primary font-semibold border-b border-primary pb-0.5"><a
                            class="font-label-md text-label-md text-on-surface-variant hover:text-on-surface transition-colors"
                            data-path="tentang-kami" href="#">Tentang Kami</a></nav>
                    <div class="flex items-center gap-2 bg-surface-container-low px-3 py-1.5 rounded-full"><span
                            class="material-symbols-outlined text-[18px] text-on-surface-variant">language</span><span
                            class="font-label-uppercase text-label-uppercase text-primary font-bold">ID</span><span
                            class="text-outline-variant font-label-md text-label-md">|</span><span
                            class="font-label-uppercase text-label-uppercase text-on-surface-variant hover:text-on-surface cursor-pointer transition-colors">EN</span>
                    </div><a
                        class="hidden md:flex items-center gap-2 text-on-surface-variant hover:text-on-surface transition-colors"
                        href="tel:{{ preg_replace('/[^0-9+]/', '', $site->site_phone ?: '+62218800900') }}"><span
                            class="material-symbols-outlined text-[18px] text-secondary">support_agent</span><span
                            class="font-label-md text-label-md">Concierge</span></a>
                    <div class="flex items-center gap-3"><a
                            class="bg-primary-container text-on-primary px-6 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-widest hover:bg-primary transition-colors flex items-center gap-2 shadow-sm"
                            data-path="booking" href="#"><span class="">Pesan Kamar</span><span
                                class="material-symbols-outlined text-[16px]">north_east</span></a><a
                            class="border border-outline-variant/60 hover:border-primary text-primary px-5 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-widest transition-all flex items-center gap-2 bg-surface-container-lowest/80 shadow-sm"
                            href="#"><span class="material-symbols-outlined text-[18px] text-secondary">lock</span><span
                                class="">Masuk</span></a></div>
                </div>
            </div>
        </header>
        <div class="hidden fixed inset-0 z-50 bg-primary/80 backdrop-blur-md flex transition-opacity duration-300"
            id="mobile-drawer-menu">
            <div
                class="w-80 max-w-[85vw] h-full bg-surface-container-low flex flex-col justify-between py-8 shadow-2xl relative overflow-y-auto">
                <div class="flex flex-col">
                    <div class="px-6 pb-6 flex items-center justify-between border-b border-outline-variant/30">
                        <div class="flex items-center gap-3"><img alt="Haven Palais Luxury Hotel Logo"
                                class="h-8 w-auto object-contain"
                                src="{{ $site->fileUrl('site_logo', \App\Models\Setting::DEFAULT_LOGO) }}" />
                            <div class="flex flex-col"><span
                                    class="font-headline-sm text-headline-sm text-primary tracking-tight leading-none">{{ $site->site_name ?: 'Haven Palais' }}</span><span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest mt-1">{{ $site->site_tagline ?: 'Resort & Spa' }}</span></div>
                        </div><button aria-label="Tutup Menu"
                            class="w-9 h-9 rounded-full bg-surface-container flex items-center justify-center text-primary hover:bg-surface-variant transition-colors"
                            onclick="document.getElementById('mobile-drawer-menu').classList.add('hidden')"><span
                                class="material-symbols-outlined text-[20px]">close</span></button>
                    </div>
                    <nav class="flex flex-col gap-1.5 px-6 mt-6"
                        data-active-classes="bg-primary-container text-on-primary font-semibold rounded-lg shadow-sm"><a
                            class="flex items-center gap-3.5 px-4 py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all"
                            data-path="home" href="/"><span
                                class="material-symbols-outlined text-[20px]">cottage</span>Home</a><a
                            class="flex items-center gap-3.5 px-4 py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all"
                            data-path="kamar" href="/kamar"><span
                                class="material-symbols-outlined text-[20px]">king_bed</span>Kamar</a><a
                            class="flex items-center gap-3.5 px-4 py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all"
                            data-path="fasilitas" href="/fasilitas"><span
                                class="material-symbols-outlined text-[20px]">pool</span>Fasilitas</a><a
                            class="flex items-center gap-3.5 px-4 py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all"
                            data-path="ulasan" href="/ulasan"><span
                                class="material-symbols-outlined text-[20px]">star</span>Ulasan</a><a
                            class="flex items-center gap-3.5 px-4 py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all"
                            data-path="booking" href="/reservasi"><span
                                class="material-symbols-outlined text-[20px]">calendar_month</span>Booking /
                            Reservasi</a><a
                            class="flex items-center gap-3.5 px-4 py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all"
                            data-path="tentang-kami" href="/tentang"><span
                                class="material-symbols-outlined text-[20px]">info</span>Tentang Kami</a></nav>
                </div>
                <div class="px-6 flex flex-col gap-4 mt-6">
                    <div
                        class="p-4 rounded-xl bg-surface-container-lowest shadow-[0_12px_32px_-4px_rgba(27,42,50,0.05)] border border-outline-variant/30">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-0.5 text-secondary"><span
                                    class="material-symbols-outlined text-[16px]">star</span><span
                                    class="material-symbols-outlined text-[16px]">star</span><span
                                    class="material-symbols-outlined text-[16px]">star</span><span
                                    class="material-symbols-outlined text-[16px]">star</span><span
                                    class="material-symbols-outlined text-[16px]">star</span></div><span
                                class="font-label-uppercase text-[10px] bg-secondary-fixed/30 text-on-secondary-container px-2 py-0.5 rounded font-semibold">4.9/5
                                Excellent</span>
                        </div>
                        <p class="font-title-editorial text-body-sm text-primary italic leading-snug mb-2">“Pengalaman
                            liburan yang magis dan tak terlupakan.”</p><span
                            class="font-label-uppercase text-[10px] text-on-surface-variant block tracking-wider">—
                            Alexandra D. • Verified Guest</span>
                    </div>
                    <div
                        class="p-4 rounded-xl bg-surface-container-lowest shadow-[0_12px_32px_-4px_rgba(27,42,50,0.05)]">
                        <span class="font-label-uppercase text-label-uppercase text-secondary block">Concierge
                            24/7</span>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Layanan reservasi pribadi dan
                            asisten tamu VIP.</p><a
                            class="font-title-editorial text-title-editorial text-primary block mt-2 hover:text-secondary transition-colors"
                            href="tel:{{ preg_replace('/[^0-9+]/', '', $site->site_phone ?: '+62218800900') }}">+62 (021) 8800 900</a>
                    </div>
                    <div class="flex items-center justify-between px-2 pt-2 text-on-surface-variant"><span
                            class="font-label-uppercase text-label-uppercase tracking-wider">Est. 1928</span><span
                            class="font-label-uppercase text-label-uppercase tracking-wider text-secondary">Bali •
                            Indonesia</span></div>
                </div>
            </div>
            <div class="flex-1 h-full" onclick="document.getElementById('mobile-drawer-menu').classList.add('hidden')">
            </div>
        </div>
>>>>>>> 47ac69b (backend finish):resources/views/frontend/tentang/tentang.blade.php
        <main class="relative pt-20 bg-surface min-h-screen">
            <div class="flex flex-col w-full">
                <!-- BREADCRUMB & INTRO META BAR -->
                <section class="w-full bg-surface-container-low py-4 px-6 md:px-12 lg:px-16">
                    <div class="max-w-[1320px] mx-auto flex flex-wrap items-center justify-between gap-4">
                        <nav aria-label="Breadcrumb" class="flex items-center gap-2">
                            <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1.5"
                                href="/">
                                <span class="material-symbols-outlined text-[16px]">cottage</span>
                                <span>Home</span>
                            </a>
                            <span class="text-outline-variant font-label-md text-label-md">/</span>
                            <span class="font-label-md text-label-md text-secondary font-medium">Tentang Kami</span>
                        </nav>
                        <div class="flex items-center gap-4 text-on-surface-variant">
                            <span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                Uluwatu, Bali • 8°48'12"S 115°05'20"E
                            </span>
                        </div>
                    </div>
                </section>
                <!-- HERO SECTION: KISAH & FILOSOFI KAMI -->
                <section class="relative w-full bg-surface py-16 md:py-24 px-6 md:px-12 lg:px-16 overflow-hidden">
                    <div class="max-w-[1320px] mx-auto">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                            <!-- Text Column -->
                            <div class="lg:col-span-7 flex flex-col gap-6">
                                <div
                                    class="inline-flex items-center gap-2.5 self-start px-3.5 py-1.5 rounded-full bg-secondary-fixed/40 text-on-secondary-fixed">
                                    <span class="material-symbols-outlined text-[15px] text-secondary">flare</span>
                                    <span
                                        class="font-label-uppercase text-label-uppercase tracking-widest text-[11px] font-semibold text-secondary">
                                        Warisan Kemewahan &amp; Jiwa Nusantara
                                    </span>
                                </div>
                                <h1
                                    class="font-display-hero text-headline-lg md:text-display-hero text-primary font-normal leading-[1.1] tracking-tight">
                                    {{ $site->about_title ?: 'Harmoni Keheningan Tebing Uluwatu & Keanggunan Keramahan Abadi' }}
                                </h1>
                                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                                    {{ $site->about_description ?: 'Lahir dari penghormatan mendalam terhadap deburan Samudra Hindia dan kearifan lokal Bali, Haven Palais adalah tempat perlindungan jiwa di mana kemewahan bertemu ketenteraman tanpa batas.' }}
                                </p>
                                <!-- Quick Metrics Bar -->
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6">
                                    <div
                                        class="bg-surface-container-low p-4 rounded-xl shadow-sm flex flex-col justify-between">
                                        <span
                                            class="font-title-editorial text-headline-sm text-primary font-semibold">2012</span>
                                        <span
                                            class="font-label-uppercase text-[10px] text-secondary tracking-wider mt-1">Didirikan
                                            di Uluwatu</span>
                                    </div>
                                    <div
                                        class="bg-surface-container-low p-4 rounded-xl shadow-sm flex flex-col justify-between">
                                        <span
                                            class="font-title-editorial text-headline-sm text-primary font-semibold">15
                                            Ha</span>
                                        <span
                                            class="font-label-uppercase text-[10px] text-secondary tracking-wider mt-1">Suaka
                                            Pesisir Alami</span>
                                    </div>
                                    <div
                                        class="bg-surface-container-low p-4 rounded-xl shadow-sm flex flex-col justify-between">
                                        <span
                                            class="font-title-editorial text-headline-sm text-primary font-semibold">32
                                            Villa</span>
                                        <span
                                            class="font-label-uppercase text-[10px] text-secondary tracking-wider mt-1">Mahakarya
                                            Eksklusif</span>
                                    </div>
                                    <div
                                        class="bg-surface-container-low p-4 rounded-xl shadow-sm flex flex-col justify-between">
                                        <span
                                            class="font-title-editorial text-headline-sm text-primary font-semibold">100%</span>
                                        <span
                                            class="font-label-uppercase text-[10px] text-secondary tracking-wider mt-1">Keberlanjutan
                                            Penuh</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Visual Column with Asymmetric Luxury Framing -->
                            <div class="lg:col-span-5 relative">
                                <div
                                    class="relative w-full aspect-[4/5] rounded-2xl overflow-hidden shadow-xl bg-surface-container">
                                    <img class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700"
                                        data-alt="Photographic vista of a cliffside ultra-luxury resort in Uluwatu Bali perched high above dramatic azure Indian Ocean waves at golden hour, crafted with Indonesian volcanic stone, teak timbers, serene infinity pools, soft natural warm atmospheric sunlight, editorial architectural photography."
                                        src="{{ $site->fileUrl('about_image', \App\Models\Setting::DEFAULT_ABOUT) }}" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/60 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute bottom-6 left-6 right-6 text-on-primary">
                                        <span
                                            class="font-label-uppercase text-[10px] tracking-widest text-secondary-fixed block mb-1">Candi
                                            Cliff Pavilion</span>
                                        <p
                                            class="font-title-editorial text-title-editorial italic text-on-primary leading-snug">
                                            “Di antara cakrawala laut dan batu karang purba, keheningan menemukan wujud
                                            termurninya.”
                                        </p>
                                    </div>
                                </div>
                                <!-- Overlapping Floating Accent Card -->
                                <div
                                    class="hidden sm:flex absolute -bottom-6 -left-8 bg-surface-container-lowest p-5 rounded-xl shadow-xl max-w-xs flex-col gap-2">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-secondary text-[22px]"
                                            style="font-variation-settings: 'FILL' 1;">verified</span>
                                        <span
                                            class="font-label-uppercase text-[11px] text-primary font-bold tracking-wider">Sanctuary
                                            of Solitude</span>
                                    </div>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                                        Dirancang menyatu dengan kontur tebing kapur purba tanpa merusak formasi geologi
                                        alam.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- BAB CERITA & NARASI SEJARAH (EDITORIAL SPLIT & QUOTE) -->
                <section class="w-full bg-surface-container-low py-20 md:py-28 px-6 md:px-12 lg:px-16">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-16 md:gap-20">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                            <!-- Left Editorial Section Title & Narrative -->
                            <div class="lg:col-span-6 flex flex-col gap-6">
                                <span class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">
                                    Bab I • Asal Usul Mahakarya
                                </span>
                                <h2
                                    class="font-headline-lg text-headline-md md:text-headline-lg text-primary leading-tight">
                                    Dari Gagasan Luhur Menuju Mahakarya Suaka Pesisir
                                </h2>
                                <div
                                    class="flex flex-col gap-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                    <p>
                                        {{ $site->sejarah ?: 'Berakar pada perjumpaan emosional di tebing perawan Uluwatu lebih dari satu dekade lalu, Haven Palais diciptakan sebagai penghormatan terhadap kemegahan samudra dan kemurnian spiritual Bali Selatan.' }}
                                    </p>
                                    <p>
                                        {{ $site->asal_usul ?: 'Arsitektur kami merajut keanggunan neoklasik proporsional Eropa dengan kekayaan vernakular Nusantara.' }}
                                    </p>
                                </div>
                                <!-- Mini Fact Checklist -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                                    <div class="flex items-start gap-3 p-3 bg-surface-container rounded-lg">
                                        <span
                                            class="material-symbols-outlined text-secondary text-[20px] mt-0.5">architecture</span>
                                        <div>
                                            <h4 class="font-label-md text-label-md text-primary font-semibold">Desain
                                                Vernakular</h4>
                                            <p class="font-body-sm text-body-sm text-on-surface-variant">Harmonisasi
                                                kayu ulin &amp; batu paras candi.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 p-3 bg-surface-container rounded-lg">
                                        <span
                                            class="material-symbols-outlined text-secondary text-[20px] mt-0.5">landscape</span>
                                        <div>
                                            <h4 class="font-label-md text-label-md text-primary font-semibold">150m
                                                Ketinggian Laut</h4>
                                            <p class="font-body-sm text-body-sm text-on-surface-variant">Pemandangan
                                                tebing 180° tanpa halangan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Right Gallery Collage -->
                            <div class="lg:col-span-6 grid grid-cols-2 gap-4">
                                <div class="flex flex-col gap-4">
                                    <div class="h-64 rounded-xl overflow-hidden shadow-md">
                                        <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                            data-alt="Close up architectural detail of handcrafted Balinese basalt volcanic stone carving integrated with polished teak wood beams in Haven Palais resort, luxury organic texture, warm natural lighting."
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAwPBac1oNKe3Wob5AKSibY4dzK30h26w7opyrYu3dJrDl93LhjxRD5CQipSvpvLlmHAnXBL8qV3_p0q_BwmeMGdrns-HuKMwLIuKgbZEwugmLYKeb2zq1kJ-WBO_7eEtg2naV-4L3m8-sJu1HalXufOP6u0uFIIrVkSsspYIu0wLRU24u6npXWVrTDDrA68e3ovNAYYMfHxD8Uj6Sr__NMcScYuY24N4JVDw9krMY" />
                                    </div>
                                    <div class="h-44 rounded-xl overflow-hidden shadow-md bg-surface-container">
                                        <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                            data-alt="Intimate open air breezy courtyard at Haven Palais overlooking tranquil lotus ponds, stone frangipani path, delicate linen sheer curtains swaying, quiet coastal retreat vibe."
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBh3QpgYGJ9n3wfmSZqnHARBF_2KJiYwmpoQVINNeks1KLn1YnIEl7wGkXK5gbtO_Lx0wf6AeQt1_uwXdYmwj1PYNrE3vusGkVMSXvEZAHCY5YK3tM0x6mMpUxGsl09xIXUuNLKIsKrigWurfSLdl8ibLqbk1qmgvBBGiLp0ORJYRjeQRHvKCNBPJmovizOHq_Rmdta7tb0_nCBEhiIIOvnRqVD5-iB_mvb7tSCTcM" />
                                    </div>
                                </div>
                                <div class="flex flex-col gap-4 pt-8">
                                    <div class="h-44 rounded-xl overflow-hidden shadow-md">
                                        <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                            data-alt="Private luxury villa balcony overlooking boundless turquoise Indian ocean in Uluwatu Bali with custom woven daybed and marble side table, peaceful morning glow."
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQlpJBfY2SSRLkz62XKzAWmYSD3abt8Hjct9qVH8SKpzHDiOhDuoTQmm2RHyWHItVHFC7dHBleSgTWKzO3Iku7Mby6iLunRxD72IX9gR363-iY5BmoWopHQO9eJcrD_BIVVt02pjv111i3Y2Xcl0SvdBw16uQC3HumcVeXc8ycoTqlz3LUvmImNHJeI2mRg9JJknVnxixA7UbwLuGrYSujcvViylHH9kzTfAadStk" />
                                    </div>
                                    <div class="h-64 rounded-xl overflow-hidden shadow-md">
                                        <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                            data-alt="Breathtaking wide view of Haven Palais resort architecture seamlessly blending into the rocky cliffs of Uluwatu at dusk, warm lanterns illuminating stone pathways."
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuADrXk9GKVN5guhMx-x2XZtlW13FdpLyaLIb3BXZyxzMoqTZo1qo40H_8_O4nTKhtAEQ-Ee9JkL4ZUp8EMp0MM7tGpsszCpvfqsqIZENlnuSJlmakhN36e2aXM3EIB7fhg5ZbKp1_0RULC0YoB9y2S5mhU7qocM72vTbUPsJH39CgzRjPO3sPbKXI_ZhyxMEL8aQzEwNooJB66PK3lGInEXq4HV0J7diSUtIcQN9Ns" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Founder's Quote Card -->
                        <div
                            class="relative bg-surface-container-lowest p-8 md:p-14 rounded-2xl shadow-lg overflow-hidden">
                            <div
                                class="absolute -right-8 -bottom-8 opacity-5 text-primary pointer-events-none select-none">
                                <span class="font-title-editorial text-[220px] leading-none">“</span>
                            </div>
                            <div class="max-w-4xl relative z-10 flex flex-col gap-6">
                                <div class="flex items-center gap-2 text-secondary">
                                    <span class="material-symbols-outlined text-[24px]">format_quote</span>
                                    <span
                                        class="font-label-uppercase text-label-uppercase tracking-widest text-[11px] font-semibold">Pesan
                                        Pendiri</span>
                                </div>
                                <blockquote
                                    class="font-title-editorial text-title-editorial md:text-headline-md text-primary italic font-normal leading-relaxed">
                                    “Kami tidak sekadar membangun resor; kami menghadirkan suaka di mana waktu melambat,
                                    setiap hembusan angin laut membawa ketenangan, dan setiap tamu disambut layaknya
                                    bangsawan yang pulang ke kediamannya.”
                                </blockquote>
<<<<<<< HEAD:resources/views/user/tentang/tentang.blade.php
                                <div class="flex items-center gap-4 pt-2">
                                    <div
                                        class="w-12 h-12 rounded-full bg-surface-container flex items-center justify-center text-secondary font-title-editorial text-title-editorial font-bold shadow-sm">
                                        ZR
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-headline-sm text-body-lg text-primary font-bold">Zidane
                                            Ramdhani S.Si. M.Kom</span>
=======
                                    <div class="flex items-center gap-4 pt-2">
                                    @if($site->founder_image)
                                        <img src="{{ $site->fileUrl('founder_image') }}" alt="{{ $site->founder_name }}" class="w-12 h-12 rounded-full object-cover shadow-sm">
                                    @else
                                        <div
                                            class="w-12 h-12 rounded-full bg-surface-container flex items-center justify-center text-secondary font-title-editorial text-title-editorial font-bold shadow-sm">
                                            DW
                                        </div>
                                    @endif
                                    <div class="flex flex-col">
                                        <span class="font-headline-sm text-body-lg text-primary font-bold">{{ $site->founder_name ?: 'Bapak Dewa Wicaksana' }}</span>
>>>>>>> 47ac69b (backend finish):resources/views/frontend/tentang/tentang.blade.php
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary tracking-wider">{{ $site->founder_position ?: 'Co-Founder & Principal Architect' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- TIGA PILAR FILOSOFI HAVEN PALAIS -->
                <section class="w-full bg-surface py-20 md:py-28 px-6 md:px-12 lg:px-16">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-14">
                        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                            <div class="max-w-2xl flex flex-col gap-3">
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Prinsip
                                    Kehidupan Resor</span>
                                <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-primary">Tiga
                                    Pilar Landasan Kami</h2>
                                <p class="font-body-md text-body-md text-on-surface-variant">
                                    Setiap detik yang Anda luangkan di Haven Palais dipandu oleh tiga komitmen tak
                                    tergoyahkan yang menjaga keharmonisan jiwa, rasa, dan kenyamanan raga.
                                </p>
                            </div>
                            <div
                                class="hidden md:flex items-center gap-2 text-secondary font-label-uppercase text-label-uppercase">
                                <span>Tri Daya Mahardika</span>
                                <span class="material-symbols-outlined text-[18px]">all_inclusive</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- Pilar 1 -->
                            <div
                                class="group bg-surface-container-low hover:bg-surface-container-lowest p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between gap-8">
                                <div class="flex flex-col gap-6">
                                    <div
                                        class="w-14 h-14 rounded-xl bg-surface-container flex items-center justify-center text-secondary group-hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined text-[32px]">spa</span>
                                    </div>
                                    <div class="flex flex-col gap-3">
                                        <span
                                            class="font-label-uppercase text-[10px] text-secondary tracking-widest font-semibold">Pilar
                                            I • Spiritual &amp; Ekologi</span>
                                        <h3 class="font-headline-sm text-headline-sm text-primary">Tri Hita Karana &amp;
                                            Harmoni Lingkungan</h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Keseimbangan hubungan antara manusia, alam semesta, dan Sang Pencipta yang
                                            diwujudkan dalam nol emisi limbah plastik sekali pakai, inisiatif konservasi
                                            terumbu karang pesisir selatan, serta pemanfaatan 100% energi sirkular.
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="pt-4 flex items-center gap-2 text-secondary font-label-uppercase text-[11px] tracking-wider font-semibold">
                                    <span>Harmoni Universal</span>
                                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                </div>
                            </div>
                            <!-- Pilar 2 -->
                            <div
                                class="group bg-surface-container-low hover:bg-surface-container-lowest p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between gap-8">
                                <div class="flex flex-col gap-6">
                                    <div
                                        class="w-14 h-14 rounded-xl bg-surface-container flex items-center justify-center text-secondary group-hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined text-[32px]">restaurant</span>
                                    </div>
                                    <div class="flex flex-col gap-3">
                                        <span
                                            class="font-label-uppercase text-[10px] text-secondary tracking-widest font-semibold">Pilar
                                            II • Kuliner Autentik</span>
                                        <h3 class="font-headline-sm text-headline-sm text-primary">Artisan Gastronomi
                                            &amp; Hasil Bumi Lokal</h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Konsep farm-to-table dan ocean-to-table murni yang bermitra erat dengan
                                            nelayan tradisional Jimbaran serta petani organik pegunungan Bedugul demi
                                            melahirkan sajian haute cuisine bercita rasa otentik nan menggugah.
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="pt-4 flex items-center gap-2 text-secondary font-label-uppercase text-[11px] tracking-wider font-semibold">
                                    <span>Rasa &amp; Warisan</span>
                                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                </div>
                            </div>
                            <!-- Pilar 3 -->
                            <div
                                class="group bg-surface-container-low hover:bg-surface-container-lowest p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between gap-8">
                                <div class="flex flex-col gap-6">
                                    <div
                                        class="w-14 h-14 rounded-xl bg-surface-container flex items-center justify-center text-secondary group-hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined text-[32px]">room_service</span>
                                    </div>
                                    <div class="flex flex-col gap-3">
                                        <span
                                            class="font-label-uppercase text-[10px] text-secondary tracking-widest font-semibold">Pilar
                                            III • Layanan Paripurna</span>
                                        <h3 class="font-headline-sm text-headline-sm text-primary">Butler Les Clefs d'Or
                                            Berdedikasi</h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Ketulusan keramahan tanpa cela dari staf bertaraf global yang mengantisipasi
                                            setiap kebutuhan tamu sebelum terucap, menghormati privasi penuh, dan
                                            mempersembahkan pelayanan hangat yang bersahabat.
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="pt-4 flex items-center gap-2 text-secondary font-label-uppercase text-[11px] tracking-wider font-semibold">
                                    <span>Diskresi Sempurna</span>
                                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- KOMITMEN KEBERLANJUTAN & KONSERVASI (DEEP NAVY LUXURY SECTION) -->
                <section
                    class="w-full bg-primary-container text-on-primary py-20 md:py-28 px-6 md:px-12 lg:px-16 relative overflow-hidden">
                    <!-- Subtle Ambient Glow -->
                    <div
                        class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-secondary/15 blur-3xl pointer-events-none">
                    </div>
                    <div
                        class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full bg-tertiary-container/40 blur-3xl pointer-events-none">
                    </div>
                    <div class="max-w-[1320px] mx-auto relative z-10 flex flex-col gap-16">
                        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                            <div class="max-w-2xl flex flex-col gap-4">
                                <div
                                    class="inline-flex items-center gap-2 self-start px-3 py-1 rounded bg-secondary/20 text-secondary-fixed">
                                    <span class="material-symbols-outlined text-[14px]">eco</span>
                                    <span
                                        class="font-label-uppercase text-[11px] tracking-widest font-semibold">Inisiatif
                                        Hijau Holistik</span>
                                </div>
                                <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-on-primary">
                                    Tanggung Jawab Ekologis: Kemewahan yang Menghargai Bumi
                                </h2>
                                <p class="font-body-md text-body-md text-on-primary-container leading-relaxed">
                                    Keindahan tebing Uluwatu adalah anugerah purba. Kami memastikan setiap detik tinggal
                                    Anda berkontribusi langsung pada restorasi biosfer dan pelestarian komunitas pesisir
                                    Bali.
                                </p>
                            </div>
                            <!-- Circular Sustainability Progress Metric Badge -->
                            <div
                                class="bg-primary/40 backdrop-blur-md p-6 rounded-2xl flex items-center gap-6 shadow-xl">
                                <div class="relative w-20 h-20 flex items-center justify-center">
                                    <svg class="w-full h-full transform -rotate-90" viewbox="0 0 36 36">
                                        <path class="text-on-primary/10"
                                            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none" stroke="currentColor" stroke-width="3"></path>
                                        <path class="text-secondary-fixed"
                                            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none" stroke="currentColor" stroke-dasharray="96, 100"
                                            stroke-linecap="round" stroke-width="3"></path>
                                    </svg>
                                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                                        <span class="font-headline-sm text-[18px] text-on-primary font-bold">96%</span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="font-headline-sm text-body-md text-on-primary font-semibold">Sirkularitas
                                        Sumber Daya</span>
                                    <span class="font-body-sm text-[12px] text-on-primary-container">Audit Tahunan
                                        Independen 2024</span>
                                </div>
                            </div>
                        </div>
                        <!-- 4 Sustainability Cards Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Item 1 -->
                            <div
                                class="bg-primary/50 backdrop-blur-sm p-6 rounded-xl flex flex-col justify-between gap-6 hover:bg-primary/70 transition-colors">
                                <div class="flex flex-col gap-3">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-surface-container-low/10 flex items-center justify-center text-secondary-fixed">
                                        <span class="material-symbols-outlined text-[26px]">water_drop</span>
                                    </div>
                                    <h3 class="font-headline-sm text-body-lg text-on-primary font-semibold">100%
                                        Sirkulasi Air Mandiri</h3>
                                    <p class="font-body-sm text-body-sm text-on-primary-container leading-relaxed">
                                        Teknologi Thalasso Greywater Recirculation memproses seluruh air bilasan untuk
                                        irigasi kebun botani tropis seluas 15 hektar.
                                    </p>
                                </div>
                                <span class="font-label-uppercase text-[10px] text-secondary-fixed tracking-wider">Zero
                                    Water Waste</span>
                            </div>
                            <!-- Item 2 -->
                            <div
                                class="bg-primary/50 backdrop-blur-sm p-6 rounded-xl flex flex-col justify-between gap-6 hover:bg-primary/70 transition-colors">
                                <div class="flex flex-col gap-3">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-surface-container-low/10 flex items-center justify-center text-secondary-fixed">
                                        <span class="material-symbols-outlined text-[26px]">air</span>
                                    </div>
                                    <h3 class="font-headline-sm text-body-lg text-on-primary font-semibold">Desain
                                        Bioklimatik Pasif</h3>
                                    <p class="font-body-sm text-body-sm text-on-primary-container leading-relaxed">
                                        Arsitektur terasering cerdas mengoptimalkan hembusan angin laut, mereduksi
                                        konsumsi pendingin udara sintetis hingga 45%.
                                    </p>
                                </div>
                                <span class="font-label-uppercase text-[10px] text-secondary-fixed tracking-wider">-45%
                                    Konsumsi Energi</span>
                            </div>
                            <!-- Item 3 -->
                            <div
                                class="bg-primary/50 backdrop-blur-sm p-6 rounded-xl flex flex-col justify-between gap-6 hover:bg-primary/70 transition-colors">
                                <div class="flex flex-col gap-3">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-surface-container-low/10 flex items-center justify-center text-secondary-fixed">
                                        <span class="material-symbols-outlined text-[26px]">phishing</span>
                                    </div>
                                    <h3 class="font-headline-sm text-body-lg text-on-primary font-semibold">Haven Marine
                                        Sanctuary</h3>
                                    <p class="font-body-sm text-body-sm text-on-primary-container leading-relaxed">
                                        Pusat penetasan penyu lekang dan rehabilitasi 3.200 m² terumbu karang di bawah
                                        naungan kurasi ahli biologi kelautan resor.
                                    </p>
                                </div>
                                <span
                                    class="font-label-uppercase text-[10px] text-secondary-fixed tracking-wider">+1.400
                                    Tukik Dilepasliarkan</span>
                            </div>
                            <!-- Item 4 -->
                            <div
                                class="bg-primary/50 backdrop-blur-sm p-6 rounded-xl flex flex-col justify-between gap-6 hover:bg-primary/70 transition-colors">
                                <div class="flex flex-col gap-3">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-surface-container-low/10 flex items-center justify-center text-secondary-fixed">
                                        <span class="material-symbols-outlined text-[26px]">groups</span>
                                    </div>
                                    <h3 class="font-headline-sm text-body-lg text-on-primary font-semibold">Dukungan
                                        Budaya Komunitas</h3>
                                    <p class="font-body-sm text-body-sm text-on-primary-container leading-relaxed">
                                        Pemberdayaan aktif bagi 85+ perajin ukir lokal dan pemeliharaan sanggar seni
                                        tari tradisional Pecatu melalui dana konservasi mandiri.
                                    </p>
                                </div>
                                <span
                                    class="font-label-uppercase text-[10px] text-secondary-fixed tracking-wider">Warisan
                                    Berkelanjutan</span>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- TIM KEPEMIMPINAN & PENGELOLA (LEADERSHIP CARDS) -->
                <section class="w-full bg-surface-container-low py-20 md:py-28 px-6 md:px-12 lg:px-16">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-16">
                        <div class="text-center max-w-3xl mx-auto flex flex-col gap-3">
                            <span class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Para
                                Kurator Kenyamanan</span>
                            <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-primary">Tokoh di
                                Balik Keramahan Tanpa Cela</h2>
                            <p class="font-body-md text-body-md text-on-surface-variant">
                                Perpaduan pengalaman standar intisari perhotelan Eropa terbaik dan ketulusan jiwa
                                menyambut khas budaya Bali.
                            </p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                            <!-- Pemimpin 1 -->
                            <div
                                class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-md flex flex-col hover:shadow-xl transition-shadow duration-300">
                                <div class="h-72 w-full overflow-hidden bg-surface-container relative">
                                    <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                        data-alt="Editorial portrait of Antoine de Montmirail, distinguished General Manager in tailored linen blazer overlooking coastal resort, sophisticated luxury hospitality professional with calm demeanor."
                                        src="{{ asset('images/adscut.jpeg') }} "/>
                                    <div
                                        class="absolute top-3 right-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded text-[10px] font-label-uppercase tracking-wider text-primary font-bold">
                                        GM
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between gap-4">
                                    <div>
                                        <h3 class="font-headline-sm text-title-editorial text-primary font-semibold">
                                            Cudiss de Montmirail</h3>
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary tracking-wider block mt-0.5">General
                                            Manager</span>
                                        <p
                                            class="font-body-sm text-body-sm text-on-surface-variant mt-3 leading-relaxed">
                                            25 tahun mengarungi industri resor ultra-luxury terkemuka di pegunungan
                                            Swiss dan garis pantai Riviera Prancis.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-3 flex items-center gap-2 text-on-surface-variant font-label-uppercase text-[10px] tracking-wider">
                                        <span
                                            class="material-symbols-outlined text-[16px] text-secondary">workspace_premium</span>
                                        <span>Geneva • St. Tropez • Bali</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Pemimpin 2 -->
                            <div
                                class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-md flex flex-col hover:shadow-xl transition-shadow duration-300">
                                <div class="h-72 w-full overflow-hidden bg-surface-container relative">
                                    <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                        data-alt="Editorial portrait of Ni Kadek Wardani, Balinese Director of Guest Experience with Les Clefs d'Or golden crossed keys badge on collar, warm elegant smile, natural soft lighting."
                                        src="{{ asset('images/dapa.jpeg') }}"/>
                                    <div
                                        class="absolute top-3 right-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded text-[10px] font-label-uppercase tracking-wider text-secondary font-bold">
                                        Clefs d'Or
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between gap-4">
                                    <div>
                                        <h3 class="font-headline-sm text-title-editorial text-primary font-semibold">el-daffa
                                            el-kahfi</h3>
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary tracking-wider block mt-0.5">Dir.
                                            of Guest Experience</span>
                                        <p
                                            class="font-body-sm text-body-sm text-on-surface-variant mt-3 leading-relaxed">
                                            Pemegang sertifikat bergengsi Les Clefs d'Or internasional, piawai merajut
                                            setiap impian liburan menjadi kenyataan.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-3 flex items-center gap-2 text-on-surface-variant font-label-uppercase text-[10px] tracking-wider">
                                        <span
                                            class="material-symbols-outlined text-[16px] text-secondary">vpn_key</span>
                                        <span>Les Clefs d'Or Certified</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Pemimpin 3 -->
                            <div
                                class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-md flex flex-col hover:shadow-xl transition-shadow duration-300">
                                <div class="h-72 w-full overflow-hidden bg-surface-container relative">
                                    <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                        data-alt="Editorial culinary portrait of Chef Julien Moreau in crisp minimalist chef jacket inspecting organic fresh herbs in Uluwatu garden kitchen, artistic gastronomy lighting."
                                        src="{{ asset('images/glng.jpeg') }}"/>
                                    <div
                                        class="absolute top-3 right-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded text-[10px] font-label-uppercase tracking-wider text-primary font-bold">
                                        Haute Cuisine
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between gap-4">
                                    <div>
                                        <h3 class="font-headline-sm text-title-editorial text-primary font-semibold">
                                            Chef gilang 😘😘</h3>
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary tracking-wider block mt-0.5">Culinary
                                            Director</span>
                                        <p
                                            class="font-body-sm text-body-sm text-on-surface-variant mt-3 leading-relaxed">
                                            Peraih penghargaan gastronomi prestisius, memadukan teknik French Haute
                                            Cuisine dengan rempah Nusantara otentik.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-3 flex items-center gap-2 text-on-surface-variant font-label-uppercase text-[10px] tracking-wider">
                                        <span
                                            class="material-symbols-outlined text-[16px] text-secondary">star_half</span>
                                        <span>French-Indonesian Fusion</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Pemimpin 4 -->
                            <div
                                class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-md flex flex-col hover:shadow-xl transition-shadow duration-300">
                                <div class="h-72 w-full overflow-hidden bg-surface-container relative">
                                    <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                        data-alt="Serene portrait of Wayan Sudarsana, Balinese Master Healer dressed in traditional white linen sitting near singing bowls and frangipani blossoms at Haven Palais wellness pavilion."
                                        src="{{ asset('images/reno.jpeg') }}" />
                                    <div
                                        class="absolute top-3 right-3 bg-surface-container-lowest/90 backdrop-blur-sm px-2.5 py-1 rounded text-[10px] font-label-uppercase tracking-wider text-secondary font-bold">
                                        Holistik
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between gap-4">
                                    <div>
                                        <h3 class="font-headline-sm text-title-editorial text-primary font-semibold">
                                            Reno F# gantung😹</h3>
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary tracking-wider block mt-0.5">Wellness
                                            Director &amp; Healer</span>
                                        <p
                                            class="font-body-sm text-body-sm text-on-surface-variant mt-3 leading-relaxed">
                                            Praktisi Ayurveda dan penyembuhan spiritual leluhur Bali dengan pemahaman
                                            mendalam tentang titik energi dan ketenangan batin.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-3 flex items-center gap-2 text-on-surface-variant font-label-uppercase text-[10px] tracking-wider">
                                        <span
                                            class="material-symbols-outlined text-[16px] text-secondary">self_improvement</span>
                                        <span>Usada Bali &amp; Sound Healing</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- PENGHARGAAN & REKOGNISI GLOBAL (AWARDS SHOWCASE) -->
                <section class="w-full bg-surface py-20 md:py-24 px-6 md:px-12 lg:px-16">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-12">
                        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-6">
                            <div class="flex flex-col gap-2">
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Pengakuan
                                    Dunia Internasional</span>
                                <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-primary">Rekognisi
                                    &amp; Penghargaan</h2>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant max-w-md">
                                Apresiasi atas konsistensi kami dalam menjaga kualitas layanan, privasi, dan kelestarian
                                alam pesisir Uluwatu.
                            </p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Award 1 -->
                            <div
                                class="p-6 rounded-2xl bg-surface-container-low hover:bg-surface-container-lowest transition-all duration-300 shadow-sm flex flex-col gap-4">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="material-symbols-outlined text-secondary text-[32px]">military_tech</span>
                                    <span
                                        class="font-label-uppercase text-[10px] bg-secondary-fixed/30 text-on-secondary-container px-2 py-0.5 rounded font-semibold">2024
                                        Winner</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h4 class="font-title-editorial text-title-editorial text-primary font-semibold">
                                        Condé Nast Traveler</h4>
                                    <p
                                        class="font-label-uppercase text-[11px] text-secondary font-medium tracking-wider">
                                        Readers' Choice Awards</p>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    #1 Luxury Cliffside Resort in Asia untuk panorama alam dan privasi tingkat tinggi.
                                </p>
                            </div>
                            <!-- Award 2 -->
                            <div
                                class="p-6 rounded-2xl bg-surface-container-low hover:bg-surface-container-lowest transition-all duration-300 shadow-sm flex flex-col gap-4">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="material-symbols-outlined text-secondary text-[32px]">emoji_events</span>
                                    <span
                                        class="font-label-uppercase text-[10px] bg-secondary-fixed/30 text-on-secondary-container px-2 py-0.5 rounded font-semibold">Top
                                        5 Global</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h4 class="font-title-editorial text-title-editorial text-primary font-semibold">
                                        Travel + Leisure</h4>
                                    <p
                                        class="font-label-uppercase text-[11px] text-secondary font-medium tracking-wider">
                                        World's Best Awards</p>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Peringkat 5 Besar Destinasi Resor Terbaik Dunia untuk retret peremajaan jiwa.
                                </p>
                            </div>
                            <!-- Award 3 -->
                            <div
                                class="p-6 rounded-2xl bg-surface-container-low hover:bg-surface-container-lowest transition-all duration-300 shadow-sm flex flex-col gap-4">
                                <div class="flex items-center justify-between">
                                    <span class="material-symbols-outlined text-secondary text-[32px]">villa</span>
                                    <span
                                        class="font-label-uppercase text-[10px] bg-secondary-fixed/30 text-on-secondary-container px-2 py-0.5 rounded font-semibold">Arsitektur</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h4 class="font-title-editorial text-title-editorial text-primary font-semibold">
                                        Prix Versailles</h4>
                                    <p
                                        class="font-label-uppercase text-[11px] text-secondary font-medium tracking-wider">
                                        World Architecture Award</p>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Excellence in Sustainable Biophilic Design atas harmonisasi villa dengan tebing
                                    karang.
                                </p>
                            </div>
                            <!-- Award 4 -->
                            <div
                                class="p-6 rounded-2xl bg-surface-container-low hover:bg-surface-container-lowest transition-all duration-300 shadow-sm flex flex-col gap-4">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="material-symbols-outlined text-secondary text-[32px]">hotel_class</span>
                                    <span
                                        class="font-label-uppercase text-[10px] bg-secondary-fixed/30 text-on-secondary-container px-2 py-0.5 rounded font-semibold">Three
                                        Keys</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h4 class="font-title-editorial text-title-editorial text-primary font-semibold">
                                        Michelin Guide</h4>
                                    <p
                                        class="font-label-uppercase text-[11px] text-secondary font-medium tracking-wider">
                                        Hospitality Distinction</p>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Tiga Kunci Michelin atas standar kenyamanan paripurna dan layanan sanctuary living.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- CTA & INVITATION SECTION -->
                <section class="w-full bg-surface-container-low py-20 md:py-28 px-6 md:px-12 lg:px-16">
                    <div class="max-w-[1320px] mx-auto">
                        <div
                            class="relative bg-primary text-on-primary rounded-3xl p-10 md:p-16 lg:p-20 overflow-hidden shadow-2xl flex flex-col items-center text-center">
                            <!-- Subtle Pattern overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-primary via-primary-container to-primary opacity-90 pointer-events-none">
                            </div>
                            <div class="relative z-10 max-w-3xl flex flex-col items-center gap-6">
                                <div
                                    class="w-12 h-12 rounded-full bg-surface-container-low/10 flex items-center justify-center text-secondary-fixed mb-2">
                                    <span class="material-symbols-outlined text-[24px]">key</span>
                                </div>
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary-fixed tracking-widest">
                                    Undangan Keheningan • Uluwatu, Bali
                                </span>
                                <h2
                                    class="font-display-hero text-headline-md md:text-headline-lg lg:text-display-hero font-normal text-on-primary leading-tight">
                                    Mulailah Kisah Tak Terlupakan Anda di Haven Palais
                                </h2>
                                <p
                                    class="font-body-lg text-body-lg text-on-primary-container max-w-2xl leading-relaxed">
                                    Jadwalkan kunjungan privat, konsultasi perayaan istimewa, atau pelajari lebih lanjut
                                    mengenai suaka kami yang tenteram. Butler pribadi kami siap melayani setiap harapan
                                    Anda.
                                </p>
                                <div class="flex flex-col sm:flex-row items-center gap-4 pt-4 w-full sm:w-auto">
                                    <a class="w-full sm:w-auto bg-secondary hover:bg-secondary-fixed-variant text-on-secondary px-8 py-3.5 rounded font-label-uppercase text-label-uppercase tracking-widest transition-all duration-300 flex items-center justify-center gap-2 shadow-lg"
                                        href="/kamar">
                                        <span>Pesan Kamar Sekarang</span>
                                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                    </a>
                                    <a class="w-full sm:w-auto bg-primary-container/80 hover:bg-primary-container text-on-primary border-none px-8 py-3.5 rounded font-label-uppercase text-label-uppercase tracking-widest transition-all duration-300 flex items-center justify-center gap-2 shadow-md"
<<<<<<< HEAD:resources/views/user/tentang/tentang.blade.php
                                        href="/konsultasi">
=======
                                        href="tel:{{ preg_replace('/[^0-9+]/', '', $site->site_phone ?: '+62218800900') }}">
>>>>>>> 47ac69b (backend finish):resources/views/frontend/tentang/tentang.blade.php
                                        <span
                                            class="material-symbols-outlined text-[18px] text-secondary-fixed">support_agent</span>
                                        <span>Hubungi Layanan Concierge</span>
                                    </a>
                                </div>
                                <div
                                    class="flex items-center gap-6 pt-6 text-on-primary-container text-[12px] font-label-uppercase tracking-wider">
                                    <span class="flex items-center gap-1.5">
                                        <span
                                            class="material-symbols-outlined text-[16px] text-secondary-fixed">lock</span>
                                        Privasi Terjamin Penuh
                                    </span>
                                    <span>•</span>
                                    <span class="flex items-center gap-1.5">
                                        <span
                                            class="material-symbols-outlined text-[16px] text-secondary-fixed">check_circle</span>
                                        Jaminan Tarif Eksklusif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- COMPREHENSIVE LUXURY RESORT FOOTER -->
                <footer class="w-full bg-primary text-on-primary pt-20 pb-12 px-6 md:px-12 lg:px-16">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-16">
                        <!-- Main Footer Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12">
                            <!-- Col 1: Identity & Description (4 cols) -->
                            <div class="lg:col-span-4 flex flex-col gap-6">
                                <div class="flex items-center gap-3">
<<<<<<< HEAD:resources/views/user/tentang/tentang.blade.php
                                    <img alt="Haven Palais Logo" class="h-9 w-auto"
                                        src="{{ asset('images/roundlogo.png') }}" />
=======
                                    <img alt="Haven Palais Logo" class="h-9 w-auto object-contain filter invert"
                                        src="{{ $site->fileUrl('site_logo', \App\Models\Setting::DEFAULT_LOGO) }}" />
>>>>>>> 47ac69b (backend finish):resources/views/frontend/tentang/tentang.blade.php
                                    <div class="flex flex-col">
                                        <span
                                            class="font-headline-sm text-headline-sm text-on-primary tracking-tight leading-none">{{ $site->site_name ?: 'Haven Palais' }}</span>
                                        <span
                                            class="font-label-uppercase text-label-uppercase text-secondary-fixed tracking-widest text-[10px] mt-0.5">Resort
                                            &amp; Spa • Uluwatu</span>
                                    </div>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-primary-container leading-relaxed">
                                    Suaka peristirahatan tebing kapur paling eksklusif di pesisir barat daya Bali.
                                    Menyatukan kemewahan arsitektur agung, kearifan spiritual Nusantara, dan pemandangan
                                    Samudra Hindia yang tak berbatas.
                                </p>
                                <div class="flex items-center gap-3 text-secondary-fixed">
                                    <a aria-label="Instagram"
                                        class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center hover:bg-secondary hover:text-on-secondary transition-colors"
<<<<<<< HEAD:resources/views/user/tentang/tentang.blade.php
                                        href="https://www.instagram.com/zidanermdhn18?mdxt=M2Q5ZmM2dWpyZHd2">
=======
                                        href="{{ $site->instagram_url ?: '#' }}">
>>>>>>> 47ac69b (backend finish):resources/views/frontend/tentang/tentang.blade.php
                                        <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                                    </a>
                                    <a aria-label="Facebook"
                                        class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center hover:bg-secondary hover:text-on-secondary transition-colors"
<<<<<<< HEAD:resources/views/user/tentang/tentang.blade.php
                                        href="https://www.facebook.com/share/1Kbzu9bA9w/">
=======
                                        href="{{ $site->facebook_url ?: '#' }}">
>>>>>>> 47ac69b (backend finish):resources/views/frontend/tentang/tentang.blade.php
                                        <span class="material-symbols-outlined text-[18px]">public</span>
                                    </a>
                                    <a aria-label="YouTube"
                                        class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center hover:bg-secondary hover:text-on-secondary transition-colors"
<<<<<<< HEAD:resources/views/user/tentang/tentang.blade.php
                                        href="https://www.youtube.com/@WindahBasudara">
=======
                                        href="{{ $site->youtube_url ?: '#' }}">
>>>>>>> 47ac69b (backend finish):resources/views/frontend/tentang/tentang.blade.php
                                        <span class="material-symbols-outlined text-[18px]">smart_display</span>
                                    </a>
                                </div>
                            </div>
                            <!-- Col 2: Navigasi Cepat (2 cols) -->
                            <div class="lg:col-span-2 flex flex-col gap-4">
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary-fixed tracking-widest">Eksplorasi</span>
                                <ul class="flex flex-col gap-2.5 font-body-sm text-body-sm text-on-primary-container">
                                    <li><a class="hover:text-on-primary transition-colors" href="/kamar">Koleksi
                                            Villa &amp; Suite</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="/kamar">Gastronomi
                                            Samudra</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="/kamar">Haven Spa &amp;
                                            Welness</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="/kamar">Pernikahan di
                                            Tebing</a></li>
                                    <li>
                                        <a class="hover:text-on-primary transition-colors" href="/?openGallery=true">
                                            Galeri Visual
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Col 3: Keberlanjutan & Layanan (3 cols) -->
                            <div class="lg:col-span-3 flex flex-col gap-4">
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary-fixed tracking-widest">Layanan
                                    &amp; Keberlanjutan</span>
                                <ul class="flex flex-col gap-2.5 font-body-sm text-body-sm text-on-primary-container">
                                    <li><a class="hover:text-on-primary transition-colors" href="/kamar">Les Clefs d'Or
                                            Concierge</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="/kamar">Konservasi Penyu
                                            &amp; Terumbu Karang</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="/kamar">Helipad &amp; VIP
                                            Chauffeur</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="/kamar">Laporan Ekologi
                                            2024</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="/ulasan">Karir &amp;
                                            Keramahan</a></li>
                                </ul>
                            </div>
                            <!-- Col 4: Kontak & Lokasi (3 cols) -->
                            <div class="lg:col-span-3 flex flex-col gap-4">
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary-fixed tracking-widest">Kontak
                                    Langsung</span>
                                <div class="flex flex-col gap-3 font-body-sm text-body-sm text-on-primary-container">
                                    <div class="flex items-start gap-2.5">
                                        <span
                                            class="material-symbols-outlined text-secondary-fixed text-[18px] mt-0.5">location_on</span>
                                        <span>Jl. Merdeka No.168, RT.01/RW.05, Ciwaringin, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16124</span>
                                    </div>
                                    <div class="flex items-center gap-2.5">
                                        <span
                                            class="material-symbols-outlined text-secondary-fixed text-[18px]">call</span>
<<<<<<< HEAD:resources/views/user/tentang/tentang.blade.php
                                        <a class="hover:text-on-primary transition-colors" href="https://wa.me/6281386932586">+62
                                         8138 6932 586</a>
=======
                                        <a class="hover:text-on-primary transition-colors" href="tel:{{ preg_replace('/[^0-9+]/', '', $site->site_phone ?: '+62218800900') }}">+62
                                            (021) 8800 900</a>
>>>>>>> 47ac69b (backend finish):resources/views/frontend/tentang/tentang.blade.php
                                    </div>
                                    <div class="flex items-center gap-2.5">
                                        <span
                                            class="material-symbols-outlined text-secondary-fixed text-[18px]">mail</span>
                                        <a class="hover:text-on-primary transition-colors"
<<<<<<< HEAD:resources/views/user/tentang/tentang.blade.php
                                            href="ajayzidaneramdhani@gmail.com">ajayzidaneramdhani.com</a>
=======
                                            href="mailto:{{ $site->site_email ?: 'concierge@havenpalais.com' }}">{{ $site->site_email ?: 'concierge@havenpalais.com' }}</a>
>>>>>>> 47ac69b (backend finish):resources/views/frontend/tentang/tentang.blade.php
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Bottom Separator & Copyright -->
                        <div
                            class="pt-8 border-t border-on-primary/10 flex flex-col sm:flex-row items-center justify-between gap-4 font-body-sm text-[12px] text-on-primary-container">
                            <div>
                                © 2025 Haven Palais Resort &amp; Spa Uluwatu. Hak cipta dilindungi undang-undang.
                            </div>
                            <div class="flex items-center gap-6">
                                <a class="hover:text-on-primary transition-colors" href="#">Kebijakan Privasi</a>
                                <a class="hover:text-on-primary transition-colors" href="#">Syarat &amp; Ketentuan</a>
                                <a class="hover:text-on-primary transition-colors" href="#">Aksesibilitas</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </main>
    </div>
</body>

</html>