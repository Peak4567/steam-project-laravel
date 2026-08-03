@extends('profile.profile-layout')
@section('profile-content')

<section class="w-full font-mitr max-w-6xl mx-auto text-slate-700">

    <div class="w-full bg-rose-50/60 backdrop-blur-sm border border-rose-100 text-rose-600 px-5 py-3.5 rounded-2xl flex items-center justify-between mb-8 shadow-sm">
        <p class="text-xs font-medium flex items-center gap-2">
            <i class="fa-solid fa-triangle-exclamation text-base"></i> <span>คำเตือนสำคัญ: สิ่งที่คุณอัปโหลดต้องห้ามติดสิทธิ์หรือละเมิดลิขสิทธิ์ผลงานผู้อื่น</span>
        </p>
        <button onclick="this.parentElement.remove()" class="w-6 h-7 rounded-lg hover:bg-rose-100/50 text-rose-400 hover:text-rose-600 transition-colors flex items-center justify-center">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <div class="lg:col-span-7 space-y-5">
            <div class="flex items-center gap-3 mb-6 px-1">
                <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                <h2 class="text-base font-extrabold text-slate-900 tracking-tight">รายการเล่มโครงงานของคุณ</h2>
            </div>

            @if(isset($reports) && $reports->count() > 0)
                @foreach($reports as $report)
                    <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-[0_8px_30px_rgba(0,0,0,0.02)] hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-5 group relative overflow-hidden">
                        
                        @php
                            $reportFiles = $report->file_path ?? [];
                            $firstExtension = strtolower(pathinfo($reportFiles[0] ?? '', PATHINFO_EXTENSION));
                        @endphp

                        <div class="flex items-center gap-4 z-10 w-full sm:w-auto">
                            <a href="{{ route('projects.viewReport', $report->id) }}" target="_blank"
                               class="w-12 h-16 bg-gradient-to-br from-[#5EBEE6]/10 to-blue-500/5 rounded-xl border border-slate-100 shadow-sm flex flex-col items-center justify-center text-slate-700 p-1 shrink-0 hover:scale-105 transition-transform" title="คลิกเพื่อดูไฟล์">
                                @if ($firstExtension === 'pdf')
                                    <i class="fa-solid fa-file-pdf text-rose-500 text-xl mb-0.5"></i>
                                @elseif ($firstExtension === 'docx' || $firstExtension === 'doc')
                                    <i class="fa-solid fa-file-word text-blue-500 text-xl mb-0.5"></i>
                                @else
                                    <i class="fa-solid fa-file-invoice text-slate-400 text-xl mb-0.5"></i>
                                @endif
                                <span class="text-[8px] text-slate-400 font-bold block uppercase tracking-wider">.{{ $firstExtension }}</span>
                            </a>

                            <div class="overflow-hidden">
                                @if($report->status == 'approved')
                                    <span class="inline-block bg-emerald-50 border border-emerald-100/50 text-emerald-500 text-[9px] font-bold px-2 py-0.5 rounded-md mb-2 uppercase tracking-wide">Approved</span>
                                @elseif($report->status == 'pending')
                                    <span class="inline-block bg-orange-50 border border-orange-100/50 text-orange-500 text-[9px] font-bold px-2 py-0.5 rounded-md mb-2 uppercase tracking-wide">Pending</span>
                                @else
                                    <span class="inline-block bg-slate-50 border border-slate-100 text-slate-400 text-[9px] font-bold px-2 py-0.5 rounded-md mb-2 uppercase tracking-wide">{{ $report->status }}</span>
                                @endif
                                @if (count($reportFiles) > 1)
                                    <span class="inline-block bg-blue-50 border border-blue-100/50 text-[#5EBEE6] text-[9px] font-bold px-2 py-0.5 rounded-md mb-2 ml-1"><i class="fa-solid fa-paperclip text-[8px]"></i> {{ count($reportFiles) }} ไฟล์</span>
                                @endif

                                <h4 class="text-sm font-bold text-slate-800 leading-tight mb-1.5 line-clamp-1 group-hover:text-[#5EBEE6] transition-colors">{{ $report->project_name }}</h4>
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-[10px] text-slate-400 font-medium">
                                    <p class="flex items-center gap-1"><i class="fa-solid fa-user-tie text-[9px]"></i> ที่ปรึกษา: {{ $report->advisor }}</p>
                                    <p class="flex items-center gap-1"><i class="fa-solid fa-book-open text-[9px]"></i> วิชา: {{ $report->subject }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="z-10 flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-center h-full gap-2 w-full sm:w-auto border-t sm:border-t-0 pt-3 sm:pt-0 border-slate-50">
                            <span class="text-[10px] font-bold text-slate-400 bg-slate-50 px-2 py-0.5 rounded-md shadow-inner"><i class="fa-regular fa-calendar-check text-[9px] mr-0.5"></i> {{ $report->created_at->format('Y-m-d') }}</span>
                            <div class="flex items-center gap-1.5">
                                @foreach ($reportFiles as $fileIndex => $filePath)
                                    <a href="{{ route('projects.viewReport', [$report->id, $fileIndex]) }}" target="_blank"
                                       class="w-8 h-8 rounded-xl bg-slate-50 border border-slate-100 text-slate-500 hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] transition-all flex items-center justify-center text-xs shadow-sm" title="เปิดดูไฟล์ {{ $fileIndex + 1 }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('projects.downloadReport', [$report->id, $fileIndex]) }}"
                                       class="w-8 h-8 rounded-xl bg-blue-50 border border-blue-100/30 text-[#5EBEE6] hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] transition-all flex items-center justify-center text-xs shadow-sm" title="ดาวน์โหลดไฟล์ {{ $fileIndex + 1 }}">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                @endforeach
                                <form action="{{ route('projects.deleteReport', $report->id) }}" method="POST" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบเอกสารโครงงานชิ้นนี้?');" class="inline-flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-xl bg-rose-50 border border-rose-100 text-rose-500 hover:bg-rose-500 hover:text-white hover:border-rose-500 transition-all flex items-center justify-center text-xs shadow-sm" title="ลบเล่ม">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-16 bg-white border border-slate-100 rounded-2xl shadow-[0_8px_30px_rgba(0,0,0,0.02)] flex flex-col items-center justify-center text-slate-400">
                    <div class="w-14 h-14 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-3">
                        <i class="fa-solid fa-folder-open text-2xl text-slate-300"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-700 mb-0.5">ยังไม่มีรายการเล่มโครงงาน</h3>
                    <p class="text-xs text-slate-400 font-medium">คุณยังไม่ได้อัปโหลดเล่มรายงานโครงงานไว้ในระบบ</p>
                </div>
            @endif
        </div>

        <div class="lg:col-span-5 bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)]">
            <div class="flex items-center gap-3.5 mb-6 border-b border-slate-50 pb-4 text-[#5EBEE6]">
                <div class="w-10 h-10 bg-blue-50 border border-blue-100/50 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                </div>
                <h3 class="text-sm font-extrabold text-slate-900 tracking-tight">อัปโหลดส่งรายงานโครงงาน</h3>
            </div>

            <form action="{{ route('projects.uploadReports', $project->id ?? 1) }}" method="POST" enctype="multipart/form-data" id="reports-upload-form" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-slate-500 pl-0.5">ชื่อเล่มโครงงาน</label>
                    <input type="text" name="project_name" placeholder="ป้อนชื่อเล่มรายงานโครงงาน..." 
                        class="w-full bg-slate-50/50 border border-slate-100 text-xs font-medium rounded-xl p-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700" required>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-slate-500 pl-0.5">อาจารย์ที่ปรึกษาโครงงาน</label>
                    <input type="text" name="advisor" placeholder="ระบุชื่ออาจารย์ที่ปรึกษา..." 
                        class="w-full bg-slate-50/50 border border-slate-100 text-xs font-medium rounded-xl p-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700" required>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-slate-500 pl-0.5">รายวิชาเรียน</label>
                    <input type="text" name="subject" placeholder="ป้อนชื่อวิชา (เช่น คอมพิวเตอร์, เคมี)..." 
                        class="w-full bg-slate-50/50 border border-slate-100 text-xs font-medium rounded-xl p-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700" required>
                </div>

                <div id="dropzone-area" class="mt-6 border border-dashed border-slate-200 rounded-2xl p-6 hover:border-[#5EBEE6] transition-all bg-slate-50/30 relative text-center cursor-pointer flex flex-col items-center justify-center min-h-[100px] shadow-inner" onclick="document.getElementById('document-input').click()">
                    <div id="upload-empty-hint" class="flex flex-col items-center pointer-events-none">
                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-slate-300 mb-2"></i>
                        <span class="text-xs font-bold text-slate-700">คลิกเพื่อเลือกหรือลากไฟล์มาวางอัปโหลด</span>
                        <span class="text-[10px] text-slate-400 font-medium mt-1">รองรับ PDF, WORD สูงสุด 3 ไฟล์ (จำกัดไฟล์ละไม่เกิน 10MB)</span>
                    </div>

                    <div id="document-preview-list" class="hidden w-full space-y-2" onclick="event.stopPropagation()"></div>

                    <input type="file" name="document" id="document-input" class="hidden" accept=".pdf,.doc,.docx" multiple>
                </div>

                <div id="upload-progress-wrap" class="hidden mt-3">
                    <div class="flex justify-between text-[10px] font-bold text-slate-400 mb-1">
                        <span>กำลังอัปโหลด...</span>
                        <span id="upload-progress-text">0%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div id="upload-progress-bar" class="h-full bg-gradient-to-r from-[#5EBEE6] to-blue-500 rounded-full transition-all" style="width: 0%"></div>
                    </div>
                </div>

                <p class="text-[10px] font-medium text-rose-400 text-center italic mt-2">
                    *หมายเหตุ: เล่มรายงานที่ส่งต่อคลังจะได้รับการพิจารณาและตรวจสอบโดยคณาจารย์ก่อนเริ่มแสดงผลสู่ที่สาธารณะ
                </p>

                <div class="flex justify-end gap-2 mt-6 border-t border-slate-50 pt-4">
                    <button type="reset" class="px-5 py-2.5 bg-slate-100 font-bold hover:bg-slate-200 transition text-slate-500 rounded-xl text-xs active:scale-95">
                        ล้างฟอร์ม
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-slate-900 font-bold hover:bg-slate-800 transition text-white rounded-xl text-xs shadow-md active:scale-95">
                        ยืนยันการส่งเล่ม
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="{{ asset('assets/js/multi-upload.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        MultiUpload.init({
            formId: 'reports-upload-form',
            fileInputId: 'document-input',
            dropzoneId: 'dropzone-area',
            previewListId: 'document-preview-list',
            emptyHintId: 'upload-empty-hint',
            progressWrapId: 'upload-progress-wrap',
            progressBarId: 'upload-progress-bar',
            progressTextId: 'upload-progress-text',
            fieldName: 'document',
            maxFiles: 3,
            maxSizeMb: 10,
        });
    });
</script>

@endsection