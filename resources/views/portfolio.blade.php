@extends('layout')
@section('content')
    <section class="w-full bg-slate-50/50 py-16 px-4 md:px-6 font-mitr relative overflow-hidden">
        <div
            class="absolute top-0 left-0 w-[400px] h-[400px] bg-[#5EBEE6]/10 rounded-full blur-3xl -z-10 pointer-events-none -translate-x-1/2 -translate-y-1/2">
        </div>
        <div
            class="absolute bottom-0 right-0 w-[300px] h-[300px] bg-blue-400/5 rounded-full blur-3xl -z-10 pointer-events-none translate-x-1/2 translate-y-1/2">
        </div>

        <div class="max-w-6xl mx-auto">

            <div
                class="w-full bg-white/80 backdrop-blur-xl rounded-[2rem] p-6 md:p-8 mb-10 flex flex-col md:flex-row items-center justify-between border border-white/60 shadow-[0_8px_30px_rgba(0,0,0,0.03)] gap-6 group">
                <div class="flex items-center gap-5 w-full md:w-auto">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-[#5EBEE6] to-blue-500 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20 shrink-0 group-hover:scale-105 transition-transform duration-500">
                        <i class="fa-solid fa-folder-open text-white text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl md:text-3xl text-slate-900 font-extrabold tracking-tight">แฟ้มผลงาน</h2>
                        <p class="text-slate-500 text-sm font-medium mt-1">คลังสะสมแฟ้มผลงานและประวัติกิจกรรม (Portfolio)
                            เพื่อสร้างแรงบันดาลใจ</p>
                    </div>
                </div>
                <a href="{{ route('profile.portfolio') }}"
                    class="w-full md:w-auto flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-8 py-3.5 rounded-xl font-semibold text-sm transition-all shadow-md active:scale-95">
                    อัปโหลดผลงาน
                    <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                </a>
            </div>

            {{-- 🌟 ส่วนที่ 2: ช่องป้อนคำค้นหาและคัดกรอง (Search & Filters) 🌟 --}}
            <form action="{{ route('portfolio') }}" method="GET"
                class="flex flex-col md:flex-row items-center gap-4 mb-10 relative z-20">
                <div class="relative w-full flex-grow shadow-sm">
                    <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-[#5EBEE6] text-lg"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="ค้นหาชื่อผลงาน, ชื่อผู้จัดทำ หรือมหาวิทยาลัย..."
                        class="w-full bg-white border border-slate-100 text-slate-700 text-sm font-medium rounded-2xl py-4.5 pl-14 pr-32 outline-none focus:ring-2 focus:ring-[#5EBEE6]/50 focus:border-[#5EBEE6] shadow-sm transition-all">
                    <button type="submit"
                        class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-gradient-to-r from-[#5EBEE6] to-[#3B9ADE] hover:opacity-90 transition-opacity text-white px-6 py-2 rounded-xl text-sm font-bold shadow-md shadow-blue-500/20">
                        ค้นหา
                    </button>
                </div>

                <div class="relative w-full md:w-auto shrink-0 shadow-sm">
                    <select name="sort" onchange="this.form.submit()"
                        class="appearance-none w-full md:w-auto bg-white border border-slate-100 text-slate-600 font-bold text-sm rounded-2xl px-6 py-4.5 outline-none focus:ring-2 focus:ring-[#5EBEE6]/50 shadow-sm cursor-pointer pr-12 transition-all">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>เรียงจาก: ล่าสุด</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>เรียงจาก: ยอดนิยม
                        </option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-5 flex items-center text-slate-400">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </form>

            {{-- 🌟 ส่วนที่ 3: Layout แบ่งฝั่งการ์ดพอร์ตและเมนูเคล็ดลับ (9/12 กับ 3/12) 🌟 --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                {{-- ฝั่งซ้าย: รายการการ์ดแฟ้มผลงาน (lg:col-span-9) --}}
                <div class="lg:col-span-9">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                        @forelse ($portfolios as $portfolio)
                            <a href="{{ route('portfolio.show', $portfolio->id) }}"
                                class="block group cursor-pointer bg-white rounded-2xl overflow-hidden border border-slate-100 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md flex flex-col h-full">

                                {{-- ตัวอย่างหน้าปก --}}
                                <div
                                    class="relative h-64 overflow-hidden bg-slate-50 flex items-center justify-center border-b border-slate-50">
                                    @php $ext = strtolower(pathinfo(($portfolio->file_path[0] ?? ''), PATHINFO_EXTENSION)); @endphp

                                    @if ($ext == 'pdf')
                                        <canvas
                                            class="pdf-thumbnail w-full h-full object-cover group-hover:scale-105 transition-all duration-700 ease-out opacity-0"
                                            data-pdf-url="{{ asset(($portfolio->file_path[0] ?? '')) }}"></canvas>
                                        <div
                                            class="absolute inset-0 flex flex-col items-center justify-center text-slate-300 pdf-loading bg-slate-50/50">
                                            <i class="fa-solid fa-spinner fa-spin text-xl mb-2 text-[#5EBEE6]"></i>
                                        </div>
                                    @else
                                        <img src="{{ asset(($portfolio->file_path[0] ?? '')) }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                            alt="Portfolio Cover">
                                    @endif

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-slate-900/10 via-transparent to-transparent">
                                    </div>
                                </div>

                                {{-- ข้อมูลด้านล่างการ์ด --}}
                                <div class="p-5 text-left flex flex-col flex-grow bg-white">
                                    <div class="flex items-center gap-2 mb-3 overflow-hidden">
                                        @if ($portfolio->user && $portfolio->user->profile_image)
                                            <img src="{{ asset($portfolio->user->profile_image) }}"
                                                class="w-5 h-5 rounded-full object-cover shrink-0">
                                        @else
                                            <div
                                                class="w-5 h-5 bg-blue-50 text-[#5EBEE6] border border-blue-100/50 rounded-full flex items-center justify-center text-[9px] shrink-0">
                                                <i class="fa-solid fa-graduation-cap"></i></div>
                                        @endif
                                        <span class="text-[11px] text-slate-500 font-bold line-clamp-1"
                                            title="{{ $portfolio->university }}">{{ $portfolio->university }}</span>
                                    </div>

                                    <h4
                                        class="text-slate-800 font-bold text-sm mb-1.5 line-clamp-1 group-hover:text-[#5EBEE6] transition-colors">
                                        {{ $portfolio->first_name }} {{ $portfolio->last_name }}</h4>

                                    <p class="text-slate-400 text-xs font-medium leading-relaxed line-clamp-2 mb-4 h-[36px]"
                                        title="{{ $portfolio->description }}">
                                        {{ $portfolio->description }}
                                    </p>

                                    <div
                                        class="flex items-center justify-between text-[11px] text-slate-400 pt-3 border-t border-slate-50 mt-auto">
                                        <div class="flex items-center gap-1.5 font-medium">
                                            <i class="fa-regular fa-eye text-slate-300"></i>
                                            <span>{{ number_format($portfolio->views) }} <span
                                                    class="text-[10px] text-slate-400 font-normal">วิว</span></span>
                                        </div>
                                        <span
                                            class="font-bold bg-slate-50 px-2 py-0.5 rounded text-slate-500">{{ $portfolio->created_at->format('Y') }}</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div
                                class="col-span-full py-16 text-center border border-dashed border-slate-200 rounded-3xl bg-white shadow-sm flex flex-col items-center justify-center w-full">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                    <i class="fa-solid fa-folder-open text-3xl text-slate-300"></i>
                                </div>
                                <h3 class="text-base font-bold text-slate-700 mb-0.5">ยังไม่มีแฟ้มผลงานในระบบ</h3>
                                <p class="text-xs text-slate-400">มาร่วมแชร์ผลงานหรือพอร์ตโฟลิโอเจ๋งๆ ของคุณเป็นคนแรกกันเลย
                                </p>
                            </div>
                        @endforelse

                    </div>
                </div>

                {{-- ฝั่งขวา: กล่องแนะนำเคล็ดลับเมนูเสริม (lg:col-span-3) --}}
                <div class="lg:col-span-3 space-y-6 w-full">
                    <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-md relative overflow-hidden">
                        <div class="flex items-center gap-3.5 mb-6 text-[#5EBEE6]">
                            <div
                                class="w-10 h-10 bg-blue-50 border border-blue-100/50 rounded-xl flex items-center justify-center">
                                <i class="fa-regular fa-lightbulb text-lg"></i>
                            </div>
                            <h4 class="font-extrabold text-slate-900 text-base tracking-tight">เคล็ดลับพอร์ตที่ดี</h4>
                        </div>

                        <div class="space-y-6">
                            <div class="flex gap-4 group/item">
                                <span
                                    class="text-slate-100 group-hover/item:text-[#5EBEE6]/20 font-black text-3xl transition-colors select-none">01</span>
                                <div>
                                    <p class="text-xs font-bold text-slate-800 mb-1">ใช้ภาพประกอบชัดเจน</p>
                                    <p class="text-[11px] text-slate-400 font-medium leading-relaxed">
                                        ถ่ายรูปผลงานจริงในที่ที่มีแสงเพียงพอ จะช่วยให้พอร์ตดูสะดุดตาน่าสนใจขึ้นมาก</p>
                                </div>
                            </div>
                            <div class="flex gap-4 group/item">
                                <span
                                    class="text-slate-100 group-hover/item:text-[#5EBEE6]/20 font-black text-3xl transition-colors select-none">02</span>
                                <div>
                                    <p class="text-xs font-bold text-slate-800 mb-1">อธิบายกระบวนการ</p>
                                    <p class="text-[11px] text-slate-400 font-medium leading-relaxed">
                                        เล่าเรื่องราวที่มาที่ไปของผลงานชิ้นนั้นๆ รวมถึงบทบาทที่เราทำในทีม</p>
                                </div>
                            </div>
                            <div class="flex gap-4 group/item">
                                <span
                                    class="text-slate-100 group-hover/item:text-[#5EBEE6]/20 font-black text-3xl transition-colors select-none">03</span>
                                <div>
                                    <p class="text-xs font-bold text-slate-800 mb-1">ระบุเป้าหมายชัดเจน</p>
                                    <p class="text-[11px] text-slate-400 font-medium leading-relaxed">
                                        บอกให้ชัดเจนว่าโครงงานหรือผลงานนี้ถูกสร้างมาเพื่อแก้ไขปัญหาด้านใด</p>
                                </div>
                            </div>
                            <div class="flex gap-4 group/item">
                                <span
                                    class="text-slate-100 group-hover/item:text-[#5EBEE6]/20 font-black text-3xl transition-colors select-none">04</span>
                                <div>
                                    <p class="text-xs font-bold text-slate-800 mb-1">แนบลิงก์คลิปวิดีโอ</p>
                                    <p class="text-[11px] text-slate-400 font-medium leading-relaxed">ใส่ช่องทางติดต่อ QR
                                        Code หรือแนบลิงก์สาธิตการทำงานจริงเพื่อเพิ่มความน่าเชื่อถือ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- แถบสลับหน้าตัวเลข (Pagination) --}}
            @if ($portfolios->hasPages())
                <div class="mt-10 w-full overflow-hidden border-t border-slate-100 pt-6">
                    {{ $portfolios->links() }}
                </div>
            @endif

        </div>
    </section>

    <script src="{{ asset('assets/js/portfolio-home.js') }}"></script>
@endsection
