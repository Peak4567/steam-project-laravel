@extends('profile.profile-layout')
@section('profile-content')

<section class="w-full font-mitr max-w-6xl mx-auto text-slate-700">
    <div class="mb-8 border-b border-slate-100 pb-4 flex flex-col md:flex-row justify-between items-start md:items-end gap-3">
        <div>
            <div class="flex items-center gap-2.5">
                <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                <h2 class="text-xl md:text-2xl font-extrabold text-slate-900 tracking-tight">จัดการแฟ้มผลงาน</h2>
            </div>
            <p class="text-xs text-slate-400 font-medium mt-1">อัปโหลด รวบรวม และเผยแพร่พอร์ตโฟลิโอ (Portfolio) ประวัติกิจกรรมของคุณสู่คลังระบบ</p>
        </div>
    </div>

    <div class="w-full bg-white/80 backdrop-blur-xl rounded-[2rem] p-6 md:p-8 mb-10 flex flex-col md:flex-row items-center justify-between border border-white/60 shadow-[0_8px_30px_rgba(0,0,0,0.03)] gap-6 group">
        <div class="flex items-center gap-5 w-full md:w-auto">
            <div class="w-14 h-14 bg-gradient-to-br from-[#5EBEE6] to-blue-500 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20 shrink-0 group-hover:scale-105 transition-transform duration-500">
                <i class="fa-solid fa-graduation-cap text-white text-2xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">ตามหามหาวิทยาลัยในฝัน</h3>
                <p class="text-slate-500 text-sm font-medium mt-1">กำหนดและบันทึกเป้าหมายคณะรวมถึงมหาลัยที่คุณใฝ่ฝัน พร้อมเครื่องมือช่วยจัดพอร์ต</p>
            </div>
        </div>
        <button class="w-full md:w-auto flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-8 py-3.5 rounded-xl font-semibold text-sm transition-all shadow-md active:scale-95 whitespace-nowrap">
            ดาวน์โหลดคู่มือ <i class="fa-solid fa-download text-xs ml-1"></i>
        </button>
    </div>
    <div class="bg-white p-5 md:p-6 rounded-2xl border border-slate-100 shadow-lg mb-10 max-w-3xl">
        <div class="flex items-center gap-3.5 mb-5 text-[#5EBEE6] border-b border-slate-50 pb-3">
            <div class="w-9 h-9 bg-blue-50 border border-blue-100/50 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-cloud-arrow-up text-base"></i>
            </div>
            <h3 class="text-sm font-extrabold text-slate-900 tracking-tight">ส่งข้อมูลแฟ้มผลงานใหม่</h3>
        </div>

        <form action="{{ route('profile.portfolio.store') }}" method="POST" enctype="multipart/form-data" id="portfolio-upload-form" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-slate-500 pl-0.5">ชื่อจริง (ผู้จัดทำ)</label>
                    <input type="text" name="first_name" placeholder="ป้อนชื่อจริง..." class="w-full bg-slate-50/50 border border-slate-100 text-xs font-medium rounded-xl p-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700" required>
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-slate-500 pl-0.5">นามสกุล</label>
                    <input type="text" name="last_name" placeholder="ป้อนนามสกุล..." class="w-full bg-slate-50/50 border border-slate-100 text-xs font-medium rounded-xl p-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700" required>
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 pl-0.5">คำอธิบายรายละเอียดเกี่ยวกับผลงาน</label>
                <textarea name="description" rows="3" placeholder="ระบุสรุปหัวข้อกิจกรรม รายการผลงาน หรือรางวัลเด่นๆ ที่บันทึกไว้ในเล่ม..." class="w-full bg-slate-50/50 border border-slate-100 text-xs font-medium rounded-xl p-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700 min-h-[70px] resize-none" required></textarea>
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-slate-500 pl-0.5">มหาวิทยาลัย / คณะเป้าหมาย</label>
                <input type="text" name="university" placeholder="ระบุมหาวิทยาลัย หรือหน่วยงานที่ใช้ยื่นผลงาน (เช่น คณะวิศวกรรมศาสตร์ จุฬาฯ)..." class="w-full bg-slate-50/50 border border-slate-100 text-xs font-medium rounded-xl p-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700" required>
            </div>

            <div class="space-y-2 pt-1">
                <label class="block text-xs font-bold text-[#5EBEE6] pl-0.5">
                    <i class="fa-solid fa-file-arrow-up"></i> เลือกไฟล์พอร์ตฟอลิโอ
                    <span class="text-slate-400 font-medium text-[10px] ml-1">(รองรับ PDF, JPG, PNG สูงสุด 3 ไฟล์ ไฟล์ละไม่เกิน 10MB)</span>
                </label>
                <input type="file" id="portfolio_upload" name="portfolio_file" accept=".pdf,.jpg,.jpeg,.png" multiple class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-[#5EBEE6] hover:file:bg-[#eaf6fc] border border-slate-100 rounded-xl bg-white transition cursor-pointer shadow-sm">

                <div id="file_preview_box" class="hidden space-y-2"></div>

                <div id="upload-progress-wrap" class="hidden pt-1">
                    <div class="flex justify-between text-[10px] font-bold text-slate-400 mb-1">
                        <span>กำลังอัปโหลด...</span>
                        <span id="upload-progress-text">0%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div id="upload-progress-bar" class="h-full bg-gradient-to-r from-[#5EBEE6] to-blue-500 rounded-full transition-all" style="width: 0%"></div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2 border-t border-slate-50 pt-4 mt-2">
                <button type="reset" class="px-5 py-2.5 bg-slate-100 font-bold hover:bg-slate-200 transition text-slate-500 rounded-xl text-xs active:scale-95">ล้างฟอร์ม</button>
                <button type="submit" class="px-6 py-2.5 bg-slate-900 font-bold hover:bg-slate-800 transition text-white rounded-xl text-xs shadow-md active:scale-95">ยืนยันส่งผลงาน</button>
            </div>
        </form>
    </div>

    <form action="{{ route('profile.portfolio') }}" method="GET" class="flex flex-col md:flex-row items-center gap-4 mb-10 relative z-20">
        <div class="relative w-full flex-grow shadow-sm">
            <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-[#5EBEE6] text-lg"></i>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหาชื่อพอร์ต, มหาวิทยาลัย, หรือชื่อผู้จัดทำ..."
                class="w-full bg-white border border-slate-100 text-slate-700 text-sm font-medium rounded-2xl py-4.5 pl-14 pr-32 outline-none focus:ring-2 focus:ring-[#5EBEE6]/50 focus:border-[#5EBEE6] transition-all">
            <button type="submit"
                class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-gradient-to-r from-[#5EBEE6] to-[#3B9ADE] hover:opacity-90 transition-opacity text-white px-6 py-2 rounded-xl text-sm font-bold shadow-md shadow-blue-500/20">
                ค้นหา
            </button>
        </div>

        <div class="relative w-full md:w-48 shrink-0 shadow-sm">
            <select name="sort" onchange="this.form.submit()"
                class="appearance-none w-full bg-white border border-slate-100 text-slate-600 font-bold text-sm rounded-2xl px-6 py-4.5 outline-none focus:ring-2 focus:ring-[#5EBEE6]/50 cursor-pointer pr-12 transition-all">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>เรียงจาก: ล่าสุด</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>เรียงจาก: ยอดนิยม</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-5 flex items-center text-slate-400">
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </div>
        </div>
    </form>

    <div class="mb-6 flex justify-between items-center border-b border-slate-100 pb-3">
        <h3 class="text-base font-extrabold text-slate-900 tracking-tight border-l-4 border-[#5EBEE6] pl-3">รายการแฟ้มผลงานของคุณ</h3>
        <span class="text-xs text-slate-400 font-bold bg-slate-100 px-3 py-1 rounded-md">ทั้งหมด {{ $portfolios->total() ?? 0 }} รายการ</span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        
        @forelse($portfolios as $portfolio)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden relative group hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 flex flex-col h-full">
                
                {{-- ป้าย Badge แจ้งสถานะตรวจสอบ --}}
                <div class="absolute top-3 left-3 z-10">
                    @if($portfolio->status == 'pending')
                        <span class="bg-orange-50 border border-orange-100 text-orange-500 text-[9px] font-bold px-2.5 py-1 rounded-md shadow-sm uppercase tracking-wide">Pending</span>
                    @elseif($portfolio->status == 'approved')
                        <span class="bg-emerald-50 border border-emerald-100 text-emerald-500 text-[9px] font-bold px-2.5 py-1 rounded-md shadow-sm uppercase tracking-wide">Approved</span>
                    @elseif($portfolio->status == 'rejected')
                        <span class="bg-rose-50 border border-rose-100 text-rose-500 text-[9px] font-bold px-2.5 py-1 rounded-md shadow-sm uppercase tracking-wide">Rejected</span>
                    @endif
                </div>

                <form action="{{ route('profile.portfolio.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('ยืนยันประสงค์ต้องการทำการลบแฟ้มผลงานชิ้นนี้ออกจากระบบ?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="absolute top-3 right-3 w-6 h-6 bg-rose-500 text-white rounded-full flex items-center justify-center text-[11px] opacity-0 group-hover:opacity-100 transition shadow-md z-10 hover:bg-rose-600" title="ลบผลงาน">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </form>

                <div class="w-full h-48 bg-slate-50 relative flex items-center justify-center overflow-hidden border-b border-slate-50">
                    @php
                        $portfolioFiles = $portfolio->file_path ?? [];
                        $primaryFile = $portfolioFiles[0] ?? null;
                        $ext = strtolower(pathinfo($primaryFile ?? '', PATHINFO_EXTENSION));
                    @endphp

                    @if($ext == 'pdf')
                        <canvas class="pdf-thumbnail w-full h-full object-cover transition-opacity duration-300 opacity-0" data-pdf-url="{{ asset($primaryFile) }}"></canvas>
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-300 pdf-loading bg-slate-50/50">
                            <i class="fa-solid fa-spinner fa-spin text-xl mb-1.5 text-[#5EBEE6]"></i>
                            <span class="text-[9px] font-bold text-slate-400">กำลังประมวลภาพปก...</span>
                        </div>
                    @else
                        <img src="{{ asset($primaryFile) }}" class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-700 ease-out" alt="Portfolio Cover">
                    @endif
                    @if (count($portfolioFiles) > 1)
                        <span class="absolute bottom-2 right-2 z-10 bg-slate-900/70 backdrop-blur-sm text-white text-[9px] font-bold px-2 py-1 rounded-md"><i class="fa-solid fa-paperclip"></i> {{ count($portfolioFiles) }} ไฟล์</span>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/5 via-transparent to-transparent"></div>
                </div>

                {{-- รายละเอียดเนื้อหาภายในการ์ดพอร์ต --}}
                <div class="p-5 flex flex-col flex-grow bg-white">
                    <div class="flex items-start justify-between mb-2 overflow-hidden">
                        <div class="flex items-center gap-1.5 w-full">
                            <div class="w-5 h-5 bg-blue-50 border border-blue-100/50 text-[#5EBEE6] rounded-full flex items-center justify-center text-[9px] shrink-0">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <span class="text-[10px] font-bold text-slate-500 line-clamp-1" title="{{ $portfolio->university }}">{{ $portfolio->university }}</span>
                        </div>
                    </div>

                    <h4 class="text-sm font-bold text-slate-800 mb-1.5 line-clamp-1 group-hover:text-[#5EBEE6] transition-colors">{{ $portfolio->first_name }} {{ $portfolio->last_name }}</h4>
                    <p class="text-slate-400 text-xs font-medium line-clamp-2 leading-relaxed mb-4 h-[36px]" title="{{ $portfolio->description }}">
                        {{ $portfolio->description }}
                    </p>

                    <div class="flex items-center justify-between mt-auto pt-3 border-t border-slate-50 mb-3 text-[11px] text-slate-400 font-semibold">
                        <div class="flex items-center gap-1.5">
                            <i class="fa-regular fa-calendar text-[10px] text-slate-300"></i>
                            <span>{{ $portfolio->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <i class="fa-regular fa-eye text-[10px] text-slate-300"></i>
                            <span>{{ number_format($portfolio->views) }} <span class="text-[10px] font-normal text-slate-400">วิว</span></span>
                        </div>
                    </div>

                    <a href="{{ asset($primaryFile) }}" target="_blank" class="w-full block text-center py-2.5 border border-slate-100 text-slate-600 bg-slate-50 rounded-xl text-xs font-bold hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] shadow-sm transition-all">
                        <i class="fa-solid fa-file-pdf mr-1"></i> ตรวจสอบเปิดดูผลงาน
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center border border-dashed border-slate-200 rounded-3xl bg-white shadow-sm flex flex-col items-center justify-center text-slate-400">
                <div class="w-14 h-14 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-3">
                    <i class="fa-solid fa-folder-open text-2xl text-slate-300"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-700 mb-0.5">ยังไม่มีการส่งข้อมูลผลงาน</h3>
                <p class="text-xs text-slate-400 font-medium">คุณยังไม่มีรายการจัดส่งแฟ้มประวัติพอร์ตฟอลิโอเก็บไว้ในคลังระบบ</p>
            </div>
        @endforelse

    </div>

    @if($portfolios->hasPages())
        <div class="mt-10 pt-4 border-t border-slate-100">
            {{ $portfolios->links() }}
        </div>
    @endif

</section>

<script src="{{asset('assets/js/portfolio-profile.js')}}"></script>
<script src="{{ asset('assets/js/multi-upload.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        MultiUpload.init({
            formId: 'portfolio-upload-form',
            fileInputId: 'portfolio_upload',
            previewListId: 'file_preview_box',
            progressWrapId: 'upload-progress-wrap',
            progressBarId: 'upload-progress-bar',
            progressTextId: 'upload-progress-text',
            fieldName: 'portfolio_file',
            maxFiles: 3,
            maxSizeMb: 10,
        });
    });
</script>

@endsection