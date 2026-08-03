@extends('backend.layout')
@section('content')
    <section class="w-full h-full p-4 md:p-8 font-mitr bg-slate-50/50">
        
        {{-- 🔝 1. ส่วนหัวข้อการจัดการพอร์ตโฟลิโอ (Header Section) --}}
        <div class="mb-8 border-b border-slate-100 pb-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">จัดการแฟ้มสะสมผลงาน</h2>
                </div>
                <p class="text-xs md:text-sm text-slate-400 font-medium mt-1">ตรวจสอบเป้าหมายมหาวิทยาลัย คัดกรองความถูกต้อง และอนุมัติเล่มพอร์ตโฟลิโอ (Portfolio) ของนักเรียนเข้าสู่ระบบคลังหลัก</p>
            </div>
        </div>

        {{-- 📋 2. ตารางแสดงผลรายการพอร์ตโฟลิโอคิวหลังบ้าน (Data Table Control Container) --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] overflow-hidden">
            <table class="w-full text-left border-collapse min-w-[850px]">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-400 text-[10px] font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="px-4 py-4 w-20 text-center">ID</th>
                        <th class="px-4 py-4 w-80">รายละเอียดแฟ้มผลงาน / เป้าหมาย</th>
                        <th class="px-4 py-4 w-52">ผู้จัดส่งข้อมูล</th>
                        <th class="px-4 py-4 text-center w-36">ไฟล์เอกสาร</th>
                        <th class="px-4 py-4 text-center w-36">สถานะคิว</th>
                        <th class="px-4 py-4 text-center w-24">การจัดการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-xs font-medium text-slate-600">
                    @forelse($portfolios as $pf)
                    <tr class="hover:bg-slate-50/40 transition-colors group">
                        {{-- ไอดีเอกสาร --}}
                        <td class="px-4 py-4 text-slate-400 font-bold text-center shadow-inner bg-slate-50/20">#{{ $pf->id }}</td>
                        
                        {{-- รายละเอียดผลงาน --}}
                        <td class="px-4 py-4">
                            <div class="font-bold text-slate-800 text-sm leading-tight">{{ $pf->first_name }} {{ $pf->last_name }}</div>
                            <div class="text-[10px] text-[#5EBEE6] font-bold uppercase mt-1 inline-block bg-blue-50 border border-blue-100/30 px-2 py-0.5 rounded">
                                <i class="fa-solid fa-graduation-cap mr-1.5 text-[9px]"></i>Target: {{ $pf->university ?? 'ไม่ระบุสถาบันเป้าหมาย' }}
                            </div>
                            <div class="text-[10px] text-slate-400 font-medium line-clamp-1 mt-1.5 leading-relaxed" title="{{ $pf->description }}">{{ $pf->description }}</div>
                        </td>
                        
                        {{-- สมาชิกผู้จัดส่ง --}}
                        <td class="px-4 py-4">
                            <p class="font-bold text-slate-700"><i class="fa-regular fa-user text-[10px] text-slate-400 mr-1"></i> {{ $pf->owner_fname }} {{ $pf->owner_lname }}</p>
                            <span class="text-[10px] text-slate-400 font-semibold mt-0.5 inline-block">ชื่อเล่น: {{ $pf->nickname ?? '-' }}</span>
                        </td>
                        
                        {{-- ปุ่มตรวจสอบเปิดดูไฟล์ผลงาน --}}
                        <td class="px-4 py-4 text-center">
                            @php $pfFiles = json_decode($pf->file_path, true) ?? []; @endphp
                            @if(count($pfFiles) > 0)
                                @foreach ($pfFiles as $pfIndex => $pfFile)
                                    <a href="{{ asset($pfFile) }}" target="_blank"
                                       class="inline-flex items-center gap-1.5 bg-slate-900 border border-slate-800 text-white px-3 py-1.5 rounded-xl text-[10px] font-bold shadow-sm transition-all hover:bg-[#5EBEE6] hover:border-[#5EBEE6] active:scale-95 mb-1">
                                       <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i> FILE {{ $pfIndex + 1 }}
                                    </a>
                                @endforeach
                            @else
                                <span class="text-[10px] font-bold text-slate-300 bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-100/70 inline-block italic"><i class="fa-solid fa-circle-minus text-[9px] mr-1"></i> No File</span>
                            @endif
                        </td>
                        
                        {{-- ดรอปดาวน์สถานะตรวจสอบ --}}
                        <td class="px-4 py-4 text-center">
                            <form action="{{ route('backend.portfolios.updateStatus', $pf->id) }}" method="POST" id="form-{{ $pf->id }}" class="inline-block shadow-sm rounded-xl overflow-hidden">
                                @csrf @method('PATCH')
                                <select name="status" onchange="this.form.submit()"
                                    class="appearance-none text-[11px] font-bold border border-slate-100/50 rounded-xl px-4 py-2 cursor-pointer focus:ring-4 focus:ring-[#5EBEE6]/10 outline-none transition-all pr-8 relative text-center
                                    {{ $pf->status == 'approved' ? 'bg-emerald-50 text-emerald-500 border-emerald-100' : ($pf->status == 'rejected' ? 'bg-rose-50 text-rose-500 border-rose-100' : 'bg-orange-50 text-orange-500 border-orange-100') }}">
                                    <option value="pending" {{ $pf->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                                    <option value="approved" {{ $pf->status == 'approved' ? 'selected' : '' }}>APPROVED</option>
                                    <option value="rejected" {{ $pf->status == 'rejected' ? 'selected' : '' }}>REJECTED</option>
                                </select>
                            </form>
                        </td>
                        
                        {{-- 🛠️ ปุ่มลบคำสั่งงาน (แสดงเด่นชัดถาวร ไม่ต้องรอ Hover) 🛠️ --}}
                        <td class="px-4 py-4 text-center">
                            <form action="{{ route('backend.portfolios.destroy', $pf->id) }}" method="POST" data-confirm="ยืนยันประสงค์ต้องการทำการลบข้อมูลแฟ้มผลงานพอร์ตโฟลิโอนี้ออกจากคลังระบบถาวรใช่หรือไม่?" data-confirm-title="ยืนยันการลบผลงาน" class="inline-flex">
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
                        <td colspan="6" class="px-6 py-16 text-center text-slate-400 font-medium">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-14 h-14 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-3">
                                    <i class="fa-solid fa-file-circle-exclamation text-2xl text-slate-300"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700 mb-0.5">ไม่พบข้อมูลแฟ้มสะสมผลงาน</h4>
                                <p class="text-xs text-slate-400 font-medium">คลังข้อมูลระบบหลังบ้านยังไม่มีรายการพอร์ตโฟลิโอใดๆ ส่งคำขอเข้ามาในขณะนี้</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{-- ชุดปุ่มลิงก์แบ่งหน้าข้อมูล --}}
            @if(isset($portfolios) && method_exists($portfolios, 'links') && $portfolios->hasPages())
            <div class="px-6 py-4 border-t border-slate-50 bg-white">
                {{ $portfolios->links() }}
            </div>
            @endif
        </div>
    </section>
@endsection