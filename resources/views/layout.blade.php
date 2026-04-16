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
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- font-awesome --}}
    <link href="{{ asset('assets/font-awesome/css/all.min.css') }}" rel="stylesheet">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <title>Document</title>
</head>

<body class="bg-[#feffff]">
    <x-top-bar />
    @if (Route::is('home'))
        <x-frontend.home.hero />
    @endif
    <x-navbar />
    <main>
        @yield('content')
    </main>

    <x-footer />
</body>

</html>
