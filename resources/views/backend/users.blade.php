@extends('backend.layout')
@section('content')
    <section class="w-full h-full p-4 md:p-8 font-mitr bg-slate-50/50 text-slate-700">
        
        {{-- 🔝 1. ส่วนหัวข้อและแบบฟอร์มค้นหาด่วน (Header & Search Control) --}}
        <div class="mb-8 border-b border-slate-100 pb-4 flex flex-col xl:flex-row xl:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">ระบบบริหารจัดการผู้ใช้งาน</h2>
                </div>
                <p class="text-xs md:text-sm text-slate-400 font-medium mt-1">ตรวจสอบรายชื่อ คัดกรองข้อมูลส่วนตัวนักเรียน บัญชีอีเมล และควบคุมสิทธิ์การเข้าถึงระบบหลังบ้าน</p>
            </div>
            
            {{-- ฟอร์มค้นหาข้อมูลสมาชิกสไตล์คลีน --}}
            <form action="{{ route('backend.users') }}" method="GET" class="w-full xl:w-96 relative shadow-sm rounded-xl">
                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-[#5EBEE6]"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหาด้วยชื่อ, อีเมล หรือรหัสประจำตัว..."
                    class="w-full bg-white border border-slate-100 rounded-xl pl-11 pr-12 py-3 text-xs font-medium outline-none focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 hover:text-[#5EBEE6] transition-colors">
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>
        </div>

        {{-- 📋 2. ตารางแสดงผลรายชื่อผู้ใช้งานระบบ (Data Table Control Container) --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] overflow-hidden">
            <table class="w-full text-left border-collapse min-w-[850px]">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-400 text-[10px] font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="px-4 py-4 w-20 text-center">ID</th>
                        <th class="px-6 py-4 w-80">ข้อมูลสมาชิก / โปรไฟล์</th>
                        <th class="px-6 py-4 w-48">ข้อมูลนักเรียน (Student ID)</th>
                        <th class="px-6 py-4 w-60">บัญชีอีเมล (Email Address)</th>
                        <th class="px-6 py-4 text-center w-32">สิทธิ์ระบบ</th>
                        <th class="px-6 py-4 text-center w-36">การสั่งการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-xs font-medium text-slate-600">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/40 transition-colors group">
                        {{-- ไอดีสมาชิก --}}
                        <td class="px-4 py-4 text-slate-400 font-bold text-center shadow-inner bg-slate-50/20">#{{ $user->id }}</td>
                        
                        {{-- รูปโปรไฟล์และชื่อจริง --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-9 h-9 rounded-xl border-2 border-white shadow-md flex-shrink-0 flex items-center justify-center text-slate-400 overflow-hidden bg-slate-50">
                                    @if($user->profile)
                                        <img src="{{ asset('assets/img/profile/' . $user->profile) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-xs font-black text-[#5EBEE6] bg-blue-50 w-full h-full flex items-center justify-center border border-blue-100/30">{{ substr($user->first_name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div class="overflow-hidden">
                                    <div class="text-sm font-bold text-slate-800 leading-tight truncate group-hover:text-[#5EBEE6] transition-colors">{{ $user->prefix }}{{ $user->first_name }} {{ $user->last_name }}</div>
                                    <div class="text-[10px] text-slate-400 font-bold tracking-wide mt-1"><i class="fa-regular fa-comment-dots text-[9px] mr-0.5 text-slate-300"></i> ชื่อเล่น: <span class="text-slate-600 font-extrabold">{{ $user->nickname ?? '-' }}</span></div>
                                </div>
                            </div>
                        </td>
                        
                        {{-- ข้อมูลสถานะชั้นเรียน --}}
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-700 bg-slate-50 border border-slate-100/70 px-2 py-0.5 rounded-md inline-block">ID: {{ $user->student_id ?? '-' }}</p>
                            <div class="text-[10px] text-slate-400 font-semibold mt-1.5 pl-0.5 flex items-center gap-1"><i class="fa-solid fa-graduation-cap text-[9px]"></i> ระดับชั้น: {{ $user->grade_level ?? 'ไม่ระบุชั้นเรียน' }}</div>
                        </td>
                        
                        {{-- อีเมล --}}
                        <td class="px-6 py-4 text-slate-500 font-semibold truncate" title="{{ $user->email }}">
                            <i class="fa-regular fa-envelope text-[10px] text-slate-400 mr-1.5"></i> {{ $user->email }}
                        </td>
                        
                        {{-- ป้ายสิทธิ์ระบบ (แสดงผลเด่นชัดตลอดเวลา) --}}
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($user->level == 'admin')
                                <span class="inline-flex items-center gap-1 bg-slate-900 border border-slate-800 text-white px-2.5 py-1 rounded-lg font-bold text-[9px] uppercase tracking-wider shadow-sm">
                                    <i class="fa-solid fa-user-shield text-[8px] text-sky-400"></i> {{ $user->level }}
                                </span>
                            @elseif($user->level == 'teacher' || $user->level == 'advisor')
                                <span class="inline-flex items-center gap-1 bg-purple-50 border border-purple-100 text-purple-600 px-2.5 py-1 rounded-lg font-bold text-[9px] uppercase tracking-wider shadow-sm">
                                    <i class="fa-solid fa-user-tie text-[8px]"></i> {{ $user->level }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 bg-slate-50 border border-slate-100 text-slate-500 px-2.5 py-1 rounded-lg font-bold text-[9px] uppercase tracking-wider shadow-inner">
                                    <i class="fa-solid fa-user text-[8px] text-slate-400"></i> {{ $user->level }}
                                </span>
                            @endif
                        </td>
                        
                        {{-- 🛠️ แถบปุ่มควบคุมการจัดการ (แสดงเด่นชัดถาวร ไม่ต้องรอ Hover) 🛠️ --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('backend.users.edit', $user->id) }}" 
                                   class="w-7 h-7 rounded-lg bg-slate-50 text-orange-400 flex items-center justify-center hover:bg-orange-400 hover:text-white border border-slate-100 shadow-sm transition-all"
                                   title="แก้ไขข้อมูลผู้ใช้งาน">
                                    <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                                </a>
                                <form action="{{ route('backend.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('⚠️ ยืนยันประสงค์ต้องการทำการลบสิทธิ์และข้อมูลบัญชีผู้ใช้งานคนนี้ออกจากคลังระบบถาวรใช่หรือไม่?')" class="inline-flex">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="ลบผู้ใช้งานถาวร"
                                            class="w-7 h-7 rounded-lg bg-slate-50 text-rose-500 hover:bg-rose-500 hover:text-white border border-slate-100 shadow-sm transition-all flex items-center justify-center">
                                        <i class="fa-regular fa-trash-can text-[11px]"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    
                    {{-- ❌ 3. กรณีตารางว่างเปล่า ไม่มีข้อมูลผู้ใช้หรือค้นหาไม่เจอรายชื่อ ❌ --}}
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-slate-400 font-medium">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-14 h-14 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-3">
                                    <i class="fa-solid fa-user-slash text-xl text-slate-300"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700 mb-0.5">ไม่พบรายชื่อหรือข้อมูลผู้ใช้งาน</h4>
                                <p class="text-xs text-slate-400 font-medium">ระบบไม่พบบัญชีรายชื่อผู้ใช้ที่ตรงกับเงื่อนไขการค้นหาของคุณในขณะนี้</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{-- ลิงก์แบ่งหน้าข้อมูล (Pagination) --}}
            @if($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-50 bg-white">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </section>
@endsection