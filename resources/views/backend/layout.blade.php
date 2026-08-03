<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- tailwind --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- font-awesome --}}
    <link href="{{ asset('assets/font-awesome/css/all.min.css') }}" rel="stylesheet">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/steam.png') }}">
    <title>แผงควบคุมแอดมิน | STEAM PROJECT</title>
</head>

<body class="bg-[#feffff] antialiased">

    @if (session('success'))
        <input type="hidden" id="laravel-flash-success" value="{{ session('success') }}">
    @endif

    @if ($errors->any())
        <input type="hidden" id="laravel-flash-error" value="{{ $errors->first() }}">
    @endif

    @if (session('error'))
        <input type="hidden" id="laravel-flash-error" value="{{ session('error') }}">
    @endif
    <div x-data="{ sidebarOpen: false, sidebarCollapsed: true }" class="flex h-screen overflow-hidden font-mitr">

        @include('components.backend.aside')

        <div class="flex flex-col flex-1 h-screen overflow-y-auto custom-scrollbar">

            <div class="lg:hidden sticky top-0 z-30 bg-white border-b border-slate-100 px-4 py-3 flex items-center gap-3 shadow-sm">
                <button @click="sidebarOpen = true"
                    class="w-9 h-9 rounded-xl bg-slate-50 border border-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <span class="text-sm font-black text-slate-900 tracking-tight">STEAM<span class="text-[#5EBEE6]">X</span> <span class="font-medium text-slate-400 text-xs">Admin</span></span>
            </div>

            @yield('content')
        </div>

    </div>

    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/backend-confirm.js') }}"></script>
</body>

</html>