<header class="fixed top-0 right-0 h-20 bg-surface/85 backdrop-blur-xl z-40 shadow-[0_1px_8px_rgba(0,0,0,0.04)] left-0">
    <div class="w-full h-full px-8 flex items-center justify-between">

        <!-- Logo dan Tombol Menu -->
        <div class="flex items-center gap-6">

            <button aria-label="Menu Navigasi"
                class="flex items-center gap-2.5 px-3.5 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-primary transition-colors cursor-pointer group"
                onclick="document.getElementById('mobile-drawer-menu').classList.remove('hidden')">

                <span class="material-symbols-outlined text-[22px] group-hover:scale-105 transition-transform">
                    menu
                </span>

                <span class="font-label-uppercase text-label-uppercase tracking-widest text-primary">
                    Menu
                </span>
            </button>

            <a class="flex items-center gap-3" href="/">

                <img alt="Haven Palais Luxury Hotel Logo" class="h-12 w-12 rounded-full object-cover"
                    src="{{ asset('images/roundlogo.png') }}">

                <div class="flex flex-col">

                    <span class="font-headline-sm text-headline-sm text-primary tracking-tight leading-none">
                        Haven Palais
                    </span>

                    <span
                        class="font-label-uppercase text-label-uppercase text-secondary tracking-widest text-[10px] mt-0.5">
                        Resort &amp; Spa
                    </span>

                </div>
            </a>
        </div>

        <!-- Navigasi Desktop -->
        <div class="flex items-center gap-8">

            <nav class="hidden lg:flex items-center gap-6">

                <a href="/tentang"
                    class="font-label-md text-label-md transition-colors
                    {{ request()->is('tentang*') ? 'text-primary font-semibold' : 'text-on-surface-variant hover:text-on-surface' }}">
                    Tentang Kami
                </a>

            </nav>

            <!-- Pilihan Bahasa -->
            <div class="flex items-center gap-2 bg-surface-container-low px-3 py-1.5 rounded-full">

                <span class="material-symbols-outlined text-[18px] text-on-surface-variant">
                    language
                </span>

                <span class="font-label-uppercase text-label-uppercase text-primary font-bold">
                    ID
                </span>

                <span class="text-outline-variant font-label-md text-label-md">|</span>

                <span
                    class="font-label-uppercase text-label-uppercase text-on-surface-variant hover:text-on-surface cursor-pointer transition-colors">
                    EN
                </span>

            </div>

            <!-- Concierge -->
            <a class="hidden md:flex items-center gap-2 text-on-surface-variant hover:text-on-surface transition-colors"
                href="konsultasi">

                <span class="material-symbols-outlined text-[18px] text-secondary">
                    support_agent
                </span>

                <span class="font-label-md text-label-md">
                    konsultasi
                </span>

            </a>

            <!-- Tombol Aksi -->
            <div class="flex items-center gap-3">

                <a class="bg-primary-container text-on-primary px-6 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-widest hover:bg-primary transition-colors flex items-center gap-2 shadow-sm"
                    href="/reservasi">

                    <span>Pesan Kamar</span>

                    <span class="material-symbols-outlined text-[16px]">
                        north_east
                    </span>

                </a>

                <a class="border border-outline-variant/60 hover:border-primary text-primary px-5 py-2.5 rounded font-label-uppercase text-label-uppercase tracking-widest transition-all flex items-center gap-2 bg-surface-container-lowest/80 shadow-sm"
                    href="/login">

                    <span class="material-symbols-outlined text-[18px] text-secondary">
                        lock
                    </span>

                    <span>Masuk</span>

                </a>

            </div>
        </div>
    </div>
</header>


<!-- SIDEBAR / MOBILE DRAWER -->
<div class="hidden fixed inset-0 z-50 bg-primary/80 backdrop-blur-md flex transition-opacity duration-300"
    id="mobile-drawer-menu">

    <!-- Konten Sidebar -->
    <div
        class="w-80 max-w-[85vw] h-full bg-surface-container-low flex flex-col justify-between py-8 shadow-2xl relative overflow-y-auto">

        <div class="flex flex-col">

            <!-- Logo dan Tombol Tutup -->
            <div class="px-6 pb-6 flex items-center justify-between border-b border-outline-variant/30">

                <div class="flex items-center gap-3">

                    <img alt="Haven Palais Luxury Hotel Logo" class="h-8 w-auto object-contain"
                        src="{{ asset('images/roundlogo.png') }}">

                    <div class="flex flex-col">

                        <span class="font-headline-sm text-headline-sm text-primary tracking-tight leading-none">
                            Haven Palais
                        </span>

                        <span class="font-label-uppercase text-label-uppercase text-secondary tracking-widest mt-1">
                            Resort &amp; Spa
                        </span>

                    </div>
                </div>

                <button aria-label="Tutup Menu"
                    class="w-9 h-9 rounded-full bg-surface-container flex items-center justify-center text-primary hover:bg-surface-variant transition-colors"
                    onclick="document.getElementById('mobile-drawer-menu').classList.add('hidden')">

                    <span class="material-symbols-outlined text-[20px]">
                        close
                    </span>

                </button>
            </div>


            <!-- Navigasi Sidebar -->
            <nav class="flex flex-col gap-1.5 px-6 mt-6">

                <!-- Home -->
                <a aria-current="{{ request()->path() === '/' ? 'page' : 'false' }}" href="/"
                    class="flex items-center gap-3.5 px-4 py-3 transition-all rounded-lg
                    {{ request()->path() === '/' ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}">

                    <span class="material-symbols-outlined text-[20px]">
                        cottage
                    </span>

                    Home
                </a>


                <!-- Kamar -->
                <a href="/kamar"
                    class="flex items-center gap-3.5 px-4 py-3 transition-all rounded-lg
                    {{ request()->is('kamar*') ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}">

                    <span class="material-symbols-outlined text-[20px]">
                        king_bed
                    </span>

                    Kamar &amp; Suites
                </a>


                <!-- Fasilitas -->
                <a href="/fasilitas"
                    class="flex items-center gap-3.5 px-4 py-3 transition-all rounded-lg
                    {{ request()->is('fasilitas*') ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}">

                    <span class="material-symbols-outlined text-[20px]">
                        pool
                    </span>

                    Fasilitas Resor
                </a>


                <!-- Reservasi -->
                <a href="/reservasi"
                    class="flex items-center gap-3.5 px-4 py-3 transition-all rounded-lg
                    {{ request()->is('reservasi*') ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}">

                    <span class="material-symbols-outlined text-[20px]">
                        calendar_month
                    </span>

                    Reservasi
                </a>


                <!-- Ulasan -->
                <a href="/ulasan"
                    class="flex items-center gap-3.5 px-4 py-3 transition-all rounded-lg
                    {{ request()->is('ulasan*') ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}">

                    <span class="material-symbols-outlined text-[20px]">
                        star
                    </span>

                    Ulasan Tamu
                </a>


                <!-- Tentang Kami -->
                <a href="/tentang"
                    class="flex items-center gap-3.5 px-4 py-3 transition-all rounded-lg
                    {{ request()->is('tentang*') ? 'bg-primary-container text-on-primary font-semibold shadow-sm' : 'font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}">

                    <span class="material-symbols-outlined text-[20px]">
                        info
                    </span>

                    Tentang Kami
                </a>

            </nav>
        </div>


        <!-- Informasi Sidebar -->
        <div class="px-6 flex flex-col gap-4 mt-6">

            <!-- Rating -->
            <div
                class="p-4 rounded-xl bg-surface-container-lowest shadow-[0_12px_32px_-4px_rgba(27,42,50,0.05)] border border-outline-variant/30">

                <div class="flex items-center justify-between mb-2">

                    <div class="flex items-center gap-0.5 text-secondary">

                        <span class="material-symbols-outlined text-[16px]">star</span>
                        <span class="material-symbols-outlined text-[16px]">star</span>
                        <span class="material-symbols-outlined text-[16px]">star</span>
                        <span class="material-symbols-outlined text-[16px]">star</span>
                        <span class="material-symbols-outlined text-[16px]">star</span>

                    </div>

                    <span
                        class="font-label-uppercase text-[10px] bg-secondary-fixed/30 text-on-secondary-container px-2 py-0.5 rounded font-semibold">
                        4.9/5 Excellent
                    </span>

                </div>

                <p class="font-title-editorial text-body-sm text-primary italic leading-snug mb-2">
                    “Pengalaman liburan yang magis dan tak terlupakan.”
                </p>

                <span class="font-label-uppercase text-[10px] text-on-surface-variant block tracking-wider">
                    — Alexandra D. • Verified Guest
                </span>

            </div>


            <!-- Concierge -->
            <div class="p-4 rounded-xl bg-surface-container-lowest shadow-[0_12px_32px_-4px_rgba(27,42,50,0.05)]">

                <span class="font-label-uppercase text-label-uppercase text-secondary block">
                    Concierge 24/7
                </span>

                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                    Layanan reservasi pribadi dan asisten tamu VIP.
                </p>

                <a class="font-title-editorial text-title-editorial text-primary block mt-2 hover:text-secondary transition-colors"
                    href="tel:+62218800900">
                    +62 (021) 8800 900
                </a>

            </div>


            <!-- Lokasi -->
            <div class="flex items-center justify-between px-2 pt-2 text-on-surface-variant">

                <span class="font-label-uppercase text-label-uppercase tracking-wider">
                    Est. 1928
                </span>

                <span class="font-label-uppercase text-label-uppercase tracking-wider text-secondary">
                    Bali • Indonesia
                </span>

            </div>

        </div>
    </div>


    <!-- Area Klik untuk Menutup Sidebar -->
    <div class="flex-1 h-full" onclick="document.getElementById('mobile-drawer-menu').classList.add('hidden')">
    </div>

</div>