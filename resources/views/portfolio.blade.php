@extends('layout')
@section('content')
    <section class="max-w-screen-xl mx-auto py-12 px-6">

        <div class="w-full bg-white rounded-xl p-4 mb-8 flex items-center justify-between border border-gray-100">
            <h3 class="text-gray-400 text-sm md:text-base ml-4 font-medium">อัปโหลดพอร์ตฟอลิโอของคุณ?</h3>
            <a href="{{ route('profile.portfolio') }}"
                class="bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white px-6 py-2 rounded-xl flex items-center gap-2 transition-all font-medium text-sm shadow-none">
                อัปโหลดผลงาน
                <i class="fa-solid fa-upload"></i>
            </a>
        </div>

        <form action="{{ route('portfolio') }}" method="GET" class="flex flex-wrap items-center gap-4 mb-8">
            <div class="relative flex-grow max-w-2xl">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหา Portfolio, ชื่อ, มหาลัย..."
                    class="w-full bg-white border border-gray-100 text-sm rounded-xl px-4 py-3 outline-none focus:ring-1 focus:ring-[#5EBEE6]">
                <button type="submit"
                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#5EBEE6] hover:bg-[#4fb1d8] transition-colors text-white px-6 py-1.5 rounded-lg text-sm font-medium">
                    ค้นหา
                </button>
            </div>
            <select name="sort" onchange="this.form.submit()"
                class="bg-white border border-gray-100 text-gray-500 text-sm rounded-xl px-4 py-3 outline-none min-w-[140px] cursor-pointer">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>ล่าสุด</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>ยอดนิยม</option>
            </select>
        </form>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <div class="lg:col-span-9 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @forelse ($portfolios as $portfolio)
                    <a href="{{ route('portfolio.show', $portfolio->id) }}"
                        class="block group cursor-pointer bg-white rounded-xl overflow-hidden border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:shadow-blue-500/10">
                        
                        <div class="relative h-72 md:h-80 overflow-hidden bg-gray-50 flex items-center justify-center">
                            @php $ext = strtolower(pathinfo($portfolio->file_path, PATHINFO_EXTENSION)); @endphp
                            
                            @if($ext == 'pdf')
                                <canvas class="pdf-thumbnail w-full h-full object-cover group-hover:scale-105 transition-all duration-500 opacity-0" data-pdf-url="{{ asset($portfolio->file_path) }}"></canvas>
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 pdf-loading">
                                    <i class="fa-solid fa-spinner fa-spin text-2xl mb-2"></i>
                                </div>
                            @else
                                <img src="{{ asset($portfolio->file_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Portfolio Cover">
                            @endif
                        </div>

                        <div class="p-4 text-left border-t border-gray-50">
                            <div class="flex items-center gap-2 mb-2">
                                @if($portfolio->user && $portfolio->user->profile_image)
                                    <img src="{{ asset($portfolio->user->profile_image) }}" class="w-5 h-5 rounded-full object-cover">
                                @else
                                    <div class="w-5 h-5 bg-slate-800 text-white rounded-full flex items-center justify-center text-[8px] shrink-0"><i class="fa-solid fa-graduation-cap"></i></div>
                                @endif
                                <span class="text-[10px] text-gray-400 font-medium line-clamp-1" title="{{ $portfolio->university }}">{{ $portfolio->university }}</span>
                            </div>
                            
                            <h4 class="text-slate-800 text-sm font-medium mb-1 line-clamp-1">{{ $portfolio->first_name }} {{ $portfolio->last_name }}</h4>
                            
                            <p class="text-gray-400 text-[10px] font-normal leading-relaxed line-clamp-2 mb-3 h-[30px]" title="{{ $portfolio->description }}">
                                {{ $portfolio->description }}
                            </p>
                            
                            <div class="flex items-center justify-between text-[10px] text-gray-400 pt-3 border-t border-gray-50">
                                <div class="flex items-center gap-1">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>{{ number_format($portfolio->views) }}</span>
                                </div>
                                <span class="font-normal">{{ $portfolio->created_at->format('Y') }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-16 text-center text-gray-400 border border-dashed border-gray-200 rounded-xl bg-white w-full">
                        <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-300"></i>
                        <p class="text-sm font-medium">ยังไม่มีผลงานในระบบ</p>
                    </div>
                @endforelse

            </div>

            <div class="lg:col-span-3 space-y-6">
                <div class="bg-white border border-gray-100 rounded-xl p-6">
                    <div class="flex items-center gap-3 mb-6 text-[#5EBEE6]">
                        <i class="fa-solid fa-lightbulb text-xl"></i>
                        <h4 class="font-medium text-slate-800">เคล็ดลับ Portfolio ที่ดี</h4>
                    </div>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <span class="text-gray-200 font-medium text-2xl">1</span>
                            <div>
                                <p class="text-xs font-medium text-slate-700 mb-1">ใช้ภาพประกอบชัดเจน</p>
                                <p class="text-[10px] text-gray-400 font-normal leading-relaxed">ถ่ายรูปผลงานจริงในที่ที่มีแสงเพียงพอ จะช่วยให้พอร์ตดูน่าสนใจขึ้นมาก</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-gray-200 font-medium text-2xl">2</span>
                            <div>
                                <p class="text-xs font-medium text-slate-700 mb-1">อธิบาย Process</p>
                                <p class="text-[10px] text-gray-400 font-normal leading-relaxed">เล่าเรื่องราวที่มาที่ไปของผลงาน และบทบาทที่ได้รับในโปรเจกต์</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-gray-200 font-medium text-2xl">3</span>
                            <div>
                                <p class="text-xs font-medium text-slate-700 mb-1">ระบุเป้าหมาย</p>
                                <p class="text-[10px] text-gray-400 font-normal leading-relaxed">บอกให้ชัดเจนว่าโปรเจกต์นี้ตั้งใจจะแก้ไขปัญหาอะไร</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-gray-200 font-medium text-2xl">4</span>
                            <div>
                                <p class="text-xs font-medium text-slate-700 mb-1">แนบลิงก์สาธิต</p>
                                <p class="text-[10px] text-gray-400 font-normal leading-relaxed">ใส่ QR Code หรือลิงก์วิดีโอเพื่อเพิ่มความน่าเชื่อถือให้พอร์ต</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @if($portfolios->hasPages())
            <div class="mt-12 w-full overflow-hidden">
                {{ $portfolios->links() }}
            </div>
        @endif

    </section>

    <script src="{{asset('assets/js/portfolio-home.js')}}"></script>
@endsection