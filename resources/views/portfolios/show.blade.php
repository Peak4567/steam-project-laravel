@extends('layout')
@section('content')
    <section class="max-w-6xl mx-auto py-8 px-4 md:px-6 font-mitr min-h-screen">

        <div class="mb-6 flex flex-col md:flex-row md:items-start justify-between gap-4">
            <div>
                <a href="{{ route('portfolio') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-[#5EBEE6] transition-colors mb-4 bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm">
                    <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับไปหน้าคลัง
                </a>

                <h2 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $portfolio->first_name }}
                    {{ $portfolio->last_name }}</h2>

                <div class="flex flex-wrap items-center gap-3 mt-3 text-sm text-gray-500">
                    <span
                        class="flex items-center gap-1 bg-[#5EBEE6]/10 text-[#5EBEE6] px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm">
                        <i class="fa-solid fa-graduation-cap"></i> {{ $portfolio->university }}
                    </span>
                    <span
                        class="flex items-center gap-1 text-xs bg-white px-3 py-1.5 rounded-lg border border-gray-100 shadow-sm">
                        <i class="fa-solid fa-eye text-gray-400"></i> {{ number_format($portfolio->views) }} ผู้เข้าชม
                    </span>
                    <span
                        class="flex items-center gap-1 text-xs bg-white px-3 py-1.5 rounded-lg border border-gray-100 shadow-sm">
                        <i class="fa-regular fa-calendar text-gray-400"></i> {{ $portfolio->created_at->format('d/m/Y') }}
                    </span>
                </div>
            </div>

            <a href="{{ asset($portfolio->file_path) }}" download
                class="px-6 py-2.5 bg-white border border-[#5EBEE6] text-[#5EBEE6] hover:bg-[#5EBEE6] hover:text-white rounded-xl text-sm font-bold shadow-sm transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                <i class="fa-solid fa-download"></i> โหลดไฟล์ PDF
            </a>
        </div>

        @if ($portfolio->description)
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm mb-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-[#5EBEE6]"></div>
                <h3 class="text-sm font-bold text-slate-800 mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-[#5EBEE6]"></i> รายละเอียดผลงาน
                </h3>
                <p class="text-sm text-gray-600 leading-relaxed">{{ $portfolio->description }}</p>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col relative">

            <div class="bg-white px-4 py-3 flex flex-wrap items-center justify-between border-b border-gray-100 gap-3">

                <div id="pdf-zoom-controls" class="hidden items-center gap-2">
                    <button id="zoom-out"
                        class="w-8 h-8 flex items-center justify-center bg-gray-50 text-gray-500 rounded-lg border border-gray-200 hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] transition-colors"
                        title="ซูมออก">
                        <i class="fa-solid fa-magnifying-glass-minus"></i>
                    </button>
                    <span id="zoom-level" class="text-xs font-bold text-slate-600 w-10 text-center">70%</span>
                    <button id="zoom-in"
                        class="w-8 h-8 flex items-center justify-center bg-gray-50 text-gray-500 rounded-lg border border-gray-200 hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] transition-colors"
                        title="ซูมเข้า">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                    </button>
                </div>

                <div id="pdf-controls" class="hidden items-center gap-2 ml-auto">
                    <button id="prev-page"
                        class="w-8 h-8 flex items-center justify-center bg-gray-50 text-gray-500 border border-gray-200 rounded-lg hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] transition-colors disabled:opacity-40 disabled:cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <div class="text-xs font-bold text-slate-600 bg-gray-50 border border-gray-100 px-3 py-1.5 rounded-lg">
                        หน้า <span id="page-num" class="text-[#5EBEE6]">1</span> / <span id="page-count">?</span>
                    </div>
                    <button id="next-page"
                        class="w-8 h-8 flex items-center justify-center bg-gray-50 text-gray-500 border border-gray-200 rounded-lg hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] transition-colors disabled:opacity-40 disabled:cursor-not-allowed">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div class="flex flex-col md:flex-row h-[75vh] min-h-[500px]">

                <div
                    class="flex-grow bg-gray-100 relative overflow-auto custom-scrollbar flex justify-center items-center py-4 px-4">
                    <div id="loading-indicator"
                        class="absolute inset-0 flex flex-col items-center justify-center text-[#5EBEE6] z-10 bg-gray-100/90">
                        <i class="fa-solid fa-spinner fa-spin text-5xl mb-4"></i>
                        <span class="font-bold text-lg text-slate-700">กำลังเตรียมเอกสาร...</span>
                    </div>

                    <div id="canvas-container" class="transition-transform duration-300 origin-top">
                        <canvas id="pdf-render"
                            class="bg-white shadow-md border border-gray-200 hidden transition-opacity duration-300"></canvas>
                    </div>

                    <img id="img-render"
                        class="max-h-full max-w-full object-contain shadow-md bg-white border border-gray-200 hidden"
                        alt="Portfolio Image">
                </div>

                <div id="thumbnails-wrapper"
                    class="hidden w-full md:w-48 lg:w-56 bg-white border-t md:border-t-0 md:border-l border-gray-100 overflow-y-auto overflow-x-auto p-4 custom-scrollbar">
                    <div id="thumbnails-container" class="flex flex-row md:flex-col gap-4 items-center">
                    </div>
                </div>

            </div>
        </div>

    </section>

    <script>
        window.PORTFOLIO_PDF_URL = "{{ asset($portfolio->file_path) }}";
    </script>
    <script src="{{ asset('assets/js/show-portfolio.js') }}"></script>
@endsection
