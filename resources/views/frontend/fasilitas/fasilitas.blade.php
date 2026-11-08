<!DOCTYPE html>

<html lang="id">


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
                            data-path="tentang-kami" href="/tentang">Tentang Kami</a></nav>
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
                            data-path="ulasan" href="/ulasam"><span
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
                            <!-- 1. Infinity Horizon Pool (Wellness) -->
                            <article
                                class="facility-card flex flex-col bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group"
                                data-category="wellness">
                                <div class="relative h-64 overflow-hidden">
                                    <img alt="Infinity Horizon Cliff Pool"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Spectacular 75-meter infinity pool tier at edge of limestone cliff with turquoise clear water, floating luxury daybeds, and dramatic view of Indian Ocean waves crashing below during a sunny calm day in Bali."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAydjU7Gnd3PnDdafmmaP_DoWPjPaWO-HeMI5KaUDRRUsyzSmZxNnjA_nYWsk0_6JvCm-uXmMn-y4uy4EF3s8jb-CCW0hyfUJpTIvFgtwC76Xw-kJcVa3zwTfsiqFjPoJOPvX_g2NNFmUZeURa4JJ4PCIMZ9zHbYLl4KOU0PN1wBeoKZA_TxGCYhaooKASax_5Nii4pu4TBG-1EFtq39UNb9iJi3WrI2_Yp11uST2w" />
                                    <div
                                        class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1 rounded">
                                        <span
                                            class="font-label-uppercase text-[10px] text-primary font-bold tracking-wider">Rekreasi
                                            &amp; Wellness</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 right-4 bg-primary-container/85 backdrop-blur-md text-on-primary px-3 py-1 rounded text-xs flex items-center gap-1.5 font-label-md">
                                        <span
                                            class="material-symbols-outlined text-[14px] text-secondary-fixed">schedule</span>
                                        06:00 - 20:00 WITA
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                                    <div>
                                        <h3
                                            class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors">
                                            Infinity Horizon Cliff Pool
                                        </h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Kolam renang bertingkat 75 meter menggantung di bibir tebing kapur dengan
                                            panorama samudra lepas, sunbed terapung berlapis sutra mikro, dan poolside
                                            juice bar segar.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary font-semibold">Tersedia
                                            untuk Tamu Resor</span>
                                        <button
                                            class="flex items-center gap-1 font-label-uppercase text-label-uppercase text-primary hover:text-secondary transition-colors"
                                            onclick="openBookingModal('Infinity Horizon Cliff Pool')">
                                            Detail
                                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                            <!-- 2. Serenity Spa (Wellness) -->
                            <article
                                class="facility-card flex flex-col bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group"
                                data-category="wellness">
                                <div class="relative h-64 overflow-hidden">
                                    <img alt="Serenity Spa &amp; Thalassotherapy"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Interior of Serenity Spa treatment room featuring cedarwood warm tones, natural stone soaking tub filled with herbal infused warm water, candlelight, and gentle steam overlooking coastal tropical garden."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8MxL-2BiI8WL_J_5A0i_TadqyqaSmQurD4ZVwQAY8c3jvzSu7zHtJ4bq3w-ldS_fK8zC1c2NE7MjytAMAseWQaE0oxmXhb3296qGRxDiw6691038EVPqdcNS6Qi31j5_bP_wNG3hvNiOXi2N6S_u8afOra5G6LshSLjMpXAqzUxSOLXqTod8iSn6Nfgm4f4D_yRnAt5g6GMiS6eAl4vMMMe-0pfbVR3aKRcQWtKY" />
                                    <div
                                        class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1 rounded">
                                        <span
                                            class="font-label-uppercase text-[10px] text-primary font-bold tracking-wider">Rekreasi
                                            &amp; Wellness</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 right-4 bg-primary-container/85 backdrop-blur-md text-on-primary px-3 py-1 rounded text-xs flex items-center gap-1.5 font-label-md">
                                        <span
                                            class="material-symbols-outlined text-[14px] text-secondary-fixed">spa</span>
                                        09:00 - 22:00 WITA
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                                    <div>
                                        <h3
                                            class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors">
                                            Serenity Spa &amp; Thalassotherapy
                                        </h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Paviliun spa privat dengan terapi herbal tradisional Bali, sauna aroma
                                            cedarwood, hot &amp; cold vitality pools, serta perawatan holistik
                                            bersertifikasi internasional.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary font-semibold">Perlu
                                            Reservasi Awal</span>
                                        <button
                                            class="flex items-center gap-1 font-label-uppercase text-label-uppercase text-primary hover:text-secondary transition-colors"
                                            onclick="openBookingModal('Serenity Spa &amp; Thalassotherapy')">
                                            Detail
                                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                            <!-- 3. Coastal Yoga & Fitness (Wellness) -->
                            <article
                                class="facility-card flex flex-col bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group"
                                data-category="wellness">
                                <div class="relative h-64 overflow-hidden">
                                    <img alt="Coastal Yoga &amp; Fitness Sanctuary"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Open-air wooden yoga deck perched on a cliff at golden sunrise overlooking the misty sea, with modern Technogym workout sanctuary pavilion adjacent to it with floor-to-ceiling glass in Bali."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDxuUiLtVANa92zLf6J7aEbKwOKBVc0Jeho1dxnS54SIaeRAtXB2ChuOkdwU5giGlS_Vnpyy-R62DnmfuLPAot1ZrHDy5XxhCjeaiGrH_pK57MeEp4yDua3HlXl8CLaiJsS91hHrWJyYVuziaTTqZXYydeyI7odqPagR_ii2MGAVWvm278osiZis0JRpDzZW-Qe8W9QDGnNqURaD-7P9d_EurU2VRtrNp2fVJ4QssI" />
                                    <div
                                        class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1 rounded">
                                        <span
                                            class="font-label-uppercase text-[10px] text-primary font-bold tracking-wider">Rekreasi
                                            &amp; Wellness</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 right-4 bg-primary-container/85 backdrop-blur-md text-on-primary px-3 py-1 rounded text-xs flex items-center gap-1.5 font-label-md">
                                        <span
                                            class="material-symbols-outlined text-[14px] text-secondary-fixed">fitness_center</span>
                                        24 Jam Akses Tamu
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                                    <div>
                                        <h3
                                            class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors">
                                            Yoga Pavilion &amp; Fitness Sanctuary
                                        </h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Pusat kebugaran berteknologi Technogym terbaru dan dek yoga tepi tebing
                                            berangin sejuk dengan kelas terpandu meditasi sunrise &amp; sunset setiap
                                            hari.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary font-semibold">Termasuk
                                            Daily Class</span>
                                        <button
                                            class="flex items-center gap-1 font-label-uppercase text-label-uppercase text-primary hover:text-secondary transition-colors"
                                            onclick="openBookingModal('Yoga Pavilion &amp; Fitness Sanctuary')">
                                            Detail
                                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                            <!-- 4. Palais Haute Cuisine (Gastronomy) -->
                            <article
                                class="facility-card flex flex-col bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group"
                                data-category="gastronomy">
                                <div class="relative h-64 overflow-hidden">
                                    <img alt="Palais Haute Cuisine &amp; Degustation Room"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Fine dining table setting at Palais Haute Cuisine, featuring elegant crystal wine glasses, delicate porcelain dish with gastronomic food presentation, warm mood lighting, and temperature-controlled wine cellar wall in background."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAnxoyfVtVsGCZSkSobRqSKUkZMLLes20KCyk90k4Uv0WT9E4pcze0a2sfG7CzwreKbActHqD-ggPRtpovxCcD6q-1EHi14B1F2kA9aiWuhM_o-iF5DnR1UN5H8h07E9nbfuKqeuieNOBa-m7BNiKWV7N32kLfcewjyqRn8mvvm2XUHitT3WCk3iPMEComR_RW_18Nl_aPKR5g4SBBqo0GAoiNkjBhKl66XjF5dKBc" />
                                    <div
                                        class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1 rounded">
                                        <span
                                            class="font-label-uppercase text-[10px] text-primary font-bold tracking-wider">Gastronomy</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 right-4 bg-primary-container/85 backdrop-blur-md text-on-primary px-3 py-1 rounded text-xs flex items-center gap-1.5 font-label-md">
                                        <span
                                            class="material-symbols-outlined text-[14px] text-secondary-fixed">restaurant</span>
                                        18:00 - 23:00 WITA
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                                    <div>
                                        <h3
                                            class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors">
                                            Palais Haute Cuisine &amp; Degustation
                                        </h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Restoran fine dining kelas dunia dengan menu Prancis kontemporer berbalut
                                            rempah lokal Nusantara, dan koleksi 2.500+ botol anggur langka dipandu Head
                                            Sommelier.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary font-semibold">Dress
                                            Code: Resort Chic</span>
                                        <button
                                            class="flex items-center gap-1 font-label-uppercase text-label-uppercase text-primary hover:text-secondary transition-colors"
                                            onclick="openBookingModal('Palais Haute Cuisine')">
                                            Detail
                                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                            <!-- 5. Oceanfront Starlight Cabana (Gastronomy) -->
                            <article
                                class="facility-card flex flex-col bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group"
                                data-category="gastronomy">
                                <div class="relative h-64 overflow-hidden">
                                    <img alt="Oceanfront Starlight Cabana"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Intimate romantic cliffside cabana adorned with sheer linen drapes and warm glowing lanterns at twilight dusk over crashing waves, fine table set with candles and champagne in Uluwatu."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCvhKk1M_HoNkeN6nTBOfh2yyVQiCjtYFI_e3sarWXC3WoyUvPtJltJDbrGNWyhnW9QmdEyHoDfWFacxi1o7YRvoaU5SrB9hbvoX8sutHWUX9ChYZwDbp8R276mrhzWSmKfbbpeU0FQIwVWPYeX05wzu1LjVA6Ewtr8qTG5jEek1BBAWwmcjMbmZvW0llFWQwRQ5xgbn7rz0b0oQIUOWebfClFt0nmV8OZjkVNVxlo" />
                                    <div
                                        class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1 rounded">
                                        <span
                                            class="font-label-uppercase text-[10px] text-primary font-bold tracking-wider">Gastronomy</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 right-4 bg-primary-container/85 backdrop-blur-md text-on-primary px-3 py-1 rounded text-xs flex items-center gap-1.5 font-label-md">
                                        <span
                                            class="material-symbols-outlined text-[14px] text-secondary-fixed">favorite</span>
                                        Eksklusif Malam Hari
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                                    <div>
                                        <h3
                                            class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors">
                                            Oceanfront Starlight Cabana
                                        </h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Pengalaman bersantap malam romantis privat di anjungan tebing berbintang
                                            dengan tata lilin estetik, deburan ombak magis, dan hidangan 7-course
                                            tailor-made chef pribadi.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                        <span class="font-label-uppercase text-[11px] text-secondary font-semibold">Slot
                                            Terbatas (2 Pasang/Malam)</span>
                                        <button
                                            class="flex items-center gap-1 font-label-uppercase text-label-uppercase text-primary hover:text-secondary transition-colors"
                                            onclick="openBookingModal('Oceanfront Starlight Cabana')">
                                            Detail
                                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                            <!-- 6. Horizon Sunset Lounge (Gastronomy) -->
                            <article
                                class="facility-card flex flex-col bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group"
                                data-category="gastronomy">
                                <div class="relative h-64 overflow-hidden">
                                    <img alt="Horizon Sunset Cocktail Lounge"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Rooftop open-air cocktail lounge overlooking a fiery crimson and gold sunset over the ocean, artisanal cocktails in cut-crystal glassware on marble bar top with chic patrons lounging."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDN_wZGPFp1n-AIQybQ731osJvNSvKAnNv4pGVyYi0XLAhcozic0c6Q-4Vxtp5pKqRkp-K2_w3q5mPVjQmqCy9ANpSavsALFYqK2yQulzOTJ-O4l7vEkPA-c4vjmUPKEOQb3i2Awyfa-hWBFJ6TVybFHo9S12MoDV_n6Au737jseB7RZPyWbsMVOyRMoZBsxZNehBm8WJSCjkTpjf4l4Ql3z9YM-dngX1sWjUog2ZI" />
                                    <div
                                        class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1 rounded">
                                        <span
                                            class="font-label-uppercase text-[10px] text-primary font-bold tracking-wider">Gastronomy</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 right-4 bg-primary-container/85 backdrop-blur-md text-on-primary px-3 py-1 rounded text-xs flex items-center gap-1.5 font-label-md">
                                        <span
                                            class="material-symbols-outlined text-[14px] text-secondary-fixed">wine_bar</span>
                                        16:30 - 00:00 WITA
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                                    <div>
                                        <h3
                                            class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors">
                                            Horizon Sunset Cocktail Lounge
                                        </h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Bar teras lantai atas menyajikan artisan mixology dengan infusi rempah
                                            tropis, champagne vintage terkurasi, dan sajian canapé eksklusif ditemani
                                            alunan lounge ritmis.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                        <span class="font-label-uppercase text-[11px] text-secondary font-semibold">Live
                                            Saxophone Sunset</span>
                                        <button
                                            class="flex items-center gap-1 font-label-uppercase text-label-uppercase text-primary hover:text-secondary transition-colors"
                                            onclick="openBookingModal('Horizon Sunset Cocktail Lounge')">
                                            Detail
                                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                            <!-- 7. Open-Air Amphitheatre (Experiences) -->
                            <article
                                class="facility-card flex flex-col bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group"
                                data-category="experiences">
                                <div class="relative h-64 overflow-hidden">
                                    <img alt="Private Open-Air Amphitheatre"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Open-air amphitheatre with curved stone terraces illuminated by torches at dusk, traditional Balinese dancers performing in elaborate golden silk attire under starry sky with ocean backdrop."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDFy3BNdhMSlsyDbcRf-nuGI7nJ81CLVjq0TuKC6L_8J8b22U4b98Ga5NGFUNwR85OGqeaISfuhCfsEFwO7_HntOLMHqgH-Xy6i7uKCdPQKMiF5i9Rk4ul5YHr2URnnBgygECDVZ5OcYGLYbjX19IGY7xgphBA4NWR7MPi9ZMBC6m77TWZwcgOTObu1rCGTl7zMAzNDXkbw3DvL5EP10NdVwHzyfCsyLcziUq9-7nw" />
                                    <div
                                        class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1 rounded">
                                        <span
                                            class="font-label-uppercase text-[10px] text-primary font-bold tracking-wider">Hiburan
                                            &amp; Budaya</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 right-4 bg-primary-container/85 backdrop-blur-md text-on-primary px-3 py-1 rounded text-xs flex items-center gap-1.5 font-label-md">
                                        <span
                                            class="material-symbols-outlined text-[14px] text-secondary-fixed">theater_comedy</span>
                                        Jadwal Mingguan
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                                    <div>
                                        <h3
                                            class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors">
                                            Private Open-Air Amphitheatre
                                        </h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Panggung seni teater bawah bintang menampilkan pertunjukan budaya tari
                                            tradisional Bali, konser akustik intim, dan apresiasi sastra pesisir dalam
                                            atmosfer sakral.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                        <span class="font-label-uppercase text-[11px] text-secondary font-semibold">Tamu
                                            Menginap Gratis</span>
                                        <button
                                            class="flex items-center gap-1 font-label-uppercase text-label-uppercase text-primary hover:text-secondary transition-colors"
                                            onclick="openBookingModal('Private Open-Air Amphitheatre')">
                                            Detail
                                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                            <!-- 8. Beach Club & Water Sports (Experiences) -->
                            <article
                                class="facility-card flex flex-col bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group"
                                data-category="experiences">
                                <div class="relative h-64 overflow-hidden">
                                    <img alt="Private Cove Beach Club &amp; Water Sports"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Exclusive secluded white sand cove beach club with chic natural timber sunshades, crystal-clear turquoise shallow reef water, and sleek luxury motor yacht anchored off-shore."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpb8DXnwd3e9zjSxOTdVRNTmNF6fyBoUtNuCSOJuJZO5A6YTN9hvBjhUnhmnqfXwvvhz1aKWSOh7ckG12B6JchpYQ67rrRRN7bP0fRfq9N-llWKet3bdkkniCSfRVKnMVD8p9KmaXePZsKjfePc9wBJ0UB0zjZCmeeaF83KCZM8jqaCfIfL9Swo51Zoml8kwj4ogZ1YsCtItLAz1XW69yBT2mC4l4UgUlp_KIWvB0" />
                                    <div
                                        class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1 rounded">
                                        <span
                                            class="font-label-uppercase text-[10px] text-primary font-bold tracking-wider">Hiburan
                                            &amp; Budaya</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 right-4 bg-primary-container/85 backdrop-blur-md text-on-primary px-3 py-1 rounded text-xs flex items-center gap-1.5 font-label-md">
                                        <span
                                            class="material-symbols-outlined text-[14px] text-secondary-fixed">sailing</span>
                                        08:00 - 18:30 WITA
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                                    <div>
                                        <h3
                                            class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors">
                                            Private Cove Beach Club &amp; Yacht
                                        </h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Akses lift tebing privat menuju teluk pasir putih murni. Lengkap dengan
                                            armada private yacht charter, paddleboard, dan pemanduan snorkeling terumbu
                                            karang alami.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                        <span class="font-label-uppercase text-[11px] text-secondary font-semibold">Lift
                                            Akses Tebing Khusus</span>
                                        <button
                                            class="flex items-center gap-1 font-label-uppercase text-label-uppercase text-primary hover:text-secondary transition-colors"
                                            onclick="openBookingModal('Private Cove Beach Club')">
                                            Detail
                                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                            <!-- 9. CinePalais Cinema (Experiences) -->
                            <article
                                class="facility-card flex flex-col bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group"
                                data-category="experiences">
                                <div class="relative h-64 overflow-hidden">
                                    <img alt="CinePalais Private Cinema"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Intimate private luxury screening room cinema with plush deep navy velvet reclining armchairs, soft footlights, Bang and Olufsen acoustic wall panels, and large 4K cinema projection."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDFAagg2yl7j6cVrsaTOYJw30d1SwFx-xZgV8-wHwliGRpUzWlwa4hvyfUAK4UZKYN5Ou73wrQpi2Z1a0AhcMy4qU2l0tSgf6L_Ew5bxUXXocP9SOzMr0Qf8KruxVknbteUpNob05bDWxBGtTcffrGuDvaHwMFsYCE6F4CVgVx-aArVOf-eNqclUTLs9w9weQp8uDKAwIZ7pF7-z6xZut_wPlWgZzcf_vl92RCJkkI" />
                                    <div
                                        class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1 rounded">
                                        <span
                                            class="font-label-uppercase text-[10px] text-primary font-bold tracking-wider">Hiburan
                                            &amp; Budaya</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 right-4 bg-primary-container/85 backdrop-blur-md text-on-primary px-3 py-1 rounded text-xs flex items-center gap-1.5 font-label-md">
                                        <span
                                            class="material-symbols-outlined text-[14px] text-secondary-fixed">movie</span>
                                        Reservasi Sesi Privat
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                                    <div>
                                        <h3
                                            class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors">
                                            CinePalais Private Cinema
                                        </h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Bioskop privat berkapasitas 14 tamu dengan sistem tata suara Bang &amp;
                                            Olufsen, sofa kulit reclining kustom, kurasi film festival, dan gourmet
                                            concession bar.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary font-semibold">Tersedia
                                            Private Screening</span>
                                        <button
                                            class="flex items-center gap-1 font-label-uppercase text-label-uppercase text-primary hover:text-secondary transition-colors"
                                            onclick="openBookingModal('CinePalais Private Cinema')">
                                            Detail
                                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                            <!-- 10. Private Helipad & Chauffeur (VIP) -->
                            <article
                                class="facility-card flex flex-col bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group"
                                data-category="vip">
                                <div class="relative h-64 overflow-hidden">
                                    <img alt="Private Helipad &amp; Executive Chauffeur"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Helicopter landing pad on lush manicured cliff garden at Haven Palais resort, with luxury executive Maybach vehicle parked nearby and impeccably suited chauffeur awaiting arrival."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuB0PNaRrTJsFC4s4nD4f8EDPdRWFo60mxjj7cwJ2A2z1CmWNXICLC7QznV9lpWLkjjwjdlU3D64V7aHN2rv6Rtr9shpRdzxYb27rbTrbW2Gqc-ZZUknURBR0LfNCfo3dExIbkQSsk3KJol1Gst_Pz9N9Q54YEvKoCt7HhnKkac6TIuYhDIaGBkZVPeTbvTJMnjPyMSDaJ4goorf0VF6tGR41zqnI223qg1L7ts3BSc" />
                                    <div
                                        class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1 rounded">
                                        <span
                                            class="font-label-uppercase text-[10px] text-primary font-bold tracking-wider">VIP
                                            Service</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 right-4 bg-primary-container/85 backdrop-blur-md text-on-primary px-3 py-1 rounded text-xs flex items-center gap-1.5 font-label-md">
                                        <span
                                            class="material-symbols-outlined text-[14px] text-secondary-fixed">flight_land</span>
                                        Siaga 24 Jam
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                                    <div>
                                        <h3
                                            class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors">
                                            Private Helipad &amp; Fleet Maybach
                                        </h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Pendaratan helikopter langsung di dalam area resor untuk transfer bandara
                                            cepat 15 menit, didukung armada sedan Mercedes-Maybach berpemandu
                                            bersertifikasi VIP.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary font-semibold">Protokol
                                            Keamanan Ketat</span>
                                        <button
                                            class="flex items-center gap-1 font-label-uppercase text-label-uppercase text-primary hover:text-secondary transition-colors"
                                            onclick="openBookingModal('Helipad &amp; VIP Chauffeur')">
                                            Detail
                                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                            <!-- 11. Butler & Clefs d'Or Concierge (VIP) -->
                            <article
                                class="facility-card flex flex-col bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group"
                                data-category="vip">
                                <div class="relative h-64 overflow-hidden">
                                    <img alt="Dedicated Butler &amp; Les Clefs d'Or Concierge"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        data-alt="Personal butler in tailored linen suit presenting bespoke welcome tea service on silver tray in opulent oceanfront villa lounge, warm sunlight streaming through teak shutters."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA10Wgx6pON__GHPVB9rlb2cLUkIVkdN_OMOgnWn6u63qbxD4ArkH8S-ESD549eEStazpBbc_WlP9auWfRG8Kf8mW9RE-yHVFbeutG_mgRl4CIFI0hDUZqU-BdIO8hQoIe8T5T0pz4EPZuF3Qzy42WBOVQPcBDhSxMC6xVhkUc6sl6OyQjlc7BL9tNs4E1Yc0s0LiYRH9rJyIbPJOk077X_6XwZ_OW23B4f7dj1rqo" />
                                    <div
                                        class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1 rounded">
                                        <span
                                            class="font-label-uppercase text-[10px] text-primary font-bold tracking-wider">VIP
                                            Service</span>
                                    </div>
                                    <div
                                        class="absolute bottom-4 right-4 bg-primary-container/85 backdrop-blur-md text-on-primary px-3 py-1 rounded text-xs flex items-center gap-1.5 font-label-md">
                                        <span
                                            class="material-symbols-outlined text-[14px] text-secondary-fixed">key</span>
                                        24/7 Dedicated
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                                    <div>
                                        <h3
                                            class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors">
                                            Dedicated Butler &amp; Concierge
                                        </h3>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                            Asisten pribadi yang mendedikasikan waktu penuh untuk menyusun itinerari
                                            pribadi, penataan bagasi tanpa cela, hingga reservasi prioritas di restoran
                                            terkemuka pulau Dewata.
                                        </p>
                                    </div>
                                    <div
                                        class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                        <span
                                            class="font-label-uppercase text-[11px] text-secondary font-semibold">Tersedia
                                            di Seluruh Suite &amp; Villa</span>
                                        <button
                                            class="flex items-center gap-1 font-label-uppercase text-label-uppercase text-primary hover:text-secondary transition-colors"
                                            onclick="openBookingModal('Dedicated Butler &amp; Concierge')">
                                            Detail
                                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
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
                                    <li><a class="hover:text-on-primary transition-colors" href="/ulasan">Ulasan Tamu</a></li>
                                    <li><a class="hover:text-on-primary transition-colors" href="/tentang">Tentang Kami</a>
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
                        <form class="space-y-4" onsubmit="handleReservationSubmit(event)">
                            <div>
                                <label class="block font-label-uppercase text-[11px] text-on-surface-variant mb-1">Nama
                                    Lengkap Tamu</label>
                                <input
                                    class="w-full bg-surface-container-low px-3.5 py-2 rounded text-sm text-primary focus:outline-none focus:ring-1 focus:ring-primary"
                                    placeholder="Contoh: Raden Surya" required="" type="text" />
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label
                                        class="block font-label-uppercase text-[11px] text-on-surface-variant mb-1">Tanggal</label>
                                    <input
                                        class="w-full bg-surface-container-low px-3 py-2 rounded text-xs text-primary focus:outline-none focus:ring-1 focus:ring-primary"
                                        required="" type="date" />
                                </div>
                                <div>
                                    <label
                                        class="block font-label-uppercase text-[11px] text-on-surface-variant mb-1">Waktu
                                        / Sesi</label>
                                    <select
                                        class="w-full bg-surface-container-low px-3 py-2 rounded text-xs text-primary focus:outline-none focus:ring-1 focus:ring-primary">
                                        <option>Pagi (08:00 - 11:00)</option>
                                        <option>Siang (12:00 - 15:00)</option>
                                        <option>Sunset (16:30 - 19:00)</option>
                                        <option>Malam (19:30 - 22:00)</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block font-label-uppercase text-[11px] text-on-surface-variant mb-1">Status
                                    Tamu</label>
                                <div class="flex items-center gap-4 text-xs text-on-surface pt-1">
                                    <label class="flex items-center gap-1.5 cursor-pointer">
                                        <input checked="" class="text-primary" name="guest_type" type="radio" /> Tamu
                                        Menginap di Villa
                                    </label>
                                    <label class="flex items-center gap-1.5 cursor-pointer">
                                        <input class="text-primary" name="guest_type" type="radio" /> Tamu Harian (Day
                                        Guest)
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block font-label-uppercase text-[11px] text-on-surface-variant mb-1">Permintaan
                                    Khusus / Alergi</label>
                                <textarea
                                    class="w-full bg-surface-container-low px-3.5 py-2 rounded text-xs text-primary focus:outline-none focus:ring-1 focus:ring-primary"
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

                    function openBookingModal(facilityName) {
                        document.getElementById('modal-facility-title').innerText = facilityName;
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