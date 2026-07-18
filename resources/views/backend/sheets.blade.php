@extends('backend.layout')
@section('content')
    <section class="w-full h-full p-4 md:p-8 font-mitr bg-slate-50/50">
        
        {{-- 🔝 1. ส่วนหัวข้อการจัดการชีทสรุป (Header Section) --}}
        <div class="mb-8 border-b border-slate-100 pb-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">จัดการชีทสรุปเนื้อหา</h2>
                </div>
                <p class="text-xs md:text-sm text-slate-400 font-medium mt-1">ตรวจสอบความถูกต้อง คัดกรองเนื้อหา และอนุมัติไฟล์ชีทสรุปวิชาเรียนจากสมาชิกเข้าสู่ระบบ</p>
            </div>
        </div>

        {{-- 📋 2. ตารางแสดงผลรายการชีทสรุปคิวหลังบ้าน (Data Table Control Container) --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] overflow-hidden">
            <table class="w-full text-left border-collapse min-w-[850px]">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-400 text-[10px] font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="px-4 py-4 w-20 text-center">ID</th>
                        <th class="px-4 py-4 w-72">หัวข้อ / วิชาเรียน</th>
                        <th class="px-4 py-4 w-44">ระดับชั้น / ภาคเรียน</th>
                        <th class="px-4 py-4 w-48">ผู้จัดส่งข้อมูล</th>
                        <th class="px-4 py-4 text-center w-32">ประเภทสื่อ</th>
                        <th class="px-4 py-4 text-center w-36">สถานะคิว</th>
                        <th class="px-4 py-4 text-center w-24">การจัดการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-xs font-medium text-slate-600">
                    @forelse($sheets as $sheet)
                    <tr class="hover:bg-slate-50/40 transition-colors group">
                        {{-- ไอดีเอกสาร --}}
                        <td class="px-4 py-3.5 text-slate-400 font-bold text-center shadow-inner bg-slate-50/20">#{{ $sheet->id }}</td>
                        
                        {{-- หัวข้อเอกสาร --}}
                        <td class="px-4 py-3.5">
                            <div class="font-bold text-slate-800 text-sm line-clamp-1 group-hover:text-[#5EBEE6] transition-colors leading-tight">{{ $sheet->sheet_name }}</div>
                            <div class="text-[10px] text-[#5EBEE6] font-bold uppercase mt-1 inline-block bg-blue-50 border border-blue-100/30 px-2 py-0.5 rounded">วิชา: {{ $sheet->subject }}</div>
                        </td>
                        
                        {{-- ระดับชั้น --}}
                        <td class="px-4 py-3.5">
                            <p class="font-bold text-slate-700">{{ $sheet->level }}</p>
                            <span class="text-[10px] text-slate-400 font-semibold mt-0.5 inline-block">{{ $sheet->term }}</span>
                        </td>
                        
                        {{-- ผู้ส่ง --}}
                        <td class="px-4 py-3.5 text-slate-700 font-bold">
                            <i class="fa-regular fa-user text-[10px] text-slate-400 mr-1"></i> {{ $sheet->first_name }} {{ $sheet->last_name }}
                        </td>
                        
                        {{-- ประเภทสื่อเรียนรู้ --}}
                        <td class="px-4 py-3.5 text-center">
                            @if($sheet->type == 'file')
                                <a href="{{ asset($sheet->file_path) }}" target="_blank" class="inline-flex items-center gap-1.5 bg-blue-50 border border-blue-100/50 text-[#5EBEE6] px-2.5 py-1.5 rounded-xl text-[10px] font-bold shadow-sm transition-all hover:bg-[#5EBEE6] hover:text-white">
                                    <i class="fa-solid fa-file-pdf"></i> PDF FILE
                                </a>
                            @else
                                <a href="{{ $sheet->file_path }}" target="_blank" class="inline-flex items-center gap-1.5 bg-purple-50 border border-purple-100/50 text-purple-500 px-2.5 py-1.5 rounded-xl text-[10px] font-bold shadow-sm transition-all hover:bg-purple-500 hover:text-white">
                                    <i class="fa-solid fa-link"></i> URL LINK
                                </a>
                            @endif
                        </td>
                        
                        {{-- ดรอปดาวน์สถานะตรวจสอบ --}}
                        <td class="px-4 py-3.5 text-center">
                            <form action="{{ route('backend.sheets.updateStatus', $sheet->id) }}" method="POST" id="form-status-{{ $sheet->id }}" class="inline-block shadow-sm rounded-xl overflow-hidden">
                                @csrf @method('PATCH')
                                <select name="status" onchange="document.getElementById('form-status-{{ $sheet->id }}').submit()"
                                    class="appearance-none text-[11px] font-bold border border-slate-100/50 rounded-xl px-4 py-2 cursor-pointer focus:ring-4 focus:ring-[#5EBEE6]/10 outline-none transition-all pr-8 relative text-center
                                    {{ $sheet->status == 'approved' ? 'bg-emerald-50 text-emerald-500 border-emerald-100' : ($sheet->status == 'rejected' ? 'bg-rose-50 text-rose-500 border-rose-100' : 'bg-orange-50 text-orange-500 border-orange-100') }}">
                                    <option value="pending" {{ $sheet->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                                    <option value="approved" {{ $sheet->status == 'approved' ? 'selected' : '' }}>APPROVED</option>
                                    <option value="rejected" {{ $sheet->status == 'rejected' ? 'selected' : '' }}>REJECTED</option>
                                </select>
                            </form>
                        </td>
                        
                        {{-- 🛠️ ปุ่มลบคำสั่งงาน (แสดงเด่นชัดถาวร ไม่ต้องรอ Hover) 🛠️ --}}
                        <td class="px-4 py-3.5 text-center">
                            <form action="{{ route('backend.sheets.destroy', $sheet->id) }}" method="POST" onsubmit="return confirm('⚠️ ยืนยันประสงค์ต้องการทำการลบข้อมูลไฟล์ชีทวิชานี้ออกจากคลังระบบถาวรใช่หรือไม่?')" class="inline-flex">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-7 h-7 rounded-lg bg-slate-50 text-slate-400 hover:bg-rose-500 hover:text-white border border-slate-100 shadow-sm transition-all flex items-center justify-center">
                                    <i class="fa-solid fa-trash-can text-[11px]"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    
                    {{-- ❌ 3. กรณีตารางว่างเปล่า ไม่มีข้อมูลคำร้องแสดงผล ❌ --}}
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center text-slate-400 font-medium">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-14 h-14 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-3">
                                    <i class="fa-solid fa-file-circle-exclamation text-2xl text-slate-300"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700 mb-0.5">ไม่พบข้อมูลคำร้องรายการชีท</h4>
                                <p class="text-xs text-slate-400 font-medium">คลังข้อมูลระบบหลังบ้านยังไม่มีรายการชีทสรุปใดๆ ส่งคำขอเข้ามาในขณะนี้</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{-- ชุดปุ่มลิงก์แบ่งหน้าข้อมูล --}}
            @if(isset($sheets) && method_exists($sheets, 'links') && $sheets->hasPages())
            <div class="px-6 py-4 border-t border-slate-50 bg-white">
                {{ $sheets->links() }}
            </div>
            @endif
        </div>
    </section>
@endsection