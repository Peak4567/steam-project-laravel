@extends('backend.layout')
@section('content')
    <section class="w-full h-full p-4 md:p-8 font-mitr bg-slate-50/50">

        {{-- 🔝 1. ส่วนหัวข้อการจัดการกิจกรรม (Header Section) --}}
        <div class="mb-8 border-b border-slate-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">ระบบจัดการกิจกรรม / Workshop</h2>
                </div>
                <p class="text-xs md:text-sm text-slate-400 font-medium mt-1">สร้าง แก้ไข ตรวจสอบรายชื่อนักเรียนที่ลงทะเบียน และบริหารจัดการรายการกิจกรรม Workshop ทั้งหมด</p>
            </div>
            
            <a href="{{ route('backend.activity.create') }}"
                class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl text-xs font-bold transition-all shadow-md active:scale-95 flex items-center justify-center gap-2 w-full sm:w-auto shrink-0">
                <i class="fa-solid fa-plus text-[10px]"></i> เพิ่มกิจกรรม Workshop ใหม่
            </a>
        </div>

        {{-- 📋 2. ตารางแสดงผลรายการกิจกรรมคิวหลังบ้าน (Data Table Control Container) --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[850px]">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-400 text-[10px] font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="px-6 py-4 w-96">ข้อมูลหัวข้อรายละเอียดกิจกรรม</th>
                            <th class="px-6 py-4 text-center w-36">วันที่และเวลาจัด</th>
                            <th class="px-6 py-4 text-center w-48">สถานที่จัดกิจกรรม</th>
                            <th class="px-6 py-4 text-center w-36">สัดส่วนที่นั่ง/จำนวนรับ</th>
                            <th class="px-6 py-4 text-right w-36">การสั่งการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs text-slate-600 font-medium divide-y divide-slate-50">
                        @forelse($activities as $activity)
                            <tr class="hover:bg-slate-50/40 transition-colors group">
                                {{-- ข้อมูลกิจกรรมและรูปปก --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        @if ($activity->image_path)
                                            <img src="{{ asset($activity->image_path) }}"
                                                class="w-14 h-10 object-cover rounded-xl border border-slate-100 shadow-sm shrink-0">
                                        @else
                                            <div class="w-14 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-300 border border-slate-100 shrink-0 shadow-inner">
                                                <i class="fa-regular fa-image text-lg"></i>
                                            </div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <p class="font-bold text-slate-800 text-sm line-clamp-1 group-hover:text-[#5EBEE6] transition-colors leading-tight">{{ $activity->title }}</p>
                                            <p class="text-[10px] text-[#5EBEE6] font-bold mt-1.5 bg-blue-50 border border-blue-100/30 px-2 py-0.5 rounded inline-block uppercase tracking-wide">
                                                {{ $activity->category ?? 'ทั่วไป' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- วันที่จัดงาน --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap text-[11px]">
                                    <p class="font-bold text-slate-700">
                                        <i class="fa-regular fa-calendar text-[10px] text-slate-400 mr-0.5"></i> {{ date('d/m/Y', strtotime($activity->date)) }}
                                    </p>
                                    <p class="text-[10px] text-slate-400 font-semibold mt-1 bg-slate-50 px-1.5 py-0.5 rounded inline-block">{{ $activity->time_range }} น.</p>
                                </td>
                                
                                {{-- สถานที่ --}}
                                <td class="px-6 py-4 text-center">
                                    <span class="text-[11px] font-bold text-slate-600 bg-slate-50 border border-slate-100 px-3 py-1.5 rounded-xl inline-block max-w-[160px] truncate" title="{{ $activity->location }}">
                                        <i class="fa-solid fa-location-dot text-[10px] text-slate-400 mr-1"></i> {{ $activity->location }}
                                    </span>
                                </td>
                                
                                {{-- จำนวนคนสมัคร --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <span class="text-xs font-bold text-[#5EBEE6] bg-blue-50/50 border border-blue-100/40 px-3 py-1.5 rounded-xl inline-block">
                                        <i class="fa-solid fa-user-group text-[10px] mr-1.5 text-sky-400"></i> {{ $activity->current_participants }} / {{ $activity->max_participants }} <span class="text-[10px] font-medium text-slate-400 ml-0.5">คน</span>
                                    </span>
                                </td>
                                
                                {{-- 🛠️ แถบควบคุมคำสั่ง (แสดงเด่นชัดถาวร ไม่ต้องรอ Hover) 🛠️ --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('backend.activity.participants', $activity->id) }}" 
                                            title="ดูรายชื่อและตรวจสอบผู้สมัคร"
                                            class="w-7 h-7 rounded-lg bg-slate-50 text-blue-500 hover:bg-[#5EBEE6] hover:text-white border border-slate-100 flex items-center justify-center text-[11px] shadow-sm transition-all">
                                            <i class="fa-solid fa-users"></i>
                                        </a>

                                        <form action="{{ route('backend.activity.destroy', $activity->id) }}" method="POST"
                                            data-confirm="คุณต้องการดำเนินการยืนยันคำสั่งเพื่อลบกิจกรรม Workshop [ {{ $activity->title }} ] ออกจากคลังระบบถาวรใช่หรือไม่?" data-confirm-title="ยืนยันการลบกิจกรรม" class="inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="ลบกิจกรรม"
                                                class="w-7 h-7 rounded-lg bg-slate-50 text-rose-500 hover:bg-rose-500 hover:text-white border border-slate-100 flex items-center justify-center text-[11px] shadow-sm transition-all">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-slate-400 font-medium">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-14 h-14 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-3">
                                            <i class="fa-regular fa-calendar-xmark text-2xl text-slate-300"></i>
                                        </div>
                                        <h4 class="text-sm font-bold text-slate-700 mb-0.5">ไม่พบข้อมูลรายการกิจกรรม</h4>
                                        <p class="text-xs text-slate-400 font-medium">คลังหลังบ้านยังไม่มีการบันทึกกิจกรรม Workshop ใดๆ ในขณะนี้</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- หมายเลขแบ่งหน้าข้อมูล (Pagination) --}}
        @if ($activities->hasPages())
            <div class="mt-6">
                {{ $activities->links() }}
            </div>
        @endif
    </section>
@endsection