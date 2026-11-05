<!DOCTYPE html>

<html lang="id">

@extends('user.layouts.app')

@section('title', 'List Kamar')

@section('content')

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
        <div class="hidden fixed inset-0 z-50 bg-primary/80 backdrop-blur-md flex transition-opacity duration-300"
            id="mobile-drawer-menu">
            <div
                class="w-80 max-w-[85vw] h-full bg-surface-container-low flex flex-col justify-between py-8 shadow-2xl relative overflow-y-auto">
                <div class="flex flex-col">
                    <div class="px-6 pb-6 flex items-center justify-between border-b border-outline-variant/30">
                        <div class="flex items-center gap-3"><img alt="Haven Palais Luxury Hotel Logo"
                                class="h-8 w-auto object-contain"
                                src="https://lh3.googleusercontent.com/aida/AEtjO1VmGhoXmWcVDhYNqJ8JHe8OU-qWjEpJ8Op2_G3-L-mFREQkQA99a5hQQNKi9lefS9pQmekQYnvgZADhK4SDT1ZzHMUHpaQsfhRokm-Eo_zvgj0NB2lHYRT8eIvrmQTHYHAI5KpHxbV3tZGYKHlcdSa6KEHY1Q9qP8aE5H7NfTLz7_oMTdODWycblfJO2cnkvDJzcxQCMAX5FtvrLoHcPjeW6i0wDoEWud30wh8Csj06" />
                            <div class="flex flex-col"><span
                                    class="font-headline-sm text-headline-sm text-primary tracking-tight leading-none">Haven
                                    Palais</span><span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest mt-1">Resort
                                    &amp; Spa</span></div>
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
                                class="material-symbols-outlined text-[20px]">king_bed</span>Kamar &amp; Suites</a><a
                            class="flex items-center gap-3.5 px-4 py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all"
                            data-path="fasilitas" href="/fasilitas"><span
                                class="material-symbols-outlined text-[20px]">pool</span>Fasilitas Resor</a><a
                            class="flex items-center gap-3.5 px-4 py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all"
                            data-path="booking" href="/reservasi"><span
                                class="material-symbols-outlined text-[20px]">calendar_month</span>Reservasi</a><a
                            class="flex items-center gap-3.5 px-4 py-3 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all"
                            data-path="ulasan" href="/ulasan"><span
                                class="material-symbols-outlined text-[20px]">star</span>Ulasan Tamu</a><a
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
                            href="tel:+62218800900">+62 (021) 8800 900</a>
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
        <main class="relative pt-20 bg-surface min-h-screen">
            <div class="flex flex-col w-full">
                <!-- Top Hero & Breadcrumb Section -->
                <section class="w-full bg-surface-container-low px-8 lg:px-16 pt-10 pb-16">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-6">
                        <!-- Breadcrumb -->
                        <nav aria-label="Breadcrumb"
                            class="flex items-center gap-2 font-label-uppercase text-label-uppercase text-on-surface-variant tracking-widest">
                            <a class="hover:text-primary transition-colors" href="#">Beranda</a>
                            <span class="text-outline-variant">/</span>
                            <a class="hover:text-primary transition-colors" href="#kamar-pilihan">Kamar &amp; Suites</a>
                            <span class="text-outline-variant">/</span>
                            <span class="text-secondary font-bold">Semua 42 Kamar &amp; Suite</span>
                        </nav>
                        <!-- Headline & Introduction -->
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end">
                            <div class="lg:col-span-8 flex flex-col gap-4">
                                <div
                                    class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-secondary-fixed/40 text-on-secondary-container w-fit">
                                    <span
                                        class="material-symbols-outlined text-[16px] text-secondary">hotel_class</span>
                                    <span class="font-label-uppercase text-label-uppercase">Katalog Resmi Resor
                                        Uluwatu</span>
                                </div>
                                <h1 class="font-headline-lg text-headline-lg text-primary tracking-tight">
                                    Koleksi Lengkap 42 Mahakarya Akomodasi Suaka Pesisir Uluwatu
                                </h1>
                            </div>
                            <div class="lg:col-span-4 flex flex-col justify-end">
                                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                    Setiap jengkal dari 42 suaka privat kami dirancang menyatu dengan desau Samudra
                                    Hindia dan kontur tebing kapur purba. Terbagi harmonis ke dalam empat arketipe
                                    kemewahan tanpa kompromi.
                                </p>
                            </div>
                        </div>
                        <!-- Category Quick Metrics Counter -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4">
                            <div
                                class="p-5 rounded-lg bg-surface-container-lowest shadow-sm flex flex-col justify-between">
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Kategori
                                    01</span>
                                <div class="mt-3 flex items-baseline justify-between">
                                    <span class="font-headline-sm text-headline-sm text-primary">Cliffside Ocean</span>
                                    <span class="font-title-editorial text-title-editorial text-secondary">14
                                        Villa</span>
                                </div>
                            </div>
                            <div
                                class="p-5 rounded-lg bg-surface-container-lowest shadow-sm flex flex-col justify-between">
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Kategori
                                    02</span>
                                <div class="mt-3 flex items-baseline justify-between">
                                    <span class="font-headline-sm text-headline-sm text-primary">Grand Horizon</span>
                                    <span class="font-title-editorial text-secondary">12 Suites</span>
                                </div>
                            </div>
                            <div
                                class="p-5 rounded-lg bg-surface-container-lowest shadow-sm flex flex-col justify-between">
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Kategori
                                    03</span>
                                <div class="mt-3 flex items-baseline justify-between">
                                    <span class="font-headline-sm text-headline-sm text-primary">Royal Sanctuary</span>
                                    <span class="font-title-editorial text-secondary">10 Pavilion</span>
                                </div>
                            </div>
                            <div
                                class="p-5 rounded-lg bg-surface-container-lowest shadow-sm flex flex-col justify-between">
                                <span
                                    class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Kategori
                                    04</span>
                                <div class="mt-3 flex items-baseline justify-between">
                                    <span class="font-headline-sm text-headline-sm text-primary">Presidential</span>
                                    <span class="font-title-editorial text-secondary">6 Units</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Interactive Search & Filtering Dock -->
                <section class="w-full px-8 lg:px-16 -mt-6 z-20">
                    <div
                        class="max-w-[1320px] mx-auto bg-surface-container-lowest rounded-xl shadow-xl p-6 lg:p-7 flex flex-col gap-6">
                        <!-- Search Field & Primary Filter Row -->
                        <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-4">
                            <!-- Search Input -->
                            <div
                                class="flex-1 relative flex items-center bg-surface-container-low rounded-lg px-4 py-3">
                                <span
                                    class="material-symbols-outlined text-[20px] text-on-surface-variant mr-3">search</span>
                                <input
                                    class="w-full bg-transparent text-primary placeholder:text-on-surface-variant/70 focus:outline-none font-body-sm text-body-sm"
                                    id="roomSearchInput"
                                    placeholder="Cari nama kamar, kategori, atau fasilitas (cth: Private Pool, Sunset View)..."
                                    type="text" />
                                <button class="text-on-surface-variant hover:text-primary hidden" id="clearSearchBtn"
                                    title="Hapus Pencarian">
                                    <span class="material-symbols-outlined text-[18px]">close</span>
                                </button>
                            </div>
                            <!-- Quick View Mode Toggle -->
                            <div
                                class="flex items-center gap-2 bg-surface-container-low p-1.5 rounded-lg self-end lg:self-auto">
                                <button
                                    class="px-3 py-1.5 rounded bg-surface-container-lowest text-primary shadow-sm flex items-center gap-1.5 font-label-uppercase text-label-uppercase"
                                    id="viewGridBtn" title="Tampilan Kisi">
                                    <span class="material-symbols-outlined text-[18px]">grid_view</span>
                                    <span class="hidden sm:inline">Kisi</span>
                                </button>
                                <button
                                    class="px-3 py-1.5 rounded text-on-surface-variant hover:text-primary flex items-center gap-1.5 font-label-uppercase text-label-uppercase"
                                    id="viewListBtn" title="Tampilan Daftar">
                                    <span class="material-symbols-outlined text-[18px]">view_list</span>
                                    <span class="hidden sm:inline">Daftar</span>
                                </button>
                            </div>
                        </div>
                        <!-- Categories Pills Bar -->
                        <div class="flex items-center gap-2.5 overflow-x-auto pb-1 text-nowrap scrollbar-none"
                            id="categoryPillContainer">
                            <button
                                class="category-pill active-pill px-5 py-2.5 rounded-full bg-primary-container text-on-primary font-label-uppercase text-label-uppercase transition-all flex items-center gap-2"
                                data-cat="all">
                                <span>Semua Kamar</span>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-surface/20 text-on-primary text-[10px]">42</span>
                            </button>
                            <button
                                class="category-pill px-5 py-2.5 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface-variant font-label-uppercase text-label-uppercase transition-all flex items-center gap-2"
                                data-cat="cliff">
                                <span>Cliffside Ocean Villa</span>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-surface-container-highest text-primary text-[10px]">14</span>
                            </button>
                            <button
                                class="category-pill px-5 py-2.5 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface-variant font-label-uppercase text-label-uppercase transition-all flex items-center gap-2"
                                data-cat="horizon">
                                <span>Grand Horizon Suite</span>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-surface-container-highest text-primary text-[10px]">12</span>
                            </button>
                            <button
                                class="category-pill px-5 py-2.5 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface-variant font-label-uppercase text-label-uppercase transition-all flex items-center gap-2"
                                data-cat="royal">
                                <span>Royal Sanctuary Pavilion</span>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-surface-container-highest text-primary text-[10px]">10</span>
                            </button>
                            <button
                                class="category-pill px-5 py-2.5 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface-variant font-label-uppercase text-label-uppercase transition-all flex items-center gap-2"
                                data-cat="presidential">
                                <span>Penthouse &amp; Presidential</span>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-surface-container-highest text-primary text-[10px]">6</span>
                            </button>
                        </div>
                        <!-- Advanced Filter Dropdowns & Sorter -->
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-3 bg-surface-container-low/50 p-4 rounded-lg">
                            <!-- Guest Capacity -->
                            <div class="flex flex-col gap-1.5">
                                <label
                                    class="font-label-uppercase text-label-uppercase text-on-surface-variant text-[11px]">Kapasitas
                                    Tamu</label>
                                <div class="relative">
                                    <select
                                        class="w-full bg-surface-container-lowest text-primary py-2.5 px-3.5 rounded-lg appearance-none font-body-sm text-body-sm focus:outline-none shadow-sm cursor-pointer"
                                        id="filterGuests">
                                        <option value="all">Semua Kapasitas Tamu</option>
                                        <option value="couple">1 - 2 Tamu (Romantic Retreat)</option>
                                        <option value="small">3 - 4 Tamu (Family Suites)</option>
                                        <option value="large">5+ Tamu (Sanctuary Manors)</option>
                                    </select>
                                    <span
                                        class="material-symbols-outlined absolute right-3 top-3 text-[18px] text-on-surface-variant pointer-events-none">expand_more</span>
                                </div>
                            </div>
                            <!-- Room View Orientation -->
                            <div class="flex flex-col gap-1.5">
                                <label
                                    class="font-label-uppercase text-label-uppercase text-on-surface-variant text-[11px]">Pemandangan
                                    Resor</label>
                                <div class="relative">
                                    <select
                                        class="w-full bg-surface-container-lowest text-primary py-2.5 px-3.5 rounded-lg appearance-none font-body-sm text-body-sm focus:outline-none shadow-sm cursor-pointer"
                                        id="filterView">
                                        <option value="all">Semua Pemandangan</option>
                                        <option value="ocean">Samudra Hindia 180°</option>
                                        <option value="cliff">Tebing Karang Dramatis</option>
                                        <option value="garden">Taman Tropis Sentosa</option>
                                    </select>
                                    <span
                                        class="material-symbols-outlined absolute right-3 top-3 text-[18px] text-on-surface-variant pointer-events-none">expand_more</span>
                                </div>
                            </div>
                            <!-- Signature Amenities -->
                            <div class="flex flex-col gap-1.5">
                                <label
                                    class="font-label-uppercase text-label-uppercase text-on-surface-variant text-[11px]">Fasilitas
                                    Utama</label>
                                <div class="relative">
                                    <select
                                        class="w-full bg-surface-container-lowest text-primary py-2.5 px-3.5 rounded-lg appearance-none font-body-sm text-body-sm focus:outline-none shadow-sm cursor-pointer"
                                        id="filterAmenity">
                                        <option value="all">Semua Fasilitas Khas</option>
                                        <option value="infinity-pool">Private Infinity Pool</option>
                                        <option value="jacuzzi">Outdoor Cliff Jacuzzi</option>
                                        <option value="butler">Layanan Butler 24 Jam</option>
                                        <option value="spa">Private Spa &amp; Steam Deck</option>
                                    </select>
                                    <span
                                        class="material-symbols-outlined absolute right-3 top-3 text-[18px] text-on-surface-variant pointer-events-none">expand_more</span>
                                </div>
                            </div>
                            <!-- Sorting Selector -->
                            <div class="flex flex-col gap-1.5">
                                <label
                                    class="font-label-uppercase text-label-uppercase text-on-surface-variant text-[11px]">Urutkan
                                    Berdasarkan</label>
                                <div class="relative">
                                    <select
                                        class="w-full bg-surface-container-lowest text-primary py-2.5 px-3.5 rounded-lg appearance-none font-body-sm text-body-sm focus:outline-none shadow-sm cursor-pointer"
                                        id="filterSort">
                                        <option value="price-desc">Harga Tertinggi</option>
                                        <option value="price-asc">Harga Terendah</option>
                                        <option value="rating">Popularitas &amp; Rating</option>
                                        <option value="size-desc">Luas Kamar Terbesar</option>
                                    </select>
                                    <span
                                        class="material-symbols-outlined absolute right-3 top-3 text-[18px] text-on-surface-variant pointer-events-none">swap_vert</span>
                                </div>
                            </div>
                        </div>
                        <!-- Status Bar and Comparison Triggers -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-2">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-secondary animate-pulse"></span>
                                <span class="font-label-md text-label-md text-on-surface" id="inventoryCounter">
                                    Menampilkan 9 dari 42 Kamar &amp; Suites Terdaftar
                                </span>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="hidden text-on-surface-variant font-label-md text-label-md"
                                    id="compareCounterBadge">
                                    <span class="text-secondary font-bold" id="compareCountNum">0</span> kamar dipilih
                                    untuk perbandingan
                                </span>
                                <button
                                    class="hidden px-4 py-1.5 rounded bg-secondary-fixed text-on-secondary-fixed font-label-uppercase text-label-uppercase hover:bg-secondary-fixed-dim transition-colors shadow-sm"
                                    id="openCompareDrawerBtn">
                                    Lihat Perbandingan
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Showcase Cards Grid -->
                <section class="w-full px-8 lg:px-16 py-12">
                    <div class="max-w-[1320px] mx-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="roomsGridContainer">
                            <!-- Room 1 -->
                            <article
                                class="room-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col"
                                data-category="cliff" data-guests="couple" data-price="18500000" data-size="280">
                                <div class="relative w-full h-72 overflow-hidden bg-surface-container">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Luxurious cliffside villa in Uluwatu Bali with a private infinity pool overlooking the deep turquoise Indian Ocean at golden hour, featuring sleek teak timber sun deck, minimalist daybeds, floor-to-ceiling glass sliding doors, and lush frangipani blossoms under radiant sunset sky."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDuLzkl8ivr2OEME8sK-Uex195_nrp87g1QR_bFKRVOE0SythPicxtcZHVCEsR4uYOmWKOqSt4Bx30Q1moz6YADYj06JHJiQOTyvTWBEggXb-KeCXzr2ZoZkBkhIDTwTG_H9MbD0gBQuC8eP080glhQc9h7-cLqkbrIQ_1yZuZ-pVzUDW_w6ibarBCSj7nCDFGEqfj4ibydfpAwEZ377fh5_mhNmmF9oPtk-UiL8mI" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                        <span
                                            class="px-3 py-1 rounded bg-secondary text-on-secondary font-label-uppercase text-[11px] tracking-wider shadow-sm">Terpopuler</span>
                                        <span
                                            class="px-3 py-1 rounded bg-surface/90 backdrop-blur text-primary font-label-uppercase text-[11px] tracking-wider shadow-sm">Cliff
                                            Access</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-on-primary">
                                        <span
                                            class="font-label-uppercase text-[11px] tracking-widest text-secondary-fixed">Kategori:
                                            Cliffside Ocean Villa</span>
                                        <div
                                            class="flex items-center gap-1 text-[13px] bg-primary/60 px-2 py-0.5 rounded backdrop-blur">
                                            <span
                                                class="material-symbols-outlined text-[15px] text-secondary">star</span>
                                            <span class="font-bold">4.98</span>
                                            <span class="text-on-primary-container text-[11px]">(142)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div class="flex flex-col gap-3">
                                        <div class="flex items-start justify-between gap-2">
                                            <h2
                                                class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors">
                                                The Oceanfront Cliffside Pool Villa
                                            </h2>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                                            Suaka privat bertengger di tepi tebing kapur dengan kolam renang tanpa batas
                                            pribadi, menawarkan panorama lepas Samudra Hindia dari atas tempat tidur.
                                        </p>
                                        <!-- Feature Badges -->
                                        <div
                                            class="grid grid-cols-2 gap-2 pt-2 pb-1 font-body-sm text-[13px] text-on-surface-variant">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">square_foot</span>
                                                <span>280 m² Area Luas</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">bed</span>
                                                <span>1 Ultra-King Bed</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">group</span>
                                                <span>2 Tamu Dewasa</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">pool</span>
                                                <span>Private Infinity Pool</span>
                                            </div>
                                        </div>
                                        <!-- Inclusions strip -->
                                        <div
                                            class="flex items-center gap-2 py-2 px-3 rounded bg-surface-container-low text-primary text-[12px] font-medium">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">room_service</span>
                                            <span>Termasuk Butler 24 Jam &amp; Sarapan Berdua</span>
                                        </div>
                                    </div>
                                    <!-- Price and Action CTA -->
                                    <div class="pt-6 mt-4 flex flex-col gap-4">
                                        <div class="flex items-baseline justify-between">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-uppercase text-[10px] text-on-surface-variant">Mulai
                                                    dari</span>
                                                <div class="flex items-baseline gap-1">
                                                    <span class="font-headline-sm text-headline-sm text-primary">Rp
                                                        18.500.000</span>
                                                    <span class="text-on-surface-variant text-[12px]">/ malam</span>
                                                </div>
                                            </div>
                                            <label
                                                class="flex items-center gap-1.5 cursor-pointer text-on-surface-variant hover:text-primary">
                                                <input class="room-compare-chk accent-secondary rounded"
                                                    data-room-name="The Oceanfront Cliffside Pool Villa"
                                                    type="checkbox" />
                                                <span class="font-label-uppercase text-[11px]">Bandingkan</span>
                                            </label>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button
                                                class="px-4 py-2.5 rounded bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                                Detail Kamar
                                            </button>
                                            <button
                                                class="px-4 py-2.5 rounded bg-primary-container text-on-primary hover:bg-primary font-label-uppercase text-label-uppercase transition-colors shadow-sm flex items-center justify-center gap-1">
                                                <span>Reservasi</span>
                                                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!-- Room 2 -->
                            <article
                                class="room-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col"
                                data-category="horizon" data-guests="couple" data-price="12800000" data-size="160">
                                <div class="relative w-full h-72 overflow-hidden bg-surface-container">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Expansive luxury bedroom suite interior opening to a huge panoramic balcony with plush daybeds, modern wooden ceiling beams, open-concept marble bathtub, and dramatic 180 degree ocean horizon at dusk with warm golden lighting."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAw1yFy8Lka0XWnC3wYUjrAFZSppKUYjV4H--YANpxXNN5N1QQZVbOcXMLYsS5Dm11MJpT0jzHe_i4R5JA1xggj7cyVbjJKW2uzC_oFxXJVUVNfAbY3WCDK5fo439C4vwwsSi2vNKUXt6ipM_abTWPvVv5GIYUM5BdKAwCPXWPsoq3xC0a1Ndob9clBujXI33USLUmUsGXjkEc3unoZx8Fh8YZc34STbMxYSWpo5s4" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                        <span
                                            class="px-3 py-1 rounded bg-surface-container-highest text-primary font-label-uppercase text-[11px] tracking-wider shadow-sm">Best
                                            Sunset View</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-on-primary">
                                        <span
                                            class="font-label-uppercase text-[11px] tracking-widest text-secondary-fixed">Kategori:
                                            Grand Horizon Suite</span>
                                        <div
                                            class="flex items-center gap-1 text-[13px] bg-primary/60 px-2 py-0.5 rounded backdrop-blur">
                                            <span
                                                class="material-symbols-outlined text-[15px] text-secondary">star</span>
                                            <span class="font-bold">4.96</span>
                                            <span class="text-on-primary-container text-[11px]">(98)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div class="flex flex-col gap-3">
                                        <div class="flex items-start justify-between gap-2">
                                            <h2
                                                class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors">
                                                Grand Horizon Sunset Suite
                                            </h2>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                                            Dirancang khusus untuk pemburu matahari terbenam spektakuler dengan balkon
                                            teras luas, daybed luar ruangan, dan bathtub rendam marmer Carrara.
                                        </p>
                                        <!-- Feature Badges -->
                                        <div
                                            class="grid grid-cols-2 gap-2 pt-2 pb-1 font-body-sm text-[13px] text-on-surface-variant">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">square_foot</span>
                                                <span>160 m² Area Luas</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">bed</span>
                                                <span>1 Super King Bed</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">group</span>
                                                <span>2 Tamu Dewasa</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">deck</span>
                                                <span>180° Sunset Balcony</span>
                                            </div>
                                        </div>
                                        <!-- Inclusions strip -->
                                        <div
                                            class="flex items-center gap-2 py-2 px-3 rounded bg-surface-container-low text-primary text-[12px] font-medium">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">redeem</span>
                                            <span>Complimentary Sunset Canapés &amp; Wine</span>
                                        </div>
                                    </div>
                                    <!-- Price and Action CTA -->
                                    <div class="pt-6 mt-4 flex flex-col gap-4">
                                        <div class="flex items-baseline justify-between">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-uppercase text-[10px] text-on-surface-variant">Mulai
                                                    dari</span>
                                                <div class="flex items-baseline gap-1">
                                                    <span class="font-headline-sm text-headline-sm text-primary">Rp
                                                        12.800.000</span>
                                                    <span class="text-on-surface-variant text-[12px]">/ malam</span>
                                                </div>
                                            </div>
                                            <label
                                                class="flex items-center gap-1.5 cursor-pointer text-on-surface-variant hover:text-primary">
                                                <input class="room-compare-chk accent-secondary rounded"
                                                    data-room-name="Grand Horizon Sunset Suite" type="checkbox" />
                                                <span class="font-label-uppercase text-[11px]">Bandingkan</span>
                                            </label>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button
                                                class="px-4 py-2.5 rounded bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                                Detail Kamar
                                            </button>
                                            <button
                                                class="px-4 py-2.5 rounded bg-primary-container text-on-primary hover:bg-primary font-label-uppercase text-label-uppercase transition-colors shadow-sm flex items-center justify-center gap-1">
                                                <span>Reservasi</span>
                                                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!-- Room 3 -->
                            <article
                                class="room-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col"
                                data-category="royal" data-guests="small" data-price="32000000" data-size="450">
                                <div class="relative w-full h-72 overflow-hidden bg-surface-container">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Grand two bedroom sanctuary villa with private tropical grass lawn, oversized turquoise stone lap pool, traditional Balinese wooden thatched gazebo bale, overlooking sheer ocean cliffs under pristine daylight."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBh7hIU8yN9Jk99U-71pKYK9zZ8C0lFcB15uPcBd4s9kwO96AHzbgbCsTpDYvCGBag7wL3BGFG09cUhpvryAeC-y_Xcw0SsZQlPXXnxQAl51LY21aZsCNS28g8iBegtgqBKFL6a7McCbQMGKCHLjc7qboaRv8XM3L4E5c0gYo-jhNsP9dDt3QHoT_MffjmGsBTo70qwBbTlkBLvXedf4OElG56A6CIfaSEo-4vJx80" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                        <span
                                            class="px-3 py-1 rounded bg-secondary-container text-on-secondary-container font-label-uppercase text-[11px] tracking-wider shadow-sm">Signature
                                            Suite</span>
                                        <span
                                            class="px-3 py-1 rounded bg-surface/90 backdrop-blur text-primary font-label-uppercase text-[11px] tracking-wider shadow-sm">Spa
                                            Pavilion</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-on-primary">
                                        <span
                                            class="font-label-uppercase text-[11px] tracking-widest text-secondary-fixed">Kategori:
                                            Royal Sanctuary Pavilion</span>
                                        <div
                                            class="flex items-center gap-1 text-[13px] bg-primary/60 px-2 py-0.5 rounded backdrop-blur">
                                            <span
                                                class="material-symbols-outlined text-[15px] text-secondary">star</span>
                                            <span class="font-bold">5.0</span>
                                            <span class="text-on-primary-container text-[11px]">(64)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div class="flex flex-col gap-3">
                                        <div class="flex items-start justify-between gap-2">
                                            <h2
                                                class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors">
                                                Two-Bedroom Royal Sanctuary Cliff Villa
                                            </h2>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                                            Vila megah dua paviliun mandiri yang dihubungkan taman privat asri, paviliun
                                            spa outdoor, serta pelayan butler pribadi berpengalaman.
                                        </p>
                                        <!-- Feature Badges -->
                                        <div
                                            class="grid grid-cols-2 gap-2 pt-2 pb-1 font-body-sm text-[13px] text-on-surface-variant">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">square_foot</span>
                                                <span>450 m² Area Luas</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">bed</span>
                                                <span>2 Master King Beds</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">group</span>
                                                <span>4 - 5 Tamu</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">spa</span>
                                                <span>Private Spa Pavilion</span>
                                            </div>
                                        </div>
                                        <!-- Inclusions strip -->
                                        <div
                                            class="flex items-center gap-2 py-2 px-3 rounded bg-surface-container-low text-primary text-[12px] font-medium">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">concierge</span>
                                            <span>Dedicated Les Clefs d'Or Butler 24 Jam</span>
                                        </div>
                                    </div>
                                    <!-- Price and Action CTA -->
                                    <div class="pt-6 mt-4 flex flex-col gap-4">
                                        <div class="flex items-baseline justify-between">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-uppercase text-[10px] text-on-surface-variant">Mulai
                                                    dari</span>
                                                <div class="flex items-baseline gap-1">
                                                    <span class="font-headline-sm text-headline-sm text-primary">Rp
                                                        32.000.000</span>
                                                    <span class="text-on-surface-variant text-[12px]">/ malam</span>
                                                </div>
                                            </div>
                                            <label
                                                class="flex items-center gap-1.5 cursor-pointer text-on-surface-variant hover:text-primary">
                                                <input class="room-compare-chk accent-secondary rounded"
                                                    data-room-name="Two-Bedroom Royal Sanctuary Cliff Villa"
                                                    type="checkbox" />
                                                <span class="font-label-uppercase text-[11px]">Bandingkan</span>
                                            </label>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button
                                                class="px-4 py-2.5 rounded bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                                Detail Kamar
                                            </button>
                                            <button
                                                class="px-4 py-2.5 rounded bg-primary-container text-on-primary hover:bg-primary font-label-uppercase text-label-uppercase transition-colors shadow-sm flex items-center justify-center gap-1">
                                                <span>Reservasi</span>
                                                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!-- Room 4 -->
                            <article
                                class="room-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col"
                                data-category="presidential" data-guests="large" data-price="65000000" data-size="680">
                                <div class="relative w-full h-72 overflow-hidden bg-surface-container">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Ultra-luxury clifftop penthouse presidential suite with massive living dining room, floor-to-ceiling glass panoramic sea views, private cantilevered pool extending beyond cliff edge, bespoke custom teak furniture, and contemporary bronze sculptures."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7T9GjbnqqSghrVo70RXgvTQPkNc8iRMSlF_RqgPSh05ZriuL0WD9T8JnpU73wtapWFs2JNcb1qs_UTuLG5xd3FWqngYRfCzafPWnLEFqh-X2ruYQjjGoEw5t0dF3u4-IAZ2LsAjfOezRC54hayDqgnTll4lwiudUl27f9da9lVMzkodldJUvtmg-ckif28KsYWxfoowGxrneYjzqkqGsfZXNE7dvrRch2_tays5M" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                        <span
                                            class="px-3 py-1 rounded bg-primary text-on-primary font-label-uppercase text-[11px] tracking-wider shadow-sm">Flagship
                                            Penthouse</span>
                                        <span
                                            class="px-3 py-1 rounded bg-secondary text-on-secondary font-label-uppercase text-[11px] tracking-wider shadow-sm">Wine
                                            Cellar</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-on-primary">
                                        <span
                                            class="font-label-uppercase text-[11px] tracking-widest text-secondary-fixed">Kategori:
                                            Presidential Sanctuary</span>
                                        <div
                                            class="flex items-center gap-1 text-[13px] bg-primary/60 px-2 py-0.5 rounded backdrop-blur">
                                            <span
                                                class="material-symbols-outlined text-[15px] text-secondary">star</span>
                                            <span class="font-bold">5.0</span>
                                            <span class="text-on-primary-container text-[11px]">(39)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div class="flex flex-col gap-3">
                                        <div class="flex items-start justify-between gap-2">
                                            <h2
                                                class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors">
                                                The Uluwatu Presidential Cliff Penthouse
                                            </h2>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                                            Puncak kemewahan kepulauan tropis dengan 3 kamar utama independen, teras
                                            gantung di atas samudra, private cellar anggur, serta chef privat berstandar
                                            bintang Michelin.
                                        </p>
                                        <!-- Feature Badges -->
                                        <div
                                            class="grid grid-cols-2 gap-2 pt-2 pb-1 font-body-sm text-[13px] text-on-surface-variant">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">square_foot</span>
                                                <span>680 m² Mahakarya</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">bed</span>
                                                <span>3 Master Suites</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">group</span>
                                                <span>Hingga 6 Tamu</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">wine_bar</span>
                                                <span>Private Sommelier</span>
                                            </div>
                                        </div>
                                        <!-- Inclusions strip -->
                                        <div
                                            class="flex items-center gap-2 py-2 px-3 rounded bg-surface-container-low text-primary text-[12px] font-medium">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">airport_shuttle</span>
                                            <span>VIP Airport Limousine &amp; Fast-Track Immigration</span>
                                        </div>
                                    </div>
                                    <!-- Price and Action CTA -->
                                    <div class="pt-6 mt-4 flex flex-col gap-4">
                                        <div class="flex items-baseline justify-between">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-uppercase text-[10px] text-on-surface-variant">Mulai
                                                    dari</span>
                                                <div class="flex items-baseline gap-1">
                                                    <span class="font-headline-sm text-headline-sm text-primary">Rp
                                                        65.000.000</span>
                                                    <span class="text-on-surface-variant text-[12px]">/ malam</span>
                                                </div>
                                            </div>
                                            <label
                                                class="flex items-center gap-1.5 cursor-pointer text-on-surface-variant hover:text-primary">
                                                <input class="room-compare-chk accent-secondary rounded"
                                                    data-room-name="The Uluwatu Presidential Cliff Penthouse"
                                                    type="checkbox" />
                                                <span class="font-label-uppercase text-[11px]">Bandingkan</span>
                                            </label>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button
                                                class="px-4 py-2.5 rounded bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                                Detail Kamar
                                            </button>
                                            <button
                                                class="px-4 py-2.5 rounded bg-primary-container text-on-primary hover:bg-primary font-label-uppercase text-label-uppercase transition-colors shadow-sm flex items-center justify-center gap-1">
                                                <span>Reservasi</span>
                                                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!-- Room 5 -->
                            <article
                                class="room-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col"
                                data-category="horizon" data-guests="couple" data-price="9500000" data-size="140">
                                <div class="relative w-full h-72 overflow-hidden bg-surface-container">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Open-air coastal luxury suite with linen draped king bed, ocean breeze whispering through soft white curtains, sunken stone terrazzo soaking tub overlooking ocean waves crashing against southern Bali cliffs."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBvzS8MHzMo7uLtHUO9icOInOxwLG0750H2tYtmF6h5Muc1---G3Ey0HFME2H_yQ9FxC-OKbt_56clbNFC5sU81mHWe1KDy2seT2WmeNvVKgbKlZGadMVGPrQEbg59Q1AsK9riiuJMq4BgggfYPLGFRkSkAx9LY9__vJ0x0fk6Z4I8Bj339e3pHfC8CmJZeSjd_xvxjTnJKeouWn0_eHlOCK3GChNwhFgoUKIb7Lks" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                        <span
                                            class="px-3 py-1 rounded bg-surface/90 backdrop-blur text-primary font-label-uppercase text-[11px] tracking-wider shadow-sm">Sunken
                                            Bathtub</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-on-primary">
                                        <span
                                            class="font-label-uppercase text-[11px] tracking-widest text-secondary-fixed">Kategori:
                                            Grand Horizon Suite</span>
                                        <div
                                            class="flex items-center gap-1 text-[13px] bg-primary/60 px-2 py-0.5 rounded backdrop-blur">
                                            <span
                                                class="material-symbols-outlined text-[15px] text-secondary">star</span>
                                            <span class="font-bold">4.92</span>
                                            <span class="text-on-primary-container text-[11px]">(88)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div class="flex flex-col gap-3">
                                        <div class="flex items-start justify-between gap-2">
                                            <h2
                                                class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors">
                                                Azure Ocean Breeze Pavilion
                                            </h2>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                                            Ruang terbuka luas dengan aliran udara laut segar tak terhalang, bak rendam
                                            terrazzo tenggelam dengan pemandangan cakrawala birunya Samudra Hindia.
                                        </p>
                                        <!-- Feature Badges -->
                                        <div
                                            class="grid grid-cols-2 gap-2 pt-2 pb-1 font-body-sm text-[13px] text-on-surface-variant">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">square_foot</span>
                                                <span>140 m² Area Luas</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">bed</span>
                                                <span>1 King Bed</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">group</span>
                                                <span>2 Tamu Dewasa</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">bathtub</span>
                                                <span>Panoramic Sunken Tub</span>
                                            </div>
                                        </div>
                                        <!-- Inclusions strip -->
                                        <div
                                            class="flex items-center gap-2 py-2 px-3 rounded bg-surface-container-low text-primary text-[12px] font-medium">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">bakery_dining</span>
                                            <span>Artisan Breakfast &amp; Afternoon Tea Daily</span>
                                        </div>
                                    </div>
                                    <!-- Price and Action CTA -->
                                    <div class="pt-6 mt-4 flex flex-col gap-4">
                                        <div class="flex items-baseline justify-between">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-uppercase text-[10px] text-on-surface-variant">Mulai
                                                    dari</span>
                                                <div class="flex items-baseline gap-1">
                                                    <span class="font-headline-sm text-headline-sm text-primary">Rp
                                                        9.500.000</span>
                                                    <span class="text-on-surface-variant text-[12px]">/ malam</span>
                                                </div>
                                            </div>
                                            <label
                                                class="flex items-center gap-1.5 cursor-pointer text-on-surface-variant hover:text-primary">
                                                <input class="room-compare-chk accent-secondary rounded"
                                                    data-room-name="Azure Ocean Breeze Pavilion" type="checkbox" />
                                                <span class="font-label-uppercase text-[11px]">Bandingkan</span>
                                            </label>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button
                                                class="px-4 py-2.5 rounded bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                                Detail Kamar
                                            </button>
                                            <button
                                                class="px-4 py-2.5 rounded bg-primary-container text-on-primary hover:bg-primary font-label-uppercase text-label-uppercase transition-colors shadow-sm flex items-center justify-center gap-1">
                                                <span>Reservasi</span>
                                                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!-- Room 6 -->
                            <article
                                class="room-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col"
                                data-category="royal" data-guests="couple" data-price="7200000" data-size="125">
                                <div class="relative w-full h-72 overflow-hidden bg-surface-container">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Intimate tropical garden suite nestled within lush sanctuary foliage, private lotus pond, peaceful carved stone Balinese pavilion bale bengong with relaxing floor cushions, warm evening lantern lighting."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCgTdF_byDkuvp0rSTOtCDnvf2GGMbOWHhE3tt82hsKAXPvrgTRzy1UG9o8eNP-4px9gt3Y1xzeqI__nid74DcbcCz_hR1tzvrGcuaY7NJoagE_-HEDFjXo6iuKy3Z8UwQVRvhS-Kle0eTkDECmi5YvF3naEGoqLOPhGYulbmA6JlvMjtMaxCBHoPwd6RY_-o8YFPTN1zV6A0sfcUH8StyhJvzZABiqmEYCF7qfLcI" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                        <span
                                            class="px-3 py-1 rounded bg-surface/90 backdrop-blur text-primary font-label-uppercase text-[11px] tracking-wider shadow-sm">Bale
                                            Bengong</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-on-primary">
                                        <span
                                            class="font-label-uppercase text-[11px] tracking-widest text-secondary-fixed">Kategori:
                                            Royal Sanctuary Pavilion</span>
                                        <div
                                            class="flex items-center gap-1 text-[13px] bg-primary/60 px-2 py-0.5 rounded backdrop-blur">
                                            <span
                                                class="material-symbols-outlined text-[15px] text-secondary">star</span>
                                            <span class="font-bold">4.95</span>
                                            <span class="text-on-primary-container text-[11px]">(112)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div class="flex flex-col gap-3">
                                        <div class="flex items-start justify-between gap-2">
                                            <h2
                                                class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors">
                                                Haven Heritage Garden Suite
                                            </h2>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                                            Ketenangan absolut di tengah rimbunnya flora tropis asli Bali, kolam teratai
                                            privat, serta Bale Bengong terbuka untuk meditasi pagi atau sesi membaca
                                            hening.
                                        </p>
                                        <!-- Feature Badges -->
                                        <div
                                            class="grid grid-cols-2 gap-2 pt-2 pb-1 font-body-sm text-[13px] text-on-surface-variant">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">square_foot</span>
                                                <span>125 m² Area Luas</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">bed</span>
                                                <span>1 King Four-Poster</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">group</span>
                                                <span>2 Tamu Dewasa</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">potted_plant</span>
                                                <span>Taman &amp; Teratai Alami</span>
                                            </div>
                                        </div>
                                        <!-- Inclusions strip -->
                                        <div
                                            class="flex items-center gap-2 py-2 px-3 rounded bg-surface-container-low text-primary text-[12px] font-medium">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">self_improvement</span>
                                            <span>Termasuk Sesi Yoga Privat 60 Menit</span>
                                        </div>
                                    </div>
                                    <!-- Price and Action CTA -->
                                    <div class="pt-6 mt-4 flex flex-col gap-4">
                                        <div class="flex items-baseline justify-between">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-uppercase text-[10px] text-on-surface-variant">Mulai
                                                    dari</span>
                                                <div class="flex items-baseline gap-1">
                                                    <span class="font-headline-sm text-headline-sm text-primary">Rp
                                                        7.200.000</span>
                                                    <span class="text-on-surface-variant text-[12px]">/ malam</span>
                                                </div>
                                            </div>
                                            <label
                                                class="flex items-center gap-1.5 cursor-pointer text-on-surface-variant hover:text-primary">
                                                <input class="room-compare-chk accent-secondary rounded"
                                                    data-room-name="Haven Heritage Garden Suite" type="checkbox" />
                                                <span class="font-label-uppercase text-[11px]">Bandingkan</span>
                                            </label>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button
                                                class="px-4 py-2.5 rounded bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                                Detail Kamar
                                            </button>
                                            <button
                                                class="px-4 py-2.5 rounded bg-primary-container text-on-primary hover:bg-primary font-label-uppercase text-label-uppercase transition-colors shadow-sm flex items-center justify-center gap-1">
                                                <span>Reservasi</span>
                                                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!-- Room 7 -->
                            <article
                                class="room-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col"
                                data-category="cliff" data-guests="couple" data-price="22000000" data-size="210">
                                <div class="relative w-full h-72 overflow-hidden bg-surface-container">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Romantic clifftop honeymoon suite with heated cantilevered stone jacuzzi suspended over ocean abyss, bottle of chilled champagne in ice bucket, rose petals on wooden deck, twilight purple sunset sky."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBEBqr-P22N_LEtvuOqbBmq4DbtrcY5ontfRvyDV17U6DV9Nkfi86ZUsI96aVAvuj_yBUh4EmaGFpgyJPw5GHD2lA-6sJbo3VtewQ1-DY_wuPy-zighSGIDueAl7mz4bW4v1eOHUDd3eQQ-50Nv0Gh8I1A9rBNMY_0r1J1iTMphx9tiadJet3OkIAEyLANvL64Ao-F7PdPyQDu3W-gjey20itNHbSK6eORe7F-JMK4" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                        <span
                                            class="px-3 py-1 rounded bg-secondary text-on-secondary font-label-uppercase text-[11px] tracking-wider shadow-sm">Honeymoon
                                            Choice</span>
                                        <span
                                            class="px-3 py-1 rounded bg-surface/90 backdrop-blur text-primary font-label-uppercase text-[11px] tracking-wider shadow-sm">Cantilevered
                                            Jacuzzi</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-on-primary">
                                        <span
                                            class="font-label-uppercase text-[11px] tracking-widest text-secondary-fixed">Kategori:
                                            Cliffside Ocean Villa</span>
                                        <div
                                            class="flex items-center gap-1 text-[13px] bg-primary/60 px-2 py-0.5 rounded backdrop-blur">
                                            <span
                                                class="material-symbols-outlined text-[15px] text-secondary">star</span>
                                            <span class="font-bold">4.99</span>
                                            <span class="text-on-primary-container text-[11px]">(156)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div class="flex flex-col gap-3">
                                        <div class="flex items-start justify-between gap-2">
                                            <h2
                                                class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors">
                                                Cliff Edge Honeymoon Sanctuary
                                            </h2>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                                            Didesain eksklusif untuk perayaan cinta dengan hot tub gantung di atas
                                            jurang samudra, pancuran outdoor marmer, serta privasi mutlak tak
                                            tertandingi.
                                        </p>
                                        <!-- Feature Badges -->
                                        <div
                                            class="grid grid-cols-2 gap-2 pt-2 pb-1 font-body-sm text-[13px] text-on-surface-variant">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">square_foot</span>
                                                <span>210 m² Area Luas</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">bed</span>
                                                <span>1 Custom King Bed</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">group</span>
                                                <span>2 Tamu (Khusus Pasangan)</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">hot_tub</span>
                                                <span>Suspended Clifftop Tub</span>
                                            </div>
                                        </div>
                                        <!-- Inclusions strip -->
                                        <div
                                            class="flex items-center gap-2 py-2 px-3 rounded bg-surface-container-low text-primary text-[12px] font-medium">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">celebration</span>
                                            <span>Termasuk Romantic Candlelight Dinner di Tebing</span>
                                        </div>
                                    </div>
                                    <!-- Price and Action CTA -->
                                    <div class="pt-6 mt-4 flex flex-col gap-4">
                                        <div class="flex items-baseline justify-between">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-uppercase text-[10px] text-on-surface-variant">Mulai
                                                    dari</span>
                                                <div class="flex items-baseline gap-1">
                                                    <span class="font-headline-sm text-headline-sm text-primary">Rp
                                                        22.000.000</span>
                                                    <span class="text-on-surface-variant text-[12px]">/ malam</span>
                                                </div>
                                            </div>
                                            <label
                                                class="flex items-center gap-1.5 cursor-pointer text-on-surface-variant hover:text-primary">
                                                <input class="room-compare-chk accent-secondary rounded"
                                                    data-room-name="Cliff Edge Honeymoon Sanctuary" type="checkbox" />
                                                <span class="font-label-uppercase text-[11px]">Bandingkan</span>
                                            </label>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button
                                                class="px-4 py-2.5 rounded bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                                Detail Kamar
                                            </button>
                                            <button
                                                class="px-4 py-2.5 rounded bg-primary-container text-on-primary hover:bg-primary font-label-uppercase text-label-uppercase transition-colors shadow-sm flex items-center justify-center gap-1">
                                                <span>Reservasi</span>
                                                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!-- Room 8 -->
                            <article
                                class="room-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col"
                                data-category="presidential" data-guests="large" data-price="48000000" data-size="750">
                                <div class="relative w-full h-72 overflow-hidden bg-surface-container">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Massive three-bedroom family estate villa with vast 20-meter infinity lap pool overlooking Uluwatu ocean, open-air gourmet chef kitchen with marble island, children lounge wing, framed by natural stone walls."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCK3Z3MJWrvGS-Wmg-LdENjgG2ll7uQR1nwTvY98Us-U-9jlRma9kCFTH1ad5pVx0W2dKX9uLINizcZqXzfspNFYNuM5Bj120-RX5jegDIHHk02wo0Lhn2MhSH9elkUAMDLKehZPzylOARhCCuN7EDGTRqInv-Wte-0w6pcjCDugBvFQqn0YyQHfr8lz15nDcKZ2MQKT3L7yN-W8Q_CoX2xor35n3gKwrLNBflhhGI" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                        <span
                                            class="px-3 py-1 rounded bg-secondary-fixed/50 text-on-secondary-fixed font-label-uppercase text-[11px] tracking-wider shadow-sm">Family
                                            Manor</span>
                                        <span
                                            class="px-3 py-1 rounded bg-surface/90 backdrop-blur text-primary font-label-uppercase text-[11px] tracking-wider shadow-sm">Private
                                            Chef Kitchen</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-on-primary">
                                        <span
                                            class="font-label-uppercase text-[11px] tracking-widest text-secondary-fixed">Kategori:
                                            Presidential Sanctuary</span>
                                        <div
                                            class="flex items-center gap-1 text-[13px] bg-primary/60 px-2 py-0.5 rounded backdrop-blur">
                                            <span
                                                class="material-symbols-outlined text-[15px] text-secondary">star</span>
                                            <span class="font-bold">4.97</span>
                                            <span class="text-on-primary-container text-[11px]">(48)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div class="flex flex-col gap-3">
                                        <div class="flex items-start justify-between gap-2">
                                            <h2
                                                class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors">
                                                Three-Bedroom Haven Family Manor
                                            </h2>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                                            Akomodasi keluarga multi-generasi terlengkap di Uluwatu. Dilengkapi kolam
                                            renang lap 20 meter, dapur chef privat, dan ruang keluarga arsitektural
                                            megah.
                                        </p>
                                        <!-- Feature Badges -->
                                        <div
                                            class="grid grid-cols-2 gap-2 pt-2 pb-1 font-body-sm text-[13px] text-on-surface-variant">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">square_foot</span>
                                                <span>750 m² Area Luas</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">bed</span>
                                                <span>3 Master King Suites</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">group</span>
                                                <span>6 - 8 Tamu Keluarga</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">kitchen</span>
                                                <span>Private Chef Kitchen</span>
                                            </div>
                                        </div>
                                        <!-- Inclusions strip -->
                                        <div
                                            class="flex items-center gap-2 py-2 px-3 rounded bg-surface-container-low text-primary text-[12px] font-medium">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">family_restroom</span>
                                            <span>Layanan Nanny Bersertifikat &amp; Chef Resor Eksklusif</span>
                                        </div>
                                    </div>
                                    <!-- Price and Action CTA -->
                                    <div class="pt-6 mt-4 flex flex-col gap-4">
                                        <div class="flex items-baseline justify-between">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-uppercase text-[10px] text-on-surface-variant">Mulai
                                                    dari</span>
                                                <div class="flex items-baseline gap-1">
                                                    <span class="font-headline-sm text-headline-sm text-primary">Rp
                                                        48.000.000</span>
                                                    <span class="text-on-surface-variant text-[12px]">/ malam</span>
                                                </div>
                                            </div>
                                            <label
                                                class="flex items-center gap-1.5 cursor-pointer text-on-surface-variant hover:text-primary">
                                                <input class="room-compare-chk accent-secondary rounded"
                                                    data-room-name="Three-Bedroom Haven Family Manor" type="checkbox" />
                                                <span class="font-label-uppercase text-[11px]">Bandingkan</span>
                                            </label>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button
                                                class="px-4 py-2.5 rounded bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                                Detail Kamar
                                            </button>
                                            <button
                                                class="px-4 py-2.5 rounded bg-primary-container text-on-primary hover:bg-primary font-label-uppercase text-label-uppercase transition-colors shadow-sm flex items-center justify-center gap-1">
                                                <span>Reservasi</span>
                                                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!-- Room 9 -->
                            <article
                                class="room-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col"
                                data-category="royal" data-guests="couple" data-price="16000000" data-size="195">
                                <div class="relative w-full h-72 overflow-hidden bg-surface-container">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Holistic wellness resort villa interior with aromatic cedarwood steam room, outdoor treatment deck facing cliff greenery, natural stone rain shower, relaxing yoga mat space with serene soft morning sunbeams."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuArUeAcBhHeMf6lZQT6R4JWvDJ1n_jCQJGZ1fZTMMPeDcHHg1z8YXwG4KHEHhYDkuQCeF1p7HsC1SFep8E0Efhytb2nse1Pzots1UbhYTLrzsoiPLb1kzbRI0yA9avkoCbbrgeZCwXxbK5XQUEwy_iMsW3LQwO8uwn_vkXoqZ86TMy49U1KTwm7jF7KxtPO4MDvoBSNfwPnuynhXMhDyGJ9_PckVGklhkdMcaAbOv4" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                        <span
                                            class="px-3 py-1 rounded bg-surface/90 backdrop-blur text-primary font-label-uppercase text-[11px] tracking-wider shadow-sm">Wellness
                                            &amp; Steam</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-on-primary">
                                        <span
                                            class="font-label-uppercase text-[11px] tracking-widest text-secondary-fixed">Kategori:
                                            Royal Sanctuary Pavilion</span>
                                        <div
                                            class="flex items-center gap-1 text-[13px] bg-primary/60 px-2 py-0.5 rounded backdrop-blur">
                                            <span
                                                class="material-symbols-outlined text-[15px] text-secondary">star</span>
                                            <span class="font-bold">4.94</span>
                                            <span class="text-on-primary-container text-[11px]">(72)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div class="flex flex-col gap-3">
                                        <div class="flex items-start justify-between gap-2">
                                            <h2
                                                class="font-headline-sm text-headline-sm text-primary group-hover:text-secondary transition-colors">
                                                Serenity Wellness Spa Villa
                                            </h2>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                                            Suaka penyembuhan holistik dengan fasilitas ruang uap herbal cedarwood
                                            privat, tempat perawatan terapis in-villa, dan menu nutrisi terkurasi dokter
                                            naturopati.
                                        </p>
                                        <!-- Feature Badges -->
                                        <div
                                            class="grid grid-cols-2 gap-2 pt-2 pb-1 font-body-sm text-[13px] text-on-surface-variant">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">square_foot</span>
                                                <span>195 m² Area Luas</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">bed</span>
                                                <span>1 King Orthopedic</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">group</span>
                                                <span>2 Tamu Dewasa</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">sauna</span>
                                                <span>Private Steam Room</span>
                                            </div>
                                        </div>
                                        <!-- Inclusions strip -->
                                        <div
                                            class="flex items-center gap-2 py-2 px-3 rounded bg-surface-container-low text-primary text-[12px] font-medium">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">spa</span>
                                            <span>Termasuk 90-Min Heavenly Haven Spa Treatment Setiap Hari</span>
                                        </div>
                                    </div>
                                    <!-- Price and Action CTA -->
                                    <div class="pt-6 mt-4 flex flex-col gap-4">
                                        <div class="flex items-baseline justify-between">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-uppercase text-[10px] text-on-surface-variant">Mulai
                                                    dari</span>
                                                <div class="flex items-baseline gap-1">
                                                    <span class="font-headline-sm text-headline-sm text-primary">Rp
                                                        16.000.000</span>
                                                    <span class="text-on-surface-variant text-[12px]">/ malam</span>
                                                </div>
                                            </div>
                                            <label
                                                class="flex items-center gap-1.5 cursor-pointer text-on-surface-variant hover:text-primary">
                                                <input class="room-compare-chk accent-secondary rounded"
                                                    data-room-name="Serenity Wellness Spa Villa" type="checkbox" />
                                                <span class="font-label-uppercase text-[11px]">Bandingkan</span>
                                            </label>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button
                                                class="px-4 py-2.5 rounded bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                                Detail Kamar
                                            </button>
                                            <button
                                                class="px-4 py-2.5 rounded bg-primary-container text-on-primary hover:bg-primary font-label-uppercase text-label-uppercase transition-colors shadow-sm flex items-center justify-center gap-1">
                                                <span>Reservasi</span>
                                                <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- Pagination Controls -->
                        <div
                            class="mt-16 flex flex-col sm:flex-row items-center justify-between gap-6 bg-surface-container-lowest p-6 rounded-xl shadow-sm">
                            <span class="font-body-sm text-body-sm text-on-surface-variant">
                                Menampilkan <strong class="text-primary font-semibold">1 – 9</strong> dari total <strong
                                    class="text-primary font-semibold">42</strong> Kamar &amp; Suites Haven Palais
                            </span>
                            <nav aria-label="Pagination" class="flex items-center gap-2">
                                <button
                                    class="w-10 h-10 rounded flex items-center justify-center bg-surface-container-low text-on-surface-variant hover:text-primary transition-colors disabled:opacity-40"
                                    disabled="">
                                    <span class="material-symbols-outlined text-[20px]">chevron_left</span>
                                </button>
                                <button
                                    class="w-10 h-10 rounded flex items-center justify-center bg-primary text-on-primary font-label-uppercase text-label-uppercase font-bold">
                                    1
                                </button>
                                <button
                                    class="w-10 h-10 rounded flex items-center justify-center bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                    2
                                </button>
                                <button
                                    class="w-10 h-10 rounded flex items-center justify-center bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                    3
                                </button>
                                <button
                                    class="w-10 h-10 rounded flex items-center justify-center bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                    4
                                </button>
                                <button
                                    class="w-10 h-10 rounded flex items-center justify-center bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                    5
                                </button>
                                <button
                                    class="px-4 h-10 rounded flex items-center gap-1.5 bg-surface-container-low hover:bg-surface-container text-primary font-label-uppercase text-label-uppercase transition-colors">
                                    <span>Selanjutnya</span>
                                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                                </button>
                            </nav>
                        </div>
                    </div>
                </section>
                <!-- Comprehensive Category Comparison Matrix -->
                <section class="w-full bg-surface-container-low px-8 lg:px-16 py-20">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-10">
                        <div class="flex flex-col gap-3">
                            <span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Matriks
                                Perbandingan Cepat</span>
                            <h2 class="font-headline-md text-headline-md text-primary">
                                Perbandingan 4 Arketipe Akomodasi Haven Palais
                            </h2>
                            <p class="font-body-md text-body-md text-on-surface-variant max-w-3xl">
                                Setiap kategori diciptakan untuk memenuhi profil liburan yang berbeda, mulai dari
                                liburan intim berdua hingga peristirahatan keluarga bangsawan.
                            </p>
                        </div>
                        <div class="overflow-x-auto rounded-xl bg-surface-container-lowest shadow-sm">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-surface-container text-primary font-headline-sm text-body-lg">
                                        <th class="p-5 font-semibold">Koleksi Kategori</th>
                                        <th class="p-5 font-semibold">Total Unit</th>
                                        <th class="p-5 font-semibold">Rata-rata Luas</th>
                                        <th class="p-5 font-semibold">Fasilitas Pembeda Utama</th>
                                        <th class="p-5 font-semibold">Karakter Tamu Ideal</th>
                                        <th class="p-5 font-semibold">Mulai Dari</th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-surface-container text-on-surface font-body-sm text-body-sm">
                                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                                        <td class="p-5">
                                            <span class="font-bold text-primary block">Cliffside Ocean Villa</span>
                                            <span class="text-[12px] text-secondary">Tepi Tebing Samudra Hindia</span>
                                        </td>
                                        <td class="p-5">14 Villa</td>
                                        <td class="p-5 font-semibold">210 - 320 m²</td>
                                        <td class="p-5">Private Infinity Pool, Jacuzzi Gantung, Sunset View 180°</td>
                                        <td class="p-5">Pasangan Honeymoon &amp; Peminat Romantisme</td>
                                        <td class="p-5 font-title-editorial text-title-editorial text-primary">Rp
                                            18.500.000</td>
                                    </tr>
                                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                                        <td class="p-5">
                                            <span class="font-bold text-primary block">Grand Horizon Suite</span>
                                            <span class="text-[12px] text-secondary">Ketinggian Panorama Biru</span>
                                        </td>
                                        <td class="p-5">12 Suites</td>
                                        <td class="p-5 font-semibold">140 - 180 m²</td>
                                        <td class="p-5">Balkon Daybed Raksasa, Sunken Marble Tub, Cocktail Bar</td>
                                        <td class="p-5">Retreat Pribadi &amp; Pecinta Senja Santai</td>
                                        <td class="p-5 font-title-editorial text-title-editorial text-primary">Rp
                                            9.500.000</td>
                                    </tr>
                                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                                        <td class="p-5">
                                            <span class="font-bold text-primary block">Royal Sanctuary Pavilion</span>
                                            <span class="text-[12px] text-secondary">Taman &amp; Paviliun Terbuka</span>
                                        </td>
                                        <td class="p-5">10 Pavilion</td>
                                        <td class="p-5 font-semibold">125 - 450 m²</td>
                                        <td class="p-5">Bale Bengong, Kolam Renang Tropis, Private Steam Room</td>
                                        <td class="p-5">Pencari Relaksasi Wellness &amp; Keluarga Kecil</td>
                                        <td class="p-5 font-title-editorial text-title-editorial text-primary">Rp
                                            7.200.000</td>
                                    </tr>
                                    <tr class="hover:bg-surface-container-low/60 transition-colors">
                                        <td class="p-5">
                                            <span class="font-bold text-primary block">Penthouse &amp;
                                                Presidential</span>
                                            <span class="text-[12px] text-secondary">Puncak Eksklusivitas
                                                Tertinggi</span>
                                        </td>
                                        <td class="p-5">6 Units</td>
                                        <td class="p-5 font-semibold">680 - 750 m²</td>
                                        <td class="p-5">Chef Privat In-Villa, Wine Cellar, Lap Pool 20m, VIP Airport Car
                                        </td>
                                        <td class="p-5">Keluarga Besar, Delegasi VIP &amp; Selebritas</td>
                                        <td class="p-5 font-title-editorial text-title-editorial text-primary">Rp
                                            48.000.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- Inclusions Guarantee Section (Standard across all 42 accommodations) -->
                <section class="w-full px-8 lg:px-16 py-20 bg-surface">
                    <div class="max-w-[1320px] mx-auto flex flex-col gap-12">
                        <div class="text-center max-w-2xl mx-auto flex flex-col gap-3">
                            <span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Kemewahan
                                Tanpa Syarat</span>
                            <h2 class="font-headline-md text-headline-md text-primary">
                                Inklusi Eksklusif Seluruh 42 Kamar Haven Palais
                            </h2>
                            <p class="font-body-md text-body-md text-on-surface-variant">
                                Setiap tamu di seluruh 42 kamar kami berhak menikmati standar pelayanan tertinggi tanpa
                                biaya tersembunyi.
                            </p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                            <!-- Benefit 1 -->
                            <div class="p-6 rounded-xl bg-surface-container-low flex flex-col gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-surface-container-lowest flex items-center justify-center text-secondary shadow-sm">
                                    <span class="material-symbols-outlined text-[26px]">restaurant</span>
                                </div>
                                <h3 class="font-headline-sm text-body-lg text-primary font-semibold">Sarapan Artisan
                                    Harian</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Disajikan setiap pagi di restoran tepi tebing atau langsung ke dalam villa pribadi
                                    Anda tanpa batasan jam.
                                </p>
                            </div>
                            <!-- Benefit 2 -->
                            <div class="p-6 rounded-xl bg-surface-container-low flex flex-col gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-surface-container-lowest flex items-center justify-center text-secondary shadow-sm">
                                    <span class="material-symbols-outlined text-[26px]">room_service</span>
                                </div>
                                <h3 class="font-headline-sm text-body-lg text-primary font-semibold">Butler Les Clefs
                                    d'Or</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Pelayan pribadi terlatih berstandar internasional yang siap melayani segala
                                    kebutuhan Anda 24 jam sehari.
                                </p>
                            </div>
                            <!-- Benefit 3 -->
                            <div class="p-6 rounded-xl bg-surface-container-low flex flex-col gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-surface-container-lowest flex items-center justify-center text-secondary shadow-sm">
                                    <span class="material-symbols-outlined text-[26px]">wine_bar</span>
                                </div>
                                <h3 class="font-headline-sm text-body-lg text-primary font-semibold">Sunset Canapés
                                    &amp; Tea</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Sajian afternoon tea eksklusif dan hidangan pembuka koktail saat matahari terbenam
                                    di Cliff Lounge.
                                </p>
                            </div>
                            <!-- Benefit 4 -->
                            <div class="p-6 rounded-xl bg-surface-container-low flex flex-col gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-surface-container-lowest flex items-center justify-center text-secondary shadow-sm">
                                    <span class="material-symbols-outlined text-[26px]">water_lux</span>
                                </div>
                                <h3 class="font-headline-sm text-body-lg text-primary font-semibold">Akses Beach Club
                                    VIP</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Prioritas reservasi daybed utama di The Horizon Beach Club serta akses privat ke
                                    pantai berpasir putih.
                                </p>
                            </div>
                            <!-- Benefit 5 -->
                            <div class="p-6 rounded-xl bg-surface-container-low flex flex-col gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-surface-container-lowest flex items-center justify-center text-secondary shadow-sm">
                                    <span class="material-symbols-outlined text-[26px]">airport_shuttle</span>
                                </div>
                                <h3 class="font-headline-sm text-body-lg text-primary font-semibold">Antar-Jemput Mewah
                                </h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Kendaraan eksekutif ber-AC dengan fasilitas Wi-Fi dingin dari dan menuju Bandara
                                    Internasional I Gusti Ngurah Rai.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dedicated Concierge Assistance Banner -->
                <section class="w-full px-8 lg:px-16 pb-24">
                    <div
                        class="max-w-[1320px] mx-auto rounded-2xl bg-primary-container text-on-primary p-8 lg:p-12 shadow-2xl relative overflow-hidden">
                        <!-- Background Ambient Glow -->
                        <div
                            class="absolute -right-24 -bottom-24 w-96 h-96 rounded-full bg-secondary/15 blur-3xl pointer-events-none">
                        </div>
                        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                            <div class="lg:col-span-8 flex flex-col gap-4">
                                <div class="flex items-center gap-2 text-secondary">
                                    <span class="material-symbols-outlined text-[22px]">contact_support</span>
                                    <span class="font-label-uppercase text-label-uppercase tracking-widest">Haven Palais
                                        Private Concierge</span>
                                </div>
                                <h2 class="font-headline-lg text-headline-md sm:text-headline-lg text-on-primary">
                                    Memerlukan Bantuan Memilih dari 42 Kamar Kami?
                                </h2>
                                <p
                                    class="font-body-md text-body-md text-on-primary-container max-w-2xl leading-relaxed">
                                    Biarkan kurator akomodasi Haven Palais merancang pengalaman menginap sesuai
                                    preferensi personal, orientasi pemandangan, dan kebutuhan tanggal kunjungan Anda.
                                </p>
                            </div>
                            <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-4">
                                <a class="px-6 py-4 rounded bg-secondary hover:bg-secondary-fixed text-primary font-label-uppercase text-label-uppercase transition-all flex items-center justify-center gap-3 shadow-lg"
                                    href="https://wa.me/623618800900" rel="noopener noreferrer" target="_blank">
                                    <span class="material-symbols-outlined text-[20px]">chat</span>
                                    <span>WhatsApp Concierge (+62 361 8800 900)</span>
                                </a>
                                <a class="px-6 py-4 rounded border border-on-primary-container/30 hover:bg-surface-container-lowest/10 text-on-primary font-label-uppercase text-label-uppercase transition-all flex items-center justify-center gap-3"
                                    href="tel:+623618800900">
                                    <span class="material-symbols-outlined text-[20px]">call</span>
                                    <span>Jadwalkan Panggilan Privat</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Sticky Comparison Floating Bar (Appears when items are checked) -->
                <div class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 bg-primary text-on-primary px-6 py-4 rounded-xl shadow-2xl flex items-center gap-6 hidden transition-all duration-300 border border-outline/30"
                    id="stickyCompareBar">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-[24px]">compare_arrows</span>
                        <div class="flex flex-col">
                            <span class="font-label-uppercase text-[11px] text-secondary">Mode Perbandingan</span>
                            <span class="font-label-md text-label-md" id="stickyCompareText">0 Kamar Terpilih</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="text-on-primary-container hover:text-on-primary text-[12px] font-label-uppercase"
                            id="clearAllCompareBtn">
                            Reset
                        </button>
                        <button
                            class="bg-secondary hover:bg-secondary-fixed text-primary px-5 py-2 rounded font-label-uppercase text-label-uppercase text-[12px] transition-colors font-bold shadow-md"
                            id="proceedCompareBtn">
                            Bandingkan Sekarang
                        </button>
                    </div>
                </div>
                <!-- Interactive Client-side Script -->
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        // Elements
                        const searchInput = document.getElementById('roomSearchInput');
                        const clearSearchBtn = document.getElementById('clearSearchBtn');
                        const categoryPills = document.querySelectorAll('.category-pill');
                        const guestFilter = document.getElementById('filterGuests');
                        const sortFilter = document.getElementById('filterSort');
                        const roomCards = Array.from(document.querySelectorAll('.room-card'));
                        const gridContainer = document.getElementById('roomsGridContainer');
                        const inventoryCounter = document.getElementById('inventoryCounter');
                        const viewGridBtn = document.getElementById('viewGridBtn');
                        const viewListBtn = document.getElementById('viewListBtn');
                        const compareCheckboxes = document.querySelectorAll('.room-compare-chk');
                        const stickyCompareBar = document.getElementById('stickyCompareBar');
                        const stickyCompareText = document.getElementById('stickyCompareText');
                        const clearAllCompareBtn = document.getElementById('clearAllCompareBtn');
                        const compareCounterBadge = document.getElementById('compareCounterBadge');
                        const compareCountNum = document.getElementById('compareCountNum');
                        const openCompareDrawerBtn = document.getElementById('openCompareDrawerBtn');

                        let currentCategory = 'all';
                        let selectedRoomsForCompare = [];

                        // Filter & Search Logic
                        function filterRooms() {
                            const query = (searchInput.value || '').toLowerCase().trim();
                            const selectedGuest = guestFilter.value;
                            let visibleCount = 0;

                            roomCards.forEach(card => {
                                const title = card.querySelector('h2').textContent.toLowerCase();
                                const desc = card.querySelector('p').textContent.toLowerCase();
                                const category = card.dataset.category;
                                const guests = card.dataset.guests;

                                const matchesQuery = !query || title.includes(query) || desc.includes(query);
                                const matchesCategory = currentCategory === 'all' || category === currentCategory;
                                const matchesGuests = selectedGuest === 'all' || guests === selectedGuest;

                                if (matchesQuery && matchesCategory && matchesGuests) {
                                    card.style.display = 'flex';
                                    visibleCount++;
                                } else {
                                    card.style.display = 'none';
                                }
                            });

                            inventoryCounter.textContent = `Menampilkan ${visibleCount} dari 42 Kamar & Suites Terdaftar`;
                        }

                        // Sort Logic
                        function sortRooms() {
                            const criteria = sortFilter.value;
                            const sorted = [...roomCards].sort((a, b) => {
                                const priceA = parseInt(a.dataset.price, 10);
                                const priceB = parseInt(b.dataset.price, 10);
                                const sizeA = parseInt(a.dataset.size, 10);
                                const sizeB = parseInt(b.dataset.size, 10);

                                if (criteria === 'price-desc') return priceB - priceA;
                                if (criteria === 'price-asc') return priceA - priceB;
                                if (criteria === 'size-desc') return sizeB - sizeA;
                                if (criteria === 'rating') return priceB - priceA;
                                return 0;
                            });

                            sorted.forEach(card => gridContainer.appendChild(card));
                        }

                        // Search Inputs
                        searchInput.addEventListener('input', () => {
                            clearSearchBtn.classList.toggle('hidden', !searchInput.value);
                            filterRooms();
                        });

                        clearSearchBtn.addEventListener('click', () => {
                            searchInput.value = '';
                            clearSearchBtn.classList.add('hidden');
                            filterRooms();
                        });

                        // Category Pill Tabs
                        categoryPills.forEach(pill => {
                            pill.addEventListener('click', () => {
                                categoryPills.forEach(p => {
                                    p.classList.remove('bg-primary-container', 'text-on-primary');
                                    p.classList.add('bg-surface-container-low', 'text-on-surface-variant');
                                });
                                pill.classList.remove('bg-surface-container-low', 'text-on-surface-variant');
                                pill.classList.add('bg-primary-container', 'text-on-primary');

                                currentCategory = pill.dataset.cat;
                                filterRooms();
                            });
                        });

                        // Guest filter
                        guestFilter.addEventListener('change', filterRooms);

                        // Sorter
                        sortFilter.addEventListener('change', () => {
                            sortRooms();
                            filterRooms();
                        });

                        // View Layout Toggle
                        viewGridBtn.addEventListener('click', () => {
                            gridContainer.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8';
                            viewGridBtn.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
                            viewGridBtn.classList.remove('text-on-surface-variant');
                            viewListBtn.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
                            viewListBtn.classList.add('text-on-surface-variant');
                        });

                        viewListBtn.addEventListener('click', () => {
                            gridContainer.className = 'grid grid-cols-1 gap-6';
                            viewListBtn.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
                            viewListBtn.classList.remove('text-on-surface-variant');
                            viewGridBtn.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
                            viewGridBtn.classList.add('text-on-surface-variant');
                        });

                        // Room Comparison Checkboxes
                        function updateCompareState() {
                            const count = selectedRoomsForCompare.length;
                            if (count > 0) {
                                stickyCompareBar.classList.remove('hidden');
                                stickyCompareText.textContent = `${count} Kamar Terpilih untuk Dibandingkan`;
                                compareCounterBadge.classList.remove('hidden');
                                openCompareDrawerBtn.classList.remove('hidden');
                                compareCountNum.textContent = count;
                            } else {
                                stickyCompareBar.classList.add('hidden');
                                compareCounterBadge.classList.add('hidden');
                                openCompareDrawerBtn.classList.add('hidden');
                            }
                        }

                        compareCheckboxes.forEach(chk => {
                            chk.addEventListener('change', (e) => {
                                const roomName = e.target.dataset.roomName;
                                if (e.target.checked) {
                                    if (selectedRoomsForCompare.length >= 4) {
                                        alert('Anda dapat membandingkan maksimal 4 kamar sekaligus.');
                                        e.target.checked = false;
                                        return;
                                    }
                                    selectedRoomsForCompare.push(roomName);
                                } else {
                                    selectedRoomsForCompare = selectedRoomsForCompare.filter(name => name !== roomName);
                                }
                                updateCompareState();
                            });
                        });

                        clearAllCompareBtn.addEventListener('click', () => {
                            selectedRoomsForCompare = [];
                            compareCheckboxes.forEach(chk => chk.checked = false);
                            updateCompareState();
                        });

                        const triggerCompareModal = () => {
                            if (selectedRoomsForCompare.length === 0) return;
                            alert(`Membuka modal komparasi untuk:\n\n• ${selectedRoomsForCompare.join('\n• ')}\n\nFitur ini memuat spesifikasi langsung dari Concierge Database.`);
                        };

                        document.getElementById('proceedCompareBtn').addEventListener('click', triggerCompareModal);
                        openCompareDrawerBtn.addEventListener('click', triggerCompareModal);
                    });
                </script>
            </div>
        </main>
    </div>
</body>

</html>