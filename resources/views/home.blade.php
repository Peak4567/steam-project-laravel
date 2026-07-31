@extends('layout')

@section('content')
    {{-- Banner --}}
    <section class="w-full bg-slate-50/50 py-4 md:py-6 px-4 md:px-6 relative overflow-hidden font-mitr">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
            <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-[#5EBEE6]/10 rounded-full blur-3xl"></div>
            <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-blue-300/10 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-6xl mx-auto">
            <div class="relative w-full bg-white/80 backdrop-blur-xl border border-white/60 rounded-[2rem] p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-6 items-center shadow-[0_10px_40px_rgba(0,0,0,0.03)] overflow-hidden group">
                <span
                    class="absolute top-1/2 -translate-y-1/2 -right-4 md:right-2 -rotate-6 text-[4.5rem] md:text-[7rem] lg:text-[9rem] font-black tracking-tighter leading-none whitespace-nowrap text-transparent pointer-events-none select-none z-0 opacity-80"
                    style="-webkit-text-stroke: 2px rgba(94,190,230,0.15);">
                    STEAM
                </span>

                <div class="z-10 flex flex-col items-center md:items-start text-center md:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/90 border border-gray-100 rounded-full shadow-sm mb-4 hover:shadow-md transition-shadow">
                        <img src="{{ asset('assets/img/cpw.png') }}" class="w-4 h-4 object-contain" alt="Chonprathanwittaya School">
                        <span class="text-xs font-semibold text-slate-700">Chonprathanwittaya School</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl text-slate-900 font-bold mb-4 tracking-tight leading-tight drop-shadow-sm">
                        ศูนย์โครงการ<span class="text-transparent bg-clip-text bg-gradient-to-r from-[#5EBEE6] to-blue-500">สตีม</span>คืออะไร?
                    </h2>
                    <p class="text-slate-600 text-sm md:text-base leading-relaxed mb-6 max-w-lg font-medium">
                        เราคือ STEAM ผู้เชี่ยวชาญด้านการบูรณาการวิทยาศาสตร์ เทคโนโลยี วิศวกรรม ศิลปะ และคณิตศาสตร์ พร้อมยกระดับการเรียนรู้สู่ยุคใหม่ ด้วยนวัตกรรมทันสมัย
                    </p>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-[#5EBEE6] to-[#3B9ADE] text-white text-sm font-medium rounded-xl hover:shadow-[0_8px_16px_rgba(94,190,230,0.3)] hover:-translate-y-0.5 transition-all active:scale-95 group">
                        สมัครสมาชิก <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="flex justify-center md:justify-end items-center relative z-10">
                    <div class="absolute inset-0 bg-gradient-to-tr from-[#5EBEE6]/10 to-blue-300/10 rounded-full blur-2xl transform scale-75"></div>
                    <img src="{{ asset('assets/img/steam-bever.png') }}"
                        class="relative z-10 w-[200px] md:w-[240px] lg:w-[280px] h-auto object-contain drop-shadow-xl hover:scale-105 hover:-rotate-1 transition-all duration-500"
                        alt="STEAM Bever">
                </div>
            </div>
        </div>
    </section>

    {{-- Projects --}}
    <section class="w-full py-6 md:py-8 px-4 md:px-6 bg-white font-mitr">
        <div class="max-w-6xl mx-auto">
            <div class="mb-5 flex flex-col md:flex-row justify-between items-end gap-4 border-b border-gray-100 pb-4">
                <div class="flex items-start gap-3">
                    <div class="w-2.5 h-full min-h-[50px] bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full mt-1 shadow-sm"></div>
                    <div>
                        <span class="inline-block text-[#5EBEE6] text-xs font-bold uppercase tracking-widest mb-1">Projects & Competitions</span>
                        <h2 class="text-2xl md:text-3xl text-slate-900 font-extrabold tracking-tight mb-1">โครงงาน / รายการแข่งขัน</h2>
                        <p class="text-slate-500 text-sm max-w-2xl">ค้นหาไอเดีย เข้าร่วมทีม และลงมือทำโครงงานเพื่อพัฒนาศักยภาพของคุณ</p>
                    </div>
                </div>
                <div class="hidden md:block shrink-0">
                    <a href="{{ route('projects') }}"
                        class="text-sm font-semibold text-[#5EBEE6] hover:text-white transition-all flex items-center gap-2 bg-blue-50 hover:bg-[#5EBEE6] px-4 py-2 rounded-xl group">
                        ดูโครงงานทั้งหมด <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 xl:gap-6">
                @forelse($projects as $project)
                    <a href="{{ route('project.show', $project->id) }}"
                        class="group cursor-pointer bg-white rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col overflow-hidden">
                        <div class="relative h-40 md:h-44 overflow-hidden bg-slate-100">
                            <img src="{{ $project->file_path ? asset($project->file_path) : asset('assets/img/no-empty.png') }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-in-out"
                                alt="{{ $project->name ?? '' }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/30 to-transparent opacity-80"></div>
                            <div class="absolute top-3 left-3 bg-emerald-500/20 backdrop-blur-md px-2.5 py-1 rounded-full border border-emerald-500/30 flex items-center gap-1.5">
                                <span class="relative flex h-1.5 w-1.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-500"></span>
                                </span>
                                <p class="text-[9px] text-emerald-300 uppercase tracking-wider font-bold">กำลังรับสมัคร</p>
                            </div>
                            <div class="absolute bottom-4 left-4 right-4 z-10">
                                <p class="text-blue-300 text-[10px] font-medium mb-1 truncate">ทีม: {{ $project->team_name ?? 'ยังไม่มีชื่อทีม' }}</p>
                                <h4 class="text-white text-sm font-bold leading-tight line-clamp-2">{{ $project->name }}</h4>
                            </div>
                        </div>
                        <div class="p-4 bg-white flex flex-col justify-between flex-grow">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-7 h-7 rounded-full bg-gray-50 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-user-tie text-[9px] text-gray-400"></i>
                                </div>
                                <p class="text-slate-600 text-xs line-clamp-1 font-medium">
                                    {{ $project->owner_fname }} {{ $project->owner_lname }}
                                </p>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-gray-50">
                                <div class="flex flex-col">
                                    <span class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">สมาชิกในทีม</span>
                                    <span class="text-sm text-slate-800 font-bold mt-0.5">
                                        {{ $project->current_count }} / {{ $project->max_members }} คน
                                    </span>
                                </div>
                                <div class="w-8 h-8 rounded-full border border-blue-50 flex items-center justify-center">
                                    <i class="fa-solid fa-users text-[#5EBEE6] text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-12 text-center border border-dashed border-gray-200 rounded-2xl bg-slate-50 flex flex-col items-center justify-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mb-3">
                            <i class="fa-solid fa-box-open text-2xl text-gray-300"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-700 mb-1">ยังไม่มีโครงงานในขณะนี้</h3>
                        <p class="text-sm text-slate-500">กำลังเตรียมพร้อมโครงงานใหม่ๆ โปรดติดตามตอนต่อไป</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6 text-center md:hidden">
                <a href="{{ route('projects') }}"
                    class="inline-flex items-center justify-center gap-2 text-sm font-semibold text-white bg-[#5EBEE6] hover:bg-blue-500 transition px-5 py-3 rounded-xl w-full shadow-sm">
                    ดูโครงงานทั้งหมด <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- Core of STEAM --}}
    <section class="w-full bg-white py-6 md:py-8 px-4 md:px-6 border-t border-gray-50 font-mitr">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-6">
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-2">
                    Core of <span class="text-[#5EBEE6]">STEAM</span>
                </h2>
                <p class="text-slate-500 text-sm max-w-2xl mx-auto">หัวใจสำคัญของการบูรณาการศาสตร์ทั้ง 5 เพื่อสร้างสรรค์นวัตกรรมที่ยั่งยืน</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-stretch">
                <div class="lg:col-span-5 relative group">
                    <div class="h-full bg-white border border-gray-100 rounded-[2rem] p-6 md:p-8 flex flex-col items-center justify-center text-center relative overflow-hidden shadow-sm hover:shadow-md transition-all duration-500 hover:-translate-y-1">
                        <span class="absolute -top-12 -left-4 text-[18rem] font-black text-[#5EBEE6]/5 select-none">S</span>
                        <div class="z-10 relative mb-6 w-full max-w-[200px] mx-auto">
                            <img src="{{ asset('assets/img/adam-labs.png') }}" class="w-full h-auto object-contain relative z-10" alt="Science">
                        </div>
                        <h3 class="text-[#5EBEE6] font-extrabold text-2xl mb-2 z-10 relative tracking-tight">Science</h3>
                        <p class="text-slate-600 text-sm leading-relaxed z-10 relative">
                            จุดเริ่มต้นของการตั้งคำถามและค้นหาคำตอบ สำรวจกฎเกณฑ์ของธรรมชาติ ไปจนถึงปฏิกิริยาเคมีที่สร้างสิ่งใหม่ๆ ผ่านการทดลองที่คุณพิสูจน์ได้เอง
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- T --}}
                    <div class="bg-slate-50/50 hover:bg-white border border-gray-100 shadow-sm rounded-2xl p-5 flex flex-col relative overflow-hidden group hover:shadow-md transition-all duration-300 hover:-translate-y-1 cursor-default">
                        <span class="absolute -right-2 -top-6 text-[8rem] font-black text-slate-900/5 select-none">T</span>
                        <div class="w-10 h-10 bg-blue-50 text-[#5EBEE6] rounded-xl flex items-center justify-center mb-3 relative z-10 border border-blue-100/50">
                            <i class="fa-solid fa-microchip text-lg"></i>
                        </div>
                        <h4 class="text-slate-900 font-bold text-lg mb-2 relative z-10">Technology</h4>
                        <p class="text-slate-500 text-xs leading-relaxed relative z-10">เปลี่ยนไอเดียให้เป็นระบบ ลุยโลกของการเขียนโปรแกรม พัฒนาเว็บไซต์ และสร้างซอฟต์แวร์ เพื่อแก้ปัญหาในโลกยุคดิจิทัล</p>
                    </div>

                    {{-- E --}}
                    <div class="bg-slate-50/50 hover:bg-white border border-gray-100 shadow-sm rounded-2xl p-5 flex flex-col relative overflow-hidden group hover:shadow-md transition-all duration-300 hover:-translate-y-1 cursor-default">
                        <span class="absolute -right-2 -top-6 text-[8rem] font-black text-slate-900/5 select-none">E</span>
                        <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-3 relative z-10 border border-purple-100/50">
                            <i class="fa-solid fa-cogs text-lg"></i>
                        </div>
                        <h4 class="text-slate-900 font-bold text-lg mb-2 relative z-10">Engineering</h4>
                        <p class="text-slate-500 text-xs leading-relaxed relative z-10">นำทฤษฎีมาสร้างเป็นชิ้นงานจริง ออกแบบและพัฒนานวัตกรรมอย่างเป็นระบบ เช่น การต่อวงจร หรือสร้างระบบอัตโนมัติ</p>
                    </div>

                    {{-- A --}}
                    <div class="bg-slate-50/50 hover:bg-white border border-gray-100 shadow-sm rounded-2xl p-5 flex flex-col relative overflow-hidden group hover:shadow-md transition-all duration-300 hover:-translate-y-1 cursor-default">
                        <span class="absolute -right-2 -top-6 text-[8rem] font-black text-slate-900/5 select-none">A</span>
                        <div class="w-10 h-10 bg-pink-50 text-pink-500 rounded-xl flex items-center justify-center mb-3 relative z-10 border border-pink-100/50">
                            <i class="fa-solid fa-palette text-lg"></i>
                        </div>
                        <h4 class="text-slate-900 font-bold text-lg mb-2 relative z-10">Arts</h4>
                        <p class="text-slate-500 text-xs leading-relaxed relative z-10">ผสานความสวยงามเข้ากับฟังก์ชัน ใช้ความคิดสร้างสรรค์ออกแบบประสบการณ์ผู้ใช้ (UI/UX) จนถึงงานออกแบบสถาปัตยกรรมที่น่าทึ่ง</p>
                    </div>

                    {{-- M --}}
                    <div class="bg-slate-50/50 hover:bg-white border border-gray-100 shadow-sm rounded-2xl p-5 flex flex-col relative overflow-hidden group hover:shadow-md transition-all duration-300 hover:-translate-y-1 cursor-default">
                        <span class="absolute -right-2 -top-6 text-[8rem] font-black text-slate-900/5 select-none">M</span>
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center mb-3 relative z-10 border border-emerald-100/50">
                            <i class="fa-solid fa-calculator text-lg"></i>
                        </div>
                        <h4 class="text-slate-900 font-bold text-lg mb-2 relative z-10">Mathematics</h4>
                        <p class="text-slate-500 text-xs leading-relaxed relative z-10">ใช้ตรรกะและตัวเลขแก้ปัญหาซับซ้อน พัฒนาทักษะการคิดวิเคราะห์ เพื่อสร้างโมเดลคณิตศาสตร์ที่แม่นยำ</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- News & Announcements --}}
    <section class="w-full bg-slate-50/50 py-10 px-4 md:px-6 border-t border-slate-100 font-mitr">
        <div class="max-w-6xl mx-auto">
            <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-slate-100 pb-5">
                <div class="flex items-start gap-3.5">
                    <div class="w-2.5 h-14 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                    <div>
                        <span class="inline-block text-[#5EBEE6] text-xs font-bold uppercase tracking-widest mb-1">News & Announcements</span>
                        <h2 class="text-2xl md:text-3xl text-slate-800 font-extrabold tracking-tight mb-1">ประกาศ / ข่าวประชาสัมพันธ์ล่าสุด</h2>
                        <p class="text-slate-400 text-xs md:text-sm font-medium">อัปเดตกระดานกิจกรรม ข้อมูลข่าวสาร และป้ายประชาสัมพันธ์สำคัญจากศูนย์โครงการ STEAM</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 xl:gap-6">
                @forelse($publicAds as $ad)
                    @php
                        $images = json_decode($ad->image_path ?? '[]', true);
                        $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
                    @endphp

                    <a href="{{ route('news.show', $ad->slug) }}"
                        class="group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.01)] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_15px_30px_rgba(0,0,0,0.04)] flex flex-col">
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-50">
                            @if ($firstImage)
                                <img src="{{ asset($firstImage) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" alt="{{ $ad->title }}">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                    <i class="fa-regular fa-image text-3xl mb-1"></i>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3 bg-slate-900/70 backdrop-blur-sm px-2.5 py-1 rounded-md text-[9px] text-emerald-400 font-bold border border-white/10 tracking-wider">
                                <span class="w-1 h-1 rounded-full bg-emerald-400 inline-block mr-1"></span> ประชาสัมพันธ์
                            </div>
                        </div>

                        <div class="p-4 flex flex-col flex-grow space-y-2">
                            <div class="flex items-center gap-1.5 text-slate-400 font-medium text-[10px]">
                                <i class="fa-regular fa-calendar-check text-[11px] text-[#5EBEE6]"></i>
                                <p>{{ date('d/m/Y', strtotime($ad->created_at)) }}</p>
                            </div>
                            <h4 class="text-slate-800 text-sm font-bold leading-snug line-clamp-2 group-hover:text-[#5EBEE6] transition-colors">{{ $ad->title }}</h4>
                            <p class="text-slate-400 text-xs font-medium line-clamp-2 pt-1 leading-relaxed">{{ $ad->description ?? 'ไม่มีรายละเอียดข้อความประกอบ...' }}</p>
                            <div class="pt-3 border-t border-slate-50 mt-auto flex items-center justify-between text-[10px] text-slate-400 font-bold">
                                <span class="text-slate-300 font-medium">ID: #{{ $ad->id }}</span>
                                <span class="text-[#5EBEE6] group-hover:underline flex items-center gap-0.5">
                                    อ่านต่อฉบับเต็ม <i class="fa-solid fa-angle-right text-[8px]"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-1 sm:col-span-2 md:col-span-3 lg:col-span-4 bg-white p-12 rounded-2xl border border-slate-100 text-center shadow-sm">
                        <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fa-solid fa-bullhorn text-lg text-slate-300"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-700">ไม่มีข้อมูลการประกาศประชาสัมพันธ์</h4>
                        <p class="text-xs text-slate-400 font-medium mt-0.5">ขณะนี้ระบบยังไม่มีข่าวสารหรือป้ายกิจกรรมใหม่ลงบอร์ดแสดงผล</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection