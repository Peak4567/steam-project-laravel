@extends('layout')
@section('content')

    <section class="w-full bg-slate-50/50 py-16 px-4 md:px-6 font-mitr relative overflow-hidden">
        {{-- Background Glow (สไตล์เรืองแสงอ่อนๆ ด้านหลังตามหน้าหลักและคลังชีทสรุป) --}}
        <div class="absolute top-0 left-0 w-[400px] h-[400px] bg-[#5EBEE6]/10 rounded-full blur-3xl -z-10 pointer-events-none -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-[300px] h-[300px] bg-blue-400/5 rounded-full blur-3xl -z-10 pointer-events-none translate-x-1/2 translate-y-1/2"></div>

        {{-- ปรับขนาด Container หลักบีบเข้าตรงกลางที่ max-w-6xl --}}
        <div class="max-w-6xl mx-auto">

            {{-- 🌟 ส่วนที่ 1: กิจกรรมแนะนำเด่นบทเรียน (Hero Card ดีไซน์โปร่งแสง Glassmorphism) 🌟 --}}
            @if($activities->count() > 0)
                @php $hero = $activities->first(); @endphp
                <div class="w-full bg-white/80 backdrop-blur-xl border border-white/60 rounded-[2rem] p-6 md:p-8 flex flex-col lg:flex-row gap-6 lg:gap-8 mb-12 items-center shadow-lg transition-all duration-300 hover:border-[#5EBEE6]/30 group">
                    
                    {{-- ภาพหน้าปกกิจกรรม --}}
                    <div class="w-full lg:w-2/5 h-60 md:h-72 overflow-hidden rounded-2xl relative shrink-0">
                        <img src="{{ $hero->image_path ? asset($hero->image_path) : asset('assets/img/default-event.jpg') }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" alt="{{ $hero->title }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent"></div>
                    </div>

                    {{-- รายละเอียดข้อมูล --}}
                    <div class="w-full lg:w-3/5 text-left flex flex-col justify-between h-full">
                        <div>
                            <span class="inline-block px-3 py-1 bg-blue-50 border border-blue-100/50 text-[#5EBEE6] font-bold rounded-md text-[9px] mb-3 uppercase tracking-wider">
                                {{ $hero->category ?? 'กิจกรรมทั่วไป' }}
                            </span>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-3 tracking-tight group-hover:text-[#5EBEE6] transition-colors leading-tight">
                                {{ $hero->title }}
                            </h2>
                            <p class="text-slate-500 text-sm mb-5 leading-relaxed line-clamp-2 md:line-clamp-3 font-medium">
                                {{ $hero->description }}
                            </p>
                        </div>
                        
                        {{-- ไอเทมกล่องข้อมูลย่อย --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2.5 mb-6 bg-slate-50/50 border border-slate-100/30 p-4 rounded-xl">
                            <div class="flex items-center gap-2.5 text-slate-600 text-xs font-medium">
                                <i class="fa-regular fa-calendar text-[#5EBEE6] text-sm"></i> {{ date('d M Y', strtotime($hero->date)) }}
                            </div>
                            <div class="flex items-center gap-2.5 text-slate-600 text-xs font-medium">
                                <i class="fa-regular fa-clock text-[#5EBEE6] text-sm"></i> {{ $hero->time_range }} น.
                            </div>
                            <div class="flex items-center gap-2.5 text-slate-600 text-xs font-medium">
                                <i class="fa-solid fa-location-dot text-[#5EBEE6] text-sm"></i> <span class="truncate">{{ $hero->location }}</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-slate-700 text-xs font-bold">
                                <i class="fa-solid fa-user-group text-[#5EBEE6] text-sm"></i> รับสมัคร {{ $hero->current_participants }} / {{ $hero->max_participants }} คน
                            </div>
                            <div class="flex items-center gap-2.5 text-slate-600 text-xs font-medium sm:col-span-2 pt-2 border-t border-slate-200/60">
                                <i class="fa-solid fa-user-tie text-[#5EBEE6] text-sm"></i> วิทยากร: 
                                <span class="font-bold text-slate-800 ml-1">
                                    @forelse($hero->lecturers as $lec)
                                        {{ $lec->first_name }} {{ $lec->last_name }}@if(!$loop->last), @endif
                                    @empty
                                        ไม่ได้ระบุข้อมูล
                                    @endforelse
                                </span>
                            </div>
                        </div>

                        <a href="{{ route('activity.apply', $hero->id) }}"
                            class="px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-md inline-block self-start active:scale-95">
                            สมัครเข้าร่วมกิจกรรม <i class="fa-solid fa-arrow-right ml-1.5 text-[10px]"></i>
                        </a>
                    </div>
                </div>
            @endif

            {{-- 🌟 ส่วนที่ 2: จัดสัดส่วนโครงสร้างแบบ 12 คอลัมน์ (เหมือนคลังชีทสรุป) 🌟 --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                {{-- ฝั่งซ้าย: รายการกิจกรรมย่อยทั้งหมด (lg:col-span-8) --}}
                <div class="lg:col-span-8 space-y-5">
                    
                    {{-- ตกแต่งหัวข้อหลักแบบไล่เฉดสี Gradient --}}
                    <div class="flex justify-between items-center mb-6 border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-2.5 h-7 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                            <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">กิจกรรมทั้งหมด</h3>
                        </div>
                        <span class="text-xs text-[#5EBEE6] bg-blue-50 px-4 py-1.5 rounded-lg font-bold border border-blue-100/50">
                            ทั้งหมด {{ $activities->count() }} รายการ
                        </span>
                    </div>

                    {{-- รายการ Card กิจกรรมย่อย --}}
                    <div class="space-y-4">
                        @forelse ($activities as $act)
                            <div class="w-full bg-white border border-slate-100 rounded-2xl p-4 flex flex-col sm:flex-row gap-5 items-center shadow-sm hover:shadow-lg transition-all duration-300 group">
                                <div class="w-full sm:w-32 h-32 flex-shrink-0 rounded-xl overflow-hidden bg-slate-50 relative">
                                    <img src="{{ $act->image_path ? asset($act->image_path) : asset('assets/img/default-event.jpg') }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Event">
                                </div>
                                
                                <div class="flex-grow text-left w-full">
                                    <span class="text-[9px] text-[#5EBEE6] font-bold uppercase tracking-widest mb-1 block">{{ $act->category ?? 'General' }}</span>
                                    <h4 class="text-base font-bold text-slate-800 mb-1.5 line-clamp-1 group-hover:text-[#5EBEE6] transition-colors">{{ $act->title }}</h4>
                                    
                                    <p class="text-[11px] text-slate-400 mb-2.5 flex items-center gap-1.5 font-medium">
                                        <i class="fa-solid fa-chalkboard-user text-slate-300"></i>
                                        @forelse($act->lecturers as $lec)
                                            {{ $lec->first_name }} {{ $lec->last_name }}@if(!$loop->last), @endif
                                        @empty
                                            ไม่มีข้อมูลวิทยากร
                                        @endforelse
                                    </p>

                                    <div class="grid grid-cols-2 gap-x-2 gap-y-1.5 pt-1 border-t border-slate-50">
                                        <div class="flex items-center gap-1.5 text-slate-500 text-[11px] font-medium">
                                            <i class="fa-regular fa-calendar text-[#5EBEE6]/80"></i> {{ date('d/m/Y', strtotime($act->date)) }}
                                        </div>
                                        <div class="flex items-center gap-1.5 text-slate-500 text-[11px] font-medium">
                                            <i class="fa-regular fa-clock text-[#5EBEE6]/80"></i> {{ $act->time_range }} น.
                                        </div>
                                        <div class="flex items-center gap-1.5 text-slate-500 text-[11px] font-medium">
                                            <i class="fa-solid fa-location-dot text-[#5EBEE6]/80"></i> <span class="truncate">{{ $act->location }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 text-slate-600 text-[11px] font-bold">
                                            <i class="fa-solid fa-user-group text-[#5EBEE6]/80"></i> {{ $act->current_participants }} / {{ $act->max_participants }} คน
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-shrink-0 w-full sm:w-auto pt-2 sm:pt-0">
                                    <a href="{{ route('activity.apply', $act->id) }}"
                                        class="w-full sm:w-auto px-5 py-2 bg-blue-50 text-[#5EBEE6] border border-blue-100/50 hover:bg-[#5EBEE6] hover:text-white rounded-xl text-xs font-bold transition-all text-center block shadow-sm">
                                        ดูรายละเอียด
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="py-16 text-center border border-dashed border-slate-200 rounded-3xl bg-white shadow-sm flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3 shadow-sm">
                                    <i class="fa-solid fa-calendar-xmark text-2xl text-slate-300"></i>
                                </div>
                                <h3 class="text-base font-bold text-slate-700 mb-0.5">ไม่พบข้อมูลกิจกรรมในขณะนี้</h3>
                                <p class="text-xs text-slate-400">ระบบกำลังเตรียมกิจกรรมใหม่ๆ โปรดติดตามอัปเดต</p>
                            </div>
                        @endforelse
                        
                        <div class="mt-6">
                            {{ $activities->links() }}
                        </div>
                    </div>
                </div>

                {{-- ฝั่งขวา: ปฏิทินแสดงตารางกิจกรรมยึดสไตล์ Sidebar (lg:col-span-4) --}}
                <div class="lg:col-span-4 w-full">
                    <div class="bg-white border border-slate-100 rounded-3xl overflow-hidden shadow-lg">
                        
                        {{-- แถบหัวขวาสุดเข้มสไตล์เก๋ --}}
                        <div class="bg-slate-900 p-4 text-white flex justify-between items-center px-6 min-h-[50px]">
                            <i class="fa-regular fa-calendar-days opacity-80"></i>
                            <span class="text-xs font-bold uppercase tracking-[0.15em] opacity-90">Activity Calendar</span>
                            <div></div>
                        </div>

                        <div class="p-5 bg-white">
                            <div class="flex justify-between items-center mb-5 px-1">
                                <button class="w-7 h-7 rounded-lg hover:bg-slate-50 text-slate-400 hover:text-[#5EBEE6] transition-colors"><i class="fa-solid fa-angle-left text-xs"></i></button>
                                <span class="text-slate-800 font-extrabold text-xs tracking-wide uppercase">{{ date('M Y') }}</span>
                                <button class="w-7 h-7 rounded-lg hover:bg-slate-50 text-slate-400 hover:text-[#5EBEE6] transition-colors"><i class="fa-solid fa-angle-right text-xs"></i></button>
                            </div>

                            <div class="grid grid-cols-7 gap-1 text-center text-[10px] text-slate-400 mb-3 font-bold uppercase tracking-wide">
                                <span class="text-red-400">Sun</span><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span>
                            </div>

                            <div class="grid grid-cols-7 gap-1 text-center">
                                @php 
                                    $currentMonth = date('Y-m');
                                    $daysInMonth = date('t');
                                    $today = date('j');
                                @endphp
                                @for ($d = 1; $d <= $daysInMonth; $d++)
                                    @php 
                                        $dateStr = $currentMonth . '-' . sprintf('%02d', $d);
                                        $hasEvent = $activities->where('date', $dateStr)->count() > 0;
                                    @endphp
                                    <div class="py-1.5 text-xs font-bold rounded-xl transition-all
                                        {{ $hasEvent ? 'bg-gradient-to-br from-yellow-400 to-orange-400 text-white font-black shadow-sm cursor-pointer hover:scale-110' : 'text-slate-600 hover:bg-slate-50' }}
                                        {{ $d == $today ? 'border border-[#5EBEE6] text-[#5EBEE6]' : '' }}">
                                        {{ $d }}
                                    </div>
                                @endfor
                            </div>

                            {{-- แถบคำอธิบายสีกิจกรรม --}}
                            <div class="mt-5 pt-4 border-t border-slate-50 flex flex-wrap gap-4 text-[10px] font-bold uppercase text-slate-400 tracking-wider">
                                <div class="flex items-center gap-1.5">
                                    <div class="w-2.5 h-2.5 rounded-full border border-[#5EBEE6]"></div> วันนี้
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <div class="w-2.5 h-2.5 rounded-full bg-gradient-to-br from-yellow-400 to-orange-400 shadow-sm"></div> มีกิจกรรม
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection