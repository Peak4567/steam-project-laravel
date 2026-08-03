@extends('backend.layout')
@section('content')
    <section class="w-full h-full p-4 md:p-8 font-mitr bg-slate-50/50">

        {{-- 🔝 1. ส่วนหัวหัวข้อการจัดการโครงงาน (Header Section) --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">ระบบจัดการโครงงาน (Projects)</h2>
                </div>
                <p class="text-xs md:text-sm text-slate-400 font-medium mt-1">มอนิเตอร์ ตรวจสอบ ควบคุมสถานะ และบริหารจัดการระบบคลังโครงงานของนักเรียนทั้งหมด</p>
            </div>

            <a href="{{ route('backend.projects.create') }}"
                class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl text-xs font-bold transition-all shadow-md active:scale-95 flex items-center justify-center gap-2 w-full sm:w-auto shrink-0">
                <i class="fa-solid fa-plus text-[10px]"></i> เพิ่มโครงงานใหม่เข้าคลัง
            </a>
        </div>

        {{-- 📊 2. แผงกล่องข้อมูลสถิติแยกประเภท (Analytics Stats Cards Grid) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
            {{-- โครงงานทั้งหมด --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm relative overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute left-0 top-0 h-full w-1.5 bg-gradient-to-b from-[#5EBEE6] to-blue-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">โครงงานในระบบทั้งหมด</p>
                        <h3 class="text-2xl font-black text-slate-800 leading-none">{{ number_format($stats['total']) }} <span class="text-xs font-normal text-slate-400">กลุ่ม</span></h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100/30 flex items-center justify-center text-[#5EBEE6] shrink-0">
                        <i class="fa-solid fa-layer-group text-lg"></i>
                    </div>
                </div>
            </div>

            {{-- สำเร็จแล้ว --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm relative overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute left-0 top-0 h-full w-1.5 bg-gradient-to-b from-emerald-400 to-teal-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">ดำเนินการสำเร็จเสร็จสิ้น</p>
                        <h3 class="text-2xl font-black text-slate-800 leading-none">{{ number_format($stats['complated']) }} <span class="text-xs font-normal text-slate-400">โครงงาน</span></h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-100/30 flex items-center justify-center text-emerald-500 shrink-0">
                        <i class="fa-solid fa-circle-check text-lg"></i>
                    </div>
                </div>
            </div>

            {{-- ยกเลิกโครงการ --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm relative overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute left-0 top-0 h-full w-1.5 bg-gradient-to-b from-rose-400 to-red-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">โครงงานที่ถูกระงับ/ยกเลิก</p>
                        <h3 class="text-2xl font-black text-slate-800 leading-none">{{ number_format($stats['canceled']) }} <span class="text-xs font-normal text-slate-400">รายการ</span></h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-rose-50 border border-rose-100/30 flex items-center justify-center text-rose-500 shrink-0">
                        <i class="fa-solid fa-ban text-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- 🔍 3. ส่วนช่องค้นหาและคัดกรองสถานะขั้นสูง (Advanced Filters Form Box) --}}
        <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.01)] mb-6">
            <form action="{{ route('backend.projects') }}" method="GET" class="flex flex-col md:flex-row gap-3.5">
                <div class="flex-grow relative shadow-sm rounded-xl">
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-[#5EBEE6]"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหาด้วยชื่อโครงงาน หรือชื่อทีมงานผู้รับผิดชอบ..."
                        class="w-full pl-11 pr-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                </div>
                
                <div class="relative min-w-[160px] shadow-sm rounded-xl">
                    <select name="status"
                        class="appearance-none w-full py-3 pl-4 pr-10 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-bold text-slate-600 outline-none focus:bg-white focus:border-[#5EBEE6] cursor-pointer transition-all"
                        onchange="this.form.submit()">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>ทุกสถานะโครงงาน</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ รอพิจารณา</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>✅ อนุมัติแล้ว</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>❌ ถูกปฏิเสธ</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </div>
                </div>

                <button type="submit"
                    class="bg-gradient-to-r from-[#5EBEE6] to-[#3B9ADE] hover:opacity-95 text-white px-8 py-3 rounded-xl text-xs font-bold shadow-md shadow-blue-500/10 transition-all active:scale-95 whitespace-nowrap">
                    ค้นหาข้อมูล
                </button>
            </form>
        </div>

        {{-- 📋 4. ตารางแสดงผลรายการคลังวิชาโครงงานหลัก (Data Table View Box) --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-400 text-[10px] font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="px-6 py-4 w-96">ข้อมูลหัวข้อวิชาโครงงาน</th>
                            <th class="px-6 py-4 text-center w-52">ผู้จัดทำหลัก (Owner)</th>
                            <th class="px-6 py-4 text-center w-32">วันที่บันทึก</th>
                            <th class="px-6 py-4 text-center w-36">สถานะคิว</th>
                            <th class="px-6 py-4 text-right w-36">การสั่งการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs text-slate-600 font-medium divide-y divide-slate-50">

                        @forelse($projects as $project)
                            <tr class="hover:bg-slate-50/40 transition-colors group">
                                {{-- ชื่อโครงงาน --}}
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-800 text-sm line-clamp-1 group-hover:text-[#5EBEE6] transition-colors">
                                        {{ $project->name ?? 'ไม่ระบุชื่อโครงงานสตรีม' }}
                                    </p>
                                    <div class="flex items-center gap-2 mt-1.5">
                                        <span class="text-[9px] bg-slate-50 text-slate-400 px-2 py-0.5 rounded-md font-bold border border-slate-100 shadow-inner">ID: #{{ $project->id }}</span>
                                        <span class="text-[10px] text-slate-400 font-medium flex items-center gap-1"><i class="fa-solid fa-user-group text-[9px]"></i> ทีม: {{ $project->team_name ?? 'ไม่มีชื่อกลุ่มทีมงาน' }}</span>
                                    </div>
                                </td>

                                {{-- ข้อมูลเจ้าของโครงงาน --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3 justify-center min-w-[150px] text-left">
                                        @if ($project->user && $project->user->profile_image)
                                            <img src="{{ asset($project->user->profile_image) }}"
                                                class="w-8 h-8 rounded-full object-cover border-2 border-white shadow-sm shrink-0">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-blue-50 border border-blue-100/50 text-[#5EBEE6] flex items-center justify-center shrink-0 text-[10px]">
                                                <i class="fa-solid fa-user-gear"></i>
                                            </div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <p class="font-bold text-slate-700 truncate">
                                                {{ $project->user ? $project->user->first_name . ' ' . $project->user->last_name : 'Admin System' }}
                                            </p>
                                            <p class="text-[9px] text-slate-400 font-medium">ผู้สร้างโปรเจกต์</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- วันที่สร้าง --}}
                                <td class="px-6 py-4 text-center text-slate-400 text-[11px] whitespace-nowrap">
                                    <span class="font-bold text-slate-600"><i class="fa-regular fa-calendar text-[10px] mr-0.5"></i> {{ $project->created_at->format('d/m/Y') }}</span><br>
                                    <span class="text-[9px] font-medium opacity-70">{{ $project->created_at->format('H:i') }} น.</span>
                                </td>

                                {{-- ป้ายแสดงผลสถานะ --}}
                                <td class="px-6 py-4 text-center">
                                    @if ($project->status == 'approved')
                                        <span class="inline-flex items-center gap-1 bg-emerald-50 border border-emerald-100 text-emerald-500 px-2.5 py-1 rounded-lg font-bold text-[10px] tracking-wide">
                                            <i class="fa-solid fa-circle-check text-[9px]"></i> อนุมัติแล้ว
                                        </span>
                                    @elseif($project->status == 'rejected')
                                        <span class="inline-flex items-center gap-1 bg-rose-50 border border-rose-100 text-rose-500 px-2.5 py-1 rounded-lg font-bold text-[10px] tracking-wide">
                                            <i class="fa-solid fa-circle-xmark text-[9px]"></i> ถูกปฏิเสธ
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-orange-50 border border-orange-100 text-orange-500 px-2.5 py-1 rounded-lg font-bold text-[10px] tracking-wide">
                                            <span class="w-1 h-1 rounded-full bg-orange-500 animate-pulse"></span> รอการพิจารณา
                                        </span>
                                    @endif
                                </td>

                                {{-- 🛠️ บล็อกปุ่มแก้ไข/ลบคำสั่งงาน (แสดงผลถาวร ไม่ต้องรอ Hover) 🛠️ --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('backend.projects.edit', $project->id) }}"
                                            class="w-7 h-7 rounded-lg bg-slate-50 text-orange-400 flex items-center justify-center hover:bg-orange-400 hover:text-white border border-slate-100 shadow-sm transition-all"
                                            title="แก้ไขข้อมูล">
                                            <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                                        </a>
                                        <form action="{{ route('backend.projects.destroy', $project->id) }}" method="POST"
                                            class="inline-flex"
                                            data-confirm="คุณต้องการดำเนินการยืนยันคำสั่งเพื่อลบโครงงานวิชา [ {{ $project->name }} ] ออกจากคลังระบบถาวรใช่หรือไม่?" data-confirm-title="ยืนยันการลบโครงงาน">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-7 h-7 rounded-lg bg-slate-50 text-rose-500 flex items-center justify-center hover:bg-rose-500 hover:text-white border border-slate-100 shadow-sm transition-all"
                                                title="ลบข้อมูล">
                                                <i class="fa-regular fa-trash-can text-[11px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-14 h-14 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-3">
                                            <i class="fa-solid fa-box-open text-2xl text-slate-300"></i>
                                        </div>
                                        <h4 class="text-sm font-bold text-slate-700 mb-0.5">ไม่พบข้อมูลรายชื่อวิชาโครงงาน</h4>
                                        <p class="text-xs text-slate-400 font-medium">ไม่มีโครงงานที่ตรงกับเงื่อนไขการค้นหาในสถิติขณะนี้</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- หมายเลขแบ่งหน้าข้อมูล --}}
            @if ($projects->hasPages())
                <div class="px-6 py-4 border-t border-slate-50 bg-white">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>

    </section>
@endsection