<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- tailwind --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    {{-- PDF --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    {{-- font-awesome --}}
    <link href="{{ asset('assets/font-awesome/css/all.min.css') }}" rel="stylesheet">
    
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/steam.png') }}">
    <title>{{ $globalSettings['site_name'] ?? 'ศูนย์โครงการสตรีม | STEAM' }}</title>
    <meta name="description" content="{{ $globalSettings['seo_description'] ?? '' }}">
    <meta name="keywords" content="{{ $globalSettings['seo_keywords'] ?? '' }}">
    <style>
        html {
            scroll-behavior: smooth;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f8fafc;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #5EBEE6;
        }
    </style>
</head>

<body class="bg-[#feffff] min-h-screen flex flex-col overflow-x-hidden antialiased">
    
    @if (session('success'))
        <input type="hidden" id="laravel-flash-success" value="{{ session('success') }}">
    @endif

    @if ($errors->any())
        <input type="hidden" id="laravel-flash-error" value="{{ $errors->first() }}">
    @endif

    <x-navbar />

    <main class="flex-1 w-full h-full overflow-y-visible">
        @yield('content')
    </main>

    <x-footer />

    <x-cookie-consent />

    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
</body>

</html>