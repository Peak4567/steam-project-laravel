@extends('profile.profile-layout')
@section('profile-content')

<section class="max-w-7xl mx-auto">

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-3 rounded-xl mb-6 shadow-sm text-xs flex items-center">
            <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-3 rounded-xl mb-6 shadow-sm text-xs flex items-center">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="bg-red-50 border border-red-200 text-red-600 px-6 py-3 rounded-xl flex items-center justify-between mb-6 shadow-sm">
        <p class="text-xs">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i> คำเตือน: สิ่งที่คุณอัปโหลดต้องห้ามติดลิขสิทธิ์
        </p>
        <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 text-sm">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <div class="lg:col-span-7 space-y-4">
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-base text-slate-800">รายการเล่มโครงงานของคุณ</h2>
            </div>

            @if(isset($reports) && $reports->count() > 0)
                @foreach($reports as $report)
                    <div class="bg-gradient-to-r from-[#2A7696] to-[#4BA3C6] p-5 rounded-md text-white shadow-none flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden">
                        <div class="absolute -right-6 -bottom-6 text-white/10 text-9xl">
                            <i class="fa-solid fa-book-open"></i>
                        </div>

                        <div class="flex items-center gap-5 z-10 w-full md:w-auto">
                            <a href="{{ route('projects.viewReport', $report->id) }}" target="_blank" class="w-14 h-18 bg-white rounded-lg shadow-sm flex flex-col items-center justify-center text-slate-700 p-1 relative overflow-hidden hover:scale-105 transition-transform" title="คลิกเพื่อดูไฟล์">
                                @php
                                    $extension = strtolower(pathinfo($report->file_path, PATHINFO_EXTENSION));
                                @endphp
                                
                                @if ($extension === 'pdf')
                                    <i class="fa-solid fa-file-pdf text-red-500 text-xl mb-1"></i>
                                @elseif ($extension === 'docx' || $extension === 'doc')
                                    <i class="fa-solid fa-file-word text-blue-600 text-xl mb-1"></i>
                                @else
                                    <i class="fa-solid fa-file-invoice text-gray-500 text-xl mb-1"></i>
                                @endif
                                <span class="text-[8px] text-slate-400 block tracking-wider uppercase">.{{ $extension }}</span>
                            </a>
                            
                            <div>
                                <span class="inline-block bg-yellow-500 text-white text-[9px] px-2.5 py-0.5 rounded-full mb-2">
                                    {{ ucfirst($report->status) }}
                                </span>
                                <h4 class="text-sm leading-tight mb-1">{{ $report->project_name }}</h4>
                                <p class="text-[9px] text-white/80">อาจารย์ที่ปรึกษา: {{ $report->advisor }}</p>
                                <p class="text-[9px] text-white/80">วิชา: {{ $report->subject }}</p>
                            </div>
                        </div>

                        <div class="z-10 flex flex-row md:flex-col items-start md:items-end justify-between md:justify-center h-full gap-2 w-full md:w-auto border-t border-white/20 pt-3 md:pt-0 md:border-t-0">
                            <span class="text-[9px] text-white/70">{{ $report->created_at->format('Y-m-d') }}</span>
                            <div class="flex gap-2">
                                <a href="{{ route('projects.viewReport', $report->id) }}" target="_blank" 
                                   class="text-[10px] bg-white/20 px-3 py-1.5 rounded-lg text-white hover:bg-white/30 transition flex items-center gap-1 shadow-sm">
                                    <i class="fa-solid fa-eye"></i> ดู
                                </a>
                                <a href="{{ route('projects.downloadReport', $report->id) }}" 
                                   class="text-[10px] bg-[#5EBEE6] hover:bg-[#45a8d1] px-3 py-1.5 rounded-lg text-white transition flex items-center gap-1 shadow-sm">
                                    <i class="fa-solid fa-download"></i> โหลด
                                </a>
                                <form action="{{ route('projects.deleteReport', $report->id) }}" method="POST" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบเอกสารนี้?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[10px] bg-red-500 hover:bg-red-600 px-3 py-1.5 rounded-lg text-white transition flex items-center gap-1 shadow-sm">
                                        <i class="fa-solid fa-trash"></i> ลบ
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-10 bg-white border border-gray-200 rounded-xl text-gray-400">
                    <i class="fa-solid fa-folder-open text-3xl mb-2 opacity-50 block"></i>
                    ยังไม่มีรายการเล่มโครงงานที่อัปโหลด
                </div>
            @endif
        </div>

        <div class="lg:col-span-5 bg-white p-6 rounded-xl border border-gray-200 shadow-none">
            <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                <i class="fa-solid fa-cloud-arrow-up text-xl text-[#5EBEE6]"></i>
                <h3 class="text-sm text-slate-800">อัปโหลดเล่มรายงาน</h3>
            </div>

            <form action="{{ route('projects.uploadReports', $project->id ?? 1) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-[10px] text-gray-400 uppercase tracking-wider mb-1">ชื่อเล่มโครงงาน</label>
                    <input type="text" name="project_name" placeholder="ชื่อเล่มโครงงาน..." 
                        class="w-full bg-gray-50 border border-gray-200 text-xs rounded-lg p-2.5 focus:ring-1 focus:ring-[#5EBEE6] outline-none transition text-gray-600" required>
                </div>

                <div>
                    <label class="block text-[10px] text-gray-400 uppercase tracking-wider mb-1">อาจารย์ที่ปรึกษา</label>
                    <input type="text" name="advisor" placeholder="อาจารย์ที่ปรึกษา..." 
                        class="w-full bg-gray-50 border border-gray-200 text-xs rounded-lg p-2.5 focus:ring-1 focus:ring-[#5EBEE6] outline-none transition text-gray-600" required>
                </div>

                <div>
                    <label class="block text-[10px] text-gray-400 uppercase tracking-wider mb-1">วิชา</label>
                    <input type="text" name="subject" placeholder="วิชา..." 
                        class="w-full bg-gray-50 border border-gray-200 text-xs rounded-lg p-2.5 focus:ring-1 focus:ring-[#5EBEE6] outline-none transition text-gray-600" required>
                </div>

                <div id="dropzone-area" class="mt-6 border border-dashed border-gray-300 rounded-xl p-5 hover:border-[#5EBEE6] transition-all bg-gray-50/30 relative text-center cursor-pointer flex flex-col items-center justify-center min-h-[140px]" onclick="if(event.target.tagName !== 'A') document.getElementById('document-input').click()">
                    
                    <div id="upload-prompt" class="flex flex-col items-center pointer-events-none">
                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400 mb-2"></i>
                        <span class="text-xs text-slate-700">คลิกเพื่ออัปโหลดเล่มรายงาน</span>
                        <span class="text-[9px] text-gray-400 mt-1">รองรับไฟล์ PDF, WORD (สูงสุด 5MB)</span>
                    </div>

                    <div id="file-preview" class="hidden flex-col items-center relative z-10">
                        <i id="file-icon" class="fa-solid fa-file-invoice text-4xl mb-2"></i>
                        <span id="file-name" class="text-[11px] text-slate-700 truncate max-w-[200px] mb-1">filename.pdf</span>
                        <span id="file-size" class="text-[9px] text-gray-400 mb-3">0 MB</span>
                        
                        <div class="flex gap-2">
                            <a id="view-local-file" href="#" target="_blank" class="text-[10px] bg-[#5EBEE6] text-white px-3 py-1.5 rounded-lg hover:bg-[#45a8d1] transition flex items-center gap-1 shadow-sm" onclick="event.stopPropagation();">
                                <i class="fa-solid fa-eye"></i> ดูไฟล์ที่เลือก
                            </a>
                            <span class="text-[10px] text-red-500 bg-red-50 border border-red-100 px-3 py-1.5 rounded-lg hover:bg-red-100 transition cursor-pointer shadow-sm">
                                เปลี่ยนไฟล์
                            </span>
                        </div>
                    </div>

                    <input type="file" name="document" id="document-input" class="hidden" accept=".pdf,.doc,.docx" required>
                </div>

                <p class="text-[9px] text-red-500 text-center italic mt-2">
                    *เล่มรายงานที่แชร์จะถูกตรวจสอบโดย อาจารย์ผู้เชี่ยวชาญ ก่อนแสดงผลผ่านหน้าเว็บ
                </p>

                <div class="flex justify-end gap-3 mt-5 border-t border-gray-100 pt-4">
                    <button type="button" class="px-5 py-2 bg-red-500 hover:bg-red-600 transition text-white rounded-lg shadow-none text-[10px]">
                        ยกเลิก
                    </button>
                    <button type="submit" class="px-5 py-2 bg-green-500 hover:bg-green-600 transition text-white rounded-lg shadow-none text-[10px]">
                        ยืนยัน
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    let currentObjectUrl = null;

    document.getElementById('document-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const prompt = document.getElementById('upload-prompt');
        const preview = document.getElementById('file-preview');
        const icon = document.getElementById('file-icon');
        const nameDisplay = document.getElementById('file-name');
        const sizeDisplay = document.getElementById('file-size');
        const viewBtn = document.getElementById('view-local-file');
        const dropzone = document.getElementById('dropzone-area');

        if (file) {
            prompt.classList.add('hidden');
            preview.classList.remove('hidden');
            preview.classList.add('flex');
            dropzone.classList.add('bg-white', 'border-solid', 'border-[#5EBEE6]');
            dropzone.classList.remove('bg-gray-50/30', 'border-dashed', 'border-gray-300');

            nameDisplay.textContent = file.name;
            sizeDisplay.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';

            if (currentObjectUrl) {
                URL.revokeObjectURL(currentObjectUrl);
            }
            currentObjectUrl = URL.createObjectURL(file);
            viewBtn.href = currentObjectUrl;

            const extension = file.name.split('.').pop().toLowerCase();
            icon.className = 'fa-solid text-4xl mb-2 ';
            if (extension === 'pdf') {
                icon.className += 'fa-file-pdf text-red-500';
            } else if (extension === 'doc' || extension === 'docx') {
                icon.className += 'fa-file-word text-blue-600';
            } else {
                icon.className += 'fa-file-invoice text-gray-500';
            }
        } else {
            prompt.classList.remove('hidden');
            preview.classList.add('hidden');
            preview.classList.remove('flex');
            dropzone.classList.remove('bg-white', 'border-solid', 'border-[#5EBEE6]');
            dropzone.classList.add('bg-gray-50/30', 'border-dashed', 'border-gray-300');
        }
    });
</script>

@endsection