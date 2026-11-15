<!DOCTYPE html>

<html lang="id">
@extends('frontend.layouts.app')

@section('title', 'Reservasi')

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
                <div class="w-full max-w-[1320px] mx-auto px-6 lg:px-12 py-10 lg:py-16">
                    <!-- Breadcrumb & Top Indicator -->
                    <nav class="flex items-center gap-2 mb-8 font-label-md text-label-md text-on-surface-variant/80">
                        <a class="hover:text-primary transition-colors" href="#">Home</a>
                        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                        <a class="hover:text-primary transition-colors" href="#">Kamar &amp; Suites</a>
                        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                        <span class="text-primary font-semibold">Reservasi &amp; Pembayaran</span>
                    </nav>
                    <!-- Page Title & Atmosphere Intro -->
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
                        <div>
                            <span
                                class="font-label-uppercase text-label-uppercase text-secondary tracking-widest uppercase block mb-2">Haven
                                Palais Resort &amp; Spa</span>
                            <h1 class="font-headline-lg text-headline-lg text-primary leading-tight">Konfirmasi
                                Pemesanan</h1>
                        </div>
                        <div
                            class="flex items-center gap-2 bg-surface-container px-4 py-2 rounded-full self-start md:self-auto">
                            <span class="material-symbols-outlined text-[18px] text-secondary">verified_user</span>
                            <span class="font-label-uppercase text-label-uppercase text-on-surface-variant">Best Rate
                                Guaranteed • Enkripsi Bank 256-Bit</span>
                        </div>
                    </div>
                    <!-- Stepper Progress Indicator -->
                    <div class="bg-surface-container-low rounded-xl p-6 lg:p-8 mb-14 shadow-sm">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative">
                            <!-- Step 1: Completed -->
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center shrink-0 shadow-sm">
                                    <span class="material-symbols-outlined text-[20px]">check</span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="font-label-uppercase text-[11px] text-on-surface-variant/70 uppercase">Langkah
                                        1</span>
                                    <span class="font-label-md text-label-md font-semibold text-primary">Detail &amp;
                                        Tanggal</span>
                                </div>
                            </div>
                            <!-- Step 2: Active -->
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-secondary text-on-secondary flex items-center justify-center shrink-0 shadow-md">
                                    <span class="font-label-md font-bold">2</span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="font-label-uppercase text-[11px] text-secondary uppercase font-bold">Langkah
                                        2 • Aktif</span>
                                    <span class="font-label-md text-label-md font-bold text-primary">Data Diri
                                        Tamu</span>
                                </div>
                            </div>
                            <!-- Step 3: In Progress -->
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center shrink-0">
                                    <span class="font-label-md font-bold">3</span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="font-label-uppercase text-[11px] text-on-surface-variant/70 uppercase">Langkah
                                        3</span>
                                    <span class="font-label-md text-label-md text-on-surface-variant">Metode
                                        Pembayaran</span>
                                </div>
                            </div>
                            <!-- Step 4: Pending -->
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-surface-container text-on-surface-variant/50 flex items-center justify-center shrink-0">
                                    <span class="font-label-md font-bold">4</span>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="font-label-uppercase text-[11px] text-on-surface-variant/50 uppercase">Langkah
                                        4</span>
                                    <span class="font-label-md text-label-md text-on-surface-variant/60">Tiket &amp;
                                        Konfirmasi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main Content Layout (Split Columns) -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                        <!-- LEFT COLUMN: Booking Form Flow -->
                        <div class="lg:col-span-7 flex flex-col gap-10">
                            <!-- Privilege Member Invitation Card -->
@guest
<div
    class="bg-primary-container text-on-primary p-6 lg:p-7 rounded-xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 shadow-sm">
    <div class="flex items-start gap-4">
        <div
            class="w-11 h-11 rounded-lg bg-surface-container-lowest/10 flex items-center justify-center shrink-0 text-secondary-fixed">
            <span class="material-symbols-outlined text-[24px]">stars</span>
        </div>
        <div>
            <h2 class="font-title-editorial text-title-editorial text-surface-container-lowest">
                Haven Privilege Member
            </h2>
            <p class="font-body-sm text-body-sm text-surface-container-highest/80 mt-1">
                Masuk untuk menikmati <span class="text-secondary-fixed">complimentary
                    private limousine airport transfer</span> dan 4.500 poin reward
                menginap.
            </p>
        </div>
    </div>
    <a href="/login"
        class="shrink-0 px-5 py-2.5 bg-secondary-fixed text-on-secondary-fixed font-label-uppercase text-label-uppercase rounded hover:bg-secondary-fixed-dim transition-colors uppercase tracking-wider inline-flex items-center justify-center">
        Masuk Akun
    </a>
</div>
@endguest
                            <!-- Section A: Data Tamu -->
                            <section
                                class="bg-surface-container-lowest p-8 lg:p-10 rounded-xl shadow-sm flex flex-col gap-8">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="w-8 h-8 rounded-full bg-surface-container-low text-primary flex items-center justify-center font-bold text-sm">A</span>
                                        <h2 class="font-headline-sm text-headline-sm text-primary">Informasi Tamu
                                            Menginap</h2>
                                    </div>
                                    <span
                                        class="font-label-uppercase text-[11px] text-secondary tracking-widest uppercase">Identitas
                                        Resmi</span>
                                </div>
                                @if ($errors->any())
                                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
<form id="reservation-form"
    action="{{ route('customer.booking.store') }}"
    method="POST"
    class="grid grid-cols-1 md:grid-cols-2 gap-6">

    @csrf

    <!-- Tipe Kamar -->
    <div class="flex flex-col gap-2 md:col-span-2">
        <label class="font-label-uppercase text-label-uppercase text-on-surface-variant">
            Tipe Kamar
        </label>

        <select
            name="room_type_id"
            id="room_type_id"
            class="h-12 px-4 rounded bg-surface-container-low text-on-surface font-body-md focus:outline-none"
            required
        >
            <option value="">Pilih tipe kamar</option>

@foreach ($roomTypes as $roomType)
    @php
        $roomImage = $roomType->images->firstWhere('is_primary', true)
            ?? $roomType->images->first();
    @endphp

    <option
        value="{{ $roomType->id }}"
        data-max-occupancy="{{ $roomType->max_occupancy }}"
        data-price="{{ $roomType->base_price }}"
        data-image="{{ $roomImage ? asset('storage/' . $roomImage->image_path) : '' }}"
        {{ old('room_type_id') == $roomType->id ? 'selected' : '' }}
    >
        {{ $roomType->name }}
    </option>
@endforeach
        </select>
    </div>

    <!-- Tanggal Check-In -->
    <div class="flex flex-col gap-2">
        <label class="font-label-uppercase text-label-uppercase text-on-surface-variant">
            Tanggal Check-In
        </label>

<input
    type="date"
    name="check_in"
    id="check_in"
    value="{{ old('check_in') }}"
            min="{{ date('Y-m-d') }}"
            class="h-12 px-4 rounded bg-surface-container-low text-on-surface font-body-md focus:outline-none"
            required
        >
    </div>

    <!-- Tanggal Check-Out -->
    <div class="flex flex-col gap-2">
        <label class="font-label-uppercase text-label-uppercase text-on-surface-variant">
            Tanggal Check-Out
        </label>

<input
    type="date"
    name="check_out"
    id="check_out"
    value="{{ old('check_out') }}"
            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
            class="h-12 px-4 rounded bg-surface-container-low text-on-surface font-body-md focus:outline-none"
            required
        >
    </div>

    <!-- Jumlah Tamu -->
    <div class="flex flex-col gap-2">
        <label class="font-label-uppercase text-label-uppercase text-on-surface-variant">
            Jumlah Tamu
        </label>

        <input
            type="number"
            name="guests_count"
            id="guests_count"
            min="1"
            value="{{ old('guests_count', 1) }}"
            class="h-12 px-4 rounded bg-surface-container-low text-on-surface font-body-md focus:outline-none"
            required
            disabled
        >
        <span class="text-xs text-on-surface-variant" id="guest-limit-info">
            Pilih tipe kamar terlebih dahulu.
        </span>
    </div>

    <!-- Nama Lengkap -->
    <div class="flex flex-col gap-2">
        <label class="font-label-uppercase text-label-uppercase text-on-surface-variant">
            Nama Lengkap Tamu
        </label>

        <input
            type="text"
            name="guest_name"
            value="{{ old('guest_name', auth()->user()->name ?? '') }}"
            class="h-12 px-4 rounded bg-surface-container-low text-on-surface font-body-md focus:outline-none"
            required
        >
    </div>

    <!-- Permintaan Khusus -->
    <div class="flex flex-col gap-2 md:col-span-2">
        <label class="font-label-uppercase text-label-uppercase text-on-surface-variant">
            Permintaan Khusus
        </label>

        <textarea
            name="special_requests"
            rows="3"
            class="p-4 rounded bg-surface-container-low text-on-surface font-body-md focus:outline-none resize-none"
            placeholder="Tuliskan permintaan khusus Anda"
        >{{ old('special_requests') }}</textarea>
    </div>

</form>
                            </section>
                            <!-- Section B: Metode Pembayaran -->
                            <section
                                class="bg-surface-container-lowest p-8 lg:p-10 rounded-xl shadow-sm flex flex-col gap-8">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="w-8 h-8 rounded-full bg-surface-container-low text-primary flex items-center justify-center font-bold text-sm">B</span>
                                        <h2 class="font-headline-sm text-headline-sm text-primary">Metode Pembayaran
                                            Aman</h2>
                                    </div>
                                    <span
                                        class="font-label-uppercase text-[11px] text-secondary tracking-widest uppercase">Garansi
                                        Tanpa Biaya Tersembunyi</span>
                                </div>
                                <!-- Tabs Pilihan Pembayaran -->
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <button
                                        class="p-4 rounded-lg bg-surface-container text-primary flex flex-col items-center gap-2 text-center transition-all shadow-sm"
                                        type="button">
                                        <span
                                            class="material-symbols-outlined text-[24px] text-secondary">credit_card</span>
                                        <span class="font-label-uppercase text-label-uppercase font-bold">Kartu Kredit /
                                            Debit</span>
                                        <span class="font-body-sm text-[11px] text-on-surface-variant">Visa, Master,
                                            AMEX, JCB</span>
                                    </button>
                                    <button
                                        class="p-4 rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface-variant flex flex-col items-center gap-2 text-center transition-all"
                                        type="button">
                                        <span class="material-symbols-outlined text-[24px]">account_balance</span>
                                        <span class="font-label-uppercase text-label-uppercase">Transfer Bank
                                            Prioritas</span>
                                        <span class="font-body-sm text-[11px] text-on-surface-variant">BCA Prioritas,
                                            Mandiri, BNI</span>
                                    </button>
                                    <button
                                        class="p-4 rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface-variant flex flex-col items-center gap-2 text-center transition-all"
                                        type="button">
                                        <span class="material-symbols-outlined text-[24px]">qr_code_2</span>
                                        <span class="font-label-uppercase text-label-uppercase">QRIS Luxury &amp;
                                            Wallets</span>
                                        <span class="font-body-sm text-[11px] text-on-surface-variant">BCA Mobile,
                                            Gopay, Livin</span>
                                    </button>
                                </div>
                                <!-- Card Input Form -->
                                <div class="bg-surface-container-low p-6 rounded-lg flex flex-col gap-5">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="font-label-uppercase text-label-uppercase text-primary font-bold">Kartu
                                                Kredit Prioritas Internasional</span>
                                            <span
                                                class="bg-secondary-fixed/50 text-on-secondary-container px-2 py-0.5 rounded font-label-uppercase text-[10px]">0%
                                                Cicilan 3-6 Bulan</span>
                                        </div>
                                        <div class="flex items-center gap-2 opacity-75">
                                            <span
                                                class="font-label-uppercase text-[11px] font-bold tracking-tighter text-primary">AMEX</span>
                                            <span
                                                class="font-label-uppercase text-[11px] font-bold tracking-tighter text-primary">VISA</span>
                                            <span
                                                class="font-label-uppercase text-[11px] font-bold tracking-tighter text-primary">MASTERCARD</span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="md:col-span-2 flex flex-col gap-2">
                                            <label class="font-label-uppercase text-[11px] text-on-surface-variant">Nama
                                                Tertera pada Kartu</label>
                                            <input
                                                class="h-12 px-4 rounded bg-surface-container-lowest text-on-surface font-body-md focus:outline-none"
                                                type="text" />
                                        </div>
                                        <div class="md:col-span-2 flex flex-col gap-2">
                                            <label
                                                class="font-label-uppercase text-[11px] text-on-surface-variant">Nomor
                                                Kartu Kredit</label>
                                            <div class="relative">
                                                <input
                                                    class="h-12 pl-4 pr-12 w-full rounded bg-surface-container-lowest text-on-surface font-body-md focus:outline-none tracking-widest"
                                                    type="text" />
                                                <span
                                                    class="material-symbols-outlined absolute right-3 top-3 text-[22px] text-secondary">credit_card</span>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label class="font-label-uppercase text-[11px] text-on-surface-variant">Masa
                                                Berlaku (BB/TT)</label>
                                            <input
                                                class="h-12 px-4 rounded bg-surface-container-lowest text-on-surface font-body-md focus:outline-none text-center"
                                                type="text" />
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <div class="flex items-center justify-between">
                                                <label
                                                    class="font-label-uppercase text-[11px] text-on-surface-variant">Kode
                                                    Keamanan CVV</label>
                                                <span
                                                    class="font-label-uppercase text-[10px] text-secondary flex items-center gap-1 cursor-pointer">
                                                    <span
                                                        class="material-symbols-outlined text-[13px]">help_outline</span>
                                                    3 Digit Belakang
                                                </span>
                                            </div>
                                            <input
                                                class="h-12 px-4 rounded bg-surface-container-lowest text-on-surface font-body-md focus:outline-none text-center tracking-widest"
                                                type="password"  />
                                        </div>
                                    </div>
                                </div>
                                <!-- Trust Badges -->
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                                    <div class="flex items-start gap-3 p-3 rounded bg-surface-container-low">
                                        <span
                                            class="material-symbols-outlined text-secondary text-[20px] shrink-0">lock</span>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-label-uppercase text-[11px] font-bold text-primary">Transparansi
                                                Finansial</span>
                                            <span class="font-body-sm text-[12px] text-on-surface-variant">Data diproses
                                                terenkripsi SSL 256-Bit</span>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 p-3 rounded bg-surface-container-low">
                                        <span
                                            class="material-symbols-outlined text-secondary text-[20px] shrink-0">event_repeat</span>
                                        <div class="flex flex-col">
                                            <span class="font-label-uppercase text-[11px] font-bold text-primary">Bebas
                                                Pembatalan</span>
                                            <span class="font-body-sm text-[12px] text-on-surface-variant">Hingga 7 hari
                                                sebelum waktu check-in</span>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 p-3 rounded bg-surface-container-low">
                                        <span
                                            class="material-symbols-outlined text-secondary text-[20px] shrink-0">spa</span>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-label-uppercase text-[11px] font-bold text-primary">Layanan
                                                Butler</span>
                                            <span class="font-body-sm text-[12px] text-on-surface-variant">Dukungan staf
                                                pribadi 24 jam nonstop</span>
                                        </div>
                                    </div>
                                </div>
                            </section>
<section class="pt-2">
    <button
        class="w-full h-14 bg-primary hover:bg-primary-container text-on-primary font-label-uppercase text-label-uppercase uppercase tracking-widest rounded flex items-center justify-center gap-3 shadow-md transition-all"
        type="submit"
        form="reservation-form">
        <span>Konfirmasi &amp; Bayar Sekarang</span>
        <span class="material-symbols-outlined text-[18px]">lock</span>
    </button>
</section>
                        </div>
                        <!-- RIGHT COLUMN: Sticky Luxury Booking Summary -->
                        <aside class="lg:col-span-5 sticky top-28 flex flex-col gap-6">
                            <div class="bg-surface-container-lowest rounded-xl shadow-md overflow-hidden">
                                <!-- Room Preview Imagery -->
                                <div class="relative h-64 w-full overflow-hidden">
<img
    id="summary-room-image"
    class="w-full h-full object-cover"
    data-alt="Expansive panoramic view of the Royal Ocean Penthouse Villa at Haven Palais in Bali."
    src="https://lh3.googleusercontent.com/aida-public/AB6AXuChD-CI615rUws995-69h1TkY_M2aDhe_CiYJw0Jr7_8B60FbBFxlg_xjxzAOmRmgVkCrPYBXIlMl0nU3TUzOx55VkuI1IBzIm9csX6a3q_6V1yoW04GXCxJ44fJAbJ9h8d4qpw06rFAGecngmYldxv6qKzcn38GzKpb-f3XZKw3z4vATlTE66R9GwzXsQOdms562k-4-408gvn5-T2HmkvVC9Ylx5r3xJb7KC9VeY"
/>
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute bottom-4 left-6 right-6 flex items-end justify-between">
                                        <div>
                                            <span
                                                class="px-2.5 py-1 bg-surface-container-lowest/90 backdrop-blur-md rounded text-primary font-label-uppercase text-[10px] tracking-wider font-bold uppercase inline-block mb-1.5">Penawaran
                                                Eksklusif</span>
<h3 id="summary-room-name" class="font-headline-sm text-headline-sm text-on-primary">
    Pilih Tipe Kamar
</h3>
                                        </div>
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary-fixed font-bold tracking-wider">320
                                            m²</span>
                                    </div>
                                </div>
                                <!-- Stay Core Specs -->
                                <div class="p-6 lg:p-7 flex flex-col gap-6">
                                    <div
                                        class="grid grid-cols-2 gap-4 pb-6 bg-surface-container-low/50 -mx-6 -mt-6 p-6">
                                        <div>
                                            <span
                                                class="font-label-uppercase text-[10px] text-on-surface-variant block uppercase">Jadwal
                                                Menginap</span>
<span id="summary-dates" class="font-label-md text-label-md font-bold text-primary">
    Belum dipilih
</span>
<span id="summary-nights" class="font-body-sm text-[12px] text-on-surface-variant block mt-0.5">
    0 Malam Menginap
</span>
                                        </div>
                                        <div>
                                            <span
                                                class="font-label-uppercase text-[10px] text-on-surface-variant block uppercase">Kapasitas
                                                Tamu</span>
<span id="summary-guests" class="font-label-md text-label-md font-bold text-primary">
    1 Tamu
</span>
                                            <span
                                                class="font-body-sm text-[12px] text-on-surface-variant block mt-0.5">1
                                                King Bed Sanctuary</span>
                                        </div>
                                    </div>
                                    <!-- Inclusive Amenities -->
                                    <div class="flex flex-col gap-3">
                                        <span
                                            class="font-label-uppercase text-label-uppercase text-secondary tracking-widest uppercase">Keistimewaan
                                            Inklusif Suite</span>
                                        <ul class="flex flex-col gap-2.5 font-body-sm text-body-sm text-on-surface">
                                            <li class="flex items-center gap-3">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">wine_bar</span>
                                                <span>Sarapan Champagne Harian di Teras Villa / Bed</span>
                                            </li>
                                            <li class="flex items-center gap-3">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">room_service</span>
                                                <span>Layanan Butler Pribadi 24 Jam Nonstop</span>
                                            </li>
                                            <li class="flex items-center gap-3">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">flight_land</span>
                                                <span>Antar-Jemput Limusin Mewah / Helipad Bandara DPS</span>
                                            </li>
                                            <li class="flex items-center gap-3">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary">deck</span>
                                                <span>Akses VIP Tanpa Batas ke Haven Private Beach Club</span>
                                            </li>
                                        </ul>
                                    </div>

<!-- Price Breakdown Calculation -->
<div class="pt-6 flex flex-col gap-3">
    <span class="font-label-uppercase text-label-uppercase text-on-surface-variant tracking-wider uppercase">
        Rincian Tarif Transparan
    </span>

    <div class="flex justify-between items-center font-body-sm text-body-sm text-on-surface-variant">
        <span>Harga per Malam</span>
        <span id="summary-price" class="font-label-md font-semibold text-primary">
            Rp 0
        </span>
    </div>

    <div class="flex justify-between items-center font-body-sm text-body-sm text-on-surface-variant">
        <span id="summary-calculation">0 Malam × Rp 0</span>
        <span id="summary-subtotal" class="font-label-md font-semibold text-primary">
            Rp 0
        </span>
    </div>

    <div class="p-4 bg-surface-container rounded-lg flex items-center justify-between mt-2">
        <div>
            <span class="font-label-uppercase text-[11px] uppercase tracking-wider text-on-surface-variant block">
                Total Pembayaran
            </span>
            <span class="font-body-sm text-[11px] text-on-surface-variant">
                Berdasarkan lama menginap
            </span>
        </div>

        <span id="summary-total" class="font-headline-sm text-headline-sm text-primary">
            Rp 0
        </span>
    </div>
</div>
                                </div>
                            </div>
                            <!-- VIP Direct Concierge Help Box -->
                            <div class="bg-surface-container p-6 rounded-xl flex items-center gap-4 shadow-sm">
                                <div
                                    class="w-12 h-12 rounded-full bg-surface-container-lowest flex items-center justify-center shrink-0 shadow-sm">
                                    <span
                                        class="material-symbols-outlined text-secondary text-[24px]">support_agent</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-title-editorial text-title-editorial text-primary">Butuh Asistensi
                                        Khusus?</h4>
                                    <p class="font-body-sm text-[13px] text-on-surface-variant mt-0.5">Tim reservasi dan
                                        Concierge Kepala siap membantu preferensi Anda via WhatsApp 24/7.</p>
                                    <a class="font-label-uppercase text-[11px] text-primary hover:text-secondary font-bold tracking-widest mt-2 inline-flex items-center gap-1.5 transition-colors"
                                        href="https://wa.me/623618800900" target="_blank">
                                        <span>+62 361 8800 900</span>
                                        <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </main>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const roomTypeSelect = document.getElementById('room_type_id');
    const guestsInput = document.getElementById('guests_count');
    const guestLimitInfo = document.getElementById('guest-limit-info');

    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(number);
    };

    function updateSummary() {
        const option = roomTypeSelect.options[roomTypeSelect.selectedIndex];

        const roomName = option.value ? option.text.trim() : 'Pilih Tipe Kamar';
        const price = parseFloat(option.dataset.price) || 0;
        const image = option.dataset.image;
const roomImage = document.getElementById('summary-room-image');

if (image) {
    roomImage.src = image;
}

        const checkIn = checkInInput.value;
        const checkOut = checkOutInput.value;

        let nights = 0;

        if (checkIn && checkOut) {
            const start = new Date(checkIn + 'T00:00:00');
            const end = new Date(checkOut + 'T00:00:00');

            nights = Math.round((end - start) / (1000 * 60 * 60 * 24));

            if (nights < 0) nights = 0;
        }

        const guests = guestsInput.value || 1;
        const subtotal = price * nights;

        document.getElementById('summary-room-name').textContent = roomName;
        document.getElementById('summary-dates').textContent =
            checkIn && checkOut ? `${checkIn} – ${checkOut}` : 'Belum dipilih';

        document.getElementById('summary-nights').textContent =
            `${nights} Malam Menginap`;

        document.getElementById('summary-guests').textContent =
            `${guests} Tamu`;

        document.getElementById('summary-price').textContent = formatRupiah(price);
        document.getElementById('summary-calculation').textContent =
            `${nights} Malam × ${formatRupiah(price)}`;

        document.getElementById('summary-subtotal').textContent = formatRupiah(subtotal);
        document.getElementById('summary-total').textContent = formatRupiah(subtotal);
    }

    function updateGuestLimit() {
        const option = roomTypeSelect.options[roomTypeSelect.selectedIndex];
        const maxOccupancy = parseInt(option.dataset.maxOccupancy);

        if (!maxOccupancy || isNaN(maxOccupancy)) {
            guestsInput.disabled = true;
            guestsInput.value = 1;
            guestsInput.removeAttribute('max');
            guestLimitInfo.textContent = 'Pilih tipe kamar terlebih dahulu.';
        } else {
            guestsInput.disabled = false;
            guestsInput.max = maxOccupancy;

            if (parseInt(guestsInput.value) > maxOccupancy) {
                guestsInput.value = maxOccupancy;
            }

            if (!guestsInput.value || parseInt(guestsInput.value) < 1) {
                guestsInput.value = 1;
            }

            guestLimitInfo.textContent =
                `Maksimal ${maxOccupancy} tamu untuk tipe kamar ini.`;
        }

        updateSummary();
    }

    roomTypeSelect.addEventListener('change', updateGuestLimit);
    guestsInput.addEventListener('input', updateSummary);
    checkInInput.addEventListener('change', updateSummary);
    checkOutInput.addEventListener('change', updateSummary);

    updateGuestLimit();
});
</script>

</html>