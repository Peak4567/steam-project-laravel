@extends('layout')

@section('content')

    <style>
        @keyframes float-y {
            0%, 100% { transform: translateY(0px) rotate(-1deg); }
            50% { transform: translateY(-16px) rotate(1deg); }
        }
        @keyframes float-y-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes blob-pulse {
            0%, 100% { transform: scale(1) translate(0, 0); }
            33% { transform: scale(1.08) translate(10px, -10px); }
            66% { transform: scale(0.95) translate(-10px, 10px); }
        }
        .animate-float { animation: float-y 6s ease-in-out infinite; }
        .animate-float-slow { animation: float-y-slow 4.5s ease-in-out infinite; }
        .animate-blob { animation: blob-pulse 12s ease-in-out infinite; }
        .bg-grid {
            background-image: radial-gradient(circle, rgba(94,190,230,0.25) 1px, transparent 1px);
            background-size: 22px 22px;
        }
    </style>

    {{-- ============ HERO ============ --}}
    <section class="relative w-full overflow-hidden font-mitr bg-white">
        <div class="absolute inset-0 -z-10 pointer-events-none">
            <div class="absolute -top-24 -right-24 w-[420px] h-[420px] bg-[#5EBEE6]/20 rounded-full blur-3xl animate-blob"></div>
            <div class="absolute top-1/2 -left-32 w-[380px] h-[380px] bg-fuchsia-300/10 rounded-full blur-3xl animate-blob" style="animation-delay:2s"></div>
            <div class="absolute inset-x-0 top-0 h-[420px] bg-grid opacity-40 [mask-image:radial-gradient(ellipse_60%_60%_at_50%_0%,black,transparent)]"></div>
        </div>

        <div class="max-w-6xl mx-auto px-4 md:px-6 pt-8 pb-14 md:pt-14 md:pb-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

                <div class="lg:col-span-7 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white border border-slate-100 rounded-full shadow-sm mb-5">
                        <img src="{{ asset('assets/img/cpw.png') }}" class="w-4 h-4 object-contain" alt="Chonprathanwittaya School">
                        <span class="text-xs font-semibold text-slate-600">โรงเรียนชลประทานวิทยา</span>
                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                        <span class="text-xs font-semibold text-[#5EBEE6]">ศูนย์โครงการสตีม</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-5">
                        ลงมือทำโครงงาน<br>
                        ปูทางสู่<span class="relative inline-block text-transparent bg-clip-text bg-gradient-to-r from-[#5EBEE6] via-blue-500 to-indigo-500">มหาวิทยาลัยในฝัน</span>
                    </h1>
                    <p class="text-slate-500 text-base md:text-lg leading-relaxed mb-8 max-w-xl mx-auto lg:mx-0">
                        ศูนย์โครงการ STEAM ที่ช่วยให้คุณลงมือทำโครงงานจริง สร้างทีม เก็บสะสมผลงาน และสร้างพอร์ตโฟลิโอ ที่พร้อมใช้ยื่นสมัครเข้าศึกษาต่อมหาวิทยาลัยที่ใฝ่ฝัน
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3 mb-10">
                        @guest
                            <a href="{{ route('register') }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-slate-900 text-white text-sm font-bold rounded-2xl hover:bg-slate-800 hover:-translate-y-0.5 hover:shadow-xl transition-all active:scale-95 group">
                                สมัครสมาชิกฟรี <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        @else
                            <a href="{{ route('profile.portfolio') }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-slate-900 text-white text-sm font-bold rounded-2xl hover:bg-slate-800 hover:-translate-y-0.5 hover:shadow-xl transition-all active:scale-95 group">
                                ไปที่แฟ้มผลงานของฉัน <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        @endguest
                        <a href="{{ route('projects') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white text-slate-700 text-sm font-bold rounded-2xl border border-slate-200 hover:border-[#5EBEE6] hover:text-[#5EBEE6] hover:-translate-y-0.5 transition-all active:scale-95">
                            <i class="fa-regular fa-compass"></i> สำรวจโครงงาน
                        </a>
                    </div>

                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-x-8 gap-y-3">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#5EBEE6] flex items-center justify-center border border-blue-100/60">
                                <i class="fa-solid fa-diagram-project text-sm"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-slate-900 font-extrabold text-lg leading-none">{{ $stats['projects'] }}+</p>
                                <p class="text-slate-400 text-[11px] font-medium">โครงงานทั้งหมด</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center border border-purple-100/60">
                                <i class="fa-solid fa-user-graduate text-sm"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-slate-900 font-extrabold text-lg leading-none">{{ $stats['members'] }}+</p>
                                <p class="text-slate-400 text-[11px] font-medium">นักเรียนที่เข้าร่วม</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center border border-emerald-100/60">
                                <i class="fa-solid fa-award text-sm"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-slate-900 font-extrabold text-lg leading-none">{{ $stats['portfolios'] }}+</p>
                                <p class="text-slate-400 text-[11px] font-medium">ผลงานที่ได้รับอนุมัติ</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 relative flex justify-center items-center">
                    <div class="absolute w-64 h-64 md:w-80 md:h-80 bg-gradient-to-tr from-[#5EBEE6]/20 to-indigo-300/20 rounded-full blur-3xl"></div>

                    <div class="absolute -top-3 -left-2 md:left-4 bg-white/90 backdrop-blur-md border border-white shadow-lg rounded-2xl px-4 py-2.5 flex items-center gap-2 animate-float-slow z-20">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-[11px] font-bold text-slate-700">กำลังดำเนินการ {{ $stats['projects'] }} โครงงาน</span>
                    </div>

                    <div class="absolute -bottom-2 -right-2 md:right-4 bg-white/90 backdrop-blur-md border border-white shadow-lg rounded-2xl px-4 py-2.5 flex items-center gap-2 animate-float-slow z-20" style="animation-delay:1.2s">
                        <i class="fa-solid fa-trophy text-amber-400 text-xs"></i>
                        <span class="text-[11px] font-bold text-slate-700">ผลงานเด่น {{ $stats['portfolios'] }} ชิ้น</span>
                    </div>

                    <img src="{{ asset('assets/img/steam-bever.png') }}"
                        class="relative z-10 w-[220px] md:w-[300px] lg:w-[340px] h-auto object-contain drop-shadow-2xl animate-float"
                        alt="STEAM Bever">
                </div>
            </div>
        </div>
    </section>

    {{-- ============ PROJECTS ============ --}}
    <section class="w-full py-12 md:py-16 px-4 md:px-6 bg-white font-mitr">
        <div class="max-w-6xl mx-auto">
            <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-end gap-5">
                <div>
                    <span class="inline-block text-[#5EBEE6] text-xs font-bold uppercase tracking-widest mb-1.5">Projects & Competitions</span>
                    <h2 class="text-2xl md:text-3xl text-slate-900 font-extrabold tracking-tight mb-1.5">โครงงาน / รายการแข่งขัน</h2>
                    <p class="text-slate-500 text-sm max-w-2xl">ค้นหาไอเดีย เข้าร่วมทีม และลงมือทำโครงงานเพื่อพัฒนาศักยภาพของคุณ</p>
                </div>
                <a href="{{ route('projects') }}"
                    class="shrink-0 text-sm font-semibold text-[#5EBEE6] hover:text-white transition-all flex items-center gap-2 bg-blue-50 hover:bg-[#5EBEE6] px-4 py-2.5 rounded-xl group">
                    ดูโครงงานทั้งหมด <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <form action="{{ route('home') }}" method="GET" class="mb-4">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหาชื่อโครงงานที่คุณสนใจ..."
                        class="w-full bg-slate-50 border border-slate-100 rounded-2xl pl-11 pr-28 py-3.5 text-sm font-medium text-slate-700 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all">
                    @if (request('tag'))
                        <input type="hidden" name="tag" value="{{ request('tag') }}">
                    @endif
                    <button type="submit"
                        class="absolute right-1.5 top-1.5 bottom-1.5 px-5 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-slate-800 transition-all">
                        ค้นหา
                    </button>
                </div>
            </form>

            @if ($tags->count())
                <div class="flex flex-wrap items-center gap-2 mb-8">
                    <a href="{{ route('home', array_filter(['search' => request('search')])) }}"
                        class="px-4 py-2 rounded-xl text-xs font-bold border transition-all {{ !request('tag') ? 'bg-[#5EBEE6] text-white border-[#5EBEE6] shadow-sm' : 'bg-white text-slate-500 border-slate-200 hover:border-[#5EBEE6] hover:text-[#5EBEE6]' }}">
                        ทั้งหมด
                    </a>
                    @foreach ($tags as $tag)
                        <a href="{{ route('home', array_filter(['tag' => $tag->id, 'search' => request('search')])) }}"
                            class="px-4 py-2 rounded-xl text-xs font-bold border transition-all {{ request('tag') == $tag->id ? 'bg-[#5EBEE6] text-white border-[#5EBEE6] shadow-sm' : 'bg-white text-slate-500 border-slate-200 hover:border-[#5EBEE6] hover:text-[#5EBEE6]' }}">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 xl:gap-6">
                @forelse($projects as $project)
                    @php
                        $pct = $project->max_members > 0 ? min(100, round(($project->current_count / $project->max_members) * 100)) : 0;
                    @endphp
                    <a href="{{ route('project.show', $project->id) }}"
                        class="group cursor-pointer bg-white rounded-3xl transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_40px_rgba(0,0,0,0.06)] border border-slate-100 flex flex-col overflow-hidden">
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
                            <div class="pt-3 border-t border-gray-50">
                                <div class="flex justify-between items-center mb-1.5">
                                    <span class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">สมาชิกในทีม</span>
                                    <span class="text-xs text-slate-800 font-bold">
                                        {{ $project->current_count }} / {{ $project->max_members }} คน
                                    </span>
                                </div>
                                <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-[#5EBEE6] to-blue-500 rounded-full transition-all" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-14 text-center border border-dashed border-slate-200 rounded-3xl bg-slate-50 flex flex-col items-center justify-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mb-3">
                            <i class="fa-solid fa-box-open text-2xl text-gray-300"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-700 mb-1">ไม่พบโครงงานที่ตรงกับเงื่อนไข</h3>
                        <p class="text-sm text-slate-500">ลองค้นหาด้วยคำอื่น หรือเลือกหมวดหมู่ใหม่อีกครั้ง</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ============ CORE OF STEAM ============ --}}
    <section class="w-full bg-slate-50/60 py-14 md:py-16 px-4 md:px-6 border-y border-slate-100 relative overflow-hidden font-mitr">
        <div class="absolute inset-0 bg-grid opacity-30 pointer-events-none"></div>
        <div class="absolute -top-24 -right-24 w-[360px] h-[360px] bg-[#5EBEE6]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-[360px] h-[360px] bg-violet-300/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto relative">
            <div class="text-center mb-10">
                <span class="inline-block text-[#5EBEE6] text-xs font-bold uppercase tracking-widest mb-1.5">What we build with</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-2">
                    Core of <span class="text-[#5EBEE6]">STEAM</span>
                </h2>
                <p class="text-slate-500 text-sm max-w-2xl mx-auto">หัวใจสำคัญของการบูรณาการศาสตร์ทั้ง 5 เพื่อสร้างสรรค์นวัตกรรมที่ยั่งยืน</p>
            </div>

            @php
                $steamNodes = [
                    ['label' => 'Science', 'icon' => 'fa-flask', 'text' => 'text-[#5EBEE6]', 'bg' => 'bg-blue-50', 'border' => 'border-blue-100', 'ring' => 'rgba(94,190,230,0.25)', 'desc' => 'ตั้งคำถามและค้นหาคำตอบ สำรวจกฎเกณฑ์ธรรมชาติผ่านการทดลองที่พิสูจน์ได้'],
                    ['label' => 'Technology', 'icon' => 'fa-microchip', 'text' => 'text-blue-500', 'bg' => 'bg-blue-50', 'border' => 'border-blue-100', 'ring' => 'rgba(59,130,246,0.25)', 'desc' => 'เปลี่ยนไอเดียให้เป็นระบบ เขียนโปรแกรมและพัฒนาซอฟต์แวร์แก้ปัญหายุคดิจิทัล'],
                    ['label' => 'Engineering', 'icon' => 'fa-gears', 'text' => 'text-purple-600', 'bg' => 'bg-purple-50', 'border' => 'border-purple-100', 'ring' => 'rgba(147,51,234,0.2)', 'desc' => 'นำทฤษฎีมาสร้างชิ้นงานจริง ออกแบบนวัตกรรมอย่างเป็นระบบ'],
                    ['label' => 'Arts', 'icon' => 'fa-palette', 'text' => 'text-pink-500', 'bg' => 'bg-pink-50', 'border' => 'border-pink-100', 'ring' => 'rgba(236,72,153,0.2)', 'desc' => 'ผสานความสวยงามกับฟังก์ชัน ออกแบบ UI/UX ที่น่าทึ่ง'],
                    ['label' => 'Mathematics', 'icon' => 'fa-calculator', 'text' => 'text-emerald-500', 'bg' => 'bg-emerald-50', 'border' => 'border-emerald-100', 'ring' => 'rgba(16,185,129,0.2)', 'desc' => 'ใช้ตรรกะและตัวเลขแก้ปัญหาซับซ้อน สร้างโมเดลที่แม่นยำ'],
                ];
            @endphp

            <div class="relative">
                <div class="hidden lg:block absolute top-9 left-[10%] right-[10%] h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 relative">
                    @foreach ($steamNodes as $node)
                        <div class="group relative bg-white border {{ $node['border'] }} rounded-2xl p-5 hover:-translate-y-1.5 transition-all duration-300 shadow-sm"
                            onmouseover="this.style.boxShadow='0 12px 30px {{ $node['ring'] }}'" onmouseout="this.style.boxShadow=''">
                            <div class="w-12 h-12 {{ $node['bg'] }} {{ $node['text'] }} rounded-xl flex items-center justify-center mb-4 border {{ $node['border'] }}">
                                <i class="fa-solid {{ $node['icon'] }} text-lg"></i>
                            </div>
                            <h3 class="text-slate-900 font-extrabold text-base mb-1.5">{{ $node['label'] }}</h3>
                            <p class="text-slate-500 text-xs leading-relaxed">{{ $node['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ============ NEWS & ANNOUNCEMENTS ============ --}}
    <section class="w-full bg-white py-10 md:py-14 px-4 md:px-6 font-mitr">
        <div class="max-w-6xl mx-auto">
            <div class="mb-5 flex flex-col sm:flex-row sm:items-end justify-between gap-3">
                <div>
                    <span class="inline-block text-[#5EBEE6] text-xs font-bold uppercase tracking-widest mb-1">News & Announcements</span>
                    <h2 class="text-xl md:text-2xl text-slate-900 font-extrabold tracking-tight mb-1">ประกาศ / ข่าวประชาสัมพันธ์ล่าสุด</h2>
                    <p class="text-slate-400 text-xs font-medium">อัปเดตกระดานกิจกรรม ข้อมูลข่าวสาร และป้ายประชาสัมพันธ์สำคัญจากศูนย์โครงการ STEAM</p>
                </div>
                @if ($publicAds->count() > 4)
                    <div class="flex items-center gap-2 shrink-0">
                        <button type="button" onclick="document.getElementById('newsScrollTrack').scrollBy({left:-280,behavior:'smooth'})"
                            class="w-9 h-9 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-[#5EBEE6] hover:border-[#5EBEE6] transition-all">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </button>
                        <button type="button" onclick="document.getElementById('newsScrollTrack').scrollBy({left:280,behavior:'smooth'})"
                            class="w-9 h-9 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:text-[#5EBEE6] hover:border-[#5EBEE6] transition-all">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                @endif
            </div>

            @if ($publicAds->count())
                <div id="newsScrollTrack" class="grid grid-rows-2 grid-flow-col auto-cols-[220px] sm:auto-cols-[250px] gap-4 overflow-x-auto snap-x snap-mandatory custom-scrollbar pb-3">
                    @foreach ($publicAds as $ad)
                        @php
                            $images = json_decode($ad->image_path ?? '[]', true);
                            $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
                        @endphp
                        <a href="{{ route('news.show', $ad->slug) }}"
                            class="snap-start group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-[0_8px_20px_rgba(0,0,0,0.02)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_15px_30px_rgba(0,0,0,0.06)] flex flex-col">
                            <div class="relative h-24 overflow-hidden bg-slate-50 shrink-0">
                                @if ($firstImage)
                                    <img src="{{ asset($firstImage) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" alt="{{ $ad->title }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <i class="fa-regular fa-image text-lg"></i>
                                    </div>
                                @endif
                                <div class="absolute top-2 left-2 bg-slate-900/70 backdrop-blur-sm px-2 py-0.5 rounded-md text-[8px] text-emerald-400 font-bold border border-white/10 tracking-wider">
                                    ประชาสัมพันธ์
                                </div>
                            </div>
                            <div class="p-3 flex flex-col flex-grow">
                                <p class="text-slate-400 text-[9px] font-medium mb-1">{{ date('d/m/Y', strtotime($ad->created_at)) }}</p>
                                <h4 class="text-slate-800 text-xs font-bold leading-snug line-clamp-2 group-hover:text-[#5EBEE6] transition-colors mb-1.5">{{ $ad->title }}</h4>
                                <p class="text-slate-400 text-[10px] leading-relaxed line-clamp-2 mb-2">{{ $ad->description ?? 'ไม่มีรายละเอียดข้อความประกอบ...' }}</p>
                                <div class="mt-auto pt-2 border-t border-slate-50 flex items-center justify-between">
                                    <span class="text-[9px] text-slate-300 font-medium">#{{ $ad->id }}</span>
                                    <span class="text-[9px] text-[#5EBEE6] font-bold group-hover:underline flex items-center gap-0.5">
                                        อ่านต่อ <i class="fa-solid fa-angle-right text-[7px]"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 text-center">
                    <div class="w-10 h-10 bg-white border border-slate-100 rounded-full flex items-center justify-center mx-auto mb-2.5">
                        <i class="fa-solid fa-bullhorn text-base text-slate-300"></i>
                    </div>
                    <h4 class="text-sm font-bold text-slate-700">ไม่มีข้อมูลการประกาศประชาสัมพันธ์</h4>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">ขณะนี้ระบบยังไม่มีข่าวสารหรือป้ายกิจกรรมใหม่ลงบอร์ดแสดงผล</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ============ FEATURED SHEETS ============ --}}
    <section class="w-full bg-slate-50/60 py-12 md:py-16 px-4 md:px-6 border-y border-slate-100 font-mitr">
        <div class="max-w-6xl mx-auto">
            <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-end gap-5">
                <div>
                    <span class="inline-block text-[#5EBEE6] text-xs font-bold uppercase tracking-widest mb-1.5">Study Sheets</span>
                    <h2 class="text-2xl md:text-3xl text-slate-900 font-extrabold tracking-tight mb-1.5">ชีทสรุปแนะนำ</h2>
                    <p class="text-slate-500 text-sm max-w-2xl">รวมชีทสรุปคุณภาพจากรุ่นพี่ ที่ผ่านการตรวจสอบและอนุมัติแล้ว พร้อมดาวน์โหลดไปอ่านได้ทันที</p>
                </div>
                <a href="{{ route('sheets') }}"
                    class="shrink-0 text-sm font-semibold text-[#5EBEE6] hover:text-white transition-all flex items-center gap-2 bg-blue-50 hover:bg-[#5EBEE6] px-4 py-2.5 rounded-xl group">
                    ดูชีทสรุปทั้งหมด <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            @if ($featuredSheets->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach ($featuredSheets as $sheet)
                        <a href="{{ route('sheets') }}"
                            class="group bg-white rounded-2xl border border-slate-100 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_15px_30px_rgba(0,0,0,0.05)] flex flex-col">
                            <div class="w-11 h-11 bg-rose-50 text-rose-500 rounded-xl flex items-center justify-center mb-3 border border-rose-100">
                                <i class="fa-solid fa-file-pdf text-lg"></i>
                            </div>
                            <h4 class="text-slate-800 text-sm font-bold leading-snug line-clamp-2 mb-2 group-hover:text-[#5EBEE6] transition-colors">{{ $sheet->sheet_name }}</h4>
                            <div class="flex flex-wrap gap-1.5 mb-3">
                                <span class="px-2 py-0.5 bg-slate-50 border border-slate-100 rounded-md text-[9px] font-bold text-slate-500">{{ $sheet->subject }}</span>
                                <span class="px-2 py-0.5 bg-slate-50 border border-slate-100 rounded-md text-[9px] font-bold text-slate-500">{{ $sheet->level }}</span>
                            </div>
                            <div class="mt-auto pt-2.5 border-t border-slate-50 flex items-center justify-between text-[10px] text-slate-400 font-medium">
                                <span class="flex items-center gap-1"><i class="fa-regular fa-eye"></i> {{ $sheet->views }} ครั้ง</span>
                                <span class="flex items-center gap-1"><i class="fa-solid fa-arrow-down-to-line"></i> {{ $sheet->downloads }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white p-10 rounded-2xl border border-dashed border-slate-200 text-center">
                    <p class="text-sm text-slate-400 font-medium">ยังไม่มีชีทสรุปที่ได้รับการอนุมัติในขณะนี้</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ============ FEATURED PORTFOLIOS ============ --}}
    <section class="w-full bg-white py-12 md:py-16 px-4 md:px-6 font-mitr">
        <div class="max-w-6xl mx-auto">
            <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-end gap-5">
                <div>
                    <span class="inline-block text-[#5EBEE6] text-xs font-bold uppercase tracking-widest mb-1.5">Student Portfolios</span>
                    <h2 class="text-2xl md:text-3xl text-slate-900 font-extrabold tracking-tight mb-1.5">ผลงานเด่นจากแฟ้มผลงาน</h2>
                    <p class="text-slate-500 text-sm max-w-2xl">ตัวอย่างผลงานจริงของนักเรียนที่ได้รับการอนุมัติ เพื่อเป็นแรงบันดาลใจให้กับผลงานชิ้นต่อไปของคุณ</p>
                </div>
                <a href="{{ route('portfolio') }}"
                    class="shrink-0 text-sm font-semibold text-[#5EBEE6] hover:text-white transition-all flex items-center gap-2 bg-blue-50 hover:bg-[#5EBEE6] px-4 py-2.5 rounded-xl group">
                    ดูแฟ้มผลงานทั้งหมด <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            @if ($featuredPortfolios->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach ($featuredPortfolios as $portfolio)
                        @php
                            $portfolioFiles = $portfolio->file_path ?? [];
                            $primaryFile = $portfolioFiles[0] ?? null;
                            $portfolioExt = strtolower(pathinfo($primaryFile ?? '', PATHINFO_EXTENSION));
                        @endphp
                        <a href="{{ route('portfolio.show', $portfolio->id) }}"
                            class="group bg-white rounded-2xl border border-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_15px_30px_rgba(0,0,0,0.05)] flex flex-col">
                            <div class="relative h-32 bg-slate-50 flex items-center justify-center overflow-hidden border-b border-slate-50">
                                @if ($portfolioExt === 'pdf')
                                    <canvas class="pdf-thumbnail w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out opacity-0" data-pdf-url="{{ asset($primaryFile) }}"></canvas>
                                    <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-300 pdf-loading bg-slate-50/50">
                                        <i class="fa-solid fa-spinner fa-spin text-base text-[#5EBEE6]"></i>
                                    </div>
                                @elseif ($primaryFile)
                                    <img src="{{ asset($primaryFile) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" alt="ปกผลงานของ {{ $portfolio->first_name }} {{ $portfolio->last_name }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <i class="fa-regular fa-image text-xl"></i>
                                    </div>
                                @endif
                                @if (count($portfolioFiles) > 1)
                                    <span class="absolute bottom-1.5 right-1.5 z-10 bg-slate-900/70 backdrop-blur-sm text-white text-[8px] font-bold px-1.5 py-0.5 rounded-md"><i class="fa-solid fa-paperclip"></i> {{ count($portfolioFiles) }}</span>
                                @endif
                            </div>
                            <div class="p-3 flex flex-col flex-grow">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-7 h-7 rounded-full bg-gradient-to-br from-[#5EBEE6] to-blue-500 text-white flex items-center justify-center font-bold text-[10px] shrink-0">
                                        {{ mb_substr($portfolio->first_name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-slate-800 text-xs font-bold truncate">{{ $portfolio->first_name }} {{ $portfolio->last_name }}</h4>
                                        <p class="text-slate-400 text-[9px] font-medium truncate">{{ $portfolio->university }}</p>
                                    </div>
                                </div>
                                <p class="text-slate-500 text-[11px] leading-relaxed line-clamp-2 mb-2 group-hover:text-slate-600 transition-colors">{{ $portfolio->description }}</p>
                                <div class="mt-auto pt-2 border-t border-slate-50 flex items-center justify-between text-[9px] text-slate-400 font-medium">
                                    <span class="flex items-center gap-1"><i class="fa-regular fa-eye"></i> {{ $portfolio->views }}</span>
                                    <span class="text-[#5EBEE6] font-bold group-hover:underline flex items-center gap-0.5">
                                        ดู <i class="fa-solid fa-angle-right text-[7px]"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-slate-50 p-10 rounded-2xl border border-dashed border-slate-200 text-center">
                    <p class="text-sm text-slate-400 font-medium">ยังไม่มีผลงานที่ได้รับการอนุมัติในขณะนี้</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ============ WHY JOIN ============ --}}
    <section class="w-full bg-slate-50/60 py-12 md:py-16 px-4 md:px-6 border-y border-slate-100 font-mitr">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10">
                <span class="inline-block text-[#5EBEE6] text-xs font-bold uppercase tracking-widest mb-1.5">Why Join Us</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-2">ทำไมต้องเข้าร่วมศูนย์โครงการ STEAM</h2>
                <p class="text-slate-500 text-sm max-w-2xl mx-auto">มากกว่าพื้นที่เก็บโครงงาน แต่คือระบบนิเวศที่ช่วยให้คุณเติบโตในทุกด้าน</p>
            </div>

            @php
                $benefits = [
                    ['icon' => 'fa-people-group', 'text' => 'text-[#5EBEE6]', 'bg' => 'bg-blue-50', 'title' => 'ทำงานเป็นทีม', 'desc' => 'จับทีมกับเพื่อนที่มีความสนใจตรงกัน แบ่งหน้าที่ และเรียนรู้การทำงานร่วมกันจริง'],
                    ['icon' => 'fa-chalkboard-user', 'text' => 'text-purple-600', 'bg' => 'bg-purple-50', 'title' => 'พี่เลี้ยงดูแลใกล้ชิด', 'desc' => 'มีอาจารย์ที่ปรึกษาคอยให้คำแนะนำตลอดเส้นทางของโครงงาน'],
                    ['icon' => 'fa-award', 'text' => 'text-amber-500', 'bg' => 'bg-amber-50', 'title' => 'เก็บผลงานอย่างเป็นระบบ', 'desc' => 'รวบรวมผลงานทั้งหมดไว้ในแฟ้มผลงานส่วนตัว พร้อมใช้ยื่นสมัครเรียนต่อ'],
                    ['icon' => 'fa-book-open', 'text' => 'text-emerald-500', 'bg' => 'bg-emerald-50', 'title' => 'คลังความรู้ครบครัน', 'desc' => 'เข้าถึงชีทสรุปคุณภาพจากรุ่นพี่ ครอบคลุมทุกวิชาและทุกระดับชั้น'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($benefits as $b)
                    <div class="bg-white rounded-2xl border border-slate-100 p-6 text-center hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                        <div class="w-14 h-14 {{ $b['bg'] }} {{ $b['text'] }} rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid {{ $b['icon'] }} text-xl"></i>
                        </div>
                        <h4 class="text-slate-900 font-bold text-sm mb-2">{{ $b['title'] }}</h4>
                        <p class="text-slate-500 text-xs leading-relaxed">{{ $b['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ FAQ ============ --}}
    <section class="w-full bg-white py-12 md:py-16 px-4 md:px-6 font-mitr">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-10">
                <span class="inline-block text-[#5EBEE6] text-xs font-bold uppercase tracking-widest mb-1.5">FAQ</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-2">คำถามที่พบบ่อย</h2>
                <p class="text-slate-500 text-sm">ข้อสงสัยที่นักเรียนถามเข้ามาบ่อยที่สุดเกี่ยวกับศูนย์โครงการ STEAM</p>
            </div>

            @php
                $faqs = [
                    ['q' => 'ต้องสมัครสมาชิกก่อนถึงจะสร้างโครงงานได้ไหม?', 'a' => 'ใช่ครับ ต้องสมัครสมาชิกและเข้าสู่ระบบก่อน จึงจะสามารถสร้างโครงงาน เข้าร่วมทีม และอัปโหลดผลงานลงแฟ้มผลงานส่วนตัวได้'],
                    ['q' => 'สามารถเข้าร่วมโครงงานที่คนอื่นสร้างไว้แล้วได้หรือไม่?', 'a' => 'ได้ครับ สามารถเข้าไปดูรายการโครงงานที่กำลังเปิดรับสมัครสมาชิกในหน้า "โครงงาน" แล้วติดต่อขอเข้าร่วมทีมได้ทันที ตราบใดที่ทีมยังรับสมาชิกไม่ครบจำนวน'],
                    ['q' => 'ชีทสรุปที่อัปโหลดต้องรอตรวจสอบก่อนหรือไม่?', 'a' => 'ต้องรอทีมงานตรวจสอบและอนุมัติก่อน เพื่อคัดกรองคุณภาพเนื้อหา หลังผ่านการอนุมัติแล้วชีทจะแสดงผลในหน้าชีทสรุปสาธารณะทันที'],
                    ['q' => 'แฟ้มผลงานสามารถนำไปใช้ยื่นสมัครเรียนต่อได้จริงหรือไม่?', 'a' => 'ได้ครับ ผลงานที่ได้รับการอนุมัติในระบบสามารถดาวน์โหลดเป็นไฟล์ เพื่อนำไปประกอบการยื่นสมัครเข้าศึกษาต่อในระดับมหาวิทยาลัยได้'],
                ];
            @endphp

            <div class="space-y-3" x-data="{ open: 0 }">
                @foreach ($faqs as $i => $faq)
                    <div class="bg-slate-50/60 border border-slate-100 rounded-2xl overflow-hidden">
                        <button type="button" @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                            class="w-full flex items-center justify-between gap-4 text-left px-5 py-4">
                            <span class="text-slate-800 text-sm font-bold">{{ $faq['q'] }}</span>
                            <i class="fa-solid fa-chevron-down text-slate-400 text-xs transition-transform shrink-0"
                                :class="open === {{ $i }} ? 'rotate-180 text-[#5EBEE6]' : ''"></i>
                        </button>
                        <div x-show="open === {{ $i }}" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none">
                            <p class="text-slate-500 text-xs leading-relaxed px-5 pb-4">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/js/portfolio-home.js') }}"></script>
@endsection
