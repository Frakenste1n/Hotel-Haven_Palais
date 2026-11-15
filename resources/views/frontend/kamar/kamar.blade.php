<!DOCTYPE html>

<html lang="id">
@extends('frontend.layouts.app')

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

                                    @foreach ($categories as $category)
                                        <button
                                            class="category-btn px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container-high text-on-surface font-label-uppercase text-label-uppercase tracking-wider transition-all whitespace-nowrap"
                                            onclick="setActiveCategory(this, @js($category->slug))">
                                            {{ $category->name }}
                                        </button>
                                    @endforeach

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
                                    <span class="material-symbols-outlined text-[16px]">tune</span>
                                    Fasilitas Kunci:
                                </span>

                                @foreach ($facilities as $facility)
                                    <button
                                        class="quick-chip px-3 py-1.5 rounded bg-surface-container-low hover:bg-surface-container text-on-surface-variant font-body-sm text-body-sm transition-all flex items-center gap-1.5"
                                        data-filter="{{ $facility->id }}" onclick="toggleQuickFilter(this)">
                                        <span class="material-symbols-outlined text-[16px]">
                                            {{ $facility->icon ?: 'check_circle' }}
                                        </span>
                                        {{ $facility->name }}
                                    </button>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </section>
                <!-- FEATURED SIGNATURE SUITE (SHOWCASE HORIZONTAL CARD) -->

                <!-- FEATURED SIGNATURE SUITE -->
                @if ($featuredRoomType)
                    @php
                        $featuredPrimaryImage = $featuredRoomType->images->firstWhere('is_primary', true)
                            ?? $featuredRoomType->images->first();

                        $featuredImageUrl = $featuredPrimaryImage
                            ? asset('storage/' . $featuredPrimaryImage->image_path)
                            : asset('images/placeholder.jpg');

                        $featuredImages = collect([$featuredPrimaryImage])
                            ->filter()
                            ->merge(
                                $featuredRoomType->images
                                    ->reject(fn($image) => $featuredPrimaryImage && $image->id === $featuredPrimaryImage->id)
                                    ->sortBy('sort_order')
                            )
                            ->take(4)
                            ->values();

                        $featuredPrice = 'Rp ' . number_format($featuredRoomType->base_price, 0, ',', '.');
                    @endphp

                    <section class="w-full px-6 lg:px-16 py-10 bg-surface-container-low">
                        <div class="max-w-[1320px] mx-auto flex flex-col gap-6">

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-secondary text-[24px]">
                                        workspace_premium
                                    </span>
                                    <span class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">
                                        Pilihan Mahakarya Kami
                                    </span>
                                </div>

                                <span class="font-label-uppercase text-label-uppercase text-on-surface-variant">
                                    Rating Tertinggi
                                </span>
                            </div>

                            <article
                                class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_16px_40px_-6px_rgba(27,42,50,0.08)] flex flex-col xl:flex-row">

                                <!-- Gallery -->
                                <div class="xl:w-7/12 flex flex-col relative bg-surface-container-high">

                                    <div class="relative h-80 sm:h-[420px] xl:h-[480px] w-full overflow-hidden">
                                        <img class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                                            id="featured-main-img" src="{{ $featuredImageUrl }}"
                                            alt="{{ $featuredRoomType->name }}" />

                                        <div
                                            class="absolute top-5 left-5 bg-primary-container text-on-primary font-label-uppercase text-label-uppercase tracking-widest px-3.5 py-1.5 rounded shadow-md flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary-fixed">star</span>
                                            Rating Teratas
                                        </div>

                                        <div
                                            class="absolute bottom-5 left-5 bg-primary/75 backdrop-blur-md text-on-primary px-3.5 py-1.5 rounded-lg flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-[18px] text-secondary-fixed">star</span>
                                            <span class="font-label-uppercase text-label-uppercase">
                                                {{ number_format($featuredRoomType->average_rating, 1) }} / 5
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Thumbnail -->
                                    <div class="grid grid-cols-4 p-3 gap-2 bg-surface-container">
                                        @forelse ($featuredImages as $image)
                                            <button type="button"
                                                class="h-20 rounded overflow-hidden opacity-100 hover:opacity-90 transition-opacity focus:outline-none"
                                                onclick="changeFeaturedPhoto(this)">
                                                <img class="w-full h-full object-cover"
                                                    src="{{ asset('storage/' . $image->image_path) }}"
                                                    alt="{{ $image->caption ?? $featuredRoomType->name }}" />
                                            </button>
                                        @empty
                                            <div class="col-span-4 text-center py-5 text-on-surface-variant text-sm">
                                                Belum ada foto kamar.
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Room Details -->
                                <div class="xl:w-5/12 p-8 lg:p-10 flex flex-col justify-between gap-6">

                                    <div class="flex flex-col gap-5">

                                        <!-- Title and Rating -->
                                        <div class="flex flex-col gap-2">
                                            <span
                                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">
                                                {{ $featuredRoomType->category->name ?? 'Koleksi Kamar Haven Palais' }}
                                            </span>

                                            <h2 class="font-headline-md text-headline-md text-primary leading-tight">
                                                {{ $featuredRoomType->name }}
                                            </h2>

                                            <div class="flex items-baseline gap-2 pt-1">
                                                <span class="font-title-editorial text-2xl font-bold text-primary">
                                                    {{ $featuredPrice }}
                                                </span>
                                                <span class="font-body-sm text-body-sm text-on-surface-variant">
                                                    / malam
                                                </span>
                                            </div>

                                            <div class="flex items-center gap-2 pt-2 text-secondary">
                                                <span class="material-symbols-outlined text-[18px]">star</span>
                                                <span class="font-semibold">
                                                    {{ number_format($featuredRoomType->average_rating, 1) }} / 5
                                                </span>
                                                <span class="text-on-surface-variant text-sm">
                                                    ({{ $featuredRoomType->review_count }} ulasan disetujui)
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Room Metrics -->
                                        <div class="grid grid-cols-3 gap-3 p-4 bg-surface-container-low rounded-xl">

                                            <div class="flex flex-col items-center text-center p-2">
                                                <span class="material-symbols-outlined text-primary text-[24px] mb-1">
                                                    aspect_ratio
                                                </span>
                                                <span class="font-label-uppercase text-[11px] text-on-surface-variant">
                                                    Luas Area
                                                </span>
                                                <span class="font-body-md text-body-md font-semibold text-primary">
                                                    {{ number_format($featuredRoomType->room_size, 0, ',', '.') }} m²
                                                </span>
                                            </div>

                                            <div class="flex flex-col items-center text-center p-2">
                                                <span class="material-symbols-outlined text-primary text-[24px] mb-1">
                                                    groups
                                                </span>
                                                <span class="font-label-uppercase text-[11px] text-on-surface-variant">
                                                    Kapasitas
                                                </span>
                                                <span class="font-body-md text-body-md font-semibold text-primary">
                                                    {{ $featuredRoomType->capacity_adults }} Dewasa
                                                    + {{ $featuredRoomType->capacity_children }} Anak
                                                </span>
                                            </div>

                                            <div class="flex flex-col items-center text-center p-2">
                                                <span class="material-symbols-outlined text-primary text-[24px] mb-1">
                                                    bed
                                                </span>
                                                <span class="font-label-uppercase text-[11px] text-on-surface-variant">
                                                    Tipe Ranjang
                                                </span>
                                                <span class="font-body-md text-body-md font-semibold text-primary">
                                                    {{ $featuredRoomType->bed_type }}
                                                </span>
                                            </div>

                                        </div>

                                        <!-- Facilities -->
                                        <div class="flex flex-col gap-2.5">
                                            <span
                                                class="font-label-uppercase text-label-uppercase text-primary tracking-wider">
                                                Fasilitas Kamar:
                                            </span>

                                            <ul
                                                class="flex flex-col gap-2 text-on-surface-variant font-body-sm text-body-sm">
                                                @forelse ($featuredRoomType->facilities as $facility)
                                                    <li class="flex items-center gap-2.5">
                                                        <span class="material-symbols-outlined text-secondary text-[18px]">
                                                            {{ $facility->icon ?: 'check_circle' }}
                                                        </span>
                                                        <span>{{ $facility->name }}</span>
                                                    </li>
                                                @empty
                                                    <li>Belum ada fasilitas terdaftar.</li>
                                                @endforelse
                                            </ul>
                                        </div>

                                        @if ($featuredRoomType->description)
                                            <p class="font-body-sm text-body-sm text-on-surface-variant">
                                                {{ $featuredRoomType->description }}
                                            </p>
                                        @endif

                                    </div>

                                    <!-- Buttons -->
                                    <div class="flex flex-col sm:flex-row items-center gap-3 pt-4">

                                        <button type="button"
                                            class="w-full sm:flex-1 py-3 px-6 bg-primary-container text-on-primary hover:bg-primary rounded font-label-uppercase text-label-uppercase tracking-widest transition-colors flex items-center justify-center gap-2 shadow-sm"
                                            onclick="openBookingDrawer(
                                        @js($featuredRoomType->name),
                                        @js($featuredPrice),
                                        @js($featuredRoomType->max_occupancy),
                                        @js($featuredRoomType->id)
                                    )">
                                            <span>Reservasi Sekarang</span>
                                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                        </button>

                                        <button type="button"
                                            class="w-full sm:w-auto py-3 px-5 bg-surface-container hover:bg-surface-container-high text-primary rounded font-label-uppercase text-label-uppercase tracking-widest transition-colors flex items-center justify-center gap-2"
                                            onclick="showRoomModal(
                                        @js($featuredRoomType->name),
                                        @js($featuredImageUrl),
                                        @js($featuredRoomType->facilities->pluck('name')->values()),
                                        @js($featuredRoomType->description),
                                        @js($featuredRoomType->capacity_adults),
                                        @js($featuredRoomType->capacity_children),
                                        @js($featuredRoomType->room_size),
                                        @js($featuredRoomType->bed_type),
                                        @js($featuredRoomType->max_occupancy),
                                        @js($featuredRoomType->id)
                                    )">
                                            <span class="material-symbols-outlined text-[18px]">info</span>
                                            <span>Lihat Detail Lengkap</span>
                                        </button>

                                    </div>
                                </div>
                            </article>
                        </div>
                    </section>
                @else
                    <section class="w-full px-6 lg:px-16 py-10 bg-surface-container-low">
                        <div class="max-w-[1320px] mx-auto text-center py-10">
                            <h2 class="font-headline-md text-headline-md text-primary">
                                Pilihan Mahakarya Kami
                            </h2>
                            <p class="mt-3 text-on-surface-variant">
                                Belum ada kamar dengan ulasan yang disetujui.
                            </p>
                        </div>
                    </section>
                @endif

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
                        </div>
                        <!-- Grid Container: 4 Detailed Room Cards -->

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8" id="room-card-container">

                            @forelse ($roomTypes as $roomType)

                                @php
                                    $primaryImage = $roomType->images->firstWhere('is_primary', true)
                                        ?? $roomType->images->first();

                                    $imageUrl = $primaryImage
                                        ? asset('storage/' . $primaryImage->image_path)
                                        : asset('images/placeholder.jpg');

                                    $formattedPrice = 'Rp ' . number_format($roomType->base_price, 0, ',', '.');
                                @endphp

                                <article
                                    class="room-card bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_12px_32px_-4px_rgba(27,42,50,0.05)] hover:shadow-[0_20px_48px_-6px_rgba(27,42,50,0.1)] transition-all flex flex-col justify-between"
                                    data-capacity="{{ $roomType->max_occupancy }}"
                                    data-category="{{ $roomType->category->slug ?? '' }}"
                                    data-price="{{ $roomType->base_price }}">

                                    <div class="flex flex-col">

                                        <div class="relative h-64 sm:h-72 w-full overflow-hidden bg-surface-container-high">
                                            <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                src="{{ $imageUrl }}" alt="{{ $primaryImage->caption ?? $roomType->name }}">

                                            @if ($roomType->is_featured)
                                                <div
                                                    class="absolute top-4 left-4 bg-secondary text-on-secondary px-3 py-1 rounded font-label-uppercase text-[11px] tracking-wider shadow">
                                                    Best Seller
                                                </div>
                                            @endif

                                            <div
                                                class="absolute bottom-3 right-3 bg-primary/80 backdrop-blur text-on-primary px-3 py-1 rounded-full font-label-uppercase text-[10px] flex items-center gap-1">
                                                <span
                                                    class="material-symbols-outlined text-[14px] text-secondary-fixed">photo_camera</span>
                                                {{ $roomType->images->count() }} Foto
                                            </div>
                                        </div>

                                        <div class="p-6 flex flex-col gap-4">

                                            <div class="flex items-start justify-between gap-3">
                                                <div>
                                                    <span
                                                        class="font-label-uppercase text-[11px] text-secondary tracking-widest block">
                                                        {{ $roomType->category->name ?? 'Akomodasi' }}
                                                    </span>

                                                    <h3 class="font-headline-sm text-headline-sm text-primary">
                                                        {{ $roomType->name }}
                                                    </h3>
                                                </div>

                                                <div class="text-right">
                                                    <span
                                                        class="font-title-editorial text-title-editorial text-primary font-bold">
                                                        {{ $formattedPrice }}
                                                    </span>

                                                    <span class="font-body-sm text-[12px] text-on-surface-variant block">
                                                        / malam
                                                    </span>
                                                </div>
                                            </div>

                                            <div
                                                class="flex flex-wrap items-center gap-3 py-2 text-on-surface-variant font-label-uppercase text-[11px] bg-surface-container-low px-3 rounded-lg">

                                                <span class="flex items-center gap-1">
                                                    <span
                                                        class="material-symbols-outlined text-[16px] text-primary">square_foot</span>
                                                    {{ number_format($roomType->room_size, 0, ',', '.') }} m²
                                                </span>

                                                <span class="text-outline-variant">•</span>

                                                <span class="flex items-center gap-1">
                                                    <span
                                                        class="material-symbols-outlined text-[16px] text-primary">person</span>
                                                    {{ $roomType->capacity_adults }} Dewasa
                                                </span>

                                                <span class="text-outline-variant">•</span>

                                                <span class="flex items-center gap-1">
                                                    <span
                                                        class="material-symbols-outlined text-[16px] text-primary">king_bed</span>
                                                    {{ $roomType->bed_type }} Bed
                                                </span>

                                            </div>

                                            <div
                                                class="flex flex-col gap-1.5 text-on-surface-variant font-body-sm text-body-sm">

                                                @forelse ($roomType->facilities as $facility)
                                                    <div class="flex items-center gap-2">
                                                        <span class="material-symbols-outlined text-secondary text-[16px]">
                                                            {{ $facility->icon ?: 'check_circle' }}
                                                        </span>

                                                        <span>{{ $facility->name }}</span>
                                                    </div>
                                                @empty
                                                    <span>Belum ada fasilitas terdaftar.</span>
                                                @endforelse

                                            </div>

                                            <p class="text-on-surface-variant font-body-sm text-body-sm">
                                                {{ $roomType->description }}
                                            </p>

                                        </div>
                                    </div>

                                    <div class="p-6 pt-0 flex items-center gap-3">

                                        <button
                                            class="flex-1 py-2.5 px-4 bg-primary-container text-on-primary hover:bg-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-colors text-center shadow-sm"
                                            onclick="openBookingDrawer(
                                                                                                                                                @js($roomType->name),
                                                                                                                                                @js($formattedPrice),
                                                                                                                                                @js($roomType->max_occupancy),
                                                                                                                                                @js($roomType->id)
                                                                                                                                            )">
                                            Pesan Sekarang
                                        </button>

                                        <button type="button"
                                            class="py-2.5 px-4 bg-surface-container-low hover:bg-surface-container text-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-colors"
                                            onclick="showRoomModal(
                                                                @js($roomType->name),
                                                                @js($imageUrl),
                                                                @js($roomType->facilities->map(fn($facility) => $facility->name)->values()),
                                                                @js($roomType->description),
                                                                @js($roomType->capacity_adults),
                                                                @js($roomType->capacity_children),
                                                                @js($roomType->room_size),
                                                                @js($roomType->bed_type),
                                                                @js($roomType->max_occupancy),
                                                                @js($roomType->id)
                                                            )">
                                            Detail Kamar
                                        </button>

                                    </div>

                                </article>

                            @empty

                                <div class="col-span-full text-center py-12">
                                    <p class="text-on-surface-variant">
                                        Belum ada kamar yang tersedia.
                                    </p>
                                </div>

                            @endforelse

                        </div>

                        <!-- CARD 1: Deluxe Ocean Cliff Villa -->

                        @foreach ($roomTypes as $roomType)
                            @php
                                $primaryImage = $roomType->images->firstWhere('is_primary', true)
                                    ?? $roomType->images->first();

                                $features = $roomType->facilities
                                    ->pluck('id')
                                    ->implode(',');
                            @endphp

                            <article
                                class="room-card bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_12px_32px_-4px_rgba(27,42,50,0.05)] hover:shadow-[0_20px_48px_-6px_rgba(27,42,50,0.1)] transition-all flex flex-col justify-between"
                                data-capacity="{{ $roomType->max_occupancy }}"
                                data-category="{{ strtolower($roomType->category->name ?? '') }}"
                                data-features="{{ $features }}" data-price="{{ $roomType->base_price }}">
                                <div class="flex flex-col">
                                    <div class="relative h-64 sm:h-72 w-full overflow-hidden bg-surface-container-high">
                                        @if ($primaryImage)
                                            <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                                src="{{ asset('storage/' . $primaryImage->image_path) }}"
                                                alt="{{ $primaryImage->caption ?? $roomType->name }}" />
                                        @endif

                                        <div
                                            class="absolute bottom-3 right-3 bg-primary/80 backdrop-blur text-on-primary px-3 py-1 rounded-full font-label-uppercase text-[10px] flex items-center gap-1">
                                            <span
                                                class="material-symbols-outlined text-[14px] text-secondary-fixed">photo_camera</span>
                                            {{ $roomType->images->count() }} Foto
                                        </div>
                                    </div>

                                    <div class="p-6 flex flex-col gap-4">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <span
                                                    class="font-label-uppercase text-[11px] text-secondary tracking-widest block">
                                                    {{ $roomType->category->name ?? 'Kamar Haven Palais' }}
                                                </span>
                                                <h3 class="font-headline-sm text-headline-sm text-primary">
                                                    {{ $roomType->name }}
                                                </h3>
                                            </div>

                                            <div class="text-right">
                                                <span
                                                    class="font-title-editorial text-title-editorial text-primary font-bold">
                                                    Rp {{ number_format($roomType->base_price, 0, ',', '.') }}
                                                </span>
                                                <span class="font-body-sm text-[12px] text-on-surface-variant block">
                                                    / malam
                                                </span>
                                            </div>
                                        </div>

                                        <div
                                            class="flex flex-wrap items-center gap-3 py-2 text-on-surface-variant font-label-uppercase text-[11px] bg-surface-container-low px-3 py-2 rounded-lg">
                                            <span class="flex items-center gap-1">
                                                <span
                                                    class="material-symbols-outlined text-[16px] text-primary">square_foot</span>
                                                {{ $roomType->room_size }} m²
                                            </span>

                                            <span class="text-outline-variant">•</span>

                                            <span class="flex items-center gap-1">
                                                <span
                                                    class="material-symbols-outlined text-[16px] text-primary">person</span>
                                                {{ $roomType->max_occupancy }} Tamu
                                            </span>

                                            <span class="text-outline-variant">•</span>

                                            <span class="flex items-center gap-1">
                                                <span
                                                    class="material-symbols-outlined text-[16px] text-primary">king_bed</span>
                                                {{ $roomType->bed_type }}
                                            </span>
                                        </div>

                                        <div
                                            class="flex flex-col gap-1.5 text-on-surface-variant font-body-sm text-body-sm">
                                            @foreach ($roomType->facilities as $facility)
                                                <div class="flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-secondary text-[16px]">
                                                        {{ $facility->icon ?: 'check_circle' }}
                                                    </span>
                                                    <span>{{ $facility->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 pt-0 flex items-center gap-3">
                                    <button
                                        class="flex-1 py-2.5 px-4 bg-primary-container text-on-primary hover:bg-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-colors text-center shadow-sm"
                                        onclick="openBookingDrawer(@js($roomType->name), @js('Rp ' . number_format($roomType->base_price, 0, ',', '.')))">
                                        Pesan Sekarang
                                    </button>

                                    <button
                                        class="py-2.5 px-4 bg-surface-container-low hover:bg-surface-container text-primary rounded font-label-uppercase text-label-uppercase tracking-wider transition-colors"
                                        onclick="showRoomModal(@js($roomType->name))">
                                        Detail Kamar
                                    </button>
                                </div>
                            </article>
                        @endforeach

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
                                href="tel:{{ preg_replace('/[^0-9+]/', '', $site->site_phone ?: '+62218800900') }}">
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
                        <span class="font-label-uppercase text-label-uppercase text-secondary tracking-widest">Detail
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
                        <div id="modal-room-facilities"
                            class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-body-sm text-on-surface-variant">
                        </div>
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="p-3 bg-surface-container-low rounded-lg">
                                <span class="text-on-surface-variant">Dewasa</span>
                                <p id="modal-room-adults" class="font-semibold text-primary">-</p>
                            </div>

                            <div class="p-3 bg-surface-container-low rounded-lg">
                                <span class="text-on-surface-variant">Anak-anak</span>
                                <p id="modal-room-children" class="font-semibold text-primary">-</p>
                            </div>

                            <div class="p-3 bg-surface-container-low rounded-lg">
                                <span class="text-on-surface-variant">Ukuran kamar</span>
                                <p id="modal-room-size" class="font-semibold text-primary">-</p>
                            </div>

                            <div class="p-3 bg-surface-container-low rounded-lg">
                                <span class="text-on-surface-variant">Tempat tidur</span>
                                <p id="modal-room-bed" class="font-semibold text-primary">-</p>
                            </div>
                        </div>

                        <p id="modal-room-description" class="text-sm text-on-surface-variant leading-relaxed"></p>
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
            @if (session('success'))
                <div id="booking-notification"
                    class="fixed top-24 right-6 z-[100] bg-green-100 text-green-800 p-4 rounded-lg shadow-lg transition-opacity duration-500">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div id="booking-notification"
                    class="fixed top-24 right-6 z-[100] bg-red-100 text-red-800 p-4 rounded-lg shadow-lg transition-opacity duration-500">
                    <strong>Booking gagal:</strong>
                    <ul class="list-disc pl-5 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div id="booking-notification"
                    class="fixed top-24 right-6 z-[100] bg-red-100 text-red-800 p-4 rounded-lg shadow-lg transition-opacity duration-500">
                    {{ session('error') }}
                </div>
            @endif
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

                        <form class="flex flex-col gap-4" action="{{ route('customer.booking.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="room_type_id" id="drawer-room-type-id">
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-uppercase text-label-uppercase text-on-surface-variant">Tanggal
                                    Check-In &amp; Check-Out</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <input id="drawer-check-in" name="check_in"
                                        class="w-full bg-surface-container-low text-primary p-2.5 rounded font-body-sm text-body-sm focus:outline-none"
                                        required type="date" />
                                    <input id="drawer-check-out" name="check_out"
                                        class="w-full bg-surface-container-low text-primary p-2.5 rounded font-body-sm text-body-sm focus:outline-none"
                                        required type="date" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-uppercase text-label-uppercase text-on-surface-variant">Jumlah
                                    Tamu</label>
                                <select id="drawer-guest-count" name="guests_count" required
                                    class="w-full bg-surface-container-low text-primary p-2.5 rounded font-body-sm text-body-sm focus:outline-none">
                                    <option value="">Pilih jumlah tamu</option>
                                </select>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="font-label-uppercase text-label-uppercase text-on-surface-variant">Nama
                                    Lengkap Tamu</label>
                                <input id="drawer-guest-name" name="guest_name"
                                    class="w-full bg-surface-container-low text-primary p-2.5 rounded font-body-sm text-body-sm focus:outline-none"
                                    placeholder="Contoh: Raden Surya" required type="text" />
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label
                                    class="font-label-uppercase text-label-uppercase text-on-surface-variant">Permintaan
                                    Khusus</label>
                                <textarea id="drawer-special-requests" name="special_requests"
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
                const features = (card.getAttribute('data-features') || '')
                    .split(',')
                    .filter(Boolean);

                const matchesAll = Array.from(activeQuickFilters)
                    .every(filter => features.includes(filter));

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
        function changeFeaturedPhoto(button) {
            const mainImage = document.getElementById('featured-main-img');
            const thumbnail = button.querySelector('img');

            if (!mainImage || !thumbnail) return;

            mainImage.style.opacity = '0.4';

            setTimeout(() => {
                mainImage.src = thumbnail.src;
                mainImage.alt = thumbnail.alt;
                mainImage.style.opacity = '1';
            }, 180);
        }
        let modalMaxOccupancy = 0;
        let modalRoomTypeId = null;
        // Room Modal Open / Close
        function showRoomModal(
            roomName,
            imageUrl,
            facilities,
            description,
            adults,
            children,
            roomSize,
            bedType,
            maxOccupancy,
            roomTypeId
        ) {
            modalMaxOccupancy = maxOccupancy;
            modalRoomTypeId = roomTypeId;
            document.getElementById('modal-room-title').innerText = roomName;
            document.getElementById('modal-room-img').src = imageUrl;

            const facilityContainer = document.getElementById('modal-room-facilities');
            facilityContainer.innerHTML = '';

            facilities.forEach(facility => {
                const item = document.createElement('div');
                item.className = 'flex items-center gap-2 p-2 bg-surface-container-low rounded';

                const icon = document.createElement('span');
                icon.className = 'material-symbols-outlined text-secondary text-[18px]';
                icon.textContent = 'verified';

                const text = document.createElement('span');
                text.textContent = facility;

                item.appendChild(icon);
                item.appendChild(text);
                facilityContainer.appendChild(item);
            });

            document.getElementById('modal-room-adults').textContent = adults + ' orang';
            document.getElementById('modal-room-children').textContent = children + ' orang';
            document.getElementById('modal-room-size').textContent = roomSize + ' m²';
            document.getElementById('modal-room-bed').textContent = bedType + ' Bed';
            document.getElementById('modal-room-description').textContent = description || 'Belum ada deskripsi.';

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

            openBookingDrawer(
                name,
                'Rp 3.500.000 - Rp 18.000.000',
                modalMaxOccupancy,
                modalRoomTypeId
            );
        }

        // Booking Drawer Slide
        function openBookingDrawer(suiteName, price, maxOccupancy, roomTypeId) {
            document.getElementById('drawer-suite-name').innerText = suiteName;
            document.getElementById('drawer-suite-price').innerText = price + ' / malam';

            // Simpan ID tipe kamar untuk dikirim ke Laravel
            document.getElementById('drawer-room-type-id').value = roomTypeId;

            const guestSelect = document.getElementById('drawer-guest-count');

            guestSelect.innerHTML = '<option value="">Pilih jumlah tamu</option>';

            for (let guests = 1; guests <= Number(maxOccupancy); guests++) {
                const option = document.createElement('option');
                option.value = guests;
                option.textContent = guests + ' Tamu';
                guestSelect.appendChild(option);
            }

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
        document.addEventListener('DOMContentLoaded', function () {
            const notification = document.getElementById('booking-notification');

            if (notification) {
                setTimeout(() => {
                    notification.classList.add('opacity-0');

                    setTimeout(() => {
                        notification.remove();
                    }, 500);
                }, 4000);
            }
        });
    </script>
    </main>
    </div>
</body>

</html>