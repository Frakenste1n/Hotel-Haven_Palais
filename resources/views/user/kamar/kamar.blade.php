<!DOCTYPE html>

<html lang="id">
@extends('user.layouts.app')

@section('title', 'Kamar & Suites')

@section('content')

@push('scripts')
<script>
    // Simpan urutan awal kartu kamar
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('room-card-container');

        if (!container) return;

        const cards = container.querySelectorAll('.room-card');

        cards.forEach((card, index) => {
            card.dataset.originalIndex = index;
        });
    });

    // Fungsi sorting kartu kamar
    function sortCards(sortType) {
        const container = document.getElementById('room-card-container');

        if (!container) return;

        const cards = Array.from(
            container.querySelectorAll('.room-card')
        );

        cards.sort((a, b) => {
            const priceA = Number(a.dataset.price);
            const priceB = Number(b.dataset.price);

            const capacityA = Number(a.dataset.capacity);
            const capacityB = Number(b.dataset.capacity);

            switch (sortType) {

                case 'terendah':
                    return priceA - priceB;

                case 'tertinggi':
                    return priceB - priceA;

                case 'kapasitas':
                    return capacityB - capacityA;

                case 'rekomendasi':
                default:
                    return Number(a.dataset.originalIndex)
                        - Number(b.dataset.originalIndex);
            }
        });

        // Susun ulang kartu berdasarkan hasil sorting
        cards.forEach(card => {
            container.appendChild(card);
        });
    }
</script>
@endpush

@endsection
<head>
    <meta charset="utf-8" />
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
                <!-- INTRO & BREADCRUMB SECTION -->
                <section class="w-full px-6 lg:px-16 pt-8 pb-10 bg-surface">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-6">
                        <!-- Breadcrumb Navigation -->
                        <nav aria-label="Breadcrumb"
                            class="flex items-center gap-2 text-on-surface-variant font-label-uppercase text-label-uppercase">
                            <a class="hover:text-primary transition-colors" href="/">Home</a>
                            <span class="text-outline-variant">/</span>
                            <span class="text-secondary font-semibold">Kamar &amp; Suites</span>
                        </nav>
                        <!-- Main Title Header with Editorial Asymmetry -->
                        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-6">
                            <div class="max-w-3xl flex flex-col gap-3">
                                <div
                                    class="inline-flex items-center gap-2 self-start px-3 py-1 bg-surface-container-high rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                    <span
                                        class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Koleksi
                                        Hunian Istimewa</span>
                                </div>
                                <h1 class="font-headline-lg text-headline-lg text-primary tracking-tight">
                                    Akomodasi &amp; Sanctuary Eksklusif
                                </h1>
                                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">
                                    Temukan kemewahan hening berlatar cakrawala Samudra Hindia. Setiap vila dan suite
                                    dirancang dengan estetika tak lekang oleh waktu, menyajikan privasi paripurna serta
                                    sentuhan keramahan personal.
                                </p>
                            </div>
                            <div class="hidden lg:flex flex-col items-end gap-1.5 text-right">
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Kapasitas
                                    Maksimal Resor</span>
                                <span class="font-headline-sm text-headline-sm text-primary">32 Paviliun &amp; Villa
                                    Terbatas</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">Layanan Butler &amp;
                                    Akses Helipad Pribadi</span>
                            </div>
                        </div>
                        <!-- FILTER & QUICK SORT BAR -->
                        <div
                            class="bg-surface-container-lowest rounded-xl p-5 shadow-[0_12px_32px_-4px_rgba(27,42,50,0.05)] flex flex-col gap-5">
                            <!-- Top Category Row & Sort Dropdown -->
                            <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
                                <!-- Category Tabs -->
                                <div class="flex items-center gap-1.5 overflow-x-auto pb-1 lg:pb-0 scrollbar-none"
                                    id="category-tabs">
                                    <button
                                        class="category-btn active px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-uppercase text-label-uppercase tracking-wider transition-all whitespace-nowrap shadow-sm"
                                        onclick="setActiveCategory(this, 'all')">
                                        Semua Kategori
                                    </button>
                                    <button
                                        class="category-btn px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-on-surface font-label-uppercase text-label-uppercase tracking-wider transition-all whitespace-nowrap"
                                        onclick="setActiveCategory(this, 'ocean')">
                                        Oceanfront Villa
                                    </button>
                                    <button
                                        class="category-btn px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-on-surface font-label-uppercase text-label-uppercase tracking-wider transition-all whitespace-nowrap"
                                        onclick="setActiveCategory(this, 'penthouse')">
                                        Penthouse Suites
                                    </button>
                                    <button
                                        class="category-btn px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-on-surface font-label-uppercase text-label-uppercase tracking-wider transition-all whitespace-nowrap"
                                        onclick="setActiveCategory(this, 'garden')">
                                        Garden Sanctuary
                                    </button>
                                    <button
                                        class="category-btn px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-on-surface font-label-uppercase text-label-uppercase tracking-wider transition-all whitespace-nowrap"
                                        onclick="setActiveCategory(this, 'presidential')">
                                        Family Presidential
                                    </button>
                                </div>
                                <!-- Sort Select -->
                                <div class="flex items-center gap-3 self-end lg:self-center">
                                    <span
                                        class="font-label-uppercase text-label-uppercase text-on-surface-variant hidden sm:inline">Urutkan:</span>
                                    <div class="relative min-w-[200px]">
                                        <select
                                            class="w-full appearance-none bg-surface-container-low hover:bg-surface-container-high text-primary font-label-md text-label-md py-2.5 pl-3.5 pr-9 rounded-lg focus:outline-none transition-colors cursor-pointer"
                                            id="sort-select" onchange="sortCards(this.value)">
                                            <option value="rekomendasi">Rekomendasi Terbaik</option>
                                            <option value="terendah">Harga Terendah</option>
                                            <option value="tertinggi">Harga Tertinggi</option>
                                            <option value="kapasitas">Kapasitas Tamu</option>
                                        </select>
                                        <span
                                            class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none text-[20px]">expand_more</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Secondary Quick Filter Chips -->
                            <div class="flex flex-wrap items-center gap-2 pt-3">
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary mr-2 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">tune</span> Fasilitas Kunci:
                                </span>
                                <button
                                    class="quick-chip px-3 py-1.5 rounded bg-surface-container-low hover:bg-surface-container text-on-surface-variant font-body-sm text-body-sm transition-all flex items-center gap-1.5"
                                    data-filter="pool" onclick="toggleQuickFilter(this)">
                                    <span class="material-symbols-outlined text-[16px]">pool</span> Private Pool
                                </button>
                                <button
                                    class="quick-chip px-3 py-1.5 rounded bg-surface-container-low hover:bg-surface-container text-on-surface-variant font-body-sm text-body-sm transition-all flex items-center gap-1.5"
                                    data-filter="ocean" onclick="toggleQuickFilter(this)">
                                    <span class="material-symbols-outlined text-[16px]">water</span> Ocean View
                                </button>
                                <button
                                    class="quick-chip px-3 py-1.5 rounded bg-surface-container-low hover:bg-surface-container text-on-surface-variant font-body-sm text-body-sm transition-all flex items-center gap-1.5"
                                    data-filter="balcony" onclick="toggleQuickFilter(this)">
                                    <span class="material-symbols-outlined text-[16px]">deck</span> Balcony / Terrace
                                </button>
                                <button
                                    class="quick-chip px-3 py-1.5 rounded bg-surface-container-low hover:bg-surface-container text-on-surface-variant font-body-sm text-body-sm transition-all flex items-center gap-1.5"
                                    data-filter="butler" onclick="toggleQuickFilter(this)">
                                    <span class="material-symbols-outlined text-[16px]">room_service</span> Butler 24
                                    Jam
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- FEATURED SIGNATURE SUITE (SHOWCASE HORIZONTAL CARD) -->
                <section class="w-full px-6 lg:px-16 py-10 bg-surface-container-low">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span
                                    class="material-symbols-outlined text-secondary text-[24px]">workspace_premium</span>
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Pilihan
                                    Mahakarya Kami</span>
                            </div>
                            <span class="font-label-uppercase text-label-uppercase text-on-surface-variant">Hanya 1 Unit
                                Tersedia</span>
                        </div>
                        <!-- Large Asymmetrical Featured Card -->
                        <article
                            class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_16px_40px_-6px_rgba(27,42,50,0.08)] flex flex-col xl:flex-row">
                            <!-- Gallery Preview Half -->
                            <div class="xl:w-7/12 flex flex-col relative bg-surface-container-high">
                                <!-- Main Hero Image -->
                                <div class="relative h-80 sm:h-[420px] xl:h-[480px] w-full overflow-hidden">
                                    <img class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                                        data-alt="Expansive luxury cliffside penthouse suite bedroom at Haven Palais overlooking the endless azure Indian Ocean during soft golden morning light, floor-to-ceiling glass sliding doors open to an infinity plunge pool, teak woodwork, fine linen bedding, warm ivory aesthetics."
                                        id="featured-main-img"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvdWLie4zC25EWZT8Wa57TvOKSqCl2wIxHqMPi85Kg7RKoQgiyDYjwCm91VGQQIpXiJzxRnwL5TXgOcFqoEC4XvTW3nEV__-wfovZMrPFMBTwiJp1Fr6zELegir0MNihigb9CMZ465o7VWpSARUEnPp3fABP05Q8dI-VusXqkhXD6a-fBrrua3ViBYtKeBp4QqFCtsqFrHBC64AFshafEmcmYn4Sf108LOpDxaUOI" />
                                    <!-- Signature Badge -->
                                    <div
                                        class="absolute top-5 left-5 bg-primary-container text-on-primary font-label-uppercase text-label-uppercase tracking-widest px-3.5 py-1.5 rounded shadow-md flex items-center gap-2">
                                        <span
                                            class="material-symbols-outlined text-[16px] text-secondary-fixed">star</span>
                                        Signature Haven
                                    </div>
                                    <!-- Panoramic View Pill -->
                                    <div
                                        class="absolute bottom-5 left-5 bg-primary/75 backdrop-blur-md text-on-primary px-3.5 py-1.5 rounded-lg flex items-center gap-2">
                                        <span
                                            class="material-symbols-outlined text-[18px] text-secondary-fixed">panorama</span>
                                        <span class="font-label-uppercase text-label-uppercase">180° Samudra
                                            Hindia</span>
                                    </div>
                                </div>
                                <!-- Thumbnail Strip -->
                                <div class="grid grid-cols-4 p-3 gap-2 bg-surface-container">
                                    <button
                                        class="h-20 rounded overflow-hidden opacity-100 hover:opacity-90 transition-opacity focus:outline-none"
                                        onclick="changeFeaturedPhoto(this, 'interior')">
                                        <img class="w-full h-full object-cover"
                                            data-alt="Elegantly styled master bedroom interior of Royal Ocean Penthouse Villa with king size canopy bed and designer furnishings in ivory and sand tones."
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBbHNoTf2Lv-QZEaUA5gW7EWiNmblPGDer-xufNY_xFKsBVeZASb7pjfkqAvIPrsS8FMIV0v1pKkJwsQtbZLaIdBDlw3Q7gLl93AqY_UFbZhXbjUI90auqtlE43EoVDyH6NOHphXGeZvLtVZtWYGnhwbgBcxrM4Z394vMoHlSXttbCBhbp72dZW7KKSF1eWTTnNEXX_eKZAPzoF1cgOFPILKoP4Hcz_rGCyZQGgJEM" />
                                    </button>
                                    <button
                                        class="h-20 rounded overflow-hidden opacity-70 hover:opacity-100 transition-opacity focus:outline-none"
                                        onclick="changeFeaturedPhoto(this, 'pool')">
                                        <img class="w-full h-full object-cover"
                                            data-alt="Private infinity edge plunge pool on the oceanfront teak wood balcony terrace with sun loungers overlooking the azure horizon."
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAv-aRzhT_KReb-ZsoGXEC_Sght-939JTbKSAJtEeRLPO85dNrlFl4J0za8VQ0oCtEnWW5B49bqGnxaTr_nGF76DhaQcyk2arTVzlF33zgFB9EqQj_8RR_W0UnKU4_IO9VrX7FgeGPKJSZXlKR9QhDdE3_GJBoaRQC3uhaxAXDjkc6TK_CDEeh8gHGGNKKVsBLBn9Y9t04_NR7eG3RM7_TDqE_n9x_dUx0AwOGiAlc" />
                                    </button>
                                    <button
                                        class="h-20 rounded overflow-hidden opacity-70 hover:opacity-100 transition-opacity focus:outline-none"
                                        onclick="changeFeaturedPhoto(this, 'bath')">
                                        <img class="w-full h-full object-cover"
                                            data-alt="Spacious marble master bathroom suite with freestanding sculptural Jacuzzi soaking tub, double vanities, and Bvlgari luxury amenities."
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBMLfPp7Dkwm8dRnp9GXk32Q54xqVk3uKZgjUnEr-6Qikng3E3LlSDwLUBA32qXwTNZBcUfgRDwHkSLCFX77HvVWGTK6hdbHDgNUexnL3QLRLBtbZNFp0LpftRFDk9XlskGYgVFzomgYk44O1XMvNWSfy1jvWCbiUb6W45kD7ml9wnmVEOFyww2QzZYuv1qMLiyxsFd1pMGR7QHt76K9ox7yGalHxDEYMGy2VxBFbs" />
                                    </button>
                                    <button
                                        class="h-20 rounded overflow-hidden opacity-70 hover:opacity-100 transition-opacity focus:outline-none"
                                        onclick="changeFeaturedPhoto(this, 'sunset')">
                                        <img class="w-full h-full object-cover"
                                            data-alt="Sunset dining gazebo and sundeck overlooking the cliff coastline with private candlelight dinner setup."
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDc9bkiVXyWFOERfkSdAgnc4Cda2RaI7uRZQtduQf7JE6kF25d2hqU8kqdKea-lzdoE7AarYTthBsxDxUDBvJqo-OvmrMGqdzceyL2fkHY_92gCKNTxPHdX5Xx8g2fJlqlsE9jdPM6XF50oMqz0ahYC5OqoyY82b1G5ABjEeYlaAGgIeRTbp83KF57GY7pleSnZdegadFKA2qQO7qzAOMc17EAn8JtUdPEcvcpSzuY" />
                                    </button>
                                </div>
                            </div>
                            <!-- Details Half -->
                            <div class="xl:w-5/12 p-8 lg:p-10 flex flex-col justify-between gap-6">
                                <div class="flex flex-col gap-5">
                                    <!-- Title & Rate -->
                                    <div class="flex flex-col gap-2">
                                        <span
                                            class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Penthouse
                                            Collection • Lantai Puncak</span>
                                        <h2 class="font-headline-md text-headline-md text-primary leading-tight">
                                            Royal Ocean Penthouse Villa
                                        </h2>
                                        <div class="flex items-baseline gap-2 pt-1">
                                            <span class="font-title-editorial text-2xl font-bold text-primary">Rp
                                                12.500.000</span>
                                            <span class="font-body-sm text-body-sm text-on-surface-variant">/
                                                malam</span>
                                        </div>
                                        <p
                                            class="font-label-uppercase text-[11px] text-secondary flex items-center gap-1.5">
                                            <span class="material-symbols-outlined text-[15px]">done_all</span> Termasuk
                                            sarapan champagne harian &amp; afternoon tea privat
                                        </p>
                                    </div>
                                    <!-- Key Metric Icons Grid -->
                                    <div class="grid grid-cols-3 gap-3 p-4 bg-surface-container-low rounded-xl">
                                        <div class="flex flex-col items-center text-center p-2">
                                            <span
                                                class="material-symbols-outlined text-primary text-[24px] mb-1">aspect_ratio</span>
                                            <span class="font-label-uppercase text-[11px] text-on-surface-variant">Luas
                                                Area</span>
                                            <span class="font-body-md text-body-md font-semibold text-primary">320
                                                m²</span>
                                        </div>
                                        <div class="flex flex-col items-center text-center p-2">
                                            <span
                                                class="material-symbols-outlined text-primary text-[24px] mb-1">groups</span>
                                            <span
                                                class="font-label-uppercase text-[11px] text-on-surface-variant">Kapasitas</span>
                                            <span class="font-body-md text-body-md font-semibold text-primary">4 Dewasa
                                                + 2 Anak</span>
                                        </div>
                                        <div class="flex flex-col items-center text-center p-2">
                                            <span
                                                class="material-symbols-outlined text-primary text-[24px] mb-1">bed</span>
                                            <span class="font-label-uppercase text-[11px] text-on-surface-variant">Tipe
                                                Ranjang</span>
                                            <span class="font-body-md text-body-md font-semibold text-primary">1 King +
                                                2 Twin</span>
                                        </div>
                                    </div>
                                    <!-- Fasilitas Unggulan List -->
                                    <div class="flex flex-col gap-2.5">
                                        <span
                                            class="font-label-uppercase text-label-uppercase text-primary tracking-wider">Fasilitas
                                            Eksklusif Penghuni:</span>
                                        <ul
                                            class="flex flex-col gap-2 text-on-surface-variant font-body-sm text-body-sm">
                                            <li class="flex items-center gap-2.5">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[18px]">waves</span>
                                                <span>Infinity Plunge Pool pribadi di bibir teras tebing karst</span>
                                            </li>
                                            <li class="flex items-center gap-2.5">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[18px]">concierge</span>
                                                <span>Pelayanan Private Butler pribadi siaga 24 Jam</span>
                                            </li>
                                            <li class="flex items-center gap-2.5">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[18px]">bathtub</span>
                                                <span>Freestanding Marble Jacuzzi &amp; Bvlgari Luxury Spa Kit</span>
                                            </li>
                                            <li class="flex items-center gap-2.5">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[18px]">outdoor_grill</span>
                                                <span>Private Dining Gazebo &amp; Sundeck pemandangan laut lepas</span>
                                            </li>
                                            <li class="flex items-center gap-2.5">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[18px]">flight_takeoff</span>
                                                <span>Komplementari Antar-Jemput Helipad atau Limusin Bandara VIP</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- CTAs -->
                                <div class="flex flex-col sm:flex-row items-center gap-3 pt-4">
                                    <button
                                        class="w-full sm:flex-1 py-3 px-6 bg-primary-container text-on-primary hover:bg-primary rounded font-label-uppercase text-label-uppercase tracking-widest transition-colors flex items-center justify-center gap-2 shadow-sm"
                                        onclick="openBookingDrawer('Royal Ocean Penthouse Villa', 'Rp 12.500.000')">
                                        <span>Reservasi Sekarang</span>
                                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                    </button>
                                    <button
                                        class="w-full sm:w-auto py-3 px-5 bg-surface-container hover:bg-surface-container-high text-primary rounded font-label-uppercase text-label-uppercase tracking-widest transition-colors flex items-center justify-center gap-2"
                                        onclick="showRoomModal('Royal Ocean Penthouse Villa')">
                                        <span class="material-symbols-outlined text-[18px]">info</span>
                                        <span>Lihat Detail Lengkap</span>
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>
                <!-- COMPREHENSIVE ROOM & SUITE GRID -->
                <section class="w-full px-6 lg:px-16 py-14 bg-surface" id="kamar-pilihan">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-10">
                        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                            <div>
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Katalog
                                    Lengkap</span>
                                <h2 class="font-headline-md text-headline-md text-primary mt-1">Pilihan Sanctuary Kamar
                                    &amp; Villa</h2>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant max-w-sm">
                                Semua akomodasi dilengkapi teras pribadi, perlengkapan mandi artisan lokal, serta butler
                                concierge digital 24 jam.
                            </p>
                        </div>
                        <!-- Grid Container: 4 Detailed Room Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8" id="room-card-container">
                            <!-- CARD 1: Deluxe Ocean Cliff Villa -->
                            <article
                                class="room-card bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_12px_32px_-4px_rgba(27,42,50,0.05)] hover:shadow-[0_20px_48px_-6px_rgba(27,42,50,0.1)] transition-all flex flex-col justify-between"
                                data-capacity="2" data-category="ocean" data-features="pool,ocean,balcony"
                                data-price="3500000">
                                <div class="flex flex-col">
                                    <!-- Room Image Container -->
                                    <div class="relative h-64 sm:h-72 w-full overflow-hidden bg-surface-container-high">
                                        <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                            data-alt="Deluxe Ocean Cliff Villa interior at Haven Palais overlooking the dramatic cliff edge and azure sea, featuring natural rattan textures, crisp white bed canopy, and private outdoor sundeck."
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAbh0N63f1zZrxTRoZAzhkfSYl9FRfndpcP00n2WF9ITfyi-0lzOLghO7Sx5b4elxBCYyr4WRBvmtTivWu0f3oshddV8k_u5RCVfVItDieNrYKPOIhgWmPJC2faKOGWc5I8yQ_rpuGO6h3ftxk-EksmlH0b6pSJP5sK7rTvm8moHeL2pOk8sZKcnK3MG9g4s2nhzLiWpDzu8kzep0PMZ4hAbDn5P1gbK4oS6zyf2MA" />
                                        <div
                                            class="absolute top-4 left-4 bg-secondary text-on-secondary px-3 py-1 rounded font-label-uppercase text-[11px] tracking-wider shadow">
                                            Best Seller
                                        </div>
                                        <div
                                            class="absolute bottom-3 right-3 bg-primary/80 backdrop-blur text-on-primary px-3 py-1 rounded-full font-label-uppercase text-[10px] flex items-center gap-1">
                                            <span
                                                class="material-symbols-outlined text-[14px] text-secondary-fixed">photo_camera</span>
                                            8 Foto
                                        </div>
                                    </div>
                                    <!-- Content Area -->
                                    <div class="p-6 flex flex-col gap-4">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <span
                                                    class="font-label-uppercase text-[11px] text-secondary tracking-widest block">Oceanfront
                                                    Sanctuary</span>
                                                <h3 class="font-headline-sm text-headline-sm text-primary">Deluxe Ocean
                                                    Cliff Villa</h3>
                                            </div>
                                            <div class="text-right">
                                                <span
                                                    class="font-title-editorial text-title-editorial text-primary font-bold">Rp
                                                    3.500.000</span>
                                                <span class="font-body-sm text-[12px] text-on-surface-variant block">/
                                                    malam</span>
                                            </div>
                                        </div>
                                        <!-- Quick Specs Pill Row -->
                                        <div
                                            class="flex flex-wrap items-center gap-3 py-2 text-on-surface-variant font-label-uppercase text-[11px] bg-surface-container-low px-3 py-2 rounded-lg">
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-primary">square_foot</span>
                                                220 m²</span>
                                            <span class="text-outline-variant">•</span>
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-primary">person</span>
                                                2 Tamu Dewasa</span>
                                            <span class="text-outline-variant">•</span>
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-primary">king_bed</span>
                                                1 King Bed</span>
                                            <span class="text-outline-variant">•</span>
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-secondary">visibility</span>
                                                Cliff Ocean</span>
                                        </div>
                                        <!-- Amenities Bulletins -->
                                        <div
                                            class="flex flex-col gap-1.5 text-on-surface-variant font-body-sm text-body-sm">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[16px]">hot_tub</span>
                                                <span>Private Heated Jacuzzi &amp; Teras Berjemur Pribadi</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[16px]">dresser</span>
                                                <span>Spacious Walk-in Closet &amp; Vanity Dressing Room</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[16px]">coffee_maker</span>
                                                <span>Artisan Espresso Bar &amp; Rainforest Open Shower</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Footer Actions -->
                                <div class="p-6 pt-0 flex items-center gap-3">
                                    <button
                                        class="flex-1 py-2.5 px-4 bg-primary-container text-on-primary hover:bg-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-colors text-center shadow-sm"
                                        onclick="openBookingDrawer('Deluxe Ocean Cliff Villa', 'Rp 3.500.000')">
                                        Pesan Sekarang
                                    </button>
                                    <button
                                        class="py-2.5 px-4 bg-surface-container-low hover:bg-surface-container text-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-colors"
                                        onclick="showRoomModal('Deluxe Ocean Cliff Villa')">
                                        Detail Kamar
                                    </button>
                                </div>
                            </article>
                            <!-- CARD 2: Private Garden Botanical Bungalow -->
                            <article
                                class="room-card bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_12px_32px_-4px_rgba(27,42,50,0.05)] hover:shadow-[0_20px_48px_-6px_rgba(27,42,50,0.1)] transition-all flex flex-col justify-between"
                                data-capacity="2" data-category="garden" data-features="balcony" data-price="2950000">
                                <div class="flex flex-col">
                                    <!-- Room Image Container -->
                                    <div class="relative h-64 sm:h-72 w-full overflow-hidden bg-surface-container-high">
                                        <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                            data-alt="Lush tropical garden sanctuary bungalow with open stone patio, lotus pond view, ambient warm lantern lighting, surrounded by towering palms and frangipani at Haven Palais resort."
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBMrwYHlfP45KncLkCHYHt7xtqT7S-mHj2z-Z5Kh0Ne-t1faMXd81LJPw-4ydnpKu_3QRGWQEFC8UYtYfYtWa-Nu2hIE5NAhg-1AzYKb3zOyEzFqMfkqXKIlg-F91MdzUtEZWSU8CNG3JsumFjzg7QMiimYXxmoNH3rVrLmsvRDMhB8-Wu9BDaEIvIxrgC7uGa5zzve0snWlHcKq8xnUg3D0llxnNuHFRHFbyHbVyY" />
                                        <div
                                            class="absolute top-4 left-4 bg-surface-container-lowest text-primary px-3 py-1 rounded font-label-uppercase text-[11px] tracking-wider shadow">
                                            Zen Sanctuary
                                        </div>
                                        <div
                                            class="absolute bottom-3 right-3 bg-primary/80 backdrop-blur text-on-primary px-3 py-1 rounded-full font-label-uppercase text-[10px] flex items-center gap-1">
                                            <span
                                                class="material-symbols-outlined text-[14px] text-secondary-fixed">photo_camera</span>
                                            6 Foto
                                        </div>
                                    </div>
                                    <!-- Content Area -->
                                    <div class="p-6 flex flex-col gap-4">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <span
                                                    class="font-label-uppercase text-[11px] text-secondary tracking-widest block">Garden
                                                    &amp; Wellness Suite</span>
                                                <h3 class="font-headline-sm text-headline-sm text-primary">Private
                                                    Garden Botanical Bungalow</h3>
                                            </div>
                                            <div class="text-right">
                                                <span
                                                    class="font-title-editorial text-title-editorial text-primary font-bold">Rp
                                                    2.950.000</span>
                                                <span class="font-body-sm text-[12px] text-on-surface-variant block">/
                                                    malam</span>
                                            </div>
                                        </div>
                                        <!-- Quick Specs Pill Row -->
                                        <div
                                            class="flex flex-wrap items-center gap-3 py-2 text-on-surface-variant font-label-uppercase text-[11px] bg-surface-container-low px-3 py-2 rounded-lg">
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-primary">square_foot</span>
                                                180 m²</span>
                                            <span class="text-outline-variant">•</span>
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-primary">person</span>
                                                2 Tamu Dewasa</span>
                                            <span class="text-outline-variant">•</span>
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-primary">king_bed</span>
                                                1 King Bed</span>
                                            <span class="text-outline-variant">•</span>
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-secondary">potted_plant</span>
                                                Taman Tropis</span>
                                        </div>
                                        <!-- Amenities Bulletins -->
                                        <div
                                            class="flex flex-col gap-1.5 text-on-surface-variant font-body-sm text-body-sm">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[16px]">shower</span>
                                                <span>Outdoor Hand-carved Natural Stone Shower</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[16px]">self_improvement</span>
                                                <span>Paviliun Yoga Pribadi &amp; Kolam Teratai Reflektif</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[16px]">spa</span>
                                                <span>Diffuser Aromaterapi Organik &amp; Herbal Pillow Menu</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Footer Actions -->
                                <div class="p-6 pt-0 flex items-center gap-3">
                                    <button
                                        class="flex-1 py-2.5 px-4 bg-primary-container text-on-primary hover:bg-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-colors text-center shadow-sm"
                                        onclick="openBookingDrawer('Private Garden Botanical Bungalow', 'Rp 2.950.000')">
                                        Pesan Sekarang
                                    </button>
                                    <button
                                        class="py-2.5 px-4 bg-surface-container-low hover:bg-surface-container text-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-colors"
                                        onclick="showRoomModal('Private Garden Botanical Bungalow')">
                                        Detail Kamar
                                    </button>
                                </div>
                            </article>
                            <!-- CARD 3: Grand Sunset Horizon Suite -->
                            <article
                                class="room-card bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_12px_32px_-4px_rgba(27,42,50,0.05)] hover:shadow-[0_20px_48px_-6px_rgba(27,42,50,0.1)] transition-all flex flex-col justify-between"
                                data-capacity="2" data-category="penthouse" data-features="ocean,balcony,butler"
                                data-price="5200000">
                                <div class="flex flex-col">
                                    <!-- Room Image Container -->
                                    <div class="relative h-64 sm:h-72 w-full overflow-hidden bg-surface-container-high">
                                        <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                            data-alt="Romantic luxury suite terrace at dusk with a private balcony jacuzzi overlooking vibrant fiery ocean sunset at Haven Palais, soft candle lanterns, bespoke champagne set."
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCdYXU3hOnxzVVdTmyzjdk-6QmB4YkPpLpHu7Ov9-9v6RaaSPkbc_H_EDxJObDGtGGaz-bp5oIM5qB4ARk7kWZZTGwTKq_5u9ii6xeZrTkd0riLQBUquVrZC0fMRp3ZZcricRPSQ6cgVgx6mIGXwOg4SqXzI2ye67GmSM5aYthNQsPWfBT_Vv_3yi1tEB2jPjdwJvrVmsOtAtQBIEM7jsQTZ4FH5G0HlSAdB7J5t2M" />
                                        <div
                                            class="absolute top-4 left-4 bg-primary-container text-on-primary px-3 py-1 rounded font-label-uppercase text-[11px] tracking-wider shadow">
                                            Romantic Getaway
                                        </div>
                                        <div
                                            class="absolute bottom-3 right-3 bg-primary/80 backdrop-blur text-on-primary px-3 py-1 rounded-full font-label-uppercase text-[10px] flex items-center gap-1">
                                            <span
                                                class="material-symbols-outlined text-[14px] text-secondary-fixed">photo_camera</span>
                                            10 Foto
                                        </div>
                                    </div>
                                    <!-- Content Area -->
                                    <div class="p-6 flex flex-col gap-4">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <span
                                                    class="font-label-uppercase text-[11px] text-secondary tracking-widest block">Sunset
                                                    Wing • Level 3</span>
                                                <h3 class="font-headline-sm text-headline-sm text-primary">Grand Sunset
                                                    Horizon Suite</h3>
                                            </div>
                                            <div class="text-right">
                                                <span
                                                    class="font-title-editorial text-title-editorial text-primary font-bold">Rp
                                                    5.200.000</span>
                                                <span class="font-body-sm text-[12px] text-on-surface-variant block">/
                                                    malam</span>
                                            </div>
                                        </div>
                                        <!-- Quick Specs Pill Row -->
                                        <div
                                            class="flex flex-wrap items-center gap-3 py-2 text-on-surface-variant font-label-uppercase text-[11px] bg-surface-container-low px-3 py-2 rounded-lg">
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-primary">square_foot</span>
                                                260 m²</span>
                                            <span class="text-outline-variant">•</span>
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-primary">person</span>
                                                2 Tamu Dewasa</span>
                                            <span class="text-outline-variant">•</span>
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-primary">king_bed</span>
                                                1 Grand King</span>
                                            <span class="text-outline-variant">•</span>
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-secondary">wb_twilight</span>
                                                Sunset Sea View</span>
                                        </div>
                                        <!-- Amenities Bulletins -->
                                        <div
                                            class="flex flex-col gap-1.5 text-on-surface-variant font-body-sm text-body-sm">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[16px]">balcony</span>
                                                <span>Panoramic Infinity Balcony dengan Daybed Mewah</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[16px]">wine_bar</span>
                                                <span>Wine Chiller Pribadi &amp; Sunset Cocktail Lounge</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[16px]">bathtub</span>
                                                <span>Deep-soaking Spa Bath dengan Panorama Senja Samudra</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Footer Actions -->
                                <div class="p-6 pt-0 flex items-center gap-3">
                                    <button
                                        class="flex-1 py-2.5 px-4 bg-primary-container text-on-primary hover:bg-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-colors text-center shadow-sm"
                                        onclick="openBookingDrawer('Grand Sunset Horizon Suite', 'Rp 5.200.000')">
                                        Pesan Sekarang
                                    </button>
                                    <button
                                        class="py-2.5 px-4 bg-surface-container-low hover:bg-surface-container text-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-colors"
                                        onclick="showRoomModal('Grand Sunset Horizon Suite')">
                                        Detail Kamar
                                    </button>
                                </div>
                            </article>
                            <!-- CARD 4: Haven Presidential Two-Bedroom Estate -->
                            <article
                                class="room-card bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_12px_32px_-4px_rgba(27,42,50,0.05)] hover:shadow-[0_20px_48px_-6px_rgba(27,42,50,0.1)] transition-all flex flex-col justify-between"
                                data-capacity="6" data-category="presidential" data-features="pool,ocean,balcony,butler"
                                data-price="18000000">
                                <div class="flex flex-col">
                                    <!-- Room Image Container -->
                                    <div class="relative h-64 sm:h-72 w-full overflow-hidden bg-surface-container-high">
                                        <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                            data-alt="Immense Haven Presidential Estate compound featuring expansive private turquoise swimming pool, private pavilion, landscaped gardens leading to private beach cove, high ceiling architectural villa."
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxkDaLRkCChGXhPbOhEWAPPNIeXE62urG0TfN9sqY3MYrPNKnn9mUoxEJJdkJgghPyeEcIJ-B5f1WjpcJMC5_0PjIZKR3cQ_XCbNQ2z-uK7dThs9vVDkdwMmJbyj4-vCwyGo8QDXBqZMVxOpEYks7-WLylAhgdma4fiWZNnZ2F5pm3IsC-Cio83-vigPIsr4b9bls8J2of2C-oh0xTfBICY8QlupZAdwjVlOtZ5FU" />
                                        <div
                                            class="absolute top-4 left-4 bg-secondary text-on-secondary px-3 py-1 rounded font-label-uppercase text-[11px] tracking-wider shadow">
                                            Family Sanctuary
                                        </div>
                                        <div
                                            class="absolute bottom-3 right-3 bg-primary/80 backdrop-blur text-on-primary px-3 py-1 rounded-full font-label-uppercase text-[10px] flex items-center gap-1">
                                            <span
                                                class="material-symbols-outlined text-[14px] text-secondary-fixed">photo_camera</span>
                                            14 Foto
                                        </div>
                                    </div>
                                    <!-- Content Area -->
                                    <div class="p-6 flex flex-col gap-4">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <span
                                                    class="font-label-uppercase text-[11px] text-secondary tracking-widest block">Estate
                                                    Terbesar Resor</span>
                                                <h3 class="font-headline-sm text-headline-sm text-primary">Haven
                                                    Presidential Two-Bedroom Estate</h3>
                                            </div>
                                            <div class="text-right">
                                                <span
                                                    class="font-title-editorial text-title-editorial text-primary font-bold">Rp
                                                    18.000.000</span>
                                                <span class="font-body-sm text-[12px] text-on-surface-variant block">/
                                                    malam</span>
                                            </div>
                                        </div>
                                        <!-- Quick Specs Pill Row -->
                                        <div
                                            class="flex flex-wrap items-center gap-3 py-2 text-on-surface-variant font-label-uppercase text-[11px] bg-surface-container-low px-3 py-2 rounded-lg">
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-primary">square_foot</span>
                                                550 m²</span>
                                            <span class="text-outline-variant">•</span>
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-primary">groups</span>
                                                Hingga 6 Tamu</span>
                                            <span class="text-outline-variant">•</span>
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-primary">king_bed</span>
                                                2 King + 2 Single</span>
                                            <span class="text-outline-variant">•</span>
                                            <span class="flex items-center gap-1"><span
                                                    class="material-symbols-outlined text-[16px] text-secondary">water</span>
                                                Lagoon &amp; Ocean</span>
                                        </div>
                                        <!-- Amenities Bulletins -->
                                        <div
                                            class="flex flex-col gap-1.5 text-on-surface-variant font-body-sm text-body-sm">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[16px]">pool</span>
                                                <span>2 Kolam Renang Pribadi (Lagoon Pool &amp; Lap Pool)</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[16px]">skillet</span>
                                                <span>Dapur Gourmet Lengkap &amp; Private Chef on Demand</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-secondary text-[16px]">theater_comedy</span>
                                                <span>Private Screening Room / Bioskop &amp; 2 Butler Khusus</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Footer Actions -->
                                <div class="p-6 pt-0 flex items-center gap-3">
                                    <button
                                        class="flex-1 py-2.5 px-4 bg-primary-container text-on-primary hover:bg-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-colors text-center shadow-sm"
                                        onclick="openBookingDrawer('Haven Presidential Two-Bedroom Estate', 'Rp 18.000.000')">
                                        Pesan Sekarang
                                    </button>
                                    <button
                                        class="py-2.5 px-4 bg-surface-container-low hover:bg-surface-container text-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-colors"
                                        onclick="showRoomModal('Haven Presidential Two-Bedroom Estate')">
                                        Detail Kamar
                                    </button>
                                </div>
                            </article>
                        </div>
                    </div>
                </section>
                <!-- INCLUSIONS & HOSPITALITY PRIVILEGES SECTION -->
                <section class="w-full px-6 lg:px-16 py-16 bg-surface-container-low">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-12">
                        <!-- Section Intro -->
                        <div class="text-center max-w-2xl mx-auto flex flex-col items-center gap-3">
                            <span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Kenyamanan
                                Tak Tertandingi</span>
                            <h2 class="font-headline-md text-headline-md text-primary">Hak Istimewa di Setiap Hunian
                            </h2>
                            <p class="font-body-md text-body-md text-on-surface-variant">
                                Semua pemesanan kamar dan villa di Haven Palais secara otomatis menikmati fasilitas
                                standar berbintang lima berlian tanpa biaya tambahan.
                            </p>
                        </div>
                        <!-- 4 Privileges Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Privilege 1 -->
                            <div
                                class="p-6 bg-surface-container-lowest rounded-xl shadow-[0_12px_32px_-4px_rgba(27,42,50,0.04)] flex flex-col gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined text-[26px]">restaurant</span>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <h3 class="font-title-editorial text-title-editorial text-primary">Gastronomi À La
                                        Carte</h3>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                                        Sarapan gourmet harian disajikan tanpa batas waktu, baik di restoran tepi tebing
                                        maupun diantar langsung ke vila pribadi Anda.
                                    </p>
                                </div>
                            </div>
                            <!-- Privilege 2 -->
                            <div
                                class="p-6 bg-surface-container-lowest rounded-xl shadow-[0_12px_32px_-4px_rgba(27,42,50,0.04)] flex flex-col gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined text-[26px]">support_agent</span>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <h3 class="font-title-editorial text-title-editorial text-primary">Concierge
                                        Berstandar Global</h3>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                                        Asisten pribadi bersertifikasi Les Clefs d’Or siap mengurus itinerary pesiar
                                        kapal, reservasi helikopter, hingga kurasi kuliner privat.
                                    </p>
                                </div>
                            </div>
                            <!-- Privilege 3 -->
                            <div
                                class="p-6 bg-surface-container-lowest rounded-xl shadow-[0_12px_32px_-4px_rgba(27,42,50,0.04)] flex flex-col gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined text-[26px]">speaker</span>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <h3 class="font-title-editorial text-title-editorial text-primary">Teknologi Akustik
                                        Premium</h3>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                                        Setiap sudut ruang terintegrasi koneksi Wi-Fi 6 ultra-cepat serta sistem tata
                                        suara Bang &amp; Olufsen dengan kontrol sentuh cerdas.
                                    </p>
                                </div>
                            </div>
                            <!-- Privilege 4 -->
                            <div
                                class="p-6 bg-surface-container-lowest rounded-xl shadow-[0_12px_32px_-4px_rgba(27,42,50,0.04)] flex flex-col gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined text-[26px]">beach_access</span>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <h3 class="font-title-editorial text-title-editorial text-primary">Private Cove
                                        &amp; Beach Club</h3>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                                        Akses khusus tanpa antrean menuju teluk pantai pasir putih privat, fasilitas
                                        daybed eksklusif, serta infinity beach pool tepi laut.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- INTERACTIVE COMPARISON, POLICIES & CONCIERGE HOTLINE BANNER -->
                <section class="w-full px-6 lg:px-16 py-14 bg-surface">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-10">
                        <!-- Policies & Essential Notes Grid -->
                        <div
                            class="bg-surface-container-lowest rounded-2xl p-8 lg:p-10 shadow-[0_12px_32px_-4px_rgba(27,42,50,0.04)] grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-primary shrink-0">
                                    <span class="material-symbols-outlined text-[20px]">schedule</span>
                                </div>
                                <div>
                                    <span class="font-label-uppercase text-label-uppercase text-secondary">Jadwal
                                        Kedatangan</span>
                                    <h4 class="font-headline-sm text-[18px] text-primary mt-1 mb-1">Check-in &amp;
                                        Check-out</h4>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                                        Check-in pukul 15.00 WIB &amp; Check-out pukul 12.00 WIB. Nikmati layanan early
                                        check-in fleksibel berdasarkan ketersediaan vila.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-primary shrink-0">
                                    <span class="material-symbols-outlined text-[20px]">verified_user</span>
                                </div>
                                <div>
                                    <span class="font-label-uppercase text-label-uppercase text-secondary">Kebijakan
                                        Santai</span>
                                    <h4 class="font-headline-sm text-[18px] text-primary mt-1 mb-1">Pembatalan Fleksibel
                                    </h4>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                                        Pembatalan bebas biaya hingga 7 hari sebelum jadwal ketibaan. Penjadwalan ulang
                                        tanggal berlaku sepanjang 12 bulan penuh.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-primary shrink-0">
                                    <span class="material-symbols-outlined text-[20px]">helicopter</span>
                                </div>
                                <div>
                                    <span class="font-label-uppercase text-label-uppercase text-secondary">VIP
                                        Transfer</span>
                                    <h4 class="font-headline-sm text-[18px] text-primary mt-1 mb-1">Helipad &amp;
                                        Airport Escort</h4>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                                        Pendaratan helikopter pribadi langsung di tebing resor atau pengawalan limusin
                                        Mercedes-Benz Maybach dari Bandara Ngurah Rai.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Concierge Direct Helpline Banner -->
                        <div
                            class="bg-primary-container text-on-primary rounded-2xl p-8 lg:p-12 relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8 shadow-xl">
                            <div class="flex flex-col gap-3 max-w-xl z-10 text-center lg:text-left">
                                <div
                                    class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 rounded-full self-center lg:self-start">
                                    <span class="w-2 h-2 rounded-full bg-secondary-fixed animate-pulse"></span>
                                    <span
                                        class="font-label-uppercase text-[11px] text-secondary-fixed tracking-widest">Respon
                                        Langsung &lt; 3 Menit</span>
                                </div>
                                <h3 class="font-headline-md text-headline-md leading-snug">
                                    Membutuhkan Reservasi Khusus atau Rencana Spesial?
                                </h3>
                                <p class="font-body-md text-body-md text-on-primary-container">
                                    Tim VIP Concierge Haven Palais siap merancang pengalaman menginap sesuai preferensi
                                    personal Anda, mulai dari dekorasi bulan madu hingga sewa keseluruhan sayap vila.
                                </p>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center gap-4 z-10 w-full sm:w-auto">
                                <a class="w-full sm:w-auto px-6 py-3.5 bg-surface-container-lowest text-primary hover:bg-surface-container-high rounded font-label-uppercase text-label-uppercase tracking-widest transition-colors flex items-center justify-center gap-2 shadow-md"
                                    href="https://wa.me/628118800900" rel="noopener noreferrer" target="_blank">
                                    <span class="material-symbols-outlined text-[20px] text-secondary">chat</span>
                                    <span>WhatsApp Concierge</span>
                                </a>
                                <a class="w-full sm:w-auto px-6 py-3.5 bg-white/10 hover:bg-white/15 text-on-primary rounded font-label-uppercase text-label-uppercase tracking-widest transition-colors flex items-center justify-center gap-2"
                                    href="tel:+62218800900">
                                    <span class="material-symbols-outlined text-[20px]">phone_in_talk</span>
                                    <span>+62 (021) 8800 900</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- QUICK ROOM DETAIL MODAL (Hidden by Default) -->
                <div class="fixed inset-0 z-50 bg-primary/80 backdrop-blur-sm hidden items-center justify-center p-4"
                    id="room-detail-modal">
                    <div
                        class="bg-surface-container-lowest rounded-2xl max-w-2xl w-full max-h-[921px] overflow-y-auto shadow-2xl p-6 sm:p-8 flex flex-col gap-6 relative">
                        <button aria-label="Tutup Dialog"
                            class="absolute top-5 right-5 w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary hover:bg-surface-variant transition-colors"
                            onclick="closeRoomModal()">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </button>
                        <div>
                            <span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Detail
                                Akomodasi</span>
                            <h3 class="font-headline-md text-headline-md text-primary mt-1" id="modal-room-title">Nama
                                Kamar</h3>
                        </div>
                        <div class="h-64 rounded-xl overflow-hidden bg-surface-container-high">
                            <img class="w-full h-full object-cover"
                                data-alt="Refined architectural interior photo of Haven Palais luxury villa suite showcasing high-end furnishings and expansive terrace panorama."
                                id="modal-room-img"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD3k9R1e4s43r7qJD9akcQ6w69rZDF0tVRcQNgu0MV3i-WVIPHSKcboLKCK0kMCZF-nTzj5f2pxA-FyXR4ZabRepc_OSdeED9uV9UHwroymIx5CdYbX2EMb1pKveBshk0pXVSIER9DbDpgkkrN8_lWJJeWbEbqou4u3HH6bPZ1wMaFnvxPNUsR4nwA1CTMW2eJhZdp1RfZ3HRU1H2lfSpGOrt4NWX8TZl_-CPIqTGI" />
                        </div>
                        <div class="flex flex-col gap-4">
                            <h4 class="font-label-uppercase text-label-uppercase text-primary tracking-wider">
                                Keistimewaan &amp; Kenyamanan Termasuk:</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-body-sm text-on-surface-variant">
                                <div class="flex items-center gap-2 p-2 bg-surface-container-low rounded">
                                    <span class="material-symbols-outlined text-secondary text-[18px]">verified</span>
                                    <span>Check-in privat langsung di dalam villa</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-surface-container-low rounded">
                                    <span class="material-symbols-outlined text-secondary text-[18px]">verified</span>
                                    <span>Akses penuh Haven Sunset Beach Club</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-surface-container-low rounded">
                                    <span class="material-symbols-outlined text-secondary text-[18px]">verified</span>
                                    <span>Koleksi teh artisan &amp; biji kopi single origin</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-surface-container-low rounded">
                                    <span class="material-symbols-outlined text-secondary text-[18px]">verified</span>
                                    <span>Layanan perapian kasur malam (Turn-down service)</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-surface-container">
                            <button class="px-5 py-2.5 rounded text-primary font-label-uppercase text-label-uppercase"
                                onclick="closeRoomModal()">
                                Tutup
                            </button>
                            <button
                                class="px-6 py-2.5 bg-primary-container text-on-primary hover:bg-primary rounded font-label-uppercase text-label-uppercase tracking-wider"
                                onclick="proceedFromModal()">
                                Pesan Unit Ini
                            </button>
                        </div>
                    </div>
                </div>
                <!-- INTERACTIVE BOOKING DRAWER (Slide-over Right Panel) -->
                <div class="fixed inset-0 z-50 bg-primary/70 backdrop-blur-sm hidden justify-end transition-opacity duration-300"
                    id="booking-drawer">
                    <div
                        class="w-full max-w-md bg-surface-container-lowest h-full p-8 shadow-2xl flex flex-col justify-between overflow-y-auto">
                        <div class="flex flex-col gap-6">
                            <div class="flex items-center justify-between pb-4 border-b border-surface-container">
                                <div class="flex flex-col">
                                    <span
                                        class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Reservasi
                                        Cepat</span>
                                    <h3 class="font-headline-sm text-headline-sm text-primary">Konfirmasi Pemesanan</h3>
                                </div>
                                <button aria-label="Tutup Panel"
                                    class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary hover:bg-surface-variant transition-colors"
                                    onclick="closeBookingDrawer()">
                                    <span class="material-symbols-outlined text-[18px]">close</span>
                                </button>
                            </div>
                            <div class="p-4 bg-surface-container-low rounded-xl flex flex-col gap-1">
                                <span class="font-label-uppercase text-[11px] text-on-surface-variant">Pilihan
                                    Anda:</span>
                                <span class="font-headline-sm text-title-editorial text-primary font-bold"
                                    id="drawer-suite-name">Royal Ocean Penthouse</span>
                                <span class="font-body-sm text-body-sm text-secondary font-semibold"
                                    id="drawer-suite-price">Rp 12.500.000 / malam</span>
                            </div>
                            <form class="flex flex-col gap-4" onsubmit="handleReservationSubmit(event)">
                                <div class="flex flex-col gap-1.5">
                                    <label
                                        class="font-label-uppercase text-label-uppercase text-on-surface-variant">Tanggal
                                        Check-In &amp; Check-Out</label>
                                    <div class="grid grid-cols-2 gap-2">
                                        <input
                                            class="w-full bg-surface-container-low text-primary p-2.5 rounded font-body-sm text-body-sm focus:outline-none"
                                            required="" type="date" value="2025-05-10" />
                                        <input
                                            class="w-full bg-surface-container-low text-primary p-2.5 rounded font-body-sm text-body-sm focus:outline-none"
                                            required="" type="date" value="2025-05-14" />
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label
                                        class="font-label-uppercase text-label-uppercase text-on-surface-variant">Jumlah
                                        Tamu</label>
                                    <select
                                        class="w-full bg-surface-container-low text-primary p-2.5 rounded font-body-sm text-body-sm focus:outline-none">
                                        <option>2 Dewasa</option>
                                        <option>2 Dewasa, 1 Anak</option>
                                        <option>4 Dewasa</option>
                                        <option>6 Tamu (Keluarga)</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label
                                        class="font-label-uppercase text-label-uppercase text-on-surface-variant">Nama
                                        Lengkap Tamu</label>
                                    <input
                                        class="w-full bg-surface-container-low text-primary p-2.5 rounded font-body-sm text-body-sm focus:outline-none"
                                        placeholder="Contoh: Raden Surya" required="" type="text" />
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label
                                        class="font-label-uppercase text-label-uppercase text-on-surface-variant">Permintaan
                                        Khusus</label>
                                    <textarea
                                        class="w-full bg-surface-container-low text-primary p-2.5 rounded font-body-sm text-body-sm focus:outline-none"
                                        placeholder="Layanan penjemputan helipad, alergi diet, atau momen perayaan khusus..."
                                        rows="3"></textarea>
                                </div>
                                <button
                                    class="w-full mt-2 py-3 bg-primary-container text-on-primary hover:bg-primary rounded font-label-uppercase text-label-uppercase tracking-widest transition-colors flex items-center justify-center gap-2 shadow-sm"
                                    type="submit">
                                    <span class="material-symbols-outlined text-[18px]">verified</span>
                                    <span>Lanjutkan Pembayaran Aman</span>
                                </button>
                            </form>
                        </div>
                        <div
                            class="pt-6 text-center text-on-surface-variant font-body-sm text-[12px] flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[16px] text-secondary">lock</span>
                            <span>Jaminan Harga Terbaik &amp; Pembatalan Fleksibel</span>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // Filter Category Handler
                function setActiveCategory(btn, category) {
                    document.querySelectorAll('.category-btn').forEach(b => {
                        b.classList.remove('bg-primary-container', 'text-on-primary', 'shadow-sm');
                        b.classList.add('bg-surface-container-low', 'text-on-surface');
                    });
                    btn.classList.add('bg-primary-container', 'text-on-primary', 'shadow-sm');
                    btn.classList.remove('bg-surface-container-low', 'text-on-surface');

                    const cards = document.querySelectorAll('.room-card');
                    cards.forEach(card => {
                        if (category === 'all' || card.getAttribute('data-category') === category) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                }

                // Quick Filter Feature Chips
                let activeQuickFilters = new Set();
                function toggleQuickFilter(chip) {
                    const filter = chip.getAttribute('data-filter');
                    if (activeQuickFilters.has(filter)) {
                        activeQuickFilters.delete(filter);
                        chip.classList.remove('bg-primary', 'text-on-primary');
                        chip.classList.add('bg-surface-container-low', 'text-on-surface-variant');
                    } else {
                        activeQuickFilters.add(filter);
                        chip.classList.add('bg-primary', 'text-on-primary');
                        chip.classList.remove('bg-surface-container-low', 'text-on-surface-variant');
                    }

                    const cards = document.querySelectorAll('.room-card');
                    cards.forEach(card => {
                        if (activeQuickFilters.size === 0) {
                            card.style.display = 'flex';
                            return;
                        }
                        const features = (card.getAttribute('data-features') || '').split(',');
                        const matchesAll = Array.from(activeQuickFilters).every(f => features.includes(f));
                        card.style.display = matchesAll ? 'flex' : 'none';
                    });
                }

                // Card Sorting
                function sortCards(criteria) {
                    const container = document.getElementById('room-card-container');
                    const cards = Array.from(container.querySelectorAll('.room-card'));

                    cards.sort((a, b) => {
                        const priceA = parseInt(a.getAttribute('data-price') || '0', 10);
                        const priceB = parseInt(b.getAttribute('data-price') || '0', 10);
                        const capA = parseInt(a.getAttribute('data-capacity') || '0', 10);
                        const capB = parseInt(b.getAttribute('data-capacity') || '0', 10);

                        if (criteria === 'terendah') return priceA - priceB;
                        if (criteria === 'tertinggi') return priceB - priceA;
                        if (criteria === 'kapasitas') return capB - capA;
                        return 0; // rekomendasi default
                    });

                    cards.forEach(card => container.appendChild(card));
                }

                // Featured Photo Switcher
                function changeFeaturedPhoto(button, type) {
                    document.querySelectorAll('#featured-main-img').forEach(img => {
                        img.style.opacity = '0.5';
                        setTimeout(() => { img.style.opacity = '1'; }, 180);
                    });
                }

                // Room Modal Open / Close
                function showRoomModal(roomName) {
                    document.getElementById('modal-room-title').innerText = roomName;
                    const modal = document.getElementById('room-detail-modal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

                function closeRoomModal() {
                    const modal = document.getElementById('room-detail-modal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }

                function proceedFromModal() {
                    const name = document.getElementById('modal-room-title').innerText;
                    closeRoomModal();
                    openBookingDrawer(name, 'Rp 3.500.000 - Rp 18.000.000');
                }

                // Booking Drawer Slide
                function openBookingDrawer(suiteName, price) {
                    document.getElementById('drawer-suite-name').innerText = suiteName;
                    document.getElementById('drawer-suite-price').innerText = price + ' / malam';
                    const drawer = document.getElementById('booking-drawer');
                    drawer.classList.remove('hidden');
                    drawer.classList.add('flex');
                }

                function closeBookingDrawer() {
                    const drawer = document.getElementById('booking-drawer');
                    drawer.classList.add('hidden');
                    drawer.classList.remove('flex');
                }

                function handleReservationSubmit(e) {
                    e.preventDefault();
                    alert('Terima kasih. Permintaan reservasi Anda untuk ' + document.getElementById('drawer-suite-name').innerText + ' telah diterima. Tim Concierge Haven Palais akan segera menghubungi Anda.');
                    closeBookingDrawer();
                }
            </script>
        </main>
    </div>
</body>

</html>