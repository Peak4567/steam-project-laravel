@extends('profile.profile-layout')
@section('profile-content')

<section class="w-full font-mitr max-w-6xl mx-auto text-slate-700">

    <div class="mb-8 border-b border-slate-100 pb-4 flex flex-col md:flex-row justify-between items-start md:items-end gap-3">
        <div>
            <div class="flex items-center gap-2.5">
                <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                <h2 class="text-xl md:text-2xl font-extrabold text-slate-900 tracking-tight">อัปโหลดจัดการชีทสรุป</h2>
            </div>
            <p class="text-xs text-slate-400 font-medium mt-1">แบ่งปันชีทสรุปบทเรียน, สื่อการเรียนรู้ PDF หรือคลังสไลด์ Canva เพื่อร่วมสร้างสรรค์การแบ่งปันในห้องเรียน</p>
        </div>
    </div>

    <div class="flex flex-col gap-6 mb-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm text-center group transition-all duration-300 hover:-translate-y-0.5">
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">{{ number_format($totalFiles) }}</h3>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-1">ไฟล์อัปโหลด</p>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm text-center group transition-all duration-300 hover:-translate-y-0.5">
                <h3 class="text-2xl font-black text-[#5EBEE6] tracking-tight">{{ number_format($totalDownloads) }}</h3>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-1">ยอดดาวน์โหลดรวม</p>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm text-center group transition-all duration-300 hover:-translate-y-0.5">
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">{{ number_format($totalSubjects) }}</h3>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-1">จำนวนวิชา</p>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm text-center group transition-all duration-300 hover:-translate-y-0.5">
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">{{ number_format($totalViews) }}</h3>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-1">ยอดเข้าชมรวม</p>
            </div>
        </div>

        <div class="bg-white p-5 md:p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)]">
            <div class="flex items-center gap-3.5 mb-5 text-[#5EBEE6] border-b border-slate-50 pb-3">
                <div class="w-9 h-9 bg-blue-50 border border-blue-100/50 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-cloud-arrow-up text-base"></i>
                </div>
                <h3 class="text-sm font-extrabold text-slate-900 tracking-tight">ส่งเอกสารสรุปบทเรียน</h3>
            </div>

            <form action="{{ route('profile.sheets.store') }}" method="POST" enctype="multipart/form-data" id="sheet-upload-form">
                @csrf
                
                <div class="flex flex-wrap items-center gap-6 mb-5 pb-4 border-b border-slate-50">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="radio" name="type_check" value="file" checked onchange="toggleInputType('file')" class="w-4 h-4 text-[#5EBEE6] border-slate-200 focus:ring-[#5EBEE6]/40">
                        <span class="text-xs text-slate-600 font-bold group-hover:text-slate-800 transition-colors">ประเภทไฟล์เอกสาร (PDF, Word, Image)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="radio" name="type_check" value="link" onchange="toggleInputType('link')" class="w-4 h-4 text-orange-500 border-slate-200 focus:ring-orange-500/40">
                        <span class="text-xs text-slate-600 font-bold group-hover:text-slate-800 transition-colors">ประเภทลิงก์ภายนอก (Canva, Google Drive)</span>
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">ชื่อชีทสรุป</label>
                        <input type="text" name="sheet_name" placeholder="ระบุชื่อเรียกเอกสารชีทสรุป..." class="w-full bg-slate-50/50 border border-slate-100 text-xs font-medium rounded-xl p-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700" required>
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">ระดับชั้นเรียน</label>
                        <div class="relative">
                            <select name="level" class="appearance-none w-full bg-slate-50/50 border border-slate-100 text-xs font-medium rounded-xl p-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700 cursor-pointer" required>
                                <option value="">-- เลือกระดับชั้นการศึกษา --</option>
                                <optgroup label="มัธยมศึกษาตอนต้น" class="font-bold text-slate-400">
                                    <option value="มัธยมศึกษาปีที่ 1" class="text-slate-700 font-medium">มัธยมศึกษาปีที่ 1</option>
                                    <option value="มัธยมศึกษาปีที่ 2" class="text-slate-700 font-medium">มัธยมศึกษาปีที่ 2</option>
                                    <option value="มัธยมศึกษาปีที่ 3" class="text-slate-700 font-medium">มัธยมศึกษาปีที่ 3</option>
                                </optgroup>
                                <optgroup label="มัธยมศึกษาตอนปลาย" class="font-bold text-slate-400">
                                    <option value="มัธยมศึกษาปีที่ 4" class="text-slate-700 font-medium">มัธยมศึกษาปีที่ 4</option>
                                    <option value="มัธยมศึกษาปีที่ 5" class="text-slate-700 font-medium">มัธยมศึกษาปีที่ 5</option>
                                    <option value="มัธยมศึกษาปีที่ 6" class="text-slate-700 font-medium">มัธยมศึกษาปีที่ 6</option>
                                </optgroup>
                                <option value="อื่นๆ" class="text-slate-700 font-medium">อื่นๆ</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <i class="fa-solid fa-chevron-down text-[10px]"></i>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">รายวิชา</label>
                        <input type="text" name="subject" placeholder="ระบุกลุ่มสาระวิชาเรียน..." class="w-full bg-slate-50/50 border border-slate-100 text-xs font-medium rounded-xl p-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700" required>
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">ภาคเรียน / ช่วงการสอบ</label>
                        <div class="relative">
                            <select name="term" class="appearance-none w-full bg-slate-50/50 border border-slate-100 text-xs font-medium rounded-xl p-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700 cursor-pointer" required>
                                <option value="">-- เลือกภาคสอบ/ภาคเรียน --</option>
                                <option value="กลางภาคเรียนที่ 1">กลางภาคเรียนที่ 1</option>
                                <option value="ปลายภาคเรียนที่ 1">ปลายภาคเรียนที่ 1</option>
                                <option value="กลางภาคเรียนที่ 2">กลางภาคเรียนที่ 2</option>
                                <option value="ปลายภาคเรียนที่ 2">ปลายภาคเรียนที่ 2</option>
                                <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <i class="fa-solid fa-chevron-down text-[10px]"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="file-input-container" class="mb-5 block space-y-1.5">
                    <label class="block text-xs font-bold text-[#5EBEE6] pl-0.5">
                        <i class="fa-solid fa-file-arrow-up"></i> เลือกไฟล์สรุปเอกสารในเครื่องของคุณ 
                        <span class="text-slate-400 font-medium text-[10px] ml-1">(ขนาดรวมไฟล์ห้ามเกิน 10MB)</span>
                    </label>
                    <input type="file" name="document" id="document_input" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-[#5EBEE6] hover:file:bg-[#eaf6fc] border border-slate-100 rounded-xl bg-white transition cursor-pointer shadow-sm" required>
                </div>

                <div id="link-input-container" class="mb-5 hidden space-y-1.5">
                    <label class="block text-xs font-bold text-orange-500 pl-0.5"><i class="fa-solid fa-link"></i> วาง URL ลิงก์ที่ต้องการแบ่งปันแชร์ข้อมูล</label>
                    <input type="url" name="link_url" id="link_input" placeholder="วางลิงก์ตัวอย่างแชร์ เช่น https://canva.com/..." class="w-full bg-white border border-slate-100 text-xs font-medium rounded-xl p-3 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-500/10 transition-all text-slate-700">
                </div>

                <div class="flex justify-end gap-2 border-t border-slate-50 pt-4 mt-2">
                    <button type="reset" class="px-5 py-2.5 bg-slate-100 font-bold hover:bg-slate-200 transition text-slate-500 rounded-xl text-xs active:scale-95">ยกเลิก</button>
                    <button type="submit" class="px-6 py-2.5 bg-slate-900 font-bold hover:bg-slate-800 transition text-white rounded-xl text-xs shadow-md active:scale-95">ยืนยันจัดส่งชีท</button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse table-fixed min-w-[850px]">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/70 font-bold text-slate-400 text-xs uppercase tracking-wider">
                        <th class="py-4 px-6 w-28">ประเภท</th>
                        <th class="py-4 px-6 w-52">กลุ่มวิชาเรียน</th>
                        <th class="py-4 px-6">ชื่อเอกสารข้อมูลชีท</th>
                        <th class="py-4 px-6 text-center w-28">ระดับชั้น</th>
                        <th class="py-4 px-6 text-center w-28">วันที่ส่ง</th>
                        <th class="py-4 px-6 text-center w-28">สถานะ</th>
                        <th class="py-4 px-6 text-center w-36">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-slate-600 text-xs font-medium">
                    @forelse($sheets as $sheet)
                    <tr class="hover:bg-slate-50/50 transition align-top group">
                        <td class="py-4 px-6">
                            @if($sheet->type == 'file')
                                <span class="inline-flex items-center gap-1.5 whitespace-nowrap bg-blue-50 text-[#5EBEE6] text-[10px] font-bold px-3 py-1.5 rounded-xl border border-blue-100/50"><i class="fa-solid fa-file-pdf"></i> ไฟล์เอกสาร</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 whitespace-nowrap bg-orange-50 text-orange-500 text-[10px] font-bold px-3 py-1.5 rounded-xl border border-orange-100/50"><i class="fa-solid fa-link"></i> ลิงก์แชร์</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="max-w-[180px] w-full mb-1">
                                <p class="text-sm font-bold text-slate-800 auto-clamp line-clamp-1 break-words group-hover:text-[#5EBEE6] transition-colors">{{ $sheet->subject }}</p>
                                <button onclick="toggleText(this)" class="hidden text-[9px] text-[#5EBEE6] hover:text-[#45a8d1] mt-1 outline-none font-bold">ดูทั้งหมด <i class="fa-solid fa-chevron-down text-[8px] ml-0.5"></i></button>
                            </div>
                            <div class="max-w-[180px] w-full">
                                <p class="text-[10px] text-slate-400 font-semibold auto-clamp line-clamp-1 break-words bg-slate-50 border border-slate-100 px-2 py-0.5 rounded inline-block">{{ $sheet->term }}</p>
                                <button onclick="toggleText(this)" class="hidden text-[9px] text-[#5EBEE6] hover:text-[#45a8d1] mt-1 outline-none font-bold">ดูทั้งหมด <i class="fa-solid fa-chevron-down text-[8px] ml-0.5"></i></button>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="max-w-[220px] w-full">
                                <p class="text-sm font-bold text-slate-700 auto-clamp line-clamp-1 break-words">{{ $sheet->sheet_name }}</p>
                                <button onclick="toggleText(this)" class="hidden text-[9px] text-[#5EBEE6] hover:text-[#45a8d1] mt-1 outline-none font-bold">ดูทั้งหมด <i class="fa-solid fa-chevron-down text-[8px] ml-0.5"></i></button>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-center text-slate-600 font-bold">{{ $sheet->level }}</td>
                        <td class="py-4 px-6 text-center text-slate-400">{{ $sheet->created_at->format('d/m/y') }}</td>
                        <td class="py-4 px-6 text-center">
                            @if($sheet->status == 'pending')
                                <span class="text-orange-500 bg-orange-50 border border-orange-100/50 px-2 py-0.5 rounded-md font-bold">รออนุมัติ</span>
                            @elseif($sheet->status == 'approved')
                                <span class="text-emerald-500 bg-emerald-50 border border-emerald-100/50 px-2 py-0.5 rounded-md font-bold">อนุมัติแล้ว</span>
                            @else
                                <span class="text-rose-500 bg-rose-50 border border-rose-100/50 px-2 py-0.5 rounded-md font-bold">ปฏิเสธ</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                @if($sheet->type == 'file')
                                    <a href="{{ asset($sheet->file_path) }}" target="_blank" class="w-8 h-8 rounded-xl bg-slate-50 border border-slate-100 text-slate-500 hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] transition-all flex items-center justify-center text-xs shadow-sm" title="เปิดดูไฟล์">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                @else
                                    <a href="{{ $sheet->file_path }}" target="_blank" class="w-8 h-8 rounded-xl bg-orange-50 border border-orange-100/30 text-orange-500 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition-all flex items-center justify-center text-xs shadow-sm" title="เปิดลิงก์ภายนอก">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                    </a>
                                @endif
                                
                                <form action="{{ route('profile.sheets.destroy', $sheet->id) }}" method="POST" onsubmit="return confirm('ยืนยันประสงค์ต้องการลบชีทสรุปวิชานี้จากระบบ?')" class="inline-flex">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-xl bg-rose-50 border border-rose-100 text-rose-500 hover:bg-rose-500 hover:text-white hover:border-rose-500 transition-all flex items-center justify-center text-xs shadow-sm" title="ลบข้อมูล">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-slate-400 font-medium">
                            <i class="fa-solid fa-folder-open text-2xl mb-2 opacity-30 block"></i> ยังไม่มีรายการไฟล์ชีทสรุปบทเรียนที่คุณเคยอัปโหลดไว้ในระบบ
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($sheets) && $sheets->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/30">
            {{ $sheets->links() }}
        </div>
        @endif
    </div>

</section>

<script>
    function toggleInputType(type) {
        const fileContainer = document.getElementById('file-input-container');
        const fileInput = document.getElementById('document_input');
        
        const linkContainer = document.getElementById('link-input-container');
        const linkInput = document.getElementById('link_input');

        if (type === 'file') {
            fileContainer.classList.remove('hidden');
            fileInput.setAttribute('required', 'required');
            
            linkContainer.classList.add('hidden');
            linkInput.removeAttribute('required');
        } else {
            fileContainer.classList.add('hidden');
            fileInput.removeAttribute('required');
            fileInput.value = ''; 
            
            linkContainer.classList.remove('hidden');
            linkInput.setAttribute('required', 'required');
        }
    }

    function toggleText(btn) {
        const textElement = btn.previousElementSibling;
        if (textElement.classList.contains('line-clamp-1')) {
            textElement.classList.remove('line-clamp-1');
            btn.innerHTML = 'ย่อข้อความ <i class="fa-solid fa-chevron-up text-[8px] ml-0.5"></i>';
        } else {
            textElement.classList.add('line-clamp-1');
            btn.innerHTML = 'ดูทั้งหมด <i class="fa-solid fa-chevron-down text-[8px] ml-0.5"></i>';
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const clampElements = document.querySelectorAll('.auto-clamp');
        const fileInput = document.getElementById('document_input');
        
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (typeof AppAlert !== 'undefined') {
                    AppAlert.validateFileSize(this, 10); 
                }
            });
        }
        
        function checkTruncation() {
            clampElements.forEach(el => {
                if (el.scrollWidth > el.clientWidth) {
                    el.nextElementSibling.classList.remove('hidden');
                } else {
                    if(el.classList.contains('line-clamp-1')) {
                        el.nextElementSibling.classList.add('hidden');
                    }
                }
            });
        }

        checkTruncation();
        window.addEventListener('resize', checkTruncation);
    });
</script>

@endsection