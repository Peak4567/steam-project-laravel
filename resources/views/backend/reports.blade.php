@extends('backend.layout')
@section('content')
    <section class="w-full h-full p-4 md:p-8 font-mitr bg-slate-50/50">

        {{-- 🔝 1. ส่วนหัวข้อการจัดการเล่มรายงาน (Header Section) --}}
        <div class="mb-8 border-b border-slate-100 pb-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">ระบบจัดการเล่มรายงานโครงงาน</h2>
                </div>
                <p class="text-xs md:text-sm text-slate-400 font-medium mt-1">ตรวจสอบความถูกต้อง ป้องกันการละเมิดสิทธิ์ และอนุมัติเล่มรายงานสรุปโครงงานวิชาสตรีมเข้าสู่หน้าเว็บไซต์หลัก</p>
            </div>
        </div>

        {{-- 🔍 2. ส่วนช่องค้นหาและคัดกรองสถานะเล่มโครงงาน (Advanced Filter Control) --}}
        <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.01)] mb-6">
            <form action="{{ route('backend.reports') }}" method="GET" class="flex flex-col sm:flex-row gap-3.5">
                <div class="flex-grow relative shadow-sm rounded-xl">
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-[#5EBEE6]"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหาด้วยชื่อเล่มโครงงาน หรือกลุ่มสาระวิชาเรียน..."
                        class="w-full pl-11 pr-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                </div>

                <div class="relative min-w-[160px] shadow-sm rounded-xl">
                    <select name="status"
                        class="appearance-none w-full py-3 pl-4 pr-10 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-bold text-slate-600 outline-none focus:bg-white focus:border-[#5EBEE6] cursor-pointer transition-all"
                        onchange="this.form.submit()">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>ทุกสถานะการตรวจสอบ</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ รอพิจารณา</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>✅ อนุมัติแล้ว</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>❌ ถูกปฏิเสธ</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </div>
                </div>

                <button type="submit"
                    class="bg-gradient-to-r from-[#5EBEE6] to-[#3B9ADE] hover:opacity-95 text-white px-8 py-3 rounded-xl text-xs font-bold shadow-md shadow-blue-500/10 transition-all whitespace-nowrap active:scale-95">
                    ค้นหาข้อมูล
                </button>
            </form>
        </div>

        {{-- 📋 3. ตารางแสดงผลรายการเล่มรายงานคิวหลังบ้าน (Data Table Control Container) --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[850px]">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-400 text-[10px] font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="px-6 py-4 w-96">เล่มรายงานสรุป / วิชา</th>
                            <th class="px-6 py-4 text-center w-48">คุณครูอาจารย์ที่ปรึกษา</th>
                            <th class="px-6 py-4 text-center w-40">ไฟล์เอกสารคลัง</th>
                            <th class="px-6 py-4 text-center w-36">สถานะคิว</th>
                            <th class="px-6 py-4 text-right w-44">การสั่งการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs text-slate-600 font-medium divide-y divide-slate-50">

                        @forelse($reports as $report)
                            <tr class="hover:bg-slate-50/40 transition-colors group">
                                {{-- รายละเอียดเล่มและวิชา --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        @if($report->cover_image)
                                            <img src="{{ asset($report->cover_image) }}" class="w-10 h-14 object-cover rounded-xl border border-slate-100 shadow-sm shrink-0">
                                        @else
                                            <div class="w-10 h-14 bg-gradient-to-br from-slate-50 to-slate-100/50 rounded-xl flex flex-col items-center justify-center text-slate-300 border border-slate-100 shrink-0 shadow-inner">
                                                <i class="fa-solid fa-file-pdf text-lg text-rose-400"></i>
                                            </div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <p class="font-bold text-slate-800 text-sm line-clamp-1 group-hover:text-[#5EBEE6] transition-colors">{{ $report->project_name }}</p>
                                            <p class="text-[10px] text-[#5EBEE6] font-bold mt-0.5 bg-blue-50 border border-blue-100/30 px-2 py-0.5 rounded inline-block">วิชา: {{ $report->subject }}</p>
                                            <p class="text-[9px] text-slate-400 font-medium mt-1.5 flex items-center gap-1"><i class="fa-regular fa-calendar-check text-[10px]"></i> วันที่นำส่ง: {{ $report->created_at->format('d/m/Y H:i') }} น.</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- คุณครูที่ปรึกษา --}}
                                <td class="px-6 py-4 text-center">
                                    <p class="text-xs font-bold text-slate-700 bg-slate-50 border border-slate-100 px-3 py-1.5 rounded-xl inline-block">Aj. {{ $report->advisor }}</p>
                                </td>

                                {{-- ลิงก์เช็คไฟล์ --}}
                                <td class="px-6 py-4 text-center">
                                    @foreach ($report->file_path ?? [] as $reportIndex => $reportFile)
                                        <a href="{{ asset($reportFile) }}" target="_blank"
                                           class="inline-flex items-center gap-1.5 bg-blue-50/50 border border-blue-100/50 text-[#5EBEE6] hover:bg-[#5EBEE6] hover:text-white px-3 py-1.5 rounded-xl font-bold text-[11px] shadow-sm transition-all mb-1">
                                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> ไฟล์ {{ $reportIndex + 1 }}
                                        </a>
                                    @endforeach
                                </td>

                                {{-- ป้ายแสดงสถานะอนุมัติ --}}
                                <td class="px-6 py-4 text-center">
                                    @if ($report->status == 'approved')
                                        <span class="inline-flex items-center gap-1 bg-emerald-50 border border-emerald-100 text-emerald-500 px-2.5 py-1 rounded-lg font-bold text-[10px] tracking-wide">
                                            <i class="fa-solid fa-circle-check text-[9px]"></i> อนุมัติแล้ว
                                        </span>
                                    @elseif($report->status == 'rejected')
                                        <span class="inline-flex items-center gap-1 bg-rose-50 border border-rose-100 text-rose-500 px-2.5 py-1 rounded-lg font-bold text-[10px] tracking-wide">
                                            <i class="fa-solid fa-circle-xmark text-[9px]"></i> ถูกปฏิเสธ
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-orange-50 border border-orange-100 text-orange-500 px-2.5 py-1 rounded-lg font-bold text-[10px] tracking-wide">
                                            <span class="w-1 h-1 rounded-full bg-orange-500 animate-pulse"></span> รอตรวจสอบ
                                        </span>
                                    @endif
                                </td>

                                {{-- 🛠️ แถบควบคุมคำสั่ง (แสดงเด่นชัดถาวร ไม่ซ่อน) 🛠️ --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <form action="{{ route('backend.reports.update-status', $report->id) }}" method="POST" class="inline-flex gap-1.5">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="status" value="approved" title="ยืนยันการอนุมัติเผยแพร่เล่มโครงงาน"
                                                class="w-7 h-7 rounded-lg bg-slate-50 text-emerald-500 flex items-center justify-center hover:bg-emerald-500 hover:text-white border border-slate-100 shadow-sm transition-all">
                                                <i class="fa-solid fa-check text-[11px]"></i>
                                            </button>
                                            <button type="submit" name="status" value="rejected" title="ปฏิเสธคำขอรายงาน"
                                                class="w-7 h-7 rounded-lg bg-slate-50 text-rose-500 flex items-center justify-center hover:bg-rose-500 hover:text-white border border-slate-100 shadow-sm transition-all">
                                                <i class="fa-solid fa-xmark text-[11px]"></i>
                                            </button>
                                        </form>

                                        <div class="w-px h-5 bg-slate-100 mx-1"></div>

                                        <form action="{{ route('backend.reports.destroy', $report->id) }}" method="POST"
                                            data-confirm="คุณต้องการยืนยันคำสั่งเพื่อลบเล่มรายงานโครงงานชิ้นนี้ออกจากระบบถาวรใช่หรือไม่?" data-confirm-title="ยืนยันการลบเล่มรายงาน" class="inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-7 h-7 rounded-lg bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-rose-500 hover:text-white border border-slate-100 shadow-sm transition-all"
                                                title="ลบข้อมูลข้อมูลเล่ม">
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
                                            <i class="fa-solid fa-file-circle-exclamation text-2xl text-slate-300"></i>
                                        </div>
                                        <h4 class="text-sm font-bold text-slate-700 mb-0.5">ไม่พบข้อมูลคำร้องรายงานเล่ม</h4>
                                        <p class="text-xs text-slate-400 font-medium">ยังไม่มีรายการเล่มโครงงานที่ยื่นคิวตรวจสอบในเงื่อนไขนี้</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- หมายเลขลิ้งก์แบ่งหน้า --}}
            @if ($reports->hasPages())
                <div class="px-6 py-4 border-t border-slate-50 bg-white">
                    {{ $reports->links() }}
                </div>
            @endif
        </div>

    </section>
@endsection