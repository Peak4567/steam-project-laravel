@extends('backend.layout')
@section('content')

<section class="w-full h-full p-4 md:p-8 font-mitr bg-slate-50/50">

    {{-- 🔝 1. ส่วนหัวแดชบอร์ดหลัก & แผงสั่งการด่วน (Dashboard Header & Quick Actions) --}}
    <div class="mb-8 flex flex-col xl:flex-row xl:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">ระบบควบคุมส่วนกลาง (Admin Dashboard)</h2>
            </div>
            <p class="text-xs md:text-sm text-slate-400 font-medium mt-1">มอนิเตอร์วิเคราะห์ข้อมูล อนุมัติสื่อการเรียนรู้ และตรวจสอบความปลอดภัยของระบบ Steam Portfolio</p>
        </div>
        
        <div class="flex flex-wrap items-center gap-3">
            <div class="text-xs font-bold text-slate-500 bg-white px-4 py-3 rounded-xl border border-slate-100 shadow-sm flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> 
                อัปเดตล่าสุด: {{ date('d/m/Y H:i') }} น.
            </div>
            <button class="bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs px-4 py-3 rounded-xl shadow-md transition-all active:scale-95 flex items-center gap-1.5">
                <i class="fa-solid fa-file-export text-[10px]"></i> ส่งออกรายงานระบบ (.CSV)
            </button>
        </div>
    </div>

    {{-- 📊 2. แผงกล่องข้อมูลสถิติภาพรวมเชิงลึก (Stats Overview Grid) --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        {{-- ผู้ใช้งานทั้งหมด --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:-translate-y-0.5 transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#5EBEE6] flex items-center justify-center text-xl shrink-0 border border-blue-100/30">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">ผู้ใช้งานทั้งหมด</p>
                <h3 class="text-xl font-black text-slate-800 leading-tight">{{ number_format($stats['total_users']) }} <span class="text-[10px] text-slate-400 font-medium">คน</span></h3>
                <span class="text-[9px] font-bold text-emerald-500 flex items-center gap-0.5 mt-1"><i class="fa-solid fa-caret-up"></i> +12% สัปดาห์นี้</span>
            </div>
        </div>

        {{-- ผลงานทั้งหมด --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:-translate-y-0.5 transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center text-xl shrink-0 border border-indigo-100/30">
                <i class="fa-solidxl fa-solid fa-folder-tree"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">คลังผลงานรวม</p>
                <h3 class="text-xl font-black text-slate-800 leading-tight">{{ number_format($stats['total_portfolios']) }} <span class="text-[10px] text-slate-400 font-medium">เล่ม</span></h3>
                <span class="text-[9px] font-bold text-emerald-500 flex items-center gap-0.5 mt-1"><i class="fa-solid fa-caret-up"></i> +4.8% ยื่นพอร์ต</span>
            </div>
        </div>

        {{-- รอพิจารณาอนุมัติ --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden">
            @if ($stats['pending_approvals'] > 0)
                <div class="absolute left-0 top-0 w-1 h-full bg-orange-400"></div>
            @endif
            <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center text-xl shrink-0 border border-orange-100/30">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">คำร้องรอพิจารณา</p>
                <h3 class="text-xl font-black text-slate-800 leading-tight">{{ number_format($stats['pending_approvals']) }} <span class="text-[10px] text-slate-400 font-medium">รายการ</span></h3>
                <span class="text-[9px] font-bold text-orange-500 flex items-center gap-0.5 mt-1"><i class="fa-solid fa-circle-exclamation animate-pulse"></i> จำเป็นต้องตรวจสอบ</span>
            </div>
        </div>

        {{-- ยอดเข้าชมรวม --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4 hover:-translate-y-0.5 transition-all duration-300">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl shrink-0 border border-emerald-100/30">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Traffic ยอดวิวรวม</p>
                <h3 class="text-xl font-black text-slate-800 leading-tight">{{ number_format($stats['total_views']) }} <span class="text-[10px] text-slate-400 font-medium">ครั้ง</span></h3>
                <span class="text-[9px] font-bold text-blue-500 flex items-center gap-0.5 mt-1"><i class="fa-solid fa-bolt"></i> เซิร์ฟเวอร์ทำงานปกติ</span>
            </div>
        </div>
    </div>

    {{-- 🧱 3. ส่วนแบ่งสัดส่วนคิวตรวจสอบงานหลัก และ แถบข้อมูลระบบเชิงลึก (Main Content 12 Columns Grid) 🧱 --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        {{-- 📋 ฝั่งซ้าย: ตารางคำร้องรอการอนุมัติล่าสุด (lg:col-span-8) 📋 --}}
        <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-50 flex flex-col sm:flex-row justify-between sm:items-center gap-4 bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center border border-orange-100/30">
                        <i class="fa-solid fa-bell text-xs"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-800 tracking-tight">คำร้องสื่อสารเรียนรู้ที่รอการตรวจสอบล่าสุด</h3>
                        <p class="text-[10px] text-slate-400 font-medium">โปรดกดอ่านรายละเอียด ตรวจลิขสิทธิ์ และความปลอดภัยก่อนอนุมัติ</p>
                    </div>
                </div>
                <a href="#" class="text-xs font-bold text-[#5EBEE6] hover:text-[#4fb1d8] transition-colors flex items-center gap-1">
                    เข้าสู่ระบบคิวทั้งหมด <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[650px]">
                    <thead>
                        <tr class="bg-slate-50/70 border-b border-slate-100 text-slate-400 text-[10px] font-bold uppercase tracking-wider">
                            <th class="px-6 py-3.5 w-48">ผู้รับผิดชอบ/ผู้จัดทำ</th>
                            <th class="px-6 py-3.5 w-36">หมวดหมู่/วิชา</th>
                            <th class="px-6 py-3.5">เป้าหมาย/สถาบัน</th>
                            <th class="px-6 py-3.5 text-center w-28">สถานะการส่ง</th>
                            <th class="px-6 py-3.5 text-right w-36">การสั่งการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs text-slate-600 font-medium divide-y divide-slate-50">

                        @forelse($recentPending as $portfolio)
                            <tr class="hover:bg-slate-50/40 transition-colors group">
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-3">
                                        @if ($portfolio->user && $portfolio->user->profile_image)
                                            <img src="{{ asset($portfolio->user->profile_image) }}" class="w-8 h-8 rounded-full object-cover border border-slate-100 shadow-sm shrink-0">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-blue-50 text-[#5EBEE6] flex items-center justify-center border border-blue-100/50 shrink-0 text-[10px]">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <p class="font-bold text-slate-800 truncate">{{ $portfolio->first_name }} {{ $portfolio->last_name }}</p>
                                            <p class="text-[9px] text-slate-400 font-medium mt-0.5">UID: #{{ $portfolio->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-3.5">
                                    <div class="space-y-0.5">
                                        <span class="inline-block px-2 py-0.5 bg-indigo-50 border border-indigo-100/50 text-indigo-500 rounded text-[9px] font-bold uppercase tracking-wide">Portfolio</span>
                                        <p class="text-[10px] text-slate-400 font-medium truncate">อัปเดตระบบแล้ว</p>
                                    </div>
                                </td>
                                <td class="px-6 py-3.5">
                                    <span class="text-[10px] bg-slate-50 border border-slate-100 text-slate-500 px-2 py-1 rounded-md line-clamp-1 max-w-[180px] font-bold" title="{{ $portfolio->university }}">
                                        {{ $portfolio->university }}
                                    </span>
                                </td>
                                <td class="px-6 py-3.5 text-gray-400 text-[10px] text-center whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 bg-orange-50 border border-orange-100/70 text-orange-500 px-2 py-1 rounded-md font-bold">
                                        <span class="w-1 h-1 rounded-full bg-orange-500 animate-ping"></span> ตรวจสอบลิขสิทธิ์
                                    </span>
                                </td>
                                <td class="px-6 py-3.5 text-right">
                                    <div class="flex items-center justify-end gap-1.5 opacity-100 lg:opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('portfolio.show', $portfolio->id) }}" target="_blank"
                                            class="w-7 h-7 rounded-lg bg-slate-50 text-slate-500 hover:bg-[#5EBEE6] hover:text-white border border-slate-100 flex items-center justify-center text-[11px] shadow-sm transition-all"
                                            title="เปิดดูไฟล์">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <button class="w-7 h-7 rounded-lg bg-emerald-50 border border-emerald-100/50 text-emerald-500 hover:bg-emerald-500 hover:text-white flex items-center justify-center text-[11px] shadow-sm transition-all"
                                            title="อนุมัติเผยแพร่">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 border border-rose-100/50 text-rose-500 hover:bg-rose-500 hover:text-white flex items-center justify-center text-[11px] shadow-sm transition-all"
                                            title="ปฏิเสธคำขอ">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-14 h-14 bg-emerald-50 border border-emerald-100/50 text-emerald-500 rounded-full flex items-center justify-center mb-3">
                                            <i class="fa-solid fa-check text-2xl shadow-inner"></i>
                                        </div>
                                        <h4 class="text-sm font-bold text-slate-700">ไม่มีผลงานค้างในคิวระบบ</h4>
                                        <p class="text-xs text-slate-400 font-medium mt-0.5">เรียบร้อยดี! คุณเคลียร์คำร้องในพอร์ตหลังบ้านหมดแล้ว</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

        {{-- 🗃️ ฝั่งขวา: รายละเอียด Insights แหล่งเก็บข้อมูล & ความปลอดภัยระบบ (lg:col-span-4) 🗃️ --}}
        <div class="lg:col-span-4 space-y-6 w-full">
            
            {{-- วิดเจ็ตสถิติคลัง Server Storage --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-50 pb-2.5">
                    <i class="fa-solid fa-server text-[#5EBEE6] text-xs"></i>
                    <h4 class="font-extrabold text-slate-800 text-xs uppercase tracking-wider">เซิร์ฟเวอร์คลังข้อมูล (Storage)</h4>
                </div>
                <div class="space-y-3 pt-1">
                    <div class="flex justify-between text-[11px] font-bold">
                        <span class="text-slate-500">ความจุไฟล์ PDF/เล่มโครงงาน</span>
                        <span class="text-slate-700">42.8 GB / 100 GB</span>
                    </div>
                    <div class="w-full h-2 bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                        <div class="w-[42.8%] h-full bg-gradient-to-r from-[#5EBEE6] to-blue-500 rounded-full"></div>
                    </div>
                    <div class="flex justify-between items-center text-[10px] text-slate-400 font-medium">
                        <p><i class="fa-regular fa-file-pdf"></i> รวมคลังชีทสรุป: 1.4k ไฟล์</p>
                        <p class="font-bold text-emerald-500"><i class="fa-solid fa-circle-check"></i> ปลอดภัยดี</p>
                    </div>
                </div>
            </div>

            {{-- วิดเจ็ตประวัติ Log ความปลอดภัยของแอดมิน --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-50 pb-2.5">
                    <i class="fa-solid fa-shield-halved text-amber-500 text-xs"></i>
                    <h4 class="font-extrabold text-slate-800 text-xs uppercase tracking-wider">ระบบความปลอดภัย Log หลังบ้าน</h4>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-start gap-3 bg-slate-50/50 p-2 rounded-xl border border-slate-100/50">
                        <div class="w-2 h-2 rounded-full bg-blue-400 mt-1.5 shrink-0"></div>
                        <div class="text-[11px]">
                            <p class="font-bold text-slate-700">แอดมิน Peak เข้าสู่ระบบควบคุม</p>
                            <p class="text-slate-400 font-medium text-[10px] mt-0.5">IP: 192.168.1.42 • เมื่อ 5 นาทีที่แล้ว</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 bg-slate-50/50 p-2 rounded-xl border border-slate-100/50">
                        <div class="w-2 h-2 rounded-full bg-emerald-400 mt-1.5 shrink-0"></div>
                        <div class="text-[11px]">
                            <p class="font-bold text-slate-700">อนุมัติสำเร็จ เล่มโครงงาน #84</p>
                            <p class="text-slate-400 font-medium text-[10px] mt-0.5">โดยผู้ตรวจสอบคุณครูคอมพิวเตอร์ • เมื่อ 1 ชม. ก่อน</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>

@endsection