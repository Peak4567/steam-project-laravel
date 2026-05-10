@extends('layout')
@section('content')
    <section class="max-w-screen-xl mx-auto py-12 px-6 font-mitr bg-white">

        @if($activities->count() > 0)
            @php $hero = $activities->first(); @endphp
            <div class="w-full bg-white border border-gray-100 rounded-xl p-6 flex flex-col md:flex-row gap-8 mb-16 items-center shadow-sm transition-all hover:border-[#5EBEE6]/20">
                <div class="w-full md:w-2/5 h-64 md:h-80 overflow-hidden rounded-md">
                    <img src="{{ $hero->image_path ? asset($hero->image_path) : asset('assets/img/default-event.jpg') }}" 
                         class="w-full h-full object-cover shadow-inner" alt="{{ $hero->title }}">
                </div>
                <div class="w-full md:w-3/5 text-left">
                    <span class="px-4 py-1.5 bg-[#5EBEE6]/10 text-[#5EBEE6] rounded-full text-xs mb-4 inline-block font-bold">
                        {{ $hero->category ?? 'กิจกรรมทั่วไป' }}
                    </span>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-4">{{ $hero->title }}</h2>
                    <p class="text-gray-400 text-sm mb-6 leading-relaxed line-clamp-3">
                        {{ $hero->description }}
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 mb-8">
                        <div class="flex items-center gap-2 text-slate-600 text-[13px]">
                            <i class="fa-regular fa-calendar text-[#5EBEE6]"></i> {{ date('d M Y', strtotime($hero->date)) }}
                        </div>
                        <div class="flex items-center gap-2 text-slate-600 text-[13px]">
                            <i class="fa-regular fa-clock text-[#5EBEE6]"></i> {{ $hero->time_range }} น.
                        </div>
                        <div class="flex items-center gap-2 text-slate-600 text-[13px]">
                            <i class="fa-solid fa-location-dot text-[#5EBEE6]"></i> {{ $hero->location }}
                        </div>
                        <div class="flex items-center gap-2 text-slate-600 text-[13px]">
                            <i class="fa-solid fa-user-group text-[#5EBEE6]"></i> รับสมัคร {{ $hero->current_participants }}/{{ $hero->max_participants }} คน
                        </div>
                        <div class="flex items-center gap-2 text-slate-600 text-[13px] sm:col-span-2">
                            <i class="fa-solid fa-user-tie text-[#5EBEE6]"></i> วิทยากร: 
                            <span class="font-medium text-slate-800">
                                @forelse($hero->lecturers as $lec)
                                    {{ $lec->first_name }} {{ $lec->last_name }}@if(!$loop->last), @endif
                                @empty
                                    ไม่ได้ระบุ
                                @endforelse
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('activity.apply', $hero->id) }}"
                        class="px-8 py-3 bg-[#5EBEE6] text-white rounded-xl text-sm font-bold hover:bg-[#4fb1d8] transition-all shadow-sm inline-block">
                        สมัครเข้าร่วมกิจกรรม
                    </a>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-16">
            <div class="lg:col-span-8">
                <div class="flex items-center gap-3 mb-8 px-2">
                    <div class="w-1.5 h-7 bg-[#5EBEE6] rounded-full"></div>
                    <h3 class="text-xl font-bold text-slate-900">กิจกรรมทั้งหมด</h3>
                </div>

                <div class="space-y-6">
                    @forelse ($activities as $act)
                        <div class="w-full bg-white border border-gray-100 rounded-[1.8rem] p-4 flex flex-col md:flex-row gap-5 items-center hover:border-[#5EBEE6]/30 hover:shadow-md transition-all group">
                            <div class="w-full md:w-40 h-40 flex-shrink-0 rounded-[1.2rem] overflow-hidden">
                                <img src="{{ $act->image_path ? asset($act->image_path) : asset('assets/img/default-event.jpg') }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Event">
                            </div>
                            <div class="flex-grow text-left">
                                <span class="text-[10px] text-[#5EBEE6] font-bold uppercase tracking-wider mb-1 block">{{ $act->category ?? 'General' }}</span>
                                <h4 class="text-lg font-bold text-slate-800 mb-1 line-clamp-1 group-hover:text-[#5EBEE6] transition-colors">{{ $act->title }}</h4>
                                
                                <p class="text-[11px] text-gray-500 mb-3 flex items-center gap-1.5">
                                    <i class="fa-solid fa-chalkboard-user text-[#5EBEE6]"></i>
                                    @forelse($act->lecturers as $lec)
                                        {{ $lec->first_name }} {{ $lec->last_name }}@if(!$loop->last), @endif
                                    @empty
                                        ไม่มีข้อมูลวิทยากร
                                @endforelse
                                </p>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 mb-4">
                                    <div class="flex items-center gap-2 text-slate-500 text-[11px] font-medium">
                                        <i class="fa-regular fa-calendar text-[#5EBEE6]"></i> {{ date('d/m/Y', strtotime($act->date)) }}
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-500 text-[11px] font-medium">
                                        <i class="fa-regular fa-clock text-[#5EBEE6]"></i> {{ $act->time_range }} น.
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-500 text-[11px] font-medium">
                                        <i class="fa-solid fa-location-dot text-[#5EBEE6]"></i> {{ $act->location }}
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-500 text-[11px] font-medium">
                                        <i class="fa-solid fa-user-group text-[#5EBEE6]"></i> {{ $act->current_participants }}/{{ $act->max_participants }} คน
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0 w-full md:w-auto">
                                <a href="{{ route('activity.apply', $act->id) }}"
                                    class="w-full md:w-auto px-6 py-2.5 border border-[#5EBEE6] text-[#5EBEE6] rounded-xl text-xs font-bold hover:bg-[#5EBEE6] hover:text-white transition-all text-center block">
                                    ดูรายละเอียด
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                            <i class="fa-solid fa-calendar-xmark text-4xl text-gray-200 mb-3"></i>
                            <p class="text-gray-400 font-medium">ไม่พบข้อมูลกิจกรรมในขณะนี้</p>
                        </div>
                    @endforelse
                    
                    <div class="mt-8">
                        {{ $activities->links() }}
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8">
                <div class="bg-white border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-[#5EBEE6] p-4 text-white flex justify-between items-center px-6">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span class="text-sm font-bold uppercase tracking-widest italic">Activity Calendar</span>
                        <div></div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6 px-2">
                            <button class="text-gray-400 hover:text-[#5EBEE6]"><i class="fa-solid fa-angle-left"></i></button>
                            <span class="text-slate-700 font-bold text-sm uppercase">{{ date('M Y') }}</span>
                            <button class="text-gray-400 hover:text-[#5EBEE6]"><i class="fa-solid fa-angle-right"></i></button>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-center text-[10px] text-gray-400 mb-2 font-bold uppercase">
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
                                <div class="py-2 text-[11px] transition-all rounded-lg 
                                    {{ $hasEvent ? 'bg-[#FFB917] text-white font-bold shadow-sm cursor-pointer hover:scale-110' : 'text-slate-600' }}
                                    {{ $d == $today ? 'border border-[#5EBEE6] text-[#5EBEE6]' : '' }}">
                                    {{ $d }}
                                </div>
                            @endfor
                        </div>
                        <div class="mt-6 flex flex-wrap gap-4 text-[10px] font-bold uppercase">
                            <div class="flex items-center gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full border border-[#5EBEE6]"></div> วันนี้
                            </div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full bg-[#FFB917]"></div> มีกิจกรรม
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection