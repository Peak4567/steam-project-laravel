@extends('profile.profile-layout')
@section('profile-content')

<section class="max-w-screen-xl mx-auto bg-gray-50/30 min-h-screen">

    <div class="mb-6">
        <h2 class="text-xl md:text-2xl font-bold text-[#2E8DA3]">อัปโหลดไฟล์ชีท</h2>
        <p class="text-xs md:text-sm text-gray-400 mt-1">แชร์ชีทสรุป, ไฟล์ PDF, Canva หรือสื่อการเรียนรู้ให้เพื่อนในชั้นเรียน</p>
    </div>

    <div class="flex flex-col gap-6 mb-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm text-center">
                <h3 class="text-2xl font-bold text-slate-800">{{ number_format($totalFiles) }}</h3>
                <p class="text-[10px] text-gray-400 mt-1">ไฟล์ทั้งหมด</p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm text-center">
                <h3 class="text-2xl font-bold text-slate-800">{{ number_format($totalDownloads) }}</h3>
                <p class="text-[10px] text-gray-400 mt-1">ยอดดาวน์โหลดรวม</p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm text-center">
                <h3 class="text-2xl font-bold text-slate-800">{{ number_format($totalSubjects) }}</h3>
                <p class="text-[10px] text-gray-400 mt-1">วิชาทั้งหมด</p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm text-center">
                <h3 class="text-2xl font-bold text-slate-800">{{ number_format($totalViews) }}</h3>
                <p class="text-[10px] text-gray-400 mt-1">ยอดวิวรวมทั้งสิ้น</p>
            </div>
        </div>

        <div class="bg-white p-5 md:p-6 rounded-xl border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-500">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                </div>
                <h3 class="text-base font-bold text-slate-800">อัปโหลด</h3>
            </div>

            <form action="{{ route('profile.sheets.store') }}" method="POST" enctype="multipart/form-data" id="sheet-upload-form">
                @csrf
                
                <div class="flex items-center gap-6 mb-4 pb-4 border-b border-gray-100">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="type_check" value="file" checked onchange="toggleInputType('file')" class="w-4 h-4 text-[#5EBEE6] focus:ring-[#5EBEE6]">
                        <span class="text-xs text-gray-700 font-medium">ประเภทไฟล์ (PDF, Word, รูปภาพ)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="type_check" value="link" onchange="toggleInputType('link')" class="w-4 h-4 text-[#5EBEE6] focus:ring-[#5EBEE6]">
                        <span class="text-xs text-gray-700 font-medium">ประเภทลิงก์ (Google Drive, Canva, ฯลฯ)</span>
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">ชื่อชีท</label>
                        <input type="text" name="sheet_name" placeholder="ระบุชื่อเอกสาร..." class="w-full bg-gray-50 border border-gray-200 text-xs rounded-xl p-2.5 outline-none focus:ring-1 focus:ring-[#5EBEE6] transition shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">ระดับชั้น</label>
                        <select name="level" class="w-full bg-gray-50 border border-gray-200 text-xs rounded-xl p-2.5 outline-none focus:ring-1 focus:ring-[#5EBEE6] transition shadow-sm" required>
                            <option value="">-- เลือกระดับชั้น --</option>
                            <optgroup label="อนุบาล">
                                <option value="อนุบาล 1">อนุบาล 1</option>
                                <option value="อนุบาล 2">อนุบาล 2</option>
                                <option value="อนุบาล 3">อนุบาล 3</option>
                            </optgroup>
                            <optgroup label="ประถมศึกษา">
                                <option value="ประถมศึกษาปีที่ 1">ประถมศึกษาปีที่ 1</option>
                                <option value="ประถมศึกษาปีที่ 2">ประถมศึกษาปีที่ 2</option>
                                <option value="ประถมศึกษาปีที่ 3">ประถมศึกษาปีที่ 3</option>
                                <option value="ประถมศึกษาปีที่ 4">ประถมศึกษาปีที่ 4</option>
                                <option value="ประถมศึกษาปีที่ 5">ประถมศึกษาปีที่ 5</option>
                                <option value="ประถมศึกษาปีที่ 6">ประถมศึกษาปีที่ 6</option>
                            </optgroup>
                            <optgroup label="มัธยมศึกษาตอนต้น">
                                <option value="มัธยมศึกษาปีที่ 1">มัธยมศึกษาปีที่ 1</option>
                                <option value="มัธยมศึกษาปีที่ 2">มัธยมศึกษาปีที่ 2</option>
                                <option value="มัธยมศึกษาปีที่ 3">มัธยมศึกษาปีที่ 3</option>
                            </optgroup>
                            <optgroup label="มัธยมศึกษาตอนปลาย">
                                <option value="มัธยมศึกษาปีที่ 4">มัธยมศึกษาปีที่ 4</option>
                                <option value="มัธยมศึกษาปีที่ 5">มัธยมศึกษาปีที่ 5</option>
                                <option value="มัธยมศึกษาปีที่ 6">มัธยมศึกษาปีที่ 6</option>
                            </optgroup>
                            <optgroup label="อาชีวศึกษา">
                                <option value="ปวช. 1">ปวช. 1</option>
                                <option value="ปวช. 2">ปวช. 2</option>
                                <option value="ปวช. 3">ปวช. 3</option>
                                <option value="ปวส. 1">ปวส. 1</option>
                                <option value="ปวส. 2">ปวส. 2</option>
                            </optgroup>
                            <optgroup label="มหาวิทยาลัย">
                                <option value="มหาวิทยาลัย ปี 1">มหาวิทยาลัย ปี 1</option>
                                <option value="มหาวิทยาลัย ปี 2">มหาวิทยาลัย ปี 2</option>
                                <option value="มหาวิทยาลัย ปี 3">มหาวิทยาลัย ปี 3</option>
                                <option value="มหาวิทยาลัย ปี 4">มหาวิทยาลัย ปี 4</option>
                                <option value="มหาวิทยาลัย ปี 5">มหาวิทยาลัย ปี 5</option>
                                <option value="มหาวิทยาลัย ปี 6">มหาวิทยาลัย ปี 6</option>
                            </optgroup>
                            <option value="อื่นๆ">อื่นๆ</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">วิชา</label>
                        <input type="text" name="subject" placeholder="ระบุวิชา..." class="w-full bg-gray-50 border border-gray-200 text-xs rounded-xl p-2.5 outline-none focus:ring-1 focus:ring-[#5EBEE6] transition shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">ภาค</label>
                        <select name="term" class="w-full bg-gray-50 border border-gray-200 text-xs rounded-xl p-2.5 outline-none focus:ring-1 focus:ring-[#5EBEE6] transition shadow-sm" required>
                            <option value="">-- เลือกภาคเรียน --</option>
                            <option value="ภาคเรียนที่ 1">ภาคเรียนที่ 1</option>
                            <option value="ภาคเรียนที่ 2">ภาคเรียนที่ 2</option>
                            <option value="ภาคเรียนที่ 3">ภาคเรียนที่ 3</option>
                            <option value="กลางภาคเรียนที่ 1">กลางภาคเรียนที่ 1</option>
                            <option value="ปลายภาคเรียนที่ 1">ปลายภาคเรียนที่ 1</option>
                            <option value="กลางภาคเรียนที่ 2">กลางภาคเรียนที่ 2</option>
                            <option value="ปลายภาคเรียนที่ 2">ปลายภาคเรียนที่ 2</option>
                            <option value="ภาคฤดูร้อน">ภาคฤดูร้อน (Summer)</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                        </select>
                    </div>
                </div>

                <div id="file-input-container" class="mb-6 block">
                    <label class="block text-xs font-bold text-[#5EBEE6] mb-1">
                        <i class="fa-solid fa-file-arrow-up"></i> เลือกไฟล์ที่ต้องการอัปโหลด 
                        <span class="text-gray-400 font-normal text-[10px] ml-1">(ขนาดสูงสุดไม่เกิน 10MB)</span>
                    </label>
                    <input type="file" name="document" id="document_input" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-50 file:text-[#5EBEE6] hover:file:bg-[#eaf6fc] border border-gray-200 rounded-xl bg-white transition cursor-pointer shadow-sm" required>
                </div>

                <div id="link-input-container" class="mb-6 hidden">
                    <label class="block text-xs font-bold text-orange-500 mb-1"><i class="fa-solid fa-link"></i> วางลิงก์ที่นี่</label>
                    <input type="url" name="link_url" id="link_input" placeholder="https://..." class="w-full bg-white border border-gray-200 text-xs rounded-xl p-2.5 outline-none focus:ring-1 focus:ring-orange-400 transition shadow-sm">
                </div>

                <div class="flex justify-center md:justify-end gap-3 border-t border-gray-100 pt-4 mt-2">
                    <button type="reset" class="px-8 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-xl transition shadow-sm">ยกเลิก</button>
                    <button type="submit" class="px-8 py-2 bg-white border-2 border-green-400 text-green-500 hover:bg-green-50 text-xs font-bold rounded-xl transition shadow-sm">ยืนยัน</button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse table-fixed min-w-[800px]">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 w-28">หมวดหมู่</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 w-56">วิชา</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 w-64">ชื่อชีทสรุป</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 text-center w-28">ระดับชั้น</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 text-center w-28">วันที่</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 text-center w-32">สถานะ</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 text-center w-36">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($sheets as $sheet)
                    <tr class="hover:bg-gray-50/50 transition align-top">
                        <td class="py-4 px-6">
                            @if($sheet->type == 'file')
                                <span class="inline-flex items-center gap-1.5 whitespace-nowrap bg-[#E5F3FF] text-[#5EBEE6] text-[10px] font-bold px-4 py-1.5 rounded-xl border border-[#BCE3F9]"><i class="fa-solid fa-file"></i> ไฟล์</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 whitespace-nowrap bg-orange-50 text-orange-500 text-[10px] font-bold px-4 py-1.5 rounded-xl border border-orange-200"><i class="fa-solid fa-link"></i> ลิงก์</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="max-w-[200px] w-full mb-1">
                                <p class="text-sm font-bold text-slate-800 auto-clamp line-clamp-1 break-words">{{ $sheet->subject }}</p>
                                <button onclick="toggleText(this)" class="hidden text-[9px] text-[#5EBEE6] hover:text-[#45a8d1] mt-0.5 outline-none font-medium">ดูทั้งหมด <i class="fa-solid fa-chevron-down text-[8px] ml-0.5"></i></button>
                            </div>
                            <div class="max-w-[200px] w-full">
                                <p class="text-[9px] text-gray-400 auto-clamp line-clamp-1 break-words">{{ $sheet->term }}</p>
                                <button onclick="toggleText(this)" class="hidden text-[9px] text-[#5EBEE6] hover:text-[#45a8d1] mt-0.5 outline-none font-medium">ดูทั้งหมด <i class="fa-solid fa-chevron-down text-[8px] ml-0.5"></i></button>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="max-w-[220px] w-full">
                                <p class="text-sm font-bold text-slate-800 auto-clamp line-clamp-1 break-words">{{ $sheet->sheet_name }}</p>
                                <button onclick="toggleText(this)" class="hidden text-[9px] text-[#5EBEE6] hover:text-[#45a8d1] mt-0.5 outline-none font-medium">ดูทั้งหมด <i class="fa-solid fa-chevron-down text-[8px] ml-0.5"></i></button>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-center text-xs text-gray-600 font-medium">{{ $sheet->level }}</td>
                        <td class="py-4 px-6 text-center text-xs text-gray-600">{{ $sheet->created_at->format('d/m/y') }}</td>
                        <td class="py-4 px-6 text-center">
                            @if($sheet->status == 'pending')
                                <span class="text-xs font-bold text-orange-400">รอพิจารณา</span>
                            @elseif($sheet->status == 'approved')
                                <span class="text-xs font-bold text-green-500">อนุมัติแล้ว</span>
                            @else
                                <span class="text-xs font-bold text-red-500">ปฏิเสธ</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                @if($sheet->type == 'file')
                                    <a href="{{ asset($sheet->file_path) }}" target="_blank" class="px-3 py-1.5 border border-[#5EBEE6] text-[#5EBEE6] hover:bg-[#5EBEE6] hover:text-white rounded-xl text-[10px] font-bold transition shadow-sm">ดู</a>
                                @else
                                    <a href="{{ $sheet->file_path }}" target="_blank" class="px-3 py-1.5 border border-orange-400 text-orange-500 hover:bg-orange-400 hover:text-white rounded-xl text-[10px] font-bold transition shadow-sm">เปิด</a>
                                @endif
                                
                                <form action="{{ route('profile.sheets.destroy', $sheet->id) }}" method="POST" onsubmit="return confirm('ยืนยันการลบ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 border border-red-400 text-red-500 hover:bg-red-50 rounded-xl text-[10px] font-bold transition shadow-sm">ลบ</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-10 text-center text-gray-400 text-sm">ยังไม่มีไฟล์ชีทที่อัปโหลด</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($sheets) && $sheets->hasPages())
        <div class="p-4 border-t border-gray-100">
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
        
        // ดึงฟังก์ชันตรวจสอบขนาดไฟล์จากสคริปต์ส่วนกลาง AppAlert ที่แยกไว้
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (typeof AppAlert !== 'undefined') {
                    AppAlert.validateFileSize(this, 10); // เรียกเช็คขนาดไฟล์สูงสุด 10MB
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