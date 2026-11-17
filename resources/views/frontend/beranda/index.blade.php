<!DOCTYPE html>
<html lang="id">
@extends('frontend.layouts.app')

@section('title', 'Beranda')

@section('content')

@endsection

<head>
    <meta charset="utf-8">
    @if($site->site_favicon)
        <link rel="icon" href="{{ $site->fileUrl('site_favicon') }}">
    @endif
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="web_dashboard" name="shell-type">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet">
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
                <!-- HERO SECTION WITH NEGATIVE MARGIN TO BLEED UNDER TRANSLUCENT HEADER -->
                <section
                    class="relative w-full -mt-20 overflow-hidden bg-primary text-on-primary min-h-[92vh] flex flex-col justify-between">
                    <!-- Ambient Backdrop Image -->
                    <div class="absolute inset-0 bg-cover bg-center mix-blend-luminosity opacity-40 scale-105 transition-transform duration-1000 ease-out"
                        data-alt="Ultra luxury cliffside oceanfront resort in Bali at golden hour" id="hero-bg"
                        style="background-image: url({{ asset('images/hero.png') }});">
                    </div>
                    <!-- Radiant Gradient Scrims -->
                    <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/60 to-primary/30"></div>
                    <div
                        class="absolute -right-32 -top-32 w-96 h-96 rounded-full bg-secondary/15 blur-3xl pointer-events-none">
                    </div>
                    <!-- Hero Content Container -->
                    <div
                        class="relative z-10 w-full max-w-[1320px] mx-auto px-8 pt-44 pb-20 flex-1 flex flex-col justify-center">
                        <div class="max-w-3xl">
                            <!-- Editorial Monogram Overline -->
                            <div
                                class="inline-flex items-center gap-3 px-4 py-1.5 rounded-full bg-surface/10 backdrop-blur-md mb-8">
                                <span class="w-1.5 h-1.5 rounded-full bg-secondary-fixed"></span>
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary-fixed tracking-widest">Haven
                                    Palais • Sanctuaire de Bali</span>
                                <span class="text-on-primary/40 font-label-md text-label-md">|</span>
                                <span class="font-label-uppercase text-label-uppercase text-on-primary/80">Est.
                                    1928</span>
                            </div>
                            <h1
                                class="font-display-hero text-display-hero text-on-primary leading-tight tracking-tight mb-6">
                                {{ $site->hero_title ?: 'Kemewahan Abadi' }} <br>
                                <span
                                    class="italic font-normal text-secondary-fixed">{{ $site->hero_subtitle ?: 'di Tepi Samudra' }}</span>
                            </h1>
                            <p
                                class="font-body-lg text-body-lg text-on-primary/85 max-w-2xl mb-10 leading-relaxed font-light">
                                {{ $site->hero_description ?: 'Nikmati ketenangan eksklusif, panorama pesisir spektakuler, dan keramahan kelas dunia bintang lima yang dipadukan dengan kemegahan arsitektur tropis kontemporer.' }}
                            </p>
                            <!-- CTA Cluster -->
                            <div class="flex flex-wrap items-center gap-5">
                                <a class="bg-secondary-fixed text-on-secondary-fixed px-8 py-4 rounded font-label-uppercase text-label-uppercase tracking-widest hover:bg-secondary-fixed-dim transition-all shadow-lg flex items-center gap-3"
                                    href="#kamar-pilihan">
                                    <span class="">Jelajahi Pengalaman</span>
                                    <span class="material-symbols-outlined text-[18px]">south_east</span>
                                </a>
                                <button
                                    class="px-7 py-4 rounded bg-surface/10 text-on-primary hover:bg-surface/20 backdrop-blur-sm font-label-uppercase text-label-uppercase tracking-widest transition-all flex items-center gap-2"
                                    onclick="document.getElementById('gallery-modal').classList.remove('hidden')">
                                    <span class="material-symbols-outlined text-[18px]">photo_library</span>
                                    <span class="">Lihat Galeri</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- QUICK BOOKING BAR (FLOATING CHECK-IN WIDGET) -->
                <section class="relative z-20 w-full max-w-[1240px] mx-auto px-6 -mt-12">
                    <div
                        class="bg-surface-container-lowest rounded-xl shadow-[0_12px_32px_-4px_rgba(27,42,50,0.12)] p-4 lg:p-6">
                        <form action="{{ route('kamar.index') }}" method="GET"
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-center">
                            <!-- Check In -->
                            <div
                                class="p-3 bg-surface-container-low rounded-lg transition-colors hover:bg-surface-container">
                                <label
                                    class="block font-label-uppercase text-label-uppercase text-secondary tracking-wider mb-1">Check-in</label>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="material-symbols-outlined text-primary text-[20px]">calendar_today</span>
                                    <input name="check_in"
                                        class="w-full bg-transparent font-title-editorial text-title-editorial text-primary focus:outline-none cursor-pointer"
                                        type="date" min="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <!-- Check Out -->
                            <div
                                class="p-3 bg-surface-container-low rounded-lg transition-colors hover:bg-surface-container">
                                <label
                                    class="block font-label-uppercase text-label-uppercase text-secondary tracking-wider mb-1">Check-out</label>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-[20px]">event</span>
                                    <input name="check_out"
                                        class="w-full bg-transparent font-title-editorial text-title-editorial text-primary focus:outline-none cursor-pointer"
                                        type="date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                </div>
                            </div>
                            <!-- Guests -->
                            <div
                                class="p-3 bg-surface-container-low rounded-lg transition-colors hover:bg-surface-container">
                                <label
                                    class="block font-label-uppercase text-label-uppercase text-secondary tracking-wider mb-1">
                                    Jumlah Tamu
                                </label>

                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-[20px]">group</span>

                                    <select name="adults"
                                        class="w-full bg-transparent font-body-md text-body-md text-primary font-medium focus:outline-none cursor-pointer"
                                        required>
                                        @foreach (range(1, 10) as $number)
                                            <option value="{{ $number }}" {{ $number == 2 ? 'selected' : '' }}>
                                                {{ $number }} Dewasa
                                            </option>
                                        @endforeach
                                    </select>

                                    <select name="children"
                                        class="w-full bg-transparent font-body-md text-body-md text-primary font-medium focus:outline-none cursor-pointer">
                                        @foreach (range(0, 10) as $number)
                                            <option value="{{ $number }}" {{ $number == 0 ? 'selected' : '' }}>
                                                {{ $number }} Anak
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Suite Tier -->
                            <div
                                class="p-3 bg-surface-container-low rounded-lg transition-colors hover:bg-surface-container">
                                <label
                                    class="block font-label-uppercase text-label-uppercase text-secondary tracking-wider mb-1">
                                    Tipe Kamar
                                </label>

                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-[20px]">bed</span>

                                    <select name="room_type_id"
                                        class="w-full bg-transparent font-body-md text-body-md text-primary font-medium focus:outline-none cursor-pointer">
                                        <option value="">Semua Kategori</option>

                                        @foreach ($activeRoomTypes as $roomType)
                                            <option value="{{ $roomType->id }}">
                                                {{ $roomType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="h-full flex items-end">
                                <button
                                    class="w-full h-[58px] bg-primary-container text-on-primary hover:bg-primary font-label-uppercase text-label-uppercase tracking-widest rounded-lg flex items-center justify-center gap-2 transition-all shadow-md"
                                    type="submit">
                                    <span class="">Cari Ketersediaan</span>
                                    <span class="material-symbols-outlined text-[18px]">search</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
                <!-- EDITORIAL INTRO WITH TEXTURAL ASYMMETRY -->
                <section class="max-w-[1320px] mx-auto px-8 pt-24 pb-16 w-full">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                        <div class="lg:col-span-4">
                            <span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest block mb-3">Filosofi
                                Haven Palais</span>
                            <h2 class="font-headline-md text-headline-md text-primary leading-snug">
                                Oase Tenang Dikelilingi Simfoni Ombak
                            </h2>
                        </div>
                        <div class="lg:col-span-8 flex flex-col md:flex-row gap-8 items-start">
                            <p class="font-body-lg text-body-lg text-on-surface-variant font-light leading-relaxed">
                                Dibangun di atas tebing granit pesisir selatan yang megah, Haven Palais memadukan
                                tradisi aristokrat bahari dengan privasi mutlak. Setiap sudut dirancang untuk merayakan
                                ritme cahaya matahari terbit hingga hembusan angin laut malam.
                            </p>
                            <div class="p-6 bg-surface-container-low rounded-xl min-w-[240px] shadow-sm">
                                <div class="flex items-center gap-2 text-secondary mb-2">
                                    <span class="material-symbols-outlined text-[22px]">verified</span>
                                    <span class="font-label-uppercase text-label-uppercase">Best Rate Guarantee</span>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Layanan butler pribadi 24
                                    jam &amp; fasilitas helipad transfer eksklusif untuk tamu villa.</p>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- PILIHAN KAMAR & SUITE POPULER (ROOMS & SUITES SHOWCASE) -->
                <section class="max-w-[1320px] mx-auto px-8 py-16 w-full" id="kamar-pilihan">
                    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                        <div>
                            <span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest block mb-2">Koleksi
                                Sanctuary</span>
                            <h2 class="font-headline-lg text-headline-lg text-primary">Kamar &amp; Suite Pilihan</h2>
                        </div>
                        <a class="mt-4 md:mt-0 font-label-uppercase text-label-uppercase text-primary hover:text-secondary flex items-center gap-2 transition-colors"
                            href="/kamar">
                            <span class="">
                                Lihat Semua {{ $activeRoomTypes->count() }} Kamar &amp; Suite
                            </span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                    <!-- 3 Luxury Room Cards -->

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($featuredRoomTypes as $roomType)
                            @php
                                $roomImage = $roomType->images->first();
                            @endphp

                            <article
                                class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                                <div>
                                    <div class="relative w-full h-80 overflow-hidden bg-surface-container">
                                        @if ($roomImage)
                                            <div class="w-full h-full bg-cover bg-center group-hover:scale-105 transition-transform duration-700 ease-out"
                                                style="background-image: url('{{ asset('storage/' . $roomImage->image_path) }}')">
                                            </div>
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-on-surface-variant">
                                                Foto kamar belum tersedia
                                            </div>
                                        @endif

                                        <div
                                            class="absolute top-4 left-4 bg-primary/80 backdrop-blur-md px-3.5 py-1 rounded text-on-primary font-label-uppercase text-label-uppercase">
                                            {{ $roomType->category->name ?? 'Pilihan Kamar' }}
                                        </div>

                                        <div
                                            class="absolute bottom-4 right-4 bg-surface-container-lowest/90 backdrop-blur-md px-3.5 py-1.5 rounded shadow-sm">
                                            <span
                                                class="font-label-uppercase text-label-uppercase text-secondary font-semibold">
                                                {{ $roomType->name }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="p-8">
                                        <div class="flex items-center justify-between gap-4 mb-3">
                                            <h3 class="font-headline-sm text-headline-sm text-primary">
                                                {{ $roomType->name }}
                                            </h3>

                                            <span
                                                class="font-title-editorial text-title-editorial text-secondary font-semibold whitespace-nowrap">
                                                Rp {{ number_format($roomType->base_price, 0, ',', '.') }}
                                                <span class="font-body-sm text-body-sm text-on-surface-variant font-normal">
                                                    / malam
                                                </span>
                                            </span>
                                        </div>

                                        <p class="font-body-md text-body-md text-on-surface-variant mb-6 line-clamp-2">
                                            {{ $roomType->description ?: 'Nikmati pengalaman menginap yang nyaman bersama Haven Palais.' }}
                                        </p>

                                        <div class="flex flex-wrap gap-2 mb-6">
                                            @foreach ($roomType->facilities->take(3) as $facility)
                                                <span
                                                    class="inline-flex items-center gap-1.5 bg-surface-container-low px-3 py-1.5 rounded font-label-md text-label-md text-on-surface">
                                                    <span class="material-symbols-outlined text-[16px] text-secondary">
                                                        check_circle
                                                    </span>
                                                    {{ $facility->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="px-8 pb-8 pt-0">
                                    <a href="{{ route('kamar.index', ['room_type_id' => $roomType->id]) }}"
                                        class="w-full py-3.5 px-4 bg-surface-container-low hover:bg-primary-container hover:text-on-primary text-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-all flex items-center justify-center gap-2">
                                        <span>Detail &amp; Reservasi</span>
                                        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                                    </a>
                                </div>
                            </article>
                        @empty
                            <p class="col-span-full text-center text-on-surface-variant py-8">
                                Belum ada kamar yang tersedia.
                            </p>
                        @endforelse
                    </div>

                </section>
                <!-- FASILITAS ISTIMEWA (AMENITIES HIGHLIGHTS - INTERACTIVE BENTO GRID) -->
                <section class="bg-surface-container-low py-24 my-8">
                    <div class="max-w-[1320px] mx-auto px-8">
                        <div class="max-w-2xl mb-16">
                            <span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest block mb-2">Eksklusivitas
                                Tamu</span>
                            <h2 class="font-headline-lg text-headline-lg text-primary">Fasilitas Berstandar Dunia</h2>
                            <p class="font-body-lg text-body-lg text-on-surface-variant font-light mt-3">
                                Setiap fasilitas dirancang sebagai kanvas ketenangan pribadi dengan privasi mutlak bagi
                                setiap tamu terhormat.
                            </p>
                        </div>
                        <!-- Bento Grid Layout -->
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-12 gap-6">
                            <!-- 1. Infinity Horizon Pool (Large 7 cols) -->
                            <div
                                class="lg:col-span-7 bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm group relative flex flex-col justify-end min-h-[380px] p-8">
                                <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-700"
                                    data-alt="Massive cliffside multi-tier infinity horizon swimming pool seamlessly merging with ocean horizon at noon, crystal clear turquoise water, submerged sun loungers, minimalist stone edges"
                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCq_u0ME7SDxAeALQq2D7LnwDENSQ9gP34CgzVOb-c7PtzIlhWqeIehr7VN6IoIVgZ79KkfRLWt0sz9OcAT2172ssaDir7qc5XSndQVqV989HMWsKZhoYTJaMd9jKWUNveOcg5aMSVDBp0cAXZlKVpTJs_naUgqRL4kv1mwOltxP_tAQRuRqNzwCYyPv_4V5YD-xtmIwTFazxpM3GMYagCx7T7ybd63M5XJUWQ4NtY')">
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/40 to-transparent">
                                </div>
                                <div class="relative z-10 text-on-primary">
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded bg-secondary text-on-secondary font-label-uppercase text-label-uppercase mb-3">
                                        <span class="material-symbols-outlined text-[16px]">pool</span> Iconic Facility
                                    </span>
                                    <h3 class="font-headline-sm text-headline-sm text-on-primary mb-2">Infinity Horizon
                                        Pool</h3>
                                    <p class="font-body-md text-body-md text-on-primary/80 max-w-lg font-light">
                                        Kolam renang tanpa batas sepanjang 75 meter menggantung di bibir tebing samudra,
                                        menyajikan ilusi berenang langsung di atas batas cakrawala.
                                    </p>
                                </div>
                            </div>
                            <!-- 2. Palais Michelin Dining (5 cols) -->
                            <div
                                class="lg:col-span-5 bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm group relative flex flex-col justify-end min-h-[380px] p-8">
                                <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-700"
                                    data-alt="Exquisite fine dining restaurant interior with warm candlelight, linen tablecloths, crystal glassware, private culinary plating, ocean view through expansive arched windows at twilight"
                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAjtBDkY3ESwvj9IMMJw7JhPUozV1DZap6vDm5HpW6DnDN-ule7aKZqdMYFboZuap7Utu7ORhNO1zet8UK5jdyVLj4wHMShRwJse2I-r6lY4tQdafTqfFH4fhE6k0nDeIaXuJAtDps_0c3Xw2OZtIijcMuyOIng6uSrirZ1R-qVHmypPqws93GpfLeXhclyJFVJe3hFdTn5kXA8SYsA5xTSOpn7h8TPzStGd0e4VO0')">
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/40 to-transparent">
                                </div>
                                <div class="relative z-10 text-on-primary">
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded bg-surface/20 backdrop-blur-sm text-on-primary font-label-uppercase text-label-uppercase mb-3">
                                        <span class="material-symbols-outlined text-[16px]">restaurant</span> Michelin
                                        Selected
                                    </span>
                                    <h3 class="font-headline-sm text-headline-sm text-on-primary mb-2">Palais Haute
                                        Cuisine</h3>
                                    <p class="font-body-md text-body-md text-on-primary/80 font-light">
                                        Pengalaman kuliner adiboga kurasi Chef Étoilé dengan bahan laut segar kepulauan
                                        Nusantara dan teknik klasik Prancis.
                                    </p>
                                </div>
                            </div>
                            <!-- 3. Serenity Spa & Wellness (4 cols) -->
                            <div
                                class="lg:col-span-4 bg-surface-container-lowest rounded-xl p-8 shadow-sm flex flex-col justify-between">
                                <div>
                                    <div
                                        class="w-12 h-12 rounded-lg bg-surface-container-low flex items-center justify-center text-secondary mb-6">
                                        <span class="material-symbols-outlined text-[28px]">spa</span>
                                    </div>
                                    <h3 class="font-headline-sm text-headline-sm text-primary mb-3">Serenity Spa &amp;
                                        Wellness</h3>
                                    <p class="font-body-md text-body-md text-on-surface-variant font-light mb-6">
                                        Terapi holistik berbasis rempah organik lokal, sauna aroma herbal, dan paviliun
                                        suara relaksasi ombak yang memulihkan raga.
                                    </p>
                                </div>
                                <div
                                    class="flex items-center justify-between pt-4 bg-surface-container-low px-4 py-3 rounded-lg">
                                    <span
                                        class="font-label-uppercase text-label-uppercase text-secondary font-semibold">Tersedia
                                        12 Terapi Privat</span>
                                    <span
                                        class="material-symbols-outlined text-secondary text-[18px]">arrow_forward</span>
                                </div>
                            </div>
                            <!-- 4. Private Beach Club (4 cols) -->
                            <div
                                class="lg:col-span-4 bg-surface-container-lowest rounded-xl p-8 shadow-sm flex flex-col justify-between">
                                <div>
                                    <div
                                        class="w-12 h-12 rounded-lg bg-surface-container-low flex items-center justify-center text-secondary mb-6">
                                        <span class="material-symbols-outlined text-[28px]">beach_access</span>
                                    </div>
                                    <h3 class="font-headline-sm text-headline-sm text-primary mb-3">Private Cove Beach
                                        Club</h3>
                                    <p class="font-body-md text-body-md text-on-surface-variant font-light mb-6">
                                        Akses khusus menuju teluk berpasir putih alami. Cabana eksklusif, pelayanan
                                        koktail tepi laut, dan privasi tanpa gangguan publik.
                                    </p>
                                </div>
                                <div
                                    class="flex items-center justify-between pt-4 bg-surface-container-low px-4 py-3 rounded-lg">
                                    <span
                                        class="font-label-uppercase text-label-uppercase text-secondary font-semibold">Eksklusif
                                        Tamu Hotel</span>
                                    <span
                                        class="material-symbols-outlined text-secondary text-[18px]">arrow_forward</span>
                                </div>
                            </div>
                            <!-- 5. Helipad & Yacht Charter (4 cols) -->
                            <div
                                class="lg:col-span-4 bg-surface-container-lowest rounded-xl p-8 shadow-sm flex flex-col justify-between">
                                <div>
                                    <div
                                        class="w-12 h-12 rounded-lg bg-surface-container-low flex items-center justify-center text-secondary mb-6">
                                        <span class="material-symbols-outlined text-[28px]">sailing</span>
                                    </div>
                                    <h3 class="font-headline-sm text-headline-sm text-primary mb-3">Helipad &amp; Yacht
                                        Charter</h3>
                                    <p class="font-body-md text-body-md text-on-surface-variant font-light mb-6">
                                        Pendaratan helikopter pribadi di kompleks resor serta armada yacht 85-kaki siap
                                        mengantar Anda menjelajahi pulau-pulau eksotis.
                                    </p>
                                </div>
                                <div
                                    class="flex items-center justify-between pt-4 bg-surface-container-low px-4 py-3 rounded-lg">
                                    <span
                                        class="font-label-uppercase text-label-uppercase text-secondary font-semibold">Layanan
                                        VIP On-Demand</span>
                                    <span
                                        class="material-symbols-outlined text-secondary text-[18px]">arrow_forward</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- TESTIMONI TAMU & PENGHARGAAN (AWARDS & VIP REVIEWS) -->
                <section class="max-w-[1320px] mx-auto px-8 py-16 w-full">
                    <!-- Awards Ribbon -->
                    <div
                        class="bg-surface-container-low rounded-xl p-8 mb-16 flex flex-wrap items-center justify-around gap-8 text-center">
                        <div class="flex flex-col items-center">
                            <span class="material-symbols-outlined text-secondary text-[36px] mb-2">military_tech</span>
                            <span class="font-title-editorial text-title-editorial text-primary font-semibold">Forbes
                                5-Star Hotel</span>
                            <span class="font-label-uppercase text-label-uppercase text-on-surface-variant">Penghargaan
                                Global 2022 - 2024</span>
                        </div>
                        <div class="w-px h-12 bg-outline-variant/30 hidden md:block"></div>
                        <div class="flex flex-col items-center">
                            <span
                                class="material-symbols-outlined text-secondary text-[36px] mb-2">workspace_premium</span>
                            <span class="font-title-editorial text-title-editorial text-primary font-semibold">Condé
                                Nast Traveler</span>
                            <span class="font-label-uppercase text-label-uppercase text-on-surface-variant">Top 10
                                Resorts in Asia</span>
                        </div>
                        <div class="w-px h-12 bg-outline-variant/30 hidden md:block"></div>
                        <div class="flex flex-col items-center">
                            <span class="material-symbols-outlined text-secondary text-[36px] mb-2">hotel_class</span>
                            <span class="font-title-editorial text-title-editorial text-primary font-semibold">World
                                Luxury Hotel Awards</span>
                            <span class="font-label-uppercase text-label-uppercase text-on-surface-variant">Best
                                Architectural Coastal Resort</span>
                        </div>
                    </div>
                    <!-- VIP Reviews -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Review 1 -->
                        <div
                            class="bg-surface-container-lowest p-8 lg:p-10 rounded-xl shadow-sm relative flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-1 text-secondary mb-6">
                                    <span class="material-symbols-outlined text-[18px]">star</span>
                                    <span class="material-symbols-outlined text-[18px]">star</span>
                                    <span class="material-symbols-outlined text-[18px]">star</span>
                                    <span class="material-symbols-outlined text-[18px]">star</span>
                                    <span class="material-symbols-outlined text-[18px]">star</span>
                                </div>
                                <p
                                    class="font-title-editorial text-title-editorial text-primary italic mb-6 leading-relaxed">
                                    “Pengalaman menginap paling magis yang pernah kami rasakan. Privasi di Deluxe Ocean
                                    Villa sungguh tak tertandingi, dan staf menangani setiap detail itinerari
                                    helikopter kami secara sempurna.”
                                </p>
                            </div>
                            <div class="flex items-center gap-4 pt-6 bg-surface-container-low px-4 py-3 rounded-lg">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-on-primary font-headline-sm text-sm">
                                    AW
                                </div>
                                <div>
                                    <span class="font-label-md text-label-md text-primary font-semibold block">Arthur
                                        &amp; Vivienne Wellington</span>
                                    <span class="font-body-sm text-body-sm text-on-surface-variant">Tamu Royal Penthouse
                                        • London, UK</span>
                                </div>
                            </div>
                        </div>
                        <!-- Review 2 -->
                        <div
                            class="bg-surface-container-lowest p-8 lg:p-10 rounded-xl shadow-sm relative flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-1 text-secondary mb-6">
                                    <span class="material-symbols-outlined text-[18px]">star</span>
                                    <span class="material-symbols-outlined text-[18px]">star</span>
                                    <span class="material-symbols-outlined text-[18px]">star</span>
                                    <span class="material-symbols-outlined text-[18px]">star</span>
                                    <span class="material-symbols-outlined text-[18px]">star</span>
                                </div>
                                <p
                                    class="font-title-editorial text-title-editorial text-primary italic mb-6 leading-relaxed">
                                    “Haven Palais bukan sekadar resor, melainkan perlindungan jiwa dari hiruk-pikuk
                                    dunia. Kolam renang tanpa batas dan sajian chef degustation-nya layak mendapatkan
                                    predikat terbaik dunia.”
                                </p>
                            </div>
                            <div class="flex items-center gap-4 pt-6 bg-surface-container-low px-4 py-3 rounded-lg">
                                <div
                                    class="w-10 h-10 rounded-full bg-secondary flex items-center justify-center text-on-secondary font-headline-sm text-sm">
                                    SL
                                </div>
                                <div>
                                    <span class="font-label-md text-label-md text-primary font-semibold block">Stella
                                        Linardi</span>
                                    <span class="font-body-sm text-body-sm text-on-surface-variant">Tamu Deluxe Ocean
                                        Villa • Jakarta, ID</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- HAVEN PALAIS PRIVILEGE CLUB NEWSLETTER -->
                <section class="max-w-[1320px] mx-auto px-8 py-16 w-full">
                    <div class="bg-surface-container-low rounded-2xl p-8 lg:p-16 relative overflow-hidden">
                        <div
                            class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-secondary-fixed/30 blur-2xl pointer-events-none">
                        </div>
                        <div class="relative z-10 max-w-2xl mx-auto text-center">
                            <span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest block mb-3">Keanggotaan
                                Eksklusif</span>
                            <h2 class="font-headline-lg text-headline-lg text-primary mb-4">
                                Haven Palais Privilege Club
                            </h2>
                            <p class="font-body-lg text-body-lg text-on-surface-variant font-light mb-8">
                                Dapatkan akses prioritas terhadap reservasi seasonal suite, jamuan wine khusus, dan
                                penawaran penerbangan helikopter khusus anggota.
                            </p>
                            <form class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto"
                                onsubmit="event.preventDefault(); document.getElementById('nl-success').classList.remove('hidden');">
                                <input
                                    class="flex-1 px-5 py-4 rounded-lg bg-surface-container-lowest text-primary font-body-md text-body-md focus:outline-none focus:ring-1 focus:ring-secondary shadow-sm"
                                    placeholder="Masukkan alamat email resmi Anda..." required="" type="email">
                                <button
                                    class="bg-primary-container text-on-primary hover:bg-primary px-8 py-4 rounded-lg font-label-uppercase text-label-uppercase tracking-widest transition-all whitespace-nowrap shadow-sm"
                                    type="submit">
                                    Gabung VIP
                                </button>
                            </form>
                            <div class="hidden mt-4 text-secondary font-label-md text-label-md" id="nl-success">
                                Terima kasih. Undangan keanggotaan privat sedang dikirimkan ke kotak masuk Anda.
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-4 font-light">
                                Kami menjamin kerahasiaan data pribadi Anda sepenuhnya. Tanpa spam komersial.
                            </p>
                        </div>
                    </div>
                </section>
                <!-- MODAL GALERI INTERAKTIF (TRIGGERED FROM HERO) -->
                <div class="hidden fixed inset-0 z-50 bg-primary/90 backdrop-blur-md flex items-center justify-center p-6"
                    id="gallery-modal">
                    <div class="bg-surface rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto p-6 relative">
                        <div class="flex items-center justify-between pb-4 mb-4">
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-primary">Galeri Eksklusif Haven Palais
                                </h3>
                                <span class="font-label-uppercase text-label-uppercase text-secondary">Sudut Arsitektur
                                    &amp; Alam Tropis</span>
                            </div>
                            <button
                                class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-primary hover:bg-surface-variant"
                                onclick="document.getElementById('gallery-modal').classList.add('hidden')">
                                <span class="material-symbols-outlined text-[20px]">close</span>
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse ($galleryImages as $image)
                                <div class="h-64 rounded-lg overflow-hidden bg-cover bg-center">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="{{ $image->caption ?? 'Galeri Haven Palais' }}"
                                        class="w-full h-full object-cover" loading="lazy">
                                </div>
                            @empty
                                <div class="col-span-2 text-center py-10 text-on-surface-variant">
                                    Belum ada foto galeri yang tersedia.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // Micro-interaction: Parallax effect on hero background
                window.addEventListener('scroll', function () {
                    var heroBg = document.getElementById('hero-bg');
                    if (heroBg) {
                        var scrollY = window.pageYOffset;
                        heroBg.style.transform = 'translateY(' + (scrollY * 0.25) + 'px) scale(1.05)';
                    }
                });
                document.addEventListener('DOMContentLoaded', function () {
                    const params = new URLSearchParams(window.location.search);

                    if (params.get('openGallery') === 'true') {
                        const galleryModal = document.getElementById('gallery-modal');

                        if (galleryModal) {
                            galleryModal.classList.remove('hidden');
                        }

                        // Menghapus parameter dari URL setelah modal dibuka
                        window.history.replaceState({}, document.title, '/');
                    }
                });
            </script>
        </main>
    </div>

</body>

</html>