@extends('layout')
@section('content')
    {{-- โครงงาน --}}
    <section class="max-w-screen-xl mx-auto py-12 px-6">

        <div class="flex items-center gap-4 mb-8">
            <div class="w-2 h-10 bg-[#5EBEE6] rounded-xl"></div>
            <h2 class="text-2xl md:text-3xl text-slate-900">ค้นหาโครงงานของคุณ</h2>
        </div>

        <div class="relative w-full mb-8">
            <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
            <input type="text"
                class="w-full bg-[#EEEEEE] border-none rounded-xl py-4 pl-14 pr-12 text-gray-600 focus:ring-2 focus:ring-[#5EBEE6] transition-all outline-none"
                placeholder="ค้นหา">
            <div class="absolute inset-y-0 right-5 flex items-center cursor-pointer hover:text-red-500">
                <span class="text-gray-400 font-medium">X</span>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 mb-12">
            <a href="{{ route('projects') }}"
                class="px-8 py-2.5 rounded-xl transition-all block text-center {{ !request('tag') ? 'bg-[#5EBEE6] text-white shadow-none' : 'bg-white border border-gray-100 text-gray-500 hover:bg-gray-50' }}">
                ทั้งหมด
            </a>
            @foreach ($tags as $tag)
                <a href="{{ route('projects', ['tag' => $tag->id]) }}"
                    class="px-8 py-2.5 rounded-xl transition-all block text-center {{ request('tag') == $tag->id ? 'bg-[#5EBEE6] text-white shadow-none' : 'bg-white border border-gray-100 text-gray-500 hover:bg-gray-50' }}">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>

        <div class="relative group">
            <button
                class="absolute -left-12 top-1/2 -translate-y-1/2 text-[#5EBEE6] text-4xl font-black hover:scale-125 transition-transform hidden xl:block z-10">
                <i class="fa-solid fa-angle-left"></i>
            </button>
            <button
                class="absolute -right-12 top-1/2 -translate-y-1/2 text-[#5EBEE6] text-4xl font-black hover:scale-125 transition-transform hidden xl:block z-10">
                <i class="fa-solid fa-angle-right"></i>
            </button>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12 relative z-20">
                @forelse($projects as $project)
                    <a href="{{ route('projects.applyPage', $project->id) }}"
                        class="group cursor-pointer transition-all block">

                        <div class="relative h-56 rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                            <img src="{{ $project->image_path ? asset('storage/' . $project->image_path) : asset('assets/img/aerosol.jpg') }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                alt="{{ $project->name }}">

                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>

                            <div
                                class="absolute top-3 left-3 bg-black/50 backdrop-blur-sm px-3 py-1 rounded-xl border border-white/20">
                                @if ($project->members_count < ($project->max_members ?? 5))
                                    <p class="text-[9px] text-green-400">กำลังรับสมัคร</p>
                                @else
                                    <p class="text-[9px] text-red-400">เต็มแล้ว</p>
                                @endif
                            </div>

                            <div class="absolute bottom-4 left-4 right-4 text-left">
                                <h4 class="text-white text-[11px] leading-tight mb-1 line-clamp-2">
                                    โครงงาน : {{ $project->name }}
                                </h4>
                                <p class="text-gray-300 text-[9px]">
                                    อาจารย์ที่ปรึกษา :
                                    @forelse($project->advisors as $advisor)
                                        {{ $advisor->first_name }} {{ $advisor->last_name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @empty
                                        รอระบุอาจารย์ที่ปรึกษา
                                    @endforelse
                                </p>
                            </div>
                        </div>

                        <div class="mt-3 px-2 flex justify-between items-center">
                            <div class="flex items-center gap-1">
                                <span class="text-[10px] text-[#5EBEE6]">จำนวนที่รับ</span>
                                <span class="text-[10px] text-gray-400">
                                    {{ $project->members_count ?? 0 }}/{{ $project->max_members ?? 5 }} คน
                                </span>
                            </div>
                        </div>

                    </a>
                @empty
                    <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center py-12 text-gray-500 font-medium">
                        <i class="fa-solid fa-folder-open text-4xl mb-3 text-gray-300"></i>
                        <p>ยังไม่มีโครงงานที่กำลังเปิดรับสมัครในขณะนี้</p>
                    </div>
                @endforelse
            </div>
        </div>

    </section>


    <section class="max-w-screen-xl mx-auto py-12 px-6 font-mitr">

        <div class="w-full bg-white rounded-xl p-2 mb-8 flex items-center justify-between border border-gray-100 shadow-sm">
            <h3 class="text-gray-400 text-md md:text-base ml-4">อัปโหลดเล่มรายงานของคุณ?</h3>
            <a href="{{ route('projects.reports') ?? '#' }}"
                class="bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white px-6 py-2 rounded-xl flex items-center gap-2 transition-all text-md">
                อัปโหลดรายงาน
                <i class="fa-solid fa-upload"></i>
            </a>
        </div>

        <form action="{{ url()->current() }}" method="GET"
            class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <div class="flex flex-wrap items-center gap-3 flex-grow max-w-4xl">
                <select name="year" onchange="this.form.submit()"
                    class="bg-white border border-gray-100 text-gray-400 text-md rounded-xl px-4 py-2.5 outline-none focus:ring-1 focus:ring-[#5EBEE6] min-w-[150px]">
                    <option value="">ทุกปีการศึกษา</option>
                    @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                        <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                            {{ $i + 543 }}
                        </option>
                    @endfor
                </select>

                <select name="category" onchange="this.form.submit()"
                    class="bg-white border border-gray-100 text-gray-400 text-md rounded-xl px-4 py-2.5 outline-none focus:ring-1 focus:ring-[#5EBEE6] min-w-[150px]">
                    <option value="">ทุกหมวดหมู่</option>
                    <option value="school" {{ request('category') == 'school' ? 'selected' : '' }}>โรงเรียน</option>
                </select>

                <div class="relative flex-grow">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="ค้นหาเล่มรายงาน, ผู้จัดทำ"
                        class="w-full bg-white border border-gray-100 text-md rounded-xl px-4 py-2.5 outline-none focus:ring-1 focus:ring-[#5EBEE6]">
                    <button type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#5EBEE6] text-white px-4 py-1 rounded-lg text-md hover:bg-[#45a8d1] transition-colors">
                        ค้นหา
                    </button>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" class="p-2 bg-white border border-gray-100 rounded-lg text-[#5EBEE6] shadow-sm"><i
                        class="fa-solid fa-table-cells-large"></i></button>
                <button type="button"
                    class="p-2 bg-white border border-gray-100 rounded-lg text-gray-400 hover:text-gray-600"><i
                        class="fa-solid fa-list"></i></button>
            </div>
        </form>

        <div class="flex items-center gap-4 mb-10 overflow-x-auto pb-2">
            <a href="{{ request()->fullUrlWithQuery(['tag' => null]) }}"
                class="px-8 py-2 rounded-full text-md whitespace-nowrap {{ !request('tag') ? 'bg-[#5EBEE6] text-white' : 'bg-white border border-gray-100 text-gray-400 hover:bg-gray-50' }}">ทั้งหมด</a>
            <a href="{{ request()->fullUrlWithQuery(['tag' => 'เกษตร']) }}"
                class="px-8 py-2 rounded-full text-md whitespace-nowrap {{ request('tag') == 'เกษตร' ? 'bg-[#5EBEE6] text-white' : 'bg-white border border-gray-100 text-gray-400 hover:bg-gray-50' }}">เกษตร</a>
            <a href="{{ request()->fullUrlWithQuery(['tag' => 'แข่งขัน']) }}"
                class="px-8 py-2 rounded-full text-md whitespace-nowrap {{ request('tag') == 'แข่งขัน' ? 'bg-[#5EBEE6] text-white' : 'bg-white border border-gray-100 text-gray-400 hover:bg-gray-50' }}">แข่งขัน</a>
            <a href="{{ request()->fullUrlWithQuery(['tag' => 'เคมี']) }}"
                class="px-8 py-2 rounded-full text-md whitespace-nowrap {{ request('tag') == 'เคมี' ? 'bg-[#5EBEE6] text-white' : 'bg-white border border-gray-100 text-gray-400 hover:bg-gray-50' }}">เคมี</a>
        </div>

        @if (isset($reports))
            @php
                // 🌟 กรองเอาเฉพาะข้อมูลที่มีสถานะ 'approved' (อนุมัติแล้ว) เท่านั้น 🌟
                $approvedReports = $reports->where('status', 'approved');
            @endphp

            <div class="flex justify-between items-center mb-6">
                <h4 class="text-gray-800 text-2xl">รายงานโครงงาน</h4>
                <p class="text-[12px] text-gray-500 font-medium">
                    แสดง <span class="text-[#5EBEE6]">{{ $approvedReports->count() }}</span>
                    จาก <span class="text-[#5EBEE6]">{{ $reports->total() ?? 0 }}</span> รายการ
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-2 font-mitr">
                @forelse($approvedReports as $report)
                    <div class="max-w-sm font-mitr">
                        <a href="{{ route('projects.viewReport', $report->id) }}" target="_blank"
                            class="group cursor-pointer bg-white block rounded-lg overflow-hidden border border-gray-50 transition-all duration-300 hover:-translate-y-2 shadow-md">

                            <div class="relative bg-gray-50 h-[380px] overflow-hidden flex items-center justify-center">
                                @php
                                    $ext = strtolower(pathinfo($report->file_path, PATHINFO_EXTENSION));
                                @endphp

                                <div
                                    class="absolute top-4 right-4 bg-gray-900/80 text-white text-[10px] px-3.5 py-1 rounded-full z-10 backdrop-blur-sm tracking-wider select-none uppercase">
                                    {{ $ext }}
                                </div>

                                @if ($ext === 'pdf')
                                    <canvas
                                        class="pdf-thumbnail w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        data-pdf-url="{{ route('projects.viewReport', $report->id) }}"></canvas>
                                @else
                                    <img src="{{ asset('assets/img/project.png') }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        alt="หน้าปกเล่มรายงาน">
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/5 via-transparent to-transparent">
                                </div>
                            </div>

                            <div class="bg-white p-6 pt-5 text-left">
                                <div
                                    class="inline-block px-3 py-0.5 bg-[#5EBEE6]/10 text-[#5EBEE6] rounded-full text-[10px] mb-2 tracking-wide">
                                    พ.ศ. {{ $report->created_at->format('Y') + 543 }}
                                </div>

                                <h5
                                    class="text-lg text-slate-900 mb-2 line-clamp-2 leading-snug tracking-tight group-hover:text-[#2E8DA3] transition-colors">
                                    {{ $report->project_name }}
                                </h5>

                                <div class="flex items-center gap-1.5 mb-4 text-slate-500">
                                    <i class="fa-solid fa-school text-[11px]"></i>
                                    <p class="text-[13px] font-medium">
                                        {{ $report->project->team_name ?? 'ไม่ระบุชื่อทีม/โรงเรียน' }}
                                    </p>
                                </div>

                                <p class="text-[12px] font-normal text-slate-400 line-clamp-2 leading-relaxed mb-6">
                                    {{ $report->subject ?? 'ไม่มีรายละเอียดวิชา/โครงงาน' }}
                                </p>

                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <div class="flex items-center gap-4 text-slate-500">
                                        <div class="flex items-center gap-1.5 group/icon">
                                            <i
                                                class="fa-solid fa-user text-xs group-hover/icon:text-[#2E8DA3] transition-colors"></i>
                                            <span
                                                class="text-xs tracking-tight">{{ $report->project->members_count ?? 1 }}
                                                <span class="text-[10px] text-slate-400">ผู้จัดทำ</span>
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-1.5 group/icon">
                                            <i
                                                class="fa-solid fa-eye text-xs group-hover/icon:text-[#2E8DA3] transition-colors"></i>
                                            <span class="text-xs tracking-tight">{{ number_format($report->views ?? 0) }}
                                                <span class="text-[10px] text-slate-400">วิว</span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="text-[#5EBEE6] opacity-0 group-hover:opacity-100 transition-all">
                                        <i class="fa-solid fa-arrow-right-long text-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-xl border border-gray-100">
                        <i class="fa-solid fa-folder-open text-4xl text-gray-300 mb-3 block"></i>
                        <p class="text-gray-500">ยังไม่มีรายการเล่มรายงานในระบบ</p>
                    </div>
                @endforelse
            </div>

            @if (method_exists($reports, 'links') && $reports->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $reports->links() }}
                </div>
            @endif
        @endif

    </section>

    {{-- hall of fame --}}
    <section class="mx-auto py-16 px-6 font-mitr bg-[#FFFAE8]">

        <div class="flex justify-center items-center mb-16 relative">
            <img src="{{ asset('assets/img/halloffame.png') }}" alt="Hall of Fame"
                class="w-full max-w-[600px] md:max-w-[700px] h-auto object-contain select-none">
        </div>

        <div class="flex items-center gap-4 mb-10 max-w-screen-xl mx-auto px-4">
            <div class="w-2 h-10 bg-[#5EBEE6] rounded-full"></div>
            <h2 class="text-2xl md:text-3xl text-slate-900">ผู้ได้รับรางวัลยอดเยี่ยม</h2>
        </div>

        <div class="max-w-screen-xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 px-4">

            <div class="group cursor-pointer transition-all hover:-translate-y-2">
                <div class="relative h-48 md:h-56 rounded-xl overflow-hidden border-2 border-slate-900 shadow-none">
                    <img src="{{ asset('assets/img/peak_student.png') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Person">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                    <div
                        class="absolute top-3 left-3 bg-[#5EBEE6] backdrop-blur-sm px-3 py-1 rounded-xl border border-white/20">
                        <p class="text-[9px] text-white uppercase tracking-wider">อันดับที่ 1</p>
                    </div>

                    <div class="absolute bottom-4 left-4 right-4 text-left">
                        <h4 class="text-white text-[12px] leading-tight mb-1 line-clamp-2">
                            ศรัณยกร เทพสุนทร (Peak) ม.9/4
                        </h4>
                        <p class="text-gray-300 text-[10px] line-clamp-1">Young Agri Future 2026</p>
                    </div>
                </div>
            </div>
        </div>

    </section>


    {{-- STEAM 4 --}}

    <section class="w-full bg-white py-20 px-4 font-mitr overflow-hidden">
        <div class="max-w-screen-xl mx-auto relative">

            <div class="text-center mb-20 relative">
                <h2
                    class="text-5xl md:text-6xl font-black text-[#5EBEE6]/10 absolute inset-0 flex justify-center items-center select-none uppercase tracking-widest">
                    STEAM4INNOVATOR
                </h2>
                <div class="relative z-10">
                    <h3 class="text-[#5EBEE6] text-3xl md:text-4xl font-bold mb-2">STEAM4INNOVATOR</h3>
                    <p class="text-slate-500 font-medium tracking-wide">แผนการพัฒนาศักยภาพด้านนวัตกรรม</p>
                </div>
            </div>

            <div class="relative">
                <div
                    class="hidden lg:block absolute top-16 left-[10%] right-[10%] h-[2px] bg-gradient-to-r from-transparent via-[#5EBEE6]/30 to-transparent z-0">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 relative z-10">

                    <div
                        class="group flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
                        <div
                            class="w-24 h-24 bg-white border-4 border-[#E0F2FE] rounded-full flex items-center justify-center mb-6 shadow-xl group-hover:border-[#5EBEE6] transition-colors duration-500">
                            <i class="fa-solid fa-brain text-4xl text-[#2E8DA3]"></i>
                        </div>
                        <h4 class="text-xl text-slate-800 mb-3">รู้ลึกรู้จริง</h4>
                        <p class="text-[13px] text-slate-500 leading-relaxed px-4">
                            เริ่มต้นกระบวนการสร้างสรรค์ธุรกิจนวัตกรรมด้วยการรับรู้สิ่งแวดล้อมรอบตัว
                        </p>
                    </div>

                    <div
                        class="group flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
                        <div
                            class="w-24 h-24 bg-white border-4 border-[#E0F2FE] rounded-full flex items-center justify-center mb-6 shadow-xl group-hover:border-[#5EBEE6] transition-colors duration-500">
                            <i class="fa-solid fa-lightbulb text-4xl text-[#2E8DA3]"></i>
                        </div>
                        <h4 class="text-xl text-slate-800 mb-3">สร้างสรรค์ไอเดีย</h4>
                        <p class="text-[13px] text-slate-500 leading-relaxed px-4">
                            ต่อยอดความคิดสร้างสรรค์ กำหนดปัญหาเป้าหมายในการแก้ไขที่ชัดเจน
                        </p>
                    </div>

                    <div
                        class="group flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
                        <div
                            class="w-24 h-24 bg-white border-4 border-[#E0F2FE] rounded-full flex items-center justify-center mb-6 shadow-xl group-hover:border-[#5EBEE6] transition-colors duration-500">
                            <i class="fa-solid fa-handshake text-4xl text-[#2E8DA3]"></i>
                        </div>
                        <h4 class="text-xl text-slate-800 mb-3">แผนพัฒนาธุรกิจ</h4>
                        <p class="text-[13px] text-slate-500 leading-relaxed px-4">
                            แนวคิดและแผนบริหารจัดการทั้งหมด ซึ่งจะเกี่ยวข้องทั้งการเชื่อมโยงคน
                        </p>
                    </div>

                    <div
                        class="group flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
                        <div
                            class="w-24 h-24 bg-white border-4 border-[#E0F2FE] rounded-full flex items-center justify-center mb-6 shadow-xl group-hover:border-[#5EBEE6] transition-colors duration-500">
                            <i class="fa-solid fa-gears text-4xl text-[#2E8DA3]"></i>
                        </div>
                        <h4 class="text-xl text-slate-800 mb-3">การผลิตและการกระจาย</h4>
                        <p class="text-[13px] text-slate-500 leading-relaxed px-4">
                            ลงมือสร้างผลงานนวัตกรรมและการลงมือทำอย่างจริงจังให้เกิดผลลัพธ์
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/js/pdf-project.js') }}"></script>
@endsection
