@extends('layout')
@section('content')
    {{-- banner --}}
    {{-- banner --}}
    <section class="w-full bg-slate-50/50 py-4 md:py-6 px-4 md:px-6 font-mitr relative overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
            <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-[#5EBEE6]/10 rounded-full blur-3xl"></div>
            <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-blue-300/10 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-6xl mx-auto">
            
            <div
                class="relative w-full bg-white/80 backdrop-blur-xl border border-white/60 rounded-[2rem] p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-6 items-center shadow-[0_10px_40px_rgba(0,0,0,0.03)] overflow-hidden group">

                {{-- 1. Icon Pattern Overlay (ไอคอนกระจายเต็ม Card) --}}
                <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden opacity-[0.03] text-slate-800">
                    {{-- Science --}}
                    <i class="fa-solid fa-atom absolute top-4 left-10 text-6xl rotate-12"></i>
                    <i class="fa-solid fa-flask absolute bottom-12 left-1/3 text-7xl -rotate-12"></i>
                    <i class="fa-solid fa-dna absolute top-1/3 left-2 text-5xl rotate-45"></i>
                    
                    {{-- Technology & Engineering --}}
                    <i class="fa-solid fa-microchip absolute top-10 left-1/2 text-8xl -rotate-6"></i>
                    <i class="fa-solid fa-gear absolute bottom-4 left-1/2 text-6xl rotate-90"></i>
                    <i class="fa-solid fa-robot absolute top-2/3 left-10 text-5xl -rotate-12"></i>
                    <i class="fa-solid fa-code absolute bottom-20 right-1/3 text-7xl rotate-12"></i>
                    
                    {{-- Arts & Mathematics --}}
                    <i class="fa-solid fa-palette absolute top-6 right-1/4 text-6xl -rotate-12"></i>
                    <i class="fa-solid fa-calculator absolute top-1/2 right-1/4 text-5xl rotate-12"></i>
                    <i class="fa-solid fa-square-root-variable absolute bottom-8 right-12 text-6xl -rotate-12"></i>
                    <i class="fa-solid fa-compass-drafting absolute top-1/3 right-10 text-7xl rotate-45"></i>
                </div>

                {{-- 2. Big "STEAM" outline watermark --}}
                <span
                    class="absolute top-1/2 -translate-y-1/2 -right-4 md:right-2 -rotate-6 text-[4.5rem] md:text-[7rem] lg:text-[9rem] font-black tracking-tighter leading-none whitespace-nowrap text-transparent pointer-events-none select-none z-0 opacity-80 group-hover:scale-105 transition-transform duration-700"
                    style="-webkit-text-stroke: 2px rgba(94,190,230,0.15);">
                    STEAM
                </span>

                {{-- 3. Small floating icon accents (กล่องไอคอนลอยสีๆ) --}}
                <div class="absolute top-6 right-10 md:right-16 w-10 h-10 rounded-2xl bg-gradient-to-br from-[#5EBEE6] to-[#3B9ADE] flex items-center justify-center shadow-md shadow-sky-100 rotate-6 hover:rotate-0 hover:scale-110 transition-all z-10 hidden md:flex">
                    <i class="fa-solid fa-flask-vial text-white text-xs"></i>
                </div>
                <div class="absolute bottom-10 right-6 w-9 h-9 rounded-xl bg-white border border-sky-100 flex items-center justify-center shadow-sm -rotate-6 hover:rotate-0 hover:scale-110 transition-all z-10 hidden md:flex">
                    <i class="fa-solid fa-code text-[#5EBEE6] text-xs"></i>
                </div>
                <div class="absolute top-1/2 -translate-y-1/2 right-0 w-8 h-8 rounded-full bg-white border border-sky-100 flex items-center justify-center shadow-sm z-10 hidden lg:flex hover:scale-110 transition-all">
                    <i class="fa-solid fa-square-root-variable text-[#5EBEE6] text-[10px]"></i>
                </div>

                {{-- Left Content --}}
                <div class="z-10 flex flex-col items-center md:items-start text-center md:text-left">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/90 border border-gray-100 rounded-full shadow-sm mb-4 hover:shadow-md transition-shadow">
                        <img src="{{ asset('assets/img/cpw.png') }}" class="w-4 h-4 object-contain"
                            alt="Chonprathanwittaya School">
                        <span class="text-xs font-semibold text-slate-700">Chonprathanwittaya School</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl text-slate-900 font-bold mb-4 tracking-tight leading-tight drop-shadow-sm">
                        ศูนย์โครงการ<span class="text-transparent bg-clip-text bg-gradient-to-r from-[#5EBEE6] to-blue-500">สตีม</span>คืออะไร?
                    </h2>
                    <p class="text-slate-600 text-sm md:text-base leading-relaxed mb-6 max-w-lg font-medium">
                        เราคือ STEAM ผู้เชี่ยวชาญด้านการบูรณาการวิทยาศาสตร์ เทคโนโลยี วิศวกรรม ศิลปะ และคณิตศาสตร์
                        พร้อมยกระดับการเรียนรู้สู่ยุคใหม่ ด้วยนวัตกรรมทันสมัย
                    </p>
                    <a href="#"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-[#5EBEE6] to-[#3B9ADE] text-white text-sm font-medium rounded-xl hover:shadow-[0_8px_16px_rgba(94,190,230,0.3)] hover:-translate-y-0.5 transition-all active:scale-95 group">
                        สมัครสมาชิก <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                
                {{-- Right Image --}}
                <div class="flex justify-center md:justify-end items-center relative z-10">
                    {{-- เพิ่มแสงเรืองแสงอ่อนๆ ด้านหลังบีเวอร์ --}}
                    <div class="absolute inset-0 bg-gradient-to-tr from-[#5EBEE6]/10 to-blue-300/10 rounded-full blur-2xl transform scale-75 group-hover:scale-90 transition-transform duration-700"></div>
                    <img src="{{ asset('assets/img/steam-bever.png') }}"
                        class="relative z-10 w-[200px] md:w-[240px] lg:w-[280px] object-contain drop-shadow-xl hover:scale-105 hover:-rotate-1 transition-all duration-500" alt="STEAM Bever">
                </div>
            </div>
        </div>
    </section>

    {{-- โครงงาน --}}
    <section class="w-full py-6 md:py-8 px-4 md:px-6 font-mitr bg-white">
        <div class="max-w-6xl mx-auto">
            
            {{-- ลด margin-bottom และ padding-bottom ของหัวข้อ --}}
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
                    <a href="{{ route('projects') }}" class="text-sm font-semibold text-[#5EBEE6] hover:text-white transition-all flex items-center gap-2 bg-blue-50 hover:bg-[#5EBEE6] px-4 py-2 rounded-xl group">
                        ดูโครงงานทั้งหมด <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 xl:gap-6">
                @forelse($projects as $project)
                    <div class="group cursor-pointer bg-white rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col overflow-hidden">
                        <div class="relative h-40 md:h-44 overflow-hidden">
                            
                            <img src="{{ $project->file_path ? asset($project->file_path) : asset('assets/img/default-project.jpg') }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-in-out"
                                alt="{{ $project->name }}">

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
                                <h4 class="text-white text-sm font-bold leading-tight line-clamp-2">
                                    {{ $project->name }}
                                </h4>
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
                    </div>
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
                <a href="{{ route('projects') }}" class="inline-flex items-center justify-center gap-2 text-sm font-semibold text-white bg-[#5EBEE6] hover:bg-blue-500 transition px-5 py-3 rounded-xl w-full shadow-sm">
                    ดูโครงงานทั้งหมด <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ค้นหาโครงงาน --}}
    <section class="w-full bg-slate-50 py-6 md:py-8 px-4 md:px-6 font-mitr relative">
        <div class="max-w-6xl mx-auto">
            {{-- ลด padding ภายในให้กล่องแคบลง --}}
            <div
                class="w-full bg-gradient-to-br from-white to-blue-50/20 border border-white rounded-[2rem] p-6 md:p-8 flex flex-col items-center text-center shadow-[0_8px_30px_rgba(0,0,0,0.02)] relative overflow-hidden">
                
                {{-- Decorative elements --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-[#5EBEE6]/5 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-500/5 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2"></div>

                <span class="inline-block px-3 py-1 bg-blue-50 text-[#5EBEE6] text-xs font-bold rounded-full mb-3 relative z-10 border border-blue-100">
                    Discover Your Passion
                </span>

                <h2 class="text-slate-900 text-2xl md:text-3xl mb-3 font-extrabold tracking-tight relative z-10">
                    กำลังหา<span class="text-transparent bg-clip-text bg-gradient-to-r from-[#5EBEE6] to-blue-500">โครงงาน</span>อยู่ รึเปล่า!!
                </h2>
                <p class="text-slate-500 text-sm mb-6 max-w-2xl relative z-10">
                    ค้นหาไอเดียและโครงงาน STEAM ที่น่าสนใจ กำหนดขอบเขตสิ่งที่คุณอยากเรียนรู้ แล้วมาเริ่มลงมือทำโปรเจกต์เจ๋งๆ ไปด้วยกัน
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full max-w-4xl mb-6 relative z-10">

                    <div
                        class="flex items-center gap-4 p-4 bg-white border border-slate-100 rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-sm hover:border-[#5EBEE6]/20 cursor-pointer group">
                        <div class="w-12 h-12 flex items-center justify-center bg-blue-50 text-[#5EBEE6] rounded-xl shrink-0 group-hover:scale-105 group-hover:bg-[#5EBEE6] group-hover:text-white transition-all">
                            <i class="fa-solid fa-laptop text-lg"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider mb-0.5">ระดับชั้น</p>
                            <p class="text-sm text-slate-800 font-bold">มัธยมศึกษาปีที่ 1</p>
                        </div>
                    </div>

                    <div
                        class="flex items-center gap-4 p-4 bg-white border border-slate-100 rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-sm hover:border-[#5EBEE6]/20 cursor-pointer group">
                        <div class="w-12 h-12 flex items-center justify-center bg-purple-50 text-purple-500 rounded-xl shrink-0 group-hover:scale-105 group-hover:bg-purple-500 group-hover:text-white transition-all">
                            <i class="fa-solid fa-flask text-lg"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider mb-0.5">คณะ</p>
                            <p class="text-sm text-slate-800 font-bold">วิทยาศาสตร์</p>
                        </div>
                    </div>

                    <div
                        class="flex items-center gap-4 p-4 bg-white border border-slate-100 rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-sm hover:border-[#5EBEE6]/20 cursor-pointer group">
                        <div class="w-12 h-12 flex items-center justify-center bg-emerald-50 text-emerald-500 rounded-xl shrink-0 group-hover:scale-105 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                            <i class="fa-solid fa-code-branch text-lg"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider mb-0.5">สาขา</p>
                            <p class="text-sm text-slate-800 font-bold">วิทยาการคอมพิวเตอร์</p>
                        </div>
                    </div>

                </div>

                <button
                    class="px-6 py-2.5 bg-slate-900 text-white text-sm font-medium rounded-xl hover:bg-slate-800 transition-all hover:shadow-md active:scale-95 mb-4 relative z-10 flex items-center gap-2">
                    <i class="fa-solid fa-magnifying-glass"></i> ดูโครงงานแนะนำ
                </button>

                <p class="text-xs text-slate-500 relative z-10">
                    ถ้ายังไม่รู้ว่าอยากต่อคณะไหน? <a href="#"
                        class="text-[#5EBEE6] font-semibold underline decoration-2 underline-offset-4 hover:text-blue-600 transition-colors">ติดต่อสอบถามครูแนะแนว</a>
                </p>

            </div>
        </div>
    </section>

    {{-- STEAM Features --}}
    <section class="w-full bg-white py-6 md:py-8 px-4 md:px-6 font-mitr border-t border-gray-50">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-6">
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-2">Core of <span class="text-[#5EBEE6]">STEAM</span></h2>
                <p class="text-slate-500 text-sm max-w-2xl mx-auto">หัวใจสำคัญของการบูรณาการศาสตร์ทั้ง 5 เพื่อสร้างสรรค์นวัตกรรมที่ยั่งยืน</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-stretch">

                <div class="lg:col-span-5 relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#5EBEE6] to-blue-600 rounded-[2rem] transform rotate-1 group-hover:rotate-2 transition-transform duration-500 opacity-10"></div>
                    <div
                        class="h-full bg-white border border-gray-100 rounded-[2rem] p-6 md:p-8 flex flex-col items-center justify-center text-center relative overflow-hidden shadow-sm hover:shadow-md transition-all duration-500 hover:-translate-y-1">

                        <span
                            class="absolute -top-12 -left-4 text-[18rem] font-black text-[#5EBEE6]/5 opacity-80 group-hover:scale-105 group-hover:text-[#5EBEE6]/10 transition-all duration-700 select-none">S</span>

                        <div class="z-10 relative mb-6 w-full max-w-[200px] mx-auto">
                            <div class="relative">
                                <div class="absolute inset-0 bg-blue-100 rounded-full blur-2xl opacity-40"></div>
                                <img src="{{ asset('assets/img/adam-labs.png') }}"
                                    class="w-full h-auto object-contain relative z-10 transform group-hover:scale-105 transition-transform duration-700" alt="Science">
                            </div>
                        </div>

                        <h3 class="text-[#5EBEE6] font-extrabold text-2xl mb-2 z-10 relative tracking-tight">Science</h3>
                        <p class="text-slate-600 text-sm leading-relaxed z-10 relative">
                            จุดเริ่มต้นของการตั้งคำถามและค้นหาคำตอบ สำรวจกฎเกณฑ์ของธรรมชาติ ไปจนถึงปฏิกิริยาเคมีที่สร้างสิ่งใหม่ๆ ผ่านการทดลองที่คุณพิสูจน์ได้เอง
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="bg-slate-50/50 hover:bg-white border border-gray-100 shadow-sm rounded-2xl p-5 flex flex-col relative overflow-hidden group hover:shadow-md transition-all duration-300 hover:-translate-y-1 cursor-default">
                        <span class="absolute -right-2 -top-6 text-[8rem] font-black text-slate-900/5 group-hover:text-[#5EBEE6]/10 transition-colors duration-500 select-none">T</span>
                        <div class="w-10 h-10 bg-blue-50 text-[#5EBEE6] rounded-xl flex items-center justify-center mb-3 relative z-10 border border-blue-100/50">
                            <i class="fa-solid fa-microchip text-lg"></i>
                        </div>
                        <h4 class="text-slate-900 font-bold text-lg mb-2 relative z-10">Technology</h4>
                        <p class="text-slate-500 text-xs leading-relaxed relative z-10">
                            เปลี่ยนไอเดียให้เป็นระบบ ลุยโลกของการเขียนโปรแกรม พัฒนาเว็บไซต์ และสร้างซอฟต์แวร์ เพื่อแก้ปัญหาในโลกยุคดิจิทัล
                        </p>
                    </div>

                    <div class="bg-slate-50/50 hover:bg-white border border-gray-100 shadow-sm rounded-2xl p-5 flex flex-col relative overflow-hidden group hover:shadow-md transition-all duration-300 hover:-translate-y-1 cursor-default">
                        <span class="absolute -right-2 -top-6 text-[8rem] font-black text-slate-900/5 group-hover:text-purple-500/10 transition-colors duration-500 select-none">E</span>
                        <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-3 relative z-10 border border-purple-100/50">
                            <i class="fa-solid fa-cogs text-lg"></i>
                        </div>
                        <h4 class="text-slate-900 font-bold text-lg mb-2 relative z-10">Engineering</h4>
                        <p class="text-slate-500 text-xs leading-relaxed relative z-10">
                            นำทฤษฎีมาสร้างเป็นชิ้นงานจริง ออกแบบและพัฒนานวัตกรรมอย่างเป็นระบบ เช่น การต่อวงจร หรือสร้างระบบอัตโนมัติ
                        </p>
                    </div>
                    
                    <div class="bg-slate-50/50 hover:bg-white border border-gray-100 shadow-sm rounded-2xl p-5 flex flex-col relative overflow-hidden group hover:shadow-md transition-all duration-300 hover:-translate-y-1 cursor-default">
                        <span class="absolute -right-2 -top-6 text-[8rem] font-black text-slate-900/5 group-hover:text-pink-500/10 transition-colors duration-500 select-none">A</span>
                        <div class="w-10 h-10 bg-pink-50 text-pink-500 rounded-xl flex items-center justify-center mb-3 relative z-10 border border-pink-100/50">
                            <i class="fa-solid fa-palette text-lg"></i>
                        </div>
                        <h4 class="text-slate-900 font-bold text-lg mb-2 relative z-10">Arts</h4>
                        <p class="text-slate-500 text-xs leading-relaxed relative z-10">
                            ผสานความสวยงามเข้ากับฟังก์ชัน ใช้ความคิดสร้างสรรค์ออกแบบประสบการณ์ผู้ใช้ (UI/UX) จนถึงงานออกแบบสถาปัตยกรรมที่น่าทึ่ง
                        </p>
                    </div>

                    <div class="bg-slate-50/50 hover:bg-white border border-gray-100 shadow-sm rounded-2xl p-5 flex flex-col relative overflow-hidden group hover:shadow-md transition-all duration-300 hover:-translate-y-1 cursor-default">
                        <span class="absolute -right-2 -top-6 text-[8rem] font-black text-slate-900/5 group-hover:text-emerald-500/10 transition-colors duration-500 select-none">M</span>
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center mb-3 relative z-10 border border-emerald-100/50">
                            <i class="fa-solid fa-calculator text-lg"></i>
                        </div>
                        <h4 class="text-slate-900 font-bold text-lg mb-2 relative z-10">Mathematics</h4>
                        <p class="text-slate-500 text-xs leading-relaxed relative z-10">
                            ใช้ตรรกะและตัวเลขแก้ปัญหาซับซ้อน พัฒนาทักษะการคิดวิเคราะห์ เพื่อสร้างโมเดลคณิตศาสตร์ที่แม่นยำ
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- ประกาศประชาสัมพันธ์ --}}
    <section class="w-full bg-slate-50 py-6 md:py-8 px-4 md:px-6 font-mitr border-t border-gray-200">
        <div class="max-w-6xl mx-auto">
            
            <div class="mb-5 flex flex-col md:flex-row justify-between items-end gap-4 border-b border-gray-200 pb-4">
                <div class="flex items-start gap-3">
                    <div class="w-2.5 h-full min-h-[50px] bg-gradient-to-b from-[#5EBEE6] to-[#3B9ADE] rounded-full mt-1 shadow-sm"></div>
                    <div>
                        <span class="inline-block text-[#5EBEE6] text-xs font-bold uppercase tracking-widest mb-1">News & Announcements</span>
                        <h2 class="text-2xl md:text-3xl text-slate-900 font-extrabold tracking-tight mb-1">ประกาศ / ข่าวประชาสัมพันธ์</h2>
                        <p class="text-slate-500 text-sm max-w-2xl">อัปเดตข่าวสาร กิจกรรม และประกาศสำคัญจากศูนย์โครงการสตีมที่ไม่ควรพลาด</p>
                    </div>
                </div>
                <div class="hidden md:block shrink-0">
                    <a href="#" class="text-sm font-semibold text-slate-500 hover:text-[#5EBEE6] transition-colors flex items-center gap-2 px-2 py-1 group">
                        ดูข่าวทั้งหมด <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 xl:gap-6">

                {{-- Loop Mockup --}}
                @for ($i = 0; $i < 4; $i++)
                <div class="group cursor-pointer bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md flex flex-col">
                    <div class="relative h-36 md:h-40 overflow-hidden">
                        <img src="{{ asset('assets/img/aerosol.jpg') }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                            alt="News Image">
                        
                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-full shadow-sm">
                            <p class="text-[10px] text-[#5EBEE6] font-bold uppercase tracking-wide">กิจกรรม</p>
                        </div>
                    </div>

                    <div class="p-4 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 mb-2 text-slate-400">
                            <i class="fa-regular fa-calendar text-[10px]"></i>
                            <p class="text-[10px] font-medium">1 ม.ค. 2569</p>
                        </div>
                        <h4 class="text-slate-800 text-sm font-bold leading-snug line-clamp-2 mb-2 group-hover:text-[#5EBEE6] transition-colors">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry
                        </h4>
                        <p class="text-slate-500 text-xs line-clamp-2 mt-auto">
                            เนื้อหาข่าวแบบสรุปย่อ แจ้งให้ทราบถึงกิจกรรมที่จะเกิดขึ้นภายในศูนย์สตีม...
                        </p>
                    </div>
                </div>
                @endfor

            </div>
            
            <div class="mt-6 text-center md:hidden">
                <a href="#" class="inline-flex items-center justify-center gap-2 text-sm font-semibold text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 transition px-5 py-2.5 rounded-xl w-full shadow-sm">
                    ดูข่าวประชาสัมพันธ์ทั้งหมด <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>
@endsection