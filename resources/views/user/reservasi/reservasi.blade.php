<!DOCTYPE html>

<html lang="id">
@extends('user.layouts.app')

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
<<<<<<< HEAD:resources/views/user/reservasi/reservasi.blade.php
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
                    <nav class="hidden lg:flex items-center gap-6" data-active-classes="text-primary font-semibold"><a
                            class="font-label-md text-label-md text-on-surface-variant hover:text-on-surface transition-colors"
                            data-path="tentang-kami" href="/">Tentang Kami</a></nav>
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
>>>>>>> 47ac69b (backend finish):resources/views/frontend/reservasi/reservasi.blade.php
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
                            <div
                                class="bg-primary-container text-on-primary p-6 lg:p-7 rounded-xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 shadow-sm">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-11 h-11 rounded-lg bg-surface-container-lowest/10 flex items-center justify-center shrink-0 text-secondary-fixed">
                                        <span class="material-symbols-outlined text-[24px]">stars</span>
                                    </div>
                                    <div>
                                        <h2
                                            class="font-title-editorial text-title-editorial text-surface-container-lowest">
                                            Haven Privilege Member</h2>
                                        <p class="font-body-sm text-body-sm text-surface-container-highest/80 mt-1">
                                            Masuk untuk menikmati <span class="text-secondary-fixed">complimentary
                                                private limousine airport transfer</span> dan 4.500 poin reward
                                            menginap.</p>
                                    </div>
                                </div>
                                <a href="/login"
                                    class="shrink-0 px-5 py-2.5 bg-secondary-fixed text-on-secondary-fixed font-label-uppercase text-label-uppercase rounded hover:bg-secondary-fixed-dim transition-colors uppercase tracking-wider inline-flex items-center justify-center">
                                    Masuk Akun
                                </a>
                            </div>
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
                                <form class="grid grid-cols-1 md:grid-cols-2 gap-6" onsubmit="event.preventDefault();">
                                    <!-- Title / Sapaan -->
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="font-label-uppercase text-label-uppercase text-on-surface-variant">Gelar
                                            Tamu</label>
                                        <select
                                            class="h-12 px-4 rounded bg-surface-container-low text-on-surface font-body-md focus:outline-none focus:bg-surface-container transition-colors">
                                            <option value="Bpk">Bpk. (Mr.)</option>
                                            <option value="Ibu">Ibu (Mrs. / Ms.)</option>
                                            <option value="Dr">Dr. / Prof.</option>
                                        </select>
                                    </div>
                                    <!-- Full Name -->
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="font-label-uppercase text-label-uppercase text-on-surface-variant">Nama
                                            Lengkap (Sesuai Paspor / KTP)</label>
                                        <input
                                            class="h-12 px-4 rounded bg-surface-container-low text-on-surface font-body-md focus:outline-none focus:bg-surface-container transition-colors"
                                            type="text" value="Raden Aria Wirasubrata" />
                                    </div>
                                    <!-- Email Address -->
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="font-label-uppercase text-label-uppercase text-on-surface-variant">Alamat
                                            Email Konfirmasi</label>
                                        <input
                                            class="h-12 px-4 rounded bg-surface-container-low text-on-surface font-body-md focus:outline-none focus:bg-surface-container transition-colors"
                                            type="email" value="aria.wirasubrata@havenpalais.com" />
                                    </div>
                                    <!-- WhatsApp / Phone -->
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="font-label-uppercase text-label-uppercase text-on-surface-variant">Nomor
                                            WhatsApp / Seluler</label>
                                        <div class="flex">
                                            <span
                                                class="h-12 px-3.5 bg-surface-container flex items-center font-label-md text-on-surface-variant rounded-l">+62</span>
                                            <input
                                                class="h-12 px-4 w-full rounded-r bg-surface-container-low text-on-surface font-body-md focus:outline-none focus:bg-surface-container transition-colors"
                                                type="tel" value="811-9820-4401" />
                                        </div>
                                    </div>
                                    <!-- Nationality -->
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="font-label-uppercase text-label-uppercase text-on-surface-variant">Kewarganegaraan</label>
                                        <select
                                            class="h-12 px-4 rounded bg-surface-container-low text-on-surface font-body-md focus:outline-none focus:bg-surface-container transition-colors">
                                            <option selected="" value="ID">Indonesia (WNI)</option>
                                            <option value="SG">Singapura</option>
                                            <option value="AU">Australia</option>
                                            <option value="UK">United Kingdom</option>
                                            <option value="US">United States</option>
                                        </select>
                                    </div>
                                    <!-- Arrival Time -->
                                    <div class="flex flex-col gap-2">
                                        <label
                                            class="font-label-uppercase text-label-uppercase text-on-surface-variant">Perkiraan
                                            Waktu Tiba (Check-In)</label>
                                        <select
                                            class="h-12 px-4 rounded bg-surface-container-low text-on-surface font-body-md focus:outline-none focus:bg-surface-container transition-colors">
                                            <option value="14:00">14:00 - 15:00 WITA (Waktu Standar)</option>
                                            <option value="15:00">15:00 - 17:00 WITA</option>
                                            <option value="17:00">17:00 - 20:00 WITA (Evening Arrival)</option>
                                            <option selected="" value="early">Early Check-in Priority (11:30 WITA)
                                            </option>
                                        </select>
                                    </div>
                                    <!-- Special Requests -->
                                    <div class="flex flex-col gap-2 md:col-span-2">
                                        <div class="flex items-center justify-between">
                                            <label
                                                class="font-label-uppercase text-label-uppercase text-on-surface-variant">Permintaan
                                                Khusus &amp; Preferensi Butler</label>
                                            <span
                                                class="font-label-uppercase text-[10px] text-on-surface-variant/70">Opsional</span>
                                        </div>
                                        <textarea
                                            class="p-4 rounded bg-surface-container-low text-on-surface font-body-md focus:outline-none focus:bg-surface-container transition-colors resize-none"
                                            placeholder="Contoh: Pengaturan bunga segar peringatan pernikahan di kamar tidur utama, alergi kacang/seafood, kamar di lantai tertinggi, non-smoking, bantal hypoallergenic."
                                            rows="3">Anniversary setup dengan champagne di teras infinity pool saat kedatangan. Tamu vegetarian untuk sarapan pagi.</textarea>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            <span
                                                class="px-2.5 py-1 rounded bg-surface-container text-primary font-label-uppercase text-[10px] cursor-pointer hover:bg-surface-variant">High
                                                Floor Suite</span>
                                            <span
                                                class="px-2.5 py-1 rounded bg-surface-container text-primary font-label-uppercase text-[10px] cursor-pointer hover:bg-surface-variant">Late
                                                Check-Out VIP</span>
                                            <span
                                                class="px-2.5 py-1 rounded bg-surface-container text-primary font-label-uppercase text-[10px] cursor-pointer hover:bg-surface-variant">Bantal
                                                Bulu Angsa Ekstra</span>
                                            <span
                                                class="px-2.5 py-1 rounded bg-surface-container text-primary font-label-uppercase text-[10px] cursor-pointer hover:bg-surface-variant">Silent
                                                Air-Con Mode</span>
                                        </div>
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
                                                type="text" value="RADEN ARIA WIRASUBRATA" />
                                        </div>
                                        <div class="md:col-span-2 flex flex-col gap-2">
                                            <label
                                                class="font-label-uppercase text-[11px] text-on-surface-variant">Nomor
                                                Kartu Kredit</label>
                                            <div class="relative">
                                                <input
                                                    class="h-12 pl-4 pr-12 w-full rounded bg-surface-container-lowest text-on-surface font-body-md focus:outline-none tracking-widest"
                                                    type="text" value="•••• •••• •••• 8829" />
                                                <span
                                                    class="material-symbols-outlined absolute right-3 top-3 text-[22px] text-secondary">credit_card</span>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label class="font-label-uppercase text-[11px] text-on-surface-variant">Masa
                                                Berlaku (BB/TT)</label>
                                            <input
                                                class="h-12 px-4 rounded bg-surface-container-lowest text-on-surface font-body-md focus:outline-none text-center"
                                                type="text" value="09 / 28" />
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
                                                type="password" value="•••" />
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
                            <!-- Section C: Konfirmasi & Voucher Tiket Resmi -->
                            <section
                                class="bg-surface-container-lowest p-8 lg:p-10 rounded-xl shadow-sm flex flex-col gap-8">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="w-8 h-8 rounded-full bg-surface-container-low text-primary flex items-center justify-center font-bold text-sm">C</span>
                                        <h2 class="font-headline-sm text-headline-sm text-primary">Kode Booking Resmi
                                            &amp; Tiket</h2>
                                    </div>
                                    <span
                                        class="px-3 py-1 rounded bg-secondary-fixed/50 text-on-secondary-container font-label-uppercase text-[11px] font-bold">Siap
                                        Konfirmasi</span>
                                </div>
                                <!-- Luxury Official Ticket Card -->
                                <div
                                    class="bg-primary text-on-primary rounded-xl p-8 relative overflow-hidden shadow-lg">
                                    <!-- Background Decorative Watermark -->
                                    <div class="absolute -right-12 -bottom-12 opacity-5 pointer-events-none">
                                        <span class="material-symbols-outlined text-[240px]">apartment</span>
                                    </div>
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6">
                                        <div>
                                            <span
                                                class="font-label-uppercase text-secondary-fixed text-[11px] tracking-widest uppercase block mb-1">Haven
                                                Palais Luxury Electronic Voucher</span>
                                            <h3 class="font-headline-md text-headline-md text-surface-container-lowest">
                                                #HVP-BALI-882914</h3>
                                            <p class="font-body-sm text-surface-container-high/80 text-sm mt-1">Status:
                                                <span class="text-secondary-fixed font-semibold">Terkonfirmasi Sementara
                                                    (Hold 45 Menit)</span>
                                            </p>
                                        </div>
                                        <!-- Barcode & Copy Button -->
                                        <div
                                            class="flex flex-col sm:flex-row items-start sm:items-center gap-3 shrink-0">
                                            <div
                                                class="bg-surface-container-lowest p-2.5 rounded-lg flex items-center justify-center">
                                                <!-- SVG Elegant QR Placeholder -->
                                                <svg class="text-primary" fill="none" height="60" viewbox="0 0 60 60"
                                                    width="60">
                                                    <rect fill="none" height="20" rx="3" stroke="currentColor"
                                                        stroke-width="3" width="20" x="4" y="4"></rect>
                                                    <rect fill="currentColor" height="10" width="10" x="9" y="9"></rect>
                                                    <rect fill="none" height="20" rx="3" stroke="currentColor"
                                                        stroke-width="3" width="20" x="36" y="4"></rect>
                                                    <rect fill="currentColor" height="10" width="10" x="41" y="9">
                                                    </rect>
                                                    <rect fill="none" height="20" rx="3" stroke="currentColor"
                                                        stroke-width="3" width="20" x="4" y="36"></rect>
                                                    <rect fill="currentColor" height="10" width="10" x="9" y="41">
                                                    </rect>
                                                    <rect fill="currentColor" height="6" width="6" x="30" y="30"></rect>
                                                    <rect fill="currentColor" height="12" width="5" x="42" y="32">
                                                    </rect>
                                                    <rect fill="currentColor" height="6" width="14" x="32" y="46">
                                                    </rect>
                                                    <rect fill="currentColor" height="8" width="8" x="48" y="46"></rect>
                                                </svg>
                                            </div>
                                            <button
                                                class="px-4 py-2.5 rounded bg-surface-container-lowest/15 hover:bg-surface-container-lowest/25 text-surface-container-lowest font-label-uppercase text-[11px] uppercase tracking-wider flex items-center gap-2 transition-colors"
                                                onclick="navigator.clipboard?.writeText('#HVP-BALI-882914'); alert('Kode booking #HVP-BALI-882914 berhasil disalin');"
                                                type="button">
                                                <span class="material-symbols-outlined text-[16px]">content_copy</span>
                                                Salin Kode
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Ticket Metadata Grid -->
                                    <div
                                        class="pt-6 grid grid-cols-2 md:grid-cols-4 gap-4 bg-primary-container/60 -mx-8 -mb-8 px-8 py-6">
                                        <div>
                                            <span
                                                class="font-label-uppercase text-[10px] text-on-primary-container block uppercase">Nama
                                                Pemesan</span>
                                            <span
                                                class="font-label-md text-label-md font-semibold text-surface-container-lowest">Raden
                                                Aria W.</span>
                                        </div>
                                        <div>
                                            <span
                                                class="font-label-uppercase text-[10px] text-on-primary-container block uppercase">Waktu
                                                Check-In</span>
                                            <span
                                                class="font-label-md text-label-md font-semibold text-surface-container-lowest">14
                                                Des 2025</span>
                                        </div>
                                        <div>
                                            <span
                                                class="font-label-uppercase text-[10px] text-on-primary-container block uppercase">Waktu
                                                Check-Out</span>
                                            <span
                                                class="font-label-md text-label-md font-semibold text-surface-container-lowest">16
                                                Des 2025</span>
                                        </div>
                                        <div>
                                            <span
                                                class="font-label-uppercase text-[10px] text-on-primary-container block uppercase">Total
                                                Nilai</span>
                                            <span
                                                class="font-label-md text-label-md font-semibold text-secondary-fixed">Rp
                                                29.500.000</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center gap-3 p-4 rounded-lg bg-surface-container-low text-on-surface-variant">
                                    <span
                                        class="material-symbols-outlined text-secondary text-[22px]">mark_email_read</span>
                                    <p class="font-body-sm text-body-sm leading-snug">Salinan e-voucher PDF dan
                                        instruksi check-in butler akan otomatis dikirimkan ke <strong
                                            class="text-primary">aria.wirasubrata@havenpalais.com</strong> setelah
                                        otorisasi selesai.</p>
                                </div>
                                <!-- Call To Actions -->
                                <div class="flex flex-col sm:flex-row items-center gap-4 pt-2">
                                    <button
                                        class="w-full sm:flex-1 h-14 bg-primary hover:bg-primary-container text-on-primary font-label-uppercase text-label-uppercase uppercase tracking-widest rounded flex items-center justify-center gap-3 shadow-md transition-all"
                                        type="button">
                                        <span>Konfirmasi &amp; Bayar Sekarang</span>
                                        <span class="material-symbols-outlined text-[18px]">lock</span>
                                    </button>
                                    <button
                                        class="w-full sm:w-auto h-14 px-6 bg-surface-container hover:bg-surface-variant text-primary font-label-uppercase text-label-uppercase uppercase tracking-wider rounded flex items-center justify-center gap-2 transition-colors"
                                        type="button">
                                        <span class="material-symbols-outlined text-[18px]">download</span>
                                        <span>Unduh Ringkasan PDF</span>
                                    </button>
                                </div>
                            </section>
                        </div>
                        <!-- RIGHT COLUMN: Sticky Luxury Booking Summary -->
                        <aside class="lg:col-span-5 sticky top-28 flex flex-col gap-6">
                            <div class="bg-surface-container-lowest rounded-xl shadow-md overflow-hidden">
                                <!-- Room Preview Imagery -->
                                <div class="relative h-64 w-full overflow-hidden">
                                    <img class="w-full h-full object-cover"
                                        data-alt="Expansive panoramic view of the Royal Ocean Penthouse Villa at Haven Palais in Bali. High ceiling timber suite opening onto a private cantilevered infinity plunge pool overlooking the turquoise Indian Ocean during a serene golden sunset. Soft linen loungers, champagne bucket on marble table, tranquil tropical resort architecture."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuChD-CI615rUws995-69h1TkY_M2aDhe_CiYJw0Jr7_8B60FbBFxlg_xjxzAOmRmgVkCrPYBXIlMl0nU3TUzOx55VkuI1IBzIm9csX6a3q_6V1yoW04GXCxJ44fJAbJ9h8d4qpw06rFAGecngmYldxv6qKzcn38GzKpb-f3XZKw3z4vATlTE66R9GwzXsQOdms562k-4-408gvn5-T2HmkvVC9Ylx5r3xJb7KC9VeY" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute bottom-4 left-6 right-6 flex items-end justify-between">
                                        <div>
                                            <span
                                                class="px-2.5 py-1 bg-surface-container-lowest/90 backdrop-blur-md rounded text-primary font-label-uppercase text-[10px] tracking-wider font-bold uppercase inline-block mb-1.5">Penawaran
                                                Eksklusif</span>
                                            <h3 class="font-headline-sm text-headline-sm text-on-primary">Royal Ocean
                                                Penthouse Villa</h3>
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
                                            <span class="font-label-md text-label-md font-bold text-primary">14 – 16 Des
                                                2025</span>
                                            <span
                                                class="font-body-sm text-[12px] text-on-surface-variant block mt-0.5">2
                                                Malam Menginap</span>
                                        </div>
                                        <div>
                                            <span
                                                class="font-label-uppercase text-[10px] text-on-surface-variant block uppercase">Kapasitas
                                                Tamu</span>
                                            <span class="font-label-md text-label-md font-bold text-primary">2 Tamu
                                                Dewasa</span>
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
                                        <span
                                            class="font-label-uppercase text-label-uppercase text-on-surface-variant tracking-wider uppercase">Rincian
                                            Tarif Transparan</span>
                                        <div
                                            class="flex justify-between items-center font-body-sm text-body-sm text-on-surface-variant">
                                            <span>Tarif Kamar (2 Malam × Rp 12.500.000)</span>
                                            <span class="font-label-md font-semibold text-primary">Rp 25.000.000</span>
                                        </div>
                                        <div
                                            class="flex justify-between items-center font-body-sm text-body-sm text-on-surface-variant">
                                            <span class="flex items-center gap-1">
                                                Pajak Daerah &amp; Service Charge (18%)
                                                <span class="material-symbols-outlined text-[14px]">info</span>
                                            </span>
                                            <span class="font-label-md font-semibold text-primary">Rp 4.500.000</span>
                                        </div>
                                        <div
                                            class="flex justify-between items-center font-body-sm text-body-sm text-secondary font-medium">
                                            <span>Diskon Privilege Membership Welcome</span>
                                            <span class="font-label-md font-semibold">- Rp 0</span>
                                        </div>
                                        <div
                                            class="p-4 bg-surface-container rounded-lg flex items-center justify-between mt-2">
                                            <div>
                                                <span
                                                    class="font-label-uppercase text-[11px] uppercase tracking-wider text-on-surface-variant block">Total
                                                    Pembayaran Akhir</span>
                                                <span class="font-body-sm text-[11px] text-on-surface-variant">Termasuk
                                                    semua pajak &amp; layanan</span>
                                            </div>
                                            <span class="font-headline-sm text-headline-sm text-primary">Rp
                                                29.500.000</span>
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
</body>

</html>