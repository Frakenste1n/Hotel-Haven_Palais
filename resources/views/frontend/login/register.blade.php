
<!DOCTYPE html>
<html lang="id">
    

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Haven Palais - Daftar Akun Tamu</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            navy: '#1b2a32',
                            dark: '#111b21',
                            gold: '#c5a880',
                            goldHover: '#b3946a',
                            sand: '#f4f3f1',
                            warmBg: '#faf9f7',
                            border: '#e6e4df',
                            muted: '#68737d',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #faf9f7;
            color: #1b2a32;
        }

        .font-editorial {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[#faf9f7] text-brand-navy flex flex-col justify-between selection:bg-[#c5a880] selection:text-white antialiased">

@include('partials.navlogreg')

    <!-- Konten Utama -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-10 my-auto">

        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-[0_20px_50px_rgba(27,42,50,0.06)] border border-brand-border/80 overflow-hidden grid grid-cols-1 md:grid-cols-12 min-h-[580px]">

            <!-- Sisi Kiri: Informasi Resort -->
            <div class="md:col-span-5 relative bg-brand-navy text-white p-8 sm:p-10 flex flex-col justify-between overflow-hidden">

                <img
                    alt="Haven Palais Luxury Sanctuary"
                    class="absolute inset-0 w-full h-full object-cover object-center opacity-30 mix-blend-overlay"
                    src="https://www.gstatic.com/labs-code/stitch/stitch-placeholder-300x300.svg">

                <div class="absolute inset-0 bg-gradient-to-t from-brand-navy via-brand-navy/80 to-brand-navy/40"></div>

                <!-- Konten Atas -->
                <div class="relative z-10">

                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/15 text-[11px] tracking-wider uppercase text-brand-gold font-medium mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-gold animate-pulse"></span>
                        Haven Privilege Portal
                    </div>

                    <h2 class="font-editorial text-2xl lg:text-3xl text-white font-normal leading-snug tracking-tight">
                        Bergabung Bersama Komunitas Suaka Kami
                    </h2>

                    <p class="text-xs text-white/70 mt-3 leading-relaxed font-light">
                        Daftarkan diri Anda untuk menikmati hak istimewa eksklusif, tarif preferensial, dan layanan personal butler di Haven Palais.
                    </p>

                </div>

                <!-- Poin Privilege -->
                <div class="relative z-10 pt-8 border-t border-white/15 mt-8 space-y-3.5">

                    <div class="flex items-center gap-3 text-xs text-white/80">
                        <div class="w-6 h-6 rounded-full bg-brand-gold/20 text-brand-gold flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <span>Sambutan 1.000 Poin Privilege instan</span>
                    </div>

                    <div class="flex items-center gap-3 text-xs text-white/80">
                        <div class="w-6 h-6 rounded-full bg-brand-gold/20 text-brand-gold flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <span>Tarif eksklusif & prioritas kamar upgrade</span>
                    </div>

                    <div class="flex items-center gap-3 text-xs text-white/80">
                        <div class="w-6 h-6 rounded-full bg-brand-gold/20 text-brand-gold flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <span>Layanan personal butler siaga 24 jam</span>
                    </div>

                </div>
            </div>

            <!-- Sisi Kanan: Form Registrasi -->
            <div class="md:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white">

                <div class="max-w-md w-full mx-auto">

                    <!-- Header Form -->
                    <div class="mb-6">
                        <span class="text-[11px] font-semibold tracking-[0.2em] uppercase text-brand-gold">
                            Pendaftaran Keanggotaan
                        </span>

                        <h1 class="font-editorial text-2xl sm:text-3xl text-brand-navy font-semibold mt-1">
                            Buat Akun Baru
                        </h1>

                        <p class="text-xs sm:text-sm text-brand-muted mt-1.5">
                            Lengkapi data singkat untuk mengaktifkan akun dan reward menginap Anda.
                        </p>
                    </div>

                    <!-- Form Input -->
                    <form class="space-y-4" onsubmit="event.preventDefault();">

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-brand-navy mb-1.5" for="fullname">
                                Nama Lengkap
                            </label>

                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-brand-muted/70">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path>
                                    </svg>
                                </div>

                                <input
                                    class="w-full pl-10 pr-4 py-2.5 bg-[#faf9f7] border border-brand-border rounded-lg text-sm text-brand-navy placeholder:text-brand-muted/50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-brand-gold focus:border-brand-gold transition-all"
                                    id="fullname"
                                    name="fullname"
                                    placeholder="Raden Aria Wirasubrata"
                                    required
                                    type="text"
                                    value="Raden Aria Wirasubrata">
                            </div>
                        </div>

                        <!-- Email & WhatsApp -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                            <!-- Email -->
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-navy mb-1.5" for="email">
                                    Alamat Email
                                </label>

                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-brand-muted/70">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path>
                                        </svg>
                                    </div>

                                    <input
                                        class="w-full pl-9 pr-3 py-2.5 bg-[#faf9f7] border border-brand-border rounded-lg text-sm text-brand-navy placeholder:text-brand-muted/50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-brand-gold focus:border-brand-gold transition-all"
                                        id="email"
                                        name="email"
                                        placeholder="tamu@havenpalais.com"
                                        required
                                        type="email"
                                        value="tamu@havenpalais.com">
                                </div>
                            </div>

                            <!-- Nomor Telepon -->
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-navy mb-1.5" for="phone">
                                    Nomor WhatsApp
                                </label>

                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-brand-muted/70">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path>
                                        </svg>
                                    </div>

                                    <input
                                        class="w-full pl-9 pr-3 py-2.5 bg-[#faf9f7] border border-brand-border rounded-lg text-sm text-brand-navy placeholder:text-brand-muted/50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-brand-gold focus:border-brand-gold transition-all"
                                        id="phone"
                                        name="phone"
                                        placeholder="+62 812-4920-8800"
                                        required
                                        type="tel"
                                        value="+62 812-4920-8800">
                                </div>
                            </div>

                        </div>

                        <!-- Kata Sandi -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-navy" for="password">
                                    Kata Sandi
                                </label>

                                <span class="text-[11px] text-brand-muted font-normal">
                                    Min. 8 Karakter
                                </span>
                            </div>

                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-brand-muted/70">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path>
                                    </svg>
                                </div>

                                <input
                                    class="w-full pl-10 pr-10 py-2.5 bg-[#faf9f7] border border-brand-border rounded-lg text-sm text-brand-navy placeholder:text-brand-muted/50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-brand-gold focus:border-brand-gold transition-all"
                                    id="password"
                                    name="password"
                                    placeholder="Masukkan kata sandi baru"
                                    required
                                    type="password"
                                    value="••••••••••••">

                                <button
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-brand-muted hover:text-brand-navy"
                                    type="button">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Persetujuan -->
                        <div class="flex items-start gap-2 pt-1">
                            <input
                                checked
                                class="mt-0.5 w-4 h-4 rounded border-brand-border text-brand-navy focus:ring-brand-gold focus:ring-offset-0 accent-brand-navy cursor-pointer"
                                id="agreement"
                                required
                                type="checkbox">

                            <label class="text-xs text-brand-muted leading-relaxed cursor-pointer" for="agreement">
                                Saya menyetujui
                                <a class="text-brand-navy underline hover:text-brand-gold font-medium" href="#">
                                    Syarat & Ketentuan Keanggotaan
                                </a>
                                serta
                                <a class="text-brand-navy underline hover:text-brand-gold font-medium" href="#">
                                    Kebijakan Privasi
                                </a>
                                resor.
                            </label>
                        </div>

                        <!-- Tombol Submit -->
                        <button
                            class="w-full py-3.5 px-6 rounded-lg bg-brand-navy hover:bg-[#152128] text-white font-medium text-sm tracking-wide transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 group mt-2"
                            type="submit">

                            <span>Daftar Akun Tamu</span>

                            <svg class="w-4 h-4 text-brand-gold group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </button>

                        <!-- Divider -->
                        <div class="relative my-5">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-brand-border"></div>
                            </div>

                            <div class="relative flex justify-center text-[11px] uppercase tracking-wider text-brand-muted">
                                <span class="bg-white px-3 font-medium">
                                    atau daftar dengan kode booking
                                </span>
                            </div>
                        </div>

                        <!-- Kode Booking -->
                        <button
                            class="w-full py-3 px-6 rounded-lg border border-brand-border hover:border-brand-navy/50 bg-[#faf9f7] hover:bg-white text-brand-navy text-xs font-semibold tracking-wider uppercase transition-colors flex items-center justify-center gap-2"
                            type="button">

                            <svg class="w-3.5 h-3.5 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>

                            <span>Hubungkan Akun dengan Kode Booking Resor</span>
                        </button>

                    </form>

                    <!-- Link Login -->
                    <div class="mt-6 text-center text-xs text-brand-muted">
                        Sudah memiliki akun tamu?

                        <a class="font-semibold text-brand-navy hover:text-brand-gold underline decoration-brand-border hover:decoration-brand-gold transition-colors ml-1" href="/login">
                            Masuk Sekarang
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full border-t border-brand-border/60 py-5 px-6 lg:px-12 text-center sm:flex sm:justify-between sm:items-center text-xs text-brand-muted">

        <p>
            © 2025 Haven Palais Resort & Spa Uluwatu. Hak cipta dilindungi undang-undang.
        </p>

        <div class="flex items-center justify-center gap-5 mt-2 sm:mt-0">
            <a class="hover:text-brand-navy transition-colors" href="#">
                Privasi Tamu
            </a>

            <span>•</span>

            <a class="hover:text-brand-navy transition-colors" href="#">
                Bantuan Butler & Concierge
            </a>

            <span>•</span>

            <a class="hover:text-brand-navy transition-colors" href="#">
                Syarat Keanggotaan
            </a>
        </div>

    </footer>

</body>
</html>
