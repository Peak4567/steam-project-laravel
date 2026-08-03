@extends('layout')
@section('content')

    {{-- 🌟 1. Section: ค้นหาโครงงาน (Search Projects) 🌟 --}}
    <section class="w-full bg-slate-50/50 py-16 px-4 md:px-6 font-mitr relative overflow-hidden">
        {{-- Background Glow --}}
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-[#5EBEE6]/10 rounded-full blur-3xl -z-10 pointer-events-none translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-blue-400/5 rounded-full blur-3xl -z-10 pointer-events-none -translate-x-1/2 translate-y-1/2"></div>

        <div class="max-w-6xl mx-auto">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-2.5 h-10 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                <div>
                    <span class="inline-block text-[#5EBEE6] text-xs font-bold uppercase tracking-widest mb-1">Explore</span>
                    <h2 class="text-3xl md:text-4xl text-slate-900 font-extrabold tracking-tight">ค้นหาโครงงานของคุณ</h2>
                </div>
            </div>

            <div class="relative w-full mb-8 shadow-sm">
                <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-[#5EBEE6] text-lg"></i>
                </div>
                <input type="text"
                    class="w-full bg-white border border-gray-100 rounded-2xl py-4.5 pl-14 pr-12 text-slate-600 focus:ring-2 focus:ring-[#5EBEE6]/50 focus:border-[#5EBEE6] transition-all outline-none shadow-[0_8px_30px_rgba(0,0,0,0.02)]"
                    placeholder="พิมพ์ชื่อโครงงาน หรือคีย์เวิร์ดที่สนใจ...">
                <div class="absolute inset-y-0 right-6 flex items-center cursor-pointer hover:text-red-500 transition-colors">
                    <span class="text-gray-300 font-medium hover:text-red-400"><i class="fa-solid fa-xmark text-lg"></i></span>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 mb-12">
                <a href="{{ route('projects') }}"
                    class="px-6 py-2.5 rounded-xl text-sm font-semibold transition-all block text-center {{ !request('tag') ? 'bg-gradient-to-r from-[#5EBEE6] to-blue-500 text-white shadow-md shadow-blue-500/20' : 'bg-white border border-gray-100 text-slate-500 hover:bg-slate-50 hover:text-[#5EBEE6] shadow-sm' }}">
                    ทั้งหมด
                </a>
                @foreach ($tags as $tag)
                    <a href="{{ route('projects', ['tag' => $tag->id]) }}"
                        class="px-6 py-2.5 rounded-xl text-sm font-semibold transition-all block text-center {{ request('tag') == $tag->id ? 'bg-gradient-to-r from-[#5EBEE6] to-blue-500 text-white shadow-md shadow-blue-500/20' : 'bg-white border border-gray-100 text-slate-500 hover:bg-slate-50 hover:text-[#5EBEE6] shadow-sm' }}">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>

            <div class="relative group">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12 relative z-20">
                    @forelse($projects as $project)
                        <a href="{{ route('projects.applyPage', $project->id) }}"
                            class="group cursor-pointer bg-white rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col overflow-hidden block">

                            <div class="relative h-48 md:h-52 overflow-hidden bg-slate-100">
                                @if ($project->file_path)
                                    <img src="{{ asset($project->file_path) }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-in-out"
                                        alt="{{ $project->name }}">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 group-hover:scale-105 transition-transform duration-700 bg-slate-50">
                                        <i class="fa-regular fa-image text-4xl mb-2"></i>
                                        <span class="text-sm font-medium font-kanit">ไม่มีภาพ</span>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/30 to-transparent opacity-80"></div>

                                <div class="absolute top-3 left-3 backdrop-blur-md px-2.5 py-1 rounded-full border {{ $project->members_count < ($project->max_members ?? 5) ? 'bg-emerald-500/20 border-emerald-500/30' : 'bg-red-500/20 border-red-500/30' }} flex items-center gap-1.5 shadow-sm">
                                    <span class="relative flex h-1.5 w-1.5">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $project->members_count < ($project->max_members ?? 5) ? 'bg-emerald-400' : 'bg-red-400' }} opacity-75"></span>
                                      <span class="relative inline-flex rounded-full h-1.5 w-1.5 {{ $project->members_count < ($project->max_members ?? 5) ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                    </span>
                                    <p class="text-[9px] {{ $project->members_count < ($project->max_members ?? 5) ? 'text-emerald-300' : 'text-red-300' }} uppercase tracking-wider font-bold">
                                        {{ $project->members_count < ($project->max_members ?? 5) ? 'กำลังรับสมัคร' : 'เต็มแล้ว' }}
                                    </p>
                                </div>

                                <div class="absolute bottom-4 left-4 right-4 text-left z-10">
                                    <h4 class="text-white text-sm font-bold leading-tight mb-1 line-clamp-2">
                                        {{ $project->name }}
                                    </h4>
                                    <p class="text-blue-200 text-[10px] line-clamp-1 flex items-center gap-1.5">
                                        <i class="fa-solid fa-user-tie text-[9px]"></i> 
                                        @forelse($project->advisors as $advisor)
                                            {{ $advisor->first_name }} {{ $advisor->last_name }}@if (!$loop->last), @endif
                                        @empty
                                            รอระบุที่ปรึกษา
                                        @endforelse
                                    </p>
                                </div>
                            </div>

                            <div class="p-3 bg-white flex justify-between items-center border-t border-gray-50">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-blue-50 flex items-center justify-center">
                                        <i class="fa-solid fa-users text-[#5EBEE6] text-[10px]"></i>
                                    </div>
                                    <span class="text-[10px] text-slate-500 font-bold uppercase tracking-wide">รับสมัคร</span>
                                </div>
                                <span class="text-xs text-slate-800 font-bold bg-slate-50 px-2 py-1 rounded-md">
                                    {{ $project->members_count ?? 0 }} <span class="text-slate-400 font-normal">/</span> {{ $project->max_members ?? 5 }}
                                </span>
                            </div>

                        </a>
                    @empty
                        <div class="col-span-full py-16 text-center border border-dashed border-slate-200 rounded-3xl bg-white shadow-sm flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                <i class="fa-solid fa-folder-open text-3xl text-slate-300"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-700 mb-1">ยังไม่มีโครงงานเปิดรับสมัคร</h3>
                            <p class="text-sm text-slate-400">กรุณากลับมาตรวจสอบใหม่อีกครั้งในภายหลัง</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    {{-- 🌟 2. Section: เล่มรายงาน (Reports) 🌟 --}}
    <section class="w-full bg-white py-16 px-4 md:px-6 font-mitr relative border-t border-slate-100">
        <div class="max-w-6xl mx-auto">

            <div class="w-full bg-gradient-to-r from-slate-50 to-white rounded-2xl p-4 md:p-6 mb-10 flex flex-col md:flex-row items-center justify-between border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)]">
                <div class="flex items-center gap-4 mb-4 md:mb-0">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center border border-slate-50">
                        <i class="fa-solid fa-file-pdf text-[#5EBEE6] text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-slate-900 text-lg font-bold">คลังเล่มรายงาน</h3>
                        <p class="text-slate-500 text-xs">ค้นหาและศึกษาเล่มรายงานโครงงานปีก่อนๆ หรืออัปโหลดของคุณเอง</p>
                    </div>
                </div>
                <a href="{{ route('projects.reports') ?? '#' }}"
                    class="w-full md:w-auto bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-xl flex items-center justify-center gap-2 transition-all text-sm font-semibold shadow-md active:scale-95">
                    อัปโหลดรายงาน <i class="fa-solid fa-cloud-arrow-up"></i>
                </a>
            </div>

            <form action="{{ url()->current() }}" method="GET" class="bg-white border border-slate-100 p-3 rounded-2xl shadow-sm mb-8 flex flex-col md:flex-row items-center justify-between gap-3">
                <div class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto flex-grow">
                    <select name="year" onchange="this.form.submit()"
                        class="w-full md:w-auto bg-slate-50 border-none text-slate-600 text-sm font-medium rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#5EBEE6]/30 cursor-pointer">
                        <option value="">ทุกปีการศึกษา</option>
                        @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                            <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                พ.ศ. {{ $i + 543 }}
                            </option>
                        @endfor
                    </select>

                    <select name="category" onchange="this.form.submit()"
                        class="w-full md:w-auto bg-slate-50 border-none text-slate-600 text-sm font-medium rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#5EBEE6]/30 cursor-pointer">
                        <option value="">ทุกหมวดหมู่</option>
                        <option value="school" {{ request('category') == 'school' ? 'selected' : '' }}>โครงงานโรงเรียน</option>
                    </select>

                    <div class="relative flex-grow w-full">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="ค้นหาชื่อรายงาน, ผู้จัดทำ..."
                            class="w-full bg-slate-50 border-none text-sm text-slate-700 rounded-xl pl-10 pr-24 py-3 outline-none focus:ring-2 focus:ring-[#5EBEE6]/30 transition-all">
                        <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <button type="submit"
                            class="absolute right-1.5 top-1/2 -translate-y-1/2 bg-[#5EBEE6] text-white px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-[#45a8d1] transition-colors shadow-sm">
                            ค้นหา
                        </button>
                    </div>
                </div>
            </form>

            <div class="flex items-center gap-3 mb-10 overflow-x-auto pb-4 scrollbar-hide">
                <a href="{{ request()->fullUrlWithQuery(['tag' => null]) }}"
                    class="px-6 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-colors {{ !request('tag') ? 'bg-slate-800 text-white shadow-md shadow-slate-200' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50' }}">ทั้งหมด</a>
                <a href="{{ request()->fullUrlWithQuery(['tag' => 'เกษตร']) }}"
                    class="px-6 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-colors {{ request('tag') == 'เกษตร' ? 'bg-slate-800 text-white shadow-md shadow-slate-200' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50' }}">เกษตร</a>
                <a href="{{ request()->fullUrlWithQuery(['tag' => 'แข่งขัน']) }}"
                    class="px-6 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-colors {{ request('tag') == 'แข่งขัน' ? 'bg-slate-800 text-white shadow-md shadow-slate-200' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50' }}">แข่งขัน</a>
                <a href="{{ request()->fullUrlWithQuery(['tag' => 'เคมี']) }}"
                    class="px-6 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-colors {{ request('tag') == 'เคมี' ? 'bg-slate-800 text-white shadow-md shadow-slate-200' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50' }}">เคมี</a>
            </div>

            @if (isset($reports))
                @php
                    $approvedReports = $reports->where('status', 'approved');
                @endphp

                <div class="flex justify-between items-end mb-6 border-b border-slate-100 pb-4">
                    <h4 class="text-slate-900 text-2xl font-bold tracking-tight">รายงานโครงงานล่าสุด</h4>
                    <p class="text-xs text-slate-500 font-medium bg-slate-50 px-3 py-1 rounded-lg">
                        แสดง <span class="text-[#5EBEE6] font-bold">{{ $approvedReports->count() }}</span>
                        จาก <span class="text-[#5EBEE6] font-bold">{{ $reports->total() ?? 0 }}</span> รายการ
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($approvedReports as $report)
                        <div class="font-mitr h-full flex">
                            <a href="{{ route('projects.viewReport', $report->id) }}" target="_blank"
                                class="w-full group cursor-pointer bg-white flex flex-col rounded-2xl overflow-hidden border border-slate-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_15px_40px_rgba(0,0,0,0.06)] shadow-sm">

                                <div class="relative bg-slate-50 h-[300px] overflow-hidden flex items-center justify-center border-b border-slate-100">
                                    @php
                                        $ext = strtolower(pathinfo($report->file_path[0] ?? '', PATHINFO_EXTENSION));
                                    @endphp

                                    <div class="absolute top-3 right-3 bg-white/90 text-slate-800 border border-slate-200 text-[9px] font-bold px-3 py-1 rounded-full z-10 backdrop-blur-md uppercase shadow-sm">
                                        {{ $ext }}
                                    </div>

                                    @if ($ext === 'pdf')
                                        <canvas class="pdf-thumbnail w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                            data-pdf-url="{{ route('projects.viewReport', $report->id) }}"></canvas>
                                    @else
                                        <img src="{{ asset('assets/img/project.png') }}"
                                            class="w-full h-full object-cover opacity-50 group-hover:scale-105 transition-transform duration-700" alt="Cover">
                                    @endif
                                </div>

                                <div class="bg-white p-5 flex flex-col flex-grow text-left">
                                    <div class="inline-block px-2.5 py-1 bg-blue-50 border border-blue-100/50 text-[#5EBEE6] font-bold rounded-md text-[9px] mb-3 self-start tracking-wider">
                                        พ.ศ. {{ $report->created_at->format('Y') + 543 }}
                                    </div>

                                    <h5 class="text-base font-bold text-slate-800 mb-2 line-clamp-2 leading-tight group-hover:text-[#5EBEE6] transition-colors">
                                        {{ $report->project_name }}
                                    </h5>

                                    <div class="flex items-center gap-2 mb-3 text-slate-500">
                                        <i class="fa-solid fa-school text-[10px] text-slate-400"></i>
                                        <p class="text-xs font-medium line-clamp-1">
                                            {{ $report->project->team_name ?? 'ไม่ระบุชื่อทีม/โรงเรียน' }}
                                        </p>
                                    </div>

                                    <div class="mt-auto pt-4 border-t border-slate-50 flex justify-between items-center">
                                        <div class="flex items-center gap-3 text-slate-400">
                                            <div class="flex items-center gap-1.5" title="ผู้จัดทำ">
                                                <i class="fa-solid fa-users text-[10px]"></i>
                                                <span class="text-[11px] font-semibold">{{ $report->project->members_count ?? 1 }}</span>
                                            </div>
                                            <div class="flex items-center gap-1.5" title="ยอดเข้าชม">
                                                <i class="fa-solid fa-eye text-[10px]"></i>
                                                <span class="text-[11px] font-semibold">{{ number_format($report->views ?? 0) }}</span>
                                            </div>
                                        </div>
                                        <div class="w-7 h-7 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-[#5EBEE6] group-hover:text-white transition-colors">
                                            <i class="fa-solid fa-arrow-right text-[10px] -rotate-45"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-20 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                                <i class="fa-regular fa-file-pdf text-3xl text-slate-300"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-700 mb-1">ยังไม่มีเล่มรายงาน</h3>
                            <p class="text-sm text-slate-400">ยังไม่มีผู้ทำการอัปโหลดเล่มรายงานเข้าสู่ระบบ</p>
                        </div>
                    @endforelse
                </div>

                @if (method_exists($reports, 'links') && $reports->hasPages())
                    <div class="mt-10 flex justify-center">
                        {{ $reports->links() }}
                    </div>
                @endif
            @endif

        </div>
    </section>

<section class="w-full py-20 px-4 md:px-6 font-mitr bg-gradient-to-b from-[#FFFDF5] to-white border-t border-yellow-50 overflow-hidden relative">
    <div class="absolute top-10 right-10 w-72 h-72 bg-yellow-300/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-6xl mx-auto">
        <div class="flex justify-center items-center mb-16 relative">
            <img src="{{ asset('assets/img/halloffame.png') }}" alt="Hall of Fame"
                class="w-full max-w-[500px] md:max-w-[600px] h-auto object-contain select-none drop-shadow-xl hover:scale-105 transition-transform duration-700">
        </div>

        <div class="flex items-center gap-4 mb-10 text-center justify-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">🏆 นักเรียนผู้ได้รับรางวัลเกียรติยศ</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

            @forelse($hallOfFameUsers ?? [] as $index => $fameUser)
                <div class="group cursor-pointer transition-all duration-300 hover:-translate-y-3">
                    <div class="relative h-64 md:h-72 rounded-[2rem] overflow-hidden border-4 border-yellow-400 shadow-[0_15px_30px_rgba(250,204,21,0.15)] group-hover:shadow-[0_20px_40px_rgba(250,204,21,0.25)] group-hover:border-yellow-300 bg-slate-900 flex items-center justify-center">
                        
                        @if($fameUser->profile)
                            <img src="{{ asset('assets/img/profile/' . $fameUser->profile) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                alt="{{ $fameUser->first_name }}">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-900 flex flex-col items-center justify-center text-center p-4">
                                <div class="w-20 h-20 rounded-full bg-yellow-400/10 border-2 border-yellow-400/40 flex items-center justify-center mb-8 group-hover:scale-105 transition-transform duration-500">
                                    <span class="text-2xl font-black text-yellow-400 uppercase">{{ substr($fameUser->first_name, 0, 1) }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                        
                        <div class="absolute top-4 left-4 bg-gradient-to-r from-yellow-400 to-yellow-500 shadow-md shadow-yellow-500/20 px-3 py-1.5 rounded-xl border border-yellow-200">
                            <p class="text-[9px] text-yellow-900 font-black uppercase tracking-widest flex items-center gap-1">
                                <i class="fa-solid fa-star"></i> สมาชิกดีเด่น
                            </p>
                        </div>

                        <div class="absolute bottom-5 left-5 right-5 text-left z-10">
                            <h4 class="text-white text-sm font-bold leading-tight mb-2 drop-shadow-md truncate">
                                {{ $fameUser->prefix }}{{ $fameUser->first_name }} {{ $fameUser->last_name }}
                            </h4>
                            <div class="flex items-center gap-1.5">
                                <span class="bg-white/20 backdrop-blur-md text-white text-[9px] font-bold px-2 py-0.5 rounded-md border border-white/10 uppercase">
                                    {{ $fameUser->grade_level ?? 'ไม่ระบุชั้น' }}
                                </span>
                                @if($fameUser->nickname)
                                    <span class="bg-yellow-400/20 text-yellow-300 text-[9px] font-bold px-2 py-0.5 rounded-md border border-yellow-400/20">
                                        ชื่อเล่น: {{ $fameUser->nickname }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 sm:col-span-2 md:col-span-3 lg:col-span-5 bg-white/60 p-12 rounded-[2rem] border border-yellow-100 text-center shadow-sm">
                    <div class="w-12 h-12 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fa-solid fa-trophy text-lg text-yellow-500"></i>
                    </div>
                    <h4 class="text-sm font-bold text-slate-700">อยู่ระหว่างการอัปเดตข้อมูลทำเนียบ</h4>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">ขณะนี้ยังไม่มีรายชื่อประกาศเกียรติคุณจัดแสดงบนหน้ากระดานระบบหลัก</p>
                </div>
            @endforelse

        </div>
    </div>
</section>

    {{-- 🌟 4. Section: STEAM4INNOVATOR 🌟 --}}
    <section class="w-full bg-white py-24 px-4 md:px-6 font-mitr overflow-hidden relative border-t border-slate-100">
        {{-- Background Design --}}
        <div class="absolute inset-x-0 top-0 h-[420px] bg-grid-steam opacity-40 [mask-image:radial-gradient(ellipse_60%_60%_at_50%_0%,black,transparent)] pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-[#5EBEE6]/10 rounded-full blur-[100px] pointer-events-none"></div>

        <style>
            .bg-grid-steam {
                background-image: radial-gradient(circle, rgba(94,190,230,0.25) 1px, transparent 1px);
                background-size: 22px 22px;
            }
        </style>

        <div class="max-w-6xl mx-auto relative z-10">

            <div class="text-center mb-24 relative">
                <h2 class="text-5xl md:text-7xl lg:text-[8rem] font-black text-slate-900/5 absolute inset-0 flex justify-center items-center select-none uppercase tracking-[0.2em] -mt-4">
                    INNOVATOR
                </h2>
                <div class="relative z-10">
                    <span class="inline-block px-4 py-1.5 bg-[#5EBEE6]/10 text-[#5EBEE6] border border-[#5EBEE6]/20 font-bold text-xs uppercase tracking-widest rounded-full mb-4">4 Steps to Success</span>
                    <h3 class="text-slate-900 text-4xl md:text-5xl font-black mb-3 tracking-tight">STEAM<span class="text-[#5EBEE6]">4</span>INNOVATOR</h3>
                    <p class="text-slate-500 text-sm md:text-base font-medium tracking-wide">แผนการพัฒนาศักยภาพด้านนวัตกรรม สู่การลงมือทำจริง</p>
                </div>
            </div>

            <div class="relative mt-12">
                {{-- Timeline Line --}}
                <div class="hidden lg:block absolute top-12 left-[12%] right-[12%] h-0.5 bg-gradient-to-r from-transparent via-[#5EBEE6]/40 to-transparent z-0 border-t border-dashed border-[#5EBEE6]/40"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 relative z-10">

                    {{-- Step 1 --}}
                    <div class="group flex flex-col items-center text-center transition-all duration-500 hover:-translate-y-3">
                        <div class="relative mb-6">
                            <div class="absolute inset-0 bg-[#5EBEE6] rounded-full blur-xl opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>
                            <div class="w-24 h-24 bg-white border border-slate-100 rounded-full flex items-center justify-center relative z-10 shadow-md group-hover:border-[#5EBEE6] group-hover:bg-blue-50/50 transition-colors duration-500">
                                <span class="absolute -top-2 -right-2 w-7 h-7 bg-[#5EBEE6] text-white text-[11px] font-black rounded-full flex items-center justify-center shadow-lg border-2 border-white">1</span>
                                <i class="fa-solid fa-brain text-3xl text-slate-700 group-hover:text-[#5EBEE6] transition-colors"></i>
                            </div>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">รู้ลึกรู้จริง</h4>
                        <p class="text-xs text-slate-500 leading-relaxed px-2 font-medium">
                            เริ่มต้นกระบวนการสร้างสรรค์ธุรกิจนวัตกรรมด้วยการรับรู้สิ่งแวดล้อมรอบตัว
                        </p>
                    </div>

                    {{-- Step 2 --}}
                    <div class="group flex flex-col items-center text-center transition-all duration-500 hover:-translate-y-3">
                        <div class="relative mb-6">
                            <div class="absolute inset-0 bg-[#5EBEE6] rounded-full blur-xl opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>
                            <div class="w-24 h-24 bg-white border border-slate-100 rounded-full flex items-center justify-center relative z-10 shadow-md group-hover:border-[#5EBEE6] group-hover:bg-blue-50/50 transition-colors duration-500">
                                <span class="absolute -top-2 -right-2 w-7 h-7 bg-[#5EBEE6] text-white text-[11px] font-black rounded-full flex items-center justify-center shadow-lg border-2 border-white">2</span>
                                <i class="fa-solid fa-lightbulb text-3xl text-slate-700 group-hover:text-[#5EBEE6] transition-colors"></i>
                            </div>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">สร้างสรรค์ไอเดีย</h4>
                        <p class="text-xs text-slate-500 leading-relaxed px-2 font-medium">
                            ต่อยอดความคิดสร้างสรรค์ กำหนดปัญหาเป้าหมายในการแก้ไขที่ชัดเจน
                        </p>
                    </div>

                    {{-- Step 3 --}}
                    <div class="group flex flex-col items-center text-center transition-all duration-500 hover:-translate-y-3">
                        <div class="relative mb-6">
                            <div class="absolute inset-0 bg-[#5EBEE6] rounded-full blur-xl opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>
                            <div class="w-24 h-24 bg-white border border-slate-100 rounded-full flex items-center justify-center relative z-10 shadow-md group-hover:border-[#5EBEE6] group-hover:bg-blue-50/50 transition-colors duration-500">
                                <span class="absolute -top-2 -right-2 w-7 h-7 bg-[#5EBEE6] text-white text-[11px] font-black rounded-full flex items-center justify-center shadow-lg border-2 border-white">3</span>
                                <i class="fa-solid fa-handshake text-3xl text-slate-700 group-hover:text-[#5EBEE6] transition-colors"></i>
                            </div>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">แผนพัฒนาธุรกิจ</h4>
                        <p class="text-xs text-slate-500 leading-relaxed px-2 font-medium">
                            แนวคิดและแผนบริหารจัดการทั้งหมด เชื่อมโยงคนและทรัพยากร
                        </p>
                    </div>

                    {{-- Step 4 --}}
                    <div class="group flex flex-col items-center text-center transition-all duration-500 hover:-translate-y-3">
                        <div class="relative mb-6">
                            <div class="absolute inset-0 bg-[#5EBEE6] rounded-full blur-xl opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>
                            <div class="w-24 h-24 bg-white border border-slate-100 rounded-full flex items-center justify-center relative z-10 shadow-md group-hover:border-[#5EBEE6] group-hover:bg-blue-50/50 transition-colors duration-500">
                                <span class="absolute -top-2 -right-2 w-7 h-7 bg-[#5EBEE6] text-white text-[11px] font-black rounded-full flex items-center justify-center shadow-lg border-2 border-white">4</span>
                                <i class="fa-solid fa-rocket text-3xl text-slate-700 group-hover:text-[#5EBEE6] transition-colors"></i>
                            </div>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">ผลิตและกระจาย</h4>
                        <p class="text-xs text-slate-500 leading-relaxed px-2 font-medium">
                            ลงมือสร้างผลงานนวัตกรรมและการลงมือทำอย่างจริงจังให้เกิดผลลัพธ์
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/js/pdf-project.js') }}"></script>
@endsection