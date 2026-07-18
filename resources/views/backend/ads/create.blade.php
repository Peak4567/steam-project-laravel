@extends('backend.layout')
@section('content')
<section class="w-full min-h-[calc(100vh-80px)] p-4 md:p-8 font-mitr bg-slate-50/50 text-slate-700">
    <div class="max-w-6xl mx-auto">
        
        <div class="mb-8 border-b border-slate-100 pb-4">
            <a href="{{ route('backend.ads') }}" class="text-xs font-bold text-slate-400 hover:text-[#5EBEE6] transition-all flex items-center gap-1.5 mb-2 group w-fit">
                <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-0.5"></i> กลับไปหน้าการจัดการ
            </a>
            <div class="flex items-center gap-2.5">
                <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">เพิ่มป้ายประชาสัมพันธ์ใหม่</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            {{-- ฝั่งซ้าย: ฟอร์มกรอกข้อมูล --}}
            <div class="lg:col-span-8">
                <form action="{{ route('backend.ads.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] space-y-5">
                    @csrf
                    
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">หัวข้อข่าวประชาสัมพันธ์ / ชื่อโฆษณา <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" id="in-title" value="{{ old('title') }}" required placeholder="ระบุหัวข้อที่ต้องการประกาศ" class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">ลิงก์ปลายทางเมื่อกดป้าย URL (Link Redirect)</label>
                            <input type="url" name="link_url" id="in-url" value="{{ old('link_url') }}" placeholder="เช่น https://example.com" class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">สถานะคิวการแสดงผล <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <select name="status" required class="appearance-none w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-bold text-slate-600 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 cursor-pointer transition-all">
                                    <option value="active">เปิดการแสดงผลสาธารณะ (Active)</option>
                                    <option value="inactive">ซ่อนการใช้งานชั่วคราว (Inactive)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">คำอธิบาย/เนื้อหารายละเอียดโดยย่อ</label>
                        <textarea name="description" id="in-desc" rows="3" placeholder="ระบุเนื้อหาประกอบป้ายสั้นๆ..." class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 min-h-[90px] resize-none transition-all text-slate-700">{{ old('description') }}</textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">รูปภาพแบนเนอร์ประชาสัมพันธ์ <span class="text-rose-500">*</span></label>
                        <input type="file" name="image" id="in-img" accept="image/*" required class="w-full px-4 py-2.5 bg-white border border-slate-100 rounded-xl text-xs text-slate-400 font-medium file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-[#5EBEE6] hover:file:bg-blue-100/50 cursor-pointer transition-all shadow-sm">
                    </div>

                    <div class="pt-5 border-t border-slate-50 flex gap-3">
                        <button type="submit" class="flex-1 bg-slate-900 hover:bg-slate-800 text-white py-3 rounded-xl text-xs font-bold shadow-md transition-all active:scale-95">
                            <i class="fa-regular fa-floppy-disk mr-1"></i> เพิ่มข้อมูล
                        </button>
                        <a href="{{ route('backend.ads') }}" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-500 py-3 rounded-xl text-xs font-bold text-center transition-all active:scale-95 flex items-center justify-center">ยกเลิก</a>
                    </div>
                </form>
            </div>

            {{-- ฝั่งขวา: Live Preview --}}
            <div class="lg:col-span-4">
                <p class="text-xs font-bold text-slate-400 mb-3 flex items-center gap-1.5 pl-0.5 uppercase tracking-wider"><i class="fa-solid fa-desktop text-[#5EBEE6]"></i> Live Preview</p>
                <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-lg space-y-3">
                    <div class="aspect-[16/9] bg-slate-50 border border-slate-100 rounded-xl overflow-hidden relative">
                        <img id="pv-img" src="" class="w-full h-full object-cover hidden">
                        <div id="pv-no-img" class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                            <i class="fa-regular fa-image text-3xl mb-1.5 text-slate-200"></i>
                            <span class="text-[10px] font-bold text-slate-400">ยังไม่ได้เลือกรูปภาพ</span>
                        </div>
                    </div>
                    <div class="space-y-2 pt-1">
                        <h3 id="pv-title" class="text-sm font-bold text-slate-800 line-clamp-1 leading-snug">หัวข้อข่าวจะปรากฏที่นี่</h3>
                        <p id="pv-desc" class="text-[11px] text-slate-400 line-clamp-2 font-medium leading-relaxed">คำอธิบายย่อยแบบย่อจะแสดงตรงส่วนนี้...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const sync = (id, target, defaultText) => {
        const el = document.getElementById(id);
        if(el) {
            el.addEventListener('input', e => {
                document.getElementById(target).innerText = e.target.value || defaultText;
            });
        }
    };
    sync('in-title', 'pv-title', 'หัวข้อข่าวจะปรากฏที่นี่');
    sync('in-desc', 'pv-desc', 'คำอธิบายย่อยแบบย่อจะแสดงตรงส่วนนี้...');

    document.getElementById('in-img').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = f => {
                document.getElementById('pv-img').src = f.target.result;
                document.getElementById('pv-img').classList.remove('hidden');
                document.getElementById('pv-no-img').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection