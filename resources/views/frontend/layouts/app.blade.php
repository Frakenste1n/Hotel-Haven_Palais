<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Haven Palais')</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700&display=swap"
        rel="stylesheet">

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Konfigurasi dan CSS khusus halaman --}}
    @stack('head')

    {{-- CSS tambahan --}}
    @stack('styles')

    {{-- CSS dasar --}}
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            overscroll-behavior: none;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-weight: normal;
            font-style: normal;
            font-size: 28px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            direction: ltr;
            font-feature-settings: 'liga';
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }

        #modal-star-picker .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 28;
            color: #c5c5c5;
            cursor: pointer;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        #modal-star-picker .material-symbols-outlined.active {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 28;
            color: #d4a94f;
        }
    </style>
</head>

<body class="bg-surface font-body-md text-on-surface antialiased">

    {{-- Navbar utama --}}
    @include('partials.nav')

    {{-- Konten halaman --}}
    @yield('content')

    {{-- JavaScript khusus halaman --}}
    @stack('scripts')

</body>

</html>