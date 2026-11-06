<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — {{ $site->site_name ?: 'Haven Palais' }}</title>
    @if($site->site_favicon)
        <link rel="icon" href="{{ $site->fileUrl('site_favicon') }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#06151d',
                        'primary-container': '#1b2a32',
                        'on-primary': '#ffffff',
                        secondary: '#725b38',
                        'secondary-container': '#fedeb2',
                        'on-secondary-container': '#78603e',
                        surface: '#faf9f7',
                        'surface-container-low': '#f4f3f1',
                        'surface-container-lowest': '#ffffff',
                        'on-surface': '#1a1c1b',
                        'on-surface-variant': '#43474a',
                        'outline-variant': '#c3c7ca',
                        error: '#ba1a1a',
                        'error-container': '#ffdad6',
                        'on-error-container': '#93000a',
                    },
                    fontFamily: {
                        display: ['Playfair Display', 'serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .login-spinner { animation: login-spin .7s linear infinite; }
        @keyframes login-spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body class="min-h-screen bg-surface font-sans text-on-surface antialiased">
    <div class="grid min-h-screen lg:grid-cols-[minmax(0,1.05fr)_minmax(0,0.95fr)]">
        <section class="relative hidden overflow-hidden bg-primary text-white lg:flex lg:flex-col lg:justify-between lg:p-14">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(254,222,178,0.22),transparent_42%),radial-gradient(circle_at_bottom_left,rgba(255,255,255,0.08),transparent_38%)]"></div>
            <div class="relative flex items-center gap-3">
                @if($site->fileUrl('site_logo'))
                    <img src="{{ $site->fileUrl('site_logo') }}" alt="" class="h-12 w-12 rounded-2xl object-cover ring-1 ring-white/20" onerror="this.remove()">
                @else
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 ring-1 ring-white/15">
                        <span class="material-symbols-outlined">apartment</span>
                    </span>
                @endif
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-secondary-container">Panel Admin</p>
                    <p class="font-display text-xl">{{ $site->site_name ?: 'Haven Palais' }}</p>
                </div>
            </div>

            <div class="relative max-w-lg">
                <h1 class="font-display text-5xl leading-[1.15]">Kelola operasional resort dari satu tempat.</h1>
                <p class="mt-5 max-w-md text-sm leading-relaxed text-white/70">Reservasi, kamar, pembayaran, dan konten website tersusun dalam panel yang sama.</p>
                <ul class="mt-8 space-y-3 text-sm text-white/85">
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-secondary-container">event_available</span> Reservasi dan tamu</li>
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-secondary-container">king_bed</span> Kamar dan fasilitas</li>
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-secondary-container">payments</span> Pembayaran dan laporan</li>
                </ul>
            </div>

            <p class="relative text-xs text-white/45">Khusus akun staf. Tamu masuk melalui halaman website.</p>
        </section>

        <section class="flex min-h-screen flex-col px-5 py-5 sm:px-8">
            <div class="flex items-center justify-between lg:justify-end">
                <div class="flex items-center gap-3 lg:hidden">
                    @if($site->fileUrl('site_logo'))
                        <img src="{{ $site->fileUrl('site_logo') }}" alt="" class="h-10 w-10 rounded-xl object-cover" onerror="this.remove()">
                    @endif
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-secondary">Panel Admin</p>
                        <p class="font-display text-lg text-primary">{{ $site->site_name ?: 'Haven Palais' }}</p>
                    </div>
                </div>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1 rounded-full px-3 py-2 text-sm font-medium text-on-surface-variant hover:bg-surface-container-low hover:text-primary">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Website
                </a>
            </div>

            <div class="flex flex-1 items-center justify-center py-6">
                <div class="w-full max-w-[420px]">
                    <div class="mb-7">
                        <h2 class="font-display text-4xl text-primary">Masuk</h2>
                        <p class="mt-2 text-sm leading-relaxed text-on-surface-variant">Masukkan email dan password akun staf untuk membuka panel.</p>
                    </div>

                    @if($errors->any())
                        <div id="login-alert" role="alert" class="mb-5 flex gap-3 rounded-2xl border border-error/15 bg-error-container px-4 py-3 text-sm text-on-error-container">
                            <span class="material-symbols-outlined text-[20px]">error</span>
                            <div>
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('backend.login.submit') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-semibold text-primary">Email</label>
                            <div class="relative">
                                <span class="material-symbols-outlined pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-[20px] text-on-surface-variant">mail</span>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" inputmode="email" spellcheck="false"
                                    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                                    @if($errors->any()) aria-describedby="login-alert" @endif
                                    class="w-full rounded-xl border bg-surface-container-lowest py-3 pl-11 pr-3.5 text-sm text-on-surface outline-none transition placeholder:text-on-surface-variant/50 focus:ring-2 {{ $errors->has('email') ? 'border-error focus:ring-error/30' : 'border-outline-variant focus:border-primary focus:ring-primary/15' }}"
                                    placeholder="nama@havenpalais.test">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="mb-1.5 block text-sm font-semibold text-primary">Password</label>
                            <div class="relative">
                                <span class="material-symbols-outlined pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-[20px] text-on-surface-variant">lock</span>
                                <input id="password" type="password" name="password" required autocomplete="current-password"
                                    aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                                    @if($errors->has('password')) aria-describedby="login-alert" @endif
                                    class="w-full rounded-xl border bg-surface-container-lowest py-3 pl-11 pr-12 text-sm text-on-surface outline-none transition placeholder:text-on-surface-variant/50 focus:ring-2 {{ $errors->has('password') ? 'border-error focus:ring-error/30' : 'border-outline-variant focus:border-primary focus:ring-primary/15' }}"
                                    placeholder="Password akun">
                                <button type="button" id="toggle-password" class="absolute right-2 top-1/2 inline-flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-lg text-on-surface-variant hover:bg-surface-container-low hover:text-primary" aria-label="Tampilkan password" aria-pressed="false">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </button>
                            </div>
                        </div>

                        <label class="flex cursor-pointer items-center gap-2.5 rounded-xl px-1 py-1 text-sm text-on-surface-variant">
                            <input type="checkbox" name="remember" value="1" @checked(old('remember')) class="h-4 w-4 rounded border-outline-variant text-primary focus:ring-primary/30">
                            Ingat saya di perangkat ini
                        </label>

                        <button type="submit" id="login-submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-primary px-4 py-3.5 text-sm font-semibold text-white transition hover:bg-primary-container focus:outline-none focus:ring-2 focus:ring-primary/30 focus:ring-offset-2 disabled:cursor-wait disabled:opacity-80">
                            <span data-label>Masuk ke panel</span>
                            <span data-spinner class="hidden h-4 w-4 rounded-full border-2 border-white/40 border-r-white login-spinner"></span>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script>
        const password = document.getElementById('password');
        const toggle = document.getElementById('toggle-password');
        const form = document.querySelector('form');
        const submit = document.getElementById('login-submit');

        toggle.addEventListener('click', () => {
            const visible = password.type === 'text';
            password.type = visible ? 'password' : 'text';
            toggle.setAttribute('aria-pressed', visible ? 'false' : 'true');
            toggle.setAttribute('aria-label', visible ? 'Tampilkan password' : 'Sembunyikan password');
            toggle.querySelector('span').textContent = visible ? 'visibility' : 'visibility_off';
            password.focus();
        });

        form.addEventListener('submit', () => {
            submit.querySelector('[data-label]').textContent = 'Memproses...';
            submit.querySelector('[data-spinner]').classList.remove('hidden');
            window.setTimeout(() => { submit.disabled = true; }, 0);
        });
    </script>
</body>
</html>
