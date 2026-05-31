@extends('profile.profile-layout')
@section('profile-content')

<section class="max-w-screen-xl mx-auto bg-gray-50/30 min-h-screen">

    <div class="mb-6">
        <h2 class="text-xl md:text-2xl font-bold text-[#2E8DA3]">อัปโหลดพอร์ตฟอลิโอ</h2>
        <p class="text-xs md:text-sm text-gray-400 mt-1">เผยแพร่พอร์ตฟอลิโอให้ ผู้คนได้รับชม</p>
    </div>

    <div class="bg-white border border-gray-100 rounded-xl p-4 md:p-6 mb-8 flex flex-col md:flex-row justify-between items-center shadow-sm">
        <div>
            <h3 class="text-base md:text-lg font-bold text-slate-800">ตามหามหาลัย</h3>
            <p class="text-[10px] md:text-xs text-gray-400 mt-1">ตามหามหาลัยที่คุณใฝ่ฝัน พร้อมอัปโหลดพอร์ตฟอลิโอ</p>
        </div>
        <button class="mt-4 md:mt-0 px-6 py-2 border border-green-400 text-green-500 rounded-full text-xs font-bold hover:bg-green-50 transition shadow-sm whitespace-nowrap">
            ดาวน์โหลด
        </button>
    </div>

    <div class="bg-white p-5 md:p-6 rounded-xl border border-gray-100 shadow-sm mb-10 max-w-3xl">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 shadow-sm">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <h3 class="text-base font-bold text-slate-800">อัปโหลด</h3>
        </div>

        <form action="{{ route('profile.portfolio.store') }}" method="POST" enctype="multipart/form-data" id="portfolio-upload-form">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">ชื่อ</label>
                    <input type="text" name="first_name" class="w-full bg-gray-50 border border-gray-200 text-xs rounded-xl p-2.5 outline-none focus:ring-1 focus:ring-[#5EBEE6] transition shadow-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">นามสกุล</label>
                    <input type="text" name="last_name" class="w-full bg-gray-50 border border-gray-200 text-xs rounded-xl p-2.5 outline-none focus:ring-1 focus:ring-[#5EBEE6] transition shadow-sm" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-700 mb-1">รายละเอียด</label>
                <textarea name="description" rows="3" class="w-full bg-gray-50 border border-gray-200 text-xs rounded-xl p-2.5 outline-none focus:ring-1 focus:ring-[#5EBEE6] transition shadow-sm" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-700 mb-1">มหาลัย</label>
                <input type="text" name="university" class="w-full bg-gray-50 border border-gray-200 text-xs rounded-xl p-2.5 outline-none focus:ring-1 focus:ring-[#5EBEE6] transition shadow-sm" required>
            </div>

            <div class="mb-6">
                <label class="block text-xs font-bold text-[#5EBEE6] mb-1">
                    เลือกไฟล์พอร์ตฟอลิโอของคุณ <span class="text-gray-400 font-normal text-[10px] ml-1">(ขนาดสูงสุดไม่เกิน 10MB)</span>
                </label>
                <input type="file" id="portfolio_upload" name="portfolio_file" accept=".pdf,.jpg,.jpeg,.png" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-50 file:text-[#5EBEE6] hover:file:bg-[#eaf6fc] border border-gray-200 rounded-xl bg-white transition cursor-pointer shadow-sm" required>
                
                <div id="file_preview_box" class="hidden mt-3 p-3 bg-[#f8fbff] border border-[#BCE3F9] rounded-xl flex-row justify-between items-center shadow-sm">
                    <div class="flex items-center gap-2 overflow-hidden">
                        <i class="fa-solid fa-file-lines text-[#5EBEE6]"></i>
                        <span id="file_preview_name" class="text-xs text-slate-600 font-medium truncate w-48 md:w-auto"></span>
                    </div>
                    <a id="file_preview_btn" href="#" target="_blank" class="px-3 py-1 bg-[#5EBEE6] text-white text-[10px] font-bold rounded-lg hover:bg-[#4fb1d8] transition-colors whitespace-nowrap shadow-sm">
                        เปิดดูไฟล์
                    </a>
                </div>
            </div>

            <div class="flex justify-center md:justify-start gap-3">
                <button type="reset" class="px-8 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-xl transition shadow-sm">ยกเลิก</button>
                <button type="submit" class="px-8 py-2 bg-white border border-green-400 text-green-500 hover:bg-green-50 text-xs font-bold rounded-xl transition shadow-sm">ยืนยัน</button>
            </div>
        </form>
    </div>

    {{-- ส่วนค้นหา คงเดิม --}}
    <form action="{{ route('profile.portfolio') }}" method="GET" class="flex flex-col md:flex-row items-center gap-3 md:gap-4 mb-8">
        <div class="relative w-full flex-grow">
            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหาพอร์ตฟอลิโอ, มหาลัย, หรือชื่อ..."
                class="w-full bg-white border border-gray-100 text-sm rounded-xl pl-10 pr-24 py-3 outline-none focus:ring-1 focus:ring-[#5EBEE6] shadow-sm">
            <button type="submit"
                class="absolute right-2 top-1/2 -translate-y-1/2 bg-white border border-[#5EBEE6] text-[#5EBEE6] hover:bg-[#5EBEE6] hover:text-white transition-colors px-6 py-1.5 rounded-xl text-xs font-bold shadow-sm">
                ค้นหา
            </button>
        </div>
        <select name="sort" onchange="this.form.submit()"
            class="w-full md:w-48 bg-white border border-gray-100 text-gray-500 text-sm rounded-xl px-4 py-3 outline-none shadow-sm cursor-pointer appearance-none">
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>ล่าสุด</option>
            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>ยอดนิยม</option>
        </select>
    </form>

    <div class="mb-6 flex justify-between items-center">
        <h3 class="text-lg font-bold text-slate-800 border-l-4 border-[#5EBEE6] pl-3">รายการผลงาน</h3>
        <span class="text-xs text-gray-400">ทั้งหมด {{ $portfolios->total() ?? 0 }} รายการ</span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        
        @forelse($portfolios as $portfolio)
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden relative group hover:shadow-md transition-shadow flex flex-col h-full">
                
                <div class="absolute top-3 left-3 z-10">
                    @if($portfolio->status == 'pending')
                        <span class="bg-amber-100 text-amber-600 text-[9px] font-bold px-2 py-0.5 rounded-full border border-amber-200 shadow-sm uppercase tracking-wider">Pending</span>
                    @elseif($portfolio->status == 'approved')
                        <span class="bg-emerald-100 text-emerald-600 text-[9px] font-bold px-2 py-0.5 rounded-full border border-emerald-200 shadow-sm uppercase tracking-wider">Approved</span>
                    @elseif($portfolio->status == 'rejected')
                        <span class="bg-rose-100 text-rose-600 text-[9px] font-bold px-2 py-0.5 rounded-full border border-rose-200 shadow-sm uppercase tracking-wider">Rejected</span>
                    @endif
                </div>

                <form action="{{ route('profile.portfolio.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('ยืนยันการลบผลงานพอร์ตฟอลิโอนี้?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="absolute top-3 right-3 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-[10px] opacity-0 group-hover:opacity-100 transition shadow-sm z-10 hover:bg-red-600" title="ลบผลงาน">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </form>

                <div class="w-full h-48 bg-gray-100 relative flex items-center justify-center overflow-hidden border-b border-gray-100">
                    @php
                        $ext = strtolower(pathinfo($portfolio->file_path, PATHINFO_EXTENSION));
                    @endphp
                    
                    @if($ext == 'pdf')
                        <canvas class="pdf-thumbnail w-full h-full object-cover transition-opacity duration-300 opacity-0" data-pdf-url="{{ asset($portfolio->file_path) }}"></canvas>
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 pdf-loading">
                            <i class="fa-solid fa-spinner fa-spin text-2xl mb-2"></i>
                            <span class="text-[10px] font-medium">กำลังโหลดภาพปก...</span>
                        </div>
                    @else
                        <img src="{{ asset($portfolio->file_path) }}" class="w-full h-full object-cover" alt="Portfolio Cover">
                    @endif
                </div>

                <div class="p-4 flex flex-col flex-grow">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-1.5">
                            <div class="w-5 h-5 bg-slate-800 text-white rounded-full flex items-center justify-center text-[8px] shrink-0">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <span class="text-[10px] font-bold text-slate-700 leading-tight w-full line-clamp-1" title="{{ $portfolio->university }}">{{ $portfolio->university }}</span>
                        </div>
                    </div>

                    <h4 class="text-sm font-bold text-slate-800 mb-1 line-clamp-1">{{ $portfolio->first_name }} {{ $portfolio->last_name }}</h4>
                    <p class="text-[9px] text-gray-400 line-clamp-2 leading-relaxed mb-4 h-[28px]" title="{{ $portfolio->description }}">
                        {{ $portfolio->description }}
                    </p>

                    <div class="flex items-center justify-between mt-auto pt-4 mb-4 border-t border-gray-50">
                        <div class="flex items-center gap-1.5 text-slate-400">
                            <i class="fa-regular fa-calendar text-[10px]"></i>
                            <span class="text-[9px] font-medium">{{ $portfolio->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-slate-400">
                            <i class="fa-regular fa-eye text-[10px]"></i>
                            <span class="text-[9px] font-medium">{{ number_format($portfolio->views) }}</span>
                        </div>
                    </div>

                    <a href="{{ asset($portfolio->file_path) }}" target="_blank" class="w-full block text-center py-2 border border-gray-100 text-gray-500 bg-gray-50 rounded-xl text-xs font-bold hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] hover:shadow-sm transition-all">
                        <i class="fa-solid fa-file-pdf mr-1"></i> ดูไฟล์ผลงาน
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-gray-400 border border-dashed border-gray-200 rounded-xl bg-white shadow-sm">
                <i class="fa-regular fa-folder-open text-3xl mb-3 text-gray-300"></i>
                <p class="text-sm font-medium">ยังไม่มีข้อมูลผลงานพอร์ตฟอลิโอ</p>
            </div>
        @endforelse

    </div>

    @if($portfolios->hasPages())
        <div class="mt-8 pt-4">
            {{ $portfolios->links() }}
        </div>
    @endif

</section>

<script src="{{asset('assets/js/portfolio-profile.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const fileInput = document.getElementById('portfolio_upload');
        const previewBox = document.getElementById('file_preview_box');
        const formElement = document.getElementById('portfolio-upload-form');

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                // ตรวจสอบขนาดไฟล์สูงสุดไม่เกิน 10MB ผ่านฟังก์ชันส่วนกลาง AppAlert ของ sweetalert.js
                if (typeof AppAlert !== 'undefined') {
                    const isValid = AppAlert.validateFileSize(this, 10);
                    if (!isValid) {
                        // หากขนาดไฟล์เกิน 10MB ล้างสถานะพรีวิวในหน้าตัวนี้ออก
                        if (previewBox) {
                            previewBox.classList.add('hidden');
                            previewBox.classList.remove('flex');
                        }
                        return;
                    }
                }
            });
        }

        // ดักจับการกด Reset ฟอร์มเพื่อซ่อนพรีวิวไฟล์กลับตามเดิม
        if (formElement) {
            formElement.addEventListener('reset', function() {
                if (previewBox) {
                    previewBox.classList.add('hidden');
                    previewBox.classList.remove('flex');
                }
            });
        }
    });
</script>

@endsection