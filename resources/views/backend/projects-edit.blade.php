@extends('backend.layout')
@section('content')

<section class="w-full min-h-[calc(100vh-80px)] p-4 md:p-8 font-mitr bg-slate-50/50 text-slate-700">
    <div class="max-w-6xl mx-auto">
        
        {{-- 🔝 1. ส่วนหัวนำทางย้อนกลับ (Header & Back Navigation) --}}
        <div class="mb-8 border-b border-slate-100 pb-4">
            <a href="{{ route('backend.projects') }}" class="text-xs font-bold text-slate-400 hover:text-[#5EBEE6] transition-all flex items-center gap-1.5 mb-2 group w-fit">
                <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-0.5"></i> กลับไปหน้าจัดการโครงงาน
            </a>
            <div class="flex items-center gap-2.5">
                <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">แก้ไขข้อมูลโครงงาน: <span class="text-[#5EBEE6]">{{ $project->name }}</span></h2>
            </div>
        </div>

        {{-- 📊 2. ส่วนแบ่ง Layout ฟอร์มแก้ไขข้อมูล และ กล่อง Live Preview --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            {{-- ฝั่งซ้าย: ฟอร์มแก้ไขรายละเอียดโครงงาน (lg:col-span-8) --}}
            <div class="lg:col-span-8">
                <form action="{{ route('backend.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" 
                    class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] space-y-5">
                    @csrf
                    @method('PUT')
                    
                    {{-- ชื่อโครงงาน --}}
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">ชื่อโครงงานวิชาสตรีม <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="in-name" value="{{ $project->name }}" required
                            class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                    </div>

                    {{-- ชื่อทีม และ จำนวนสมาชิก --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">ชื่อกลุ่ม / ชื่อทีม <span class="text-rose-500">*</span></label>
                            <input type="text" name="team_name" id="in-team" value="{{ $project->team_name }}" required
                                class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">จำนวนสมาชิกที่เปิดรับสมัครสูงสุด <span class="text-rose-500">*</span></label>
                            <input type="number" name="max_members" id="in-max" value="{{ $project->max_members }}" required min="1"
                                class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-bold outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                        </div>
                    </div>

                    {{-- 🛠️ แท็กหมวดหมู่โครงงาน (เปิดสิทธิ์ พิมพ์สดเพื่อสร้างแท็กใหม่ได้ทันที) --}}
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">แท็กหมวดหมู่โครงงาน (พิมพ์คำใหม่แล้วกด Enter เพื่อเพิ่มแท็กสดได้) <span class="text-emerald-500 text-[10px] font-bold">(พิมพ์สร้างใหม่ได้)</span></label>
                        <select name="tags[]" id="tags-select" placeholder="เลือกแท็กเดิม หรือพิมพ์คำใหม่แล้วกด Enter..." multiple autocomplete="off" class="w-full">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, $currentTags ?? []) ? 'selected' : '' }}>
                                    #{{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- อาจารย์ที่ปรึกษา --}}
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">อาจารย์คุณครูที่ปรึกษาโครงงาน</label>
                        <select name="advisors[]" id="advisors-select" placeholder="พิมพ์คีย์เวิร์ดเพื่อค้นหาชื่อคุณครู..." multiple autocomplete="off">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ in_array($user->id, $currentAdvisors ?? []) ? 'selected' : '' }}>
                                    {{ $user->first_name }} {{ $user->last_name }} ({{ $user->nickname }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status ของโครงงาน --}}
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">สถานะคิวดำเนินงานโครงงาน <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <select name="status" id="in-status" required class="appearance-none w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-bold text-slate-600 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 cursor-pointer transition-all">
                                <option value="in_progress" {{ $project->status == 'in_progress' ? 'selected' : '' }}>กำลังดำเนินการ (In Progress)</option>
                                <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>สำเร็จการศึกษาแล้ว (Completed)</option>
                                <option value="canceled" {{ $project->status == 'canceled' ? 'selected' : '' }}>ยกเลิกโครงการ (Canceled)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <i class="fa-solid fa-chevron-down text-[10px]"></i>
                            </div>
                        </div>
                    </div>

                    {{-- รายละเอียดโครงงาน --}}
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">คำอธิบายรายละเอียดโครงงานพอสังเขป</label>
                        <textarea name="description" rows="4" placeholder="ระบุเนื้อหาวัตถุประสงค์ที่มาและไป..." 
                            class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 min-h-[100px] resize-none transition-all text-slate-700">{{ $project->description }}</textarea>
                    </div>

                    {{-- เปลี่ยนรูปภาพโครงงาน --}}
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 pl-0.5">เปลี่ยนรูปภาพประกอบหน้าโครงงานใหม่</label>
                        <input type="file" name="file_upload" id="in-img" accept="image/*"
                            class="w-full px-4 py-2.5 bg-white border border-slate-100 rounded-xl text-xs text-slate-400 font-medium file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-[#5EBEE6] hover:file:bg-blue-100/50 cursor-pointer transition-all shadow-sm">
                    </div>

                    {{-- ปุ่มกดยืนยัน Action Buttons --}}
                    <div class="pt-5 border-t border-slate-50 flex gap-3">
                        <button type="submit" class="flex-1 bg-slate-900 hover:bg-slate-800 text-white py-3 rounded-xl text-xs font-bold shadow-md transition-all active:scale-95">
                            <i class="fa-regular fa-floppy-disk mr-1"></i> อัปเดตบันทึกข้อมูลโครงงาน
                        </button>
                        <a href="{{ route('backend.projects') }}" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-500 py-3 rounded-xl text-xs font-bold text-center transition-all active:scale-95 flex items-center justify-center">
                            ยกเลิก
                        </a>
                    </div>
                </form>
            </div>

            {{-- ฝั่งขวา: กล่องแสดงตัวอย่างผลงานแบบ Real-time Live Preview --}}
            <div class="lg:col-span-4">
                <p class="text-xs font-bold text-slate-400 mb-3 flex items-center gap-1.5 pl-0.5 uppercase tracking-wider">
                    <i class="fa-solid fa-desktop text-[#5EBEE6]"></i> การแสดงผลบนเว็บไซต์ (Live Preview)
                </p>
                
                <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-lg space-y-4 group">
                    <div class="aspect-video bg-slate-50 border border-slate-100 rounded-xl overflow-hidden relative">
                        <img id="pv-img" src="{{ $project->file_path ? asset($project->file_path) : '' }}" class="w-full h-full object-cover {{ $project->file_path ? '' : 'hidden' }}">
                        <div id="pv-no-img" class="w-full h-full flex flex-col items-center justify-center text-slate-300 {{ $project->file_path ? 'hidden' : '' }}">
                            <i class="fa-regular fa-image text-3xl mb-1.5 text-slate-200"></i>
                            <span class="text-[10px] font-bold text-slate-400 tracking-wide">ยังไม่ได้อัปโหลดภาพ</span>
                        </div>
                        <div class="absolute top-2.5 left-2.5 bg-slate-900/70 backdrop-blur-sm px-2.5 py-1 rounded-md text-[9px] text-emerald-400 font-bold uppercase tracking-wider border border-white/10">
                            <span class="w-1 h-1 rounded-full bg-emerald-400 inline-block mr-1"></span>
                            <span id="pv-status">
                                {{ $project->status == 'completed' ? 'Completed' : ($project->status == 'canceled' ? 'Canceled' : 'In Progress') }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-3 pt-1">
                        <span class="inline-block text-[9px] bg-blue-50 border border-blue-100/50 text-[#5EBEE6] px-2.5 py-0.5 rounded-md font-bold uppercase tracking-widest" id="pv-team">{{ $project->team_name ?? 'TEAM NAME' }}</span>
                        
                        {{-- พื้นที่แสดงรายการแฮชแท็กจำลองแบบเรียลไทม์บนการ์ดพรีวิว --}}
                        <div id="pv-tags" class="flex flex-wrap gap-1 text-[9px] font-bold text-[#5EBEE6]">
                            @forelse($project->tags as $t)
                                <span class="bg-slate-50 border border-slate-100 px-1.5 py-0.5 rounded-md text-slate-500">#{{ $t->name }}</span>
                            @empty
                            @endforelse
                        </div>

                        <h3 class="text-sm font-bold text-slate-800 line-clamp-1 group-hover:text-[#5EBEE6] transition-colors leading-snug" id="pv-name">{{ $project->name }}</h3>
                        
                        <div class="space-y-1.5 border-t border-slate-50 pt-2.5 text-[11px] text-slate-400 font-medium">
                            <p class="flex items-center gap-1.5">
                                <i class="fa-solid fa-user-tie text-[10px] text-slate-300"></i> คุณครูที่ปรึกษา: 
                                <span id="pv-advisor" class="font-bold text-slate-600">
                                    @forelse($project->advisors as $adv)
                                        {{ $adv->first_name }} {{ $adv->last_name }}@if (!$loop->last), @endif
                                    @empty
                                        รอระบุข้อมูล
                                    @endforelse
                                </span>
                            </p>
                            <p class="flex items-center gap-1.5"><i class="fa-solid fa-users text-[10px] text-slate-300"></i> โควตาเปิดรับ: <span class="font-bold text-slate-700">0 / <span id="pv-max">{{ $project->max_members }}</span> คน</span></p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

{{-- 🛠️ สคริปต์เปิดโหมดสร้างค่าป้ายแท็กแบบพิมพ์สดแบบพรีเมียม --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof TomSelect !== "undefined") {
            // คอนฟิกตัวจัดการแท็กแบบพิมพ์เพิ่มลบได้สดๆ
            const tagSelect = new TomSelect('#tags-select', {
                plugins: ['remove_button'],
                create: true, // 🌟 เปิดใช้งานให้พิมพ์คำใหม่แล้วกด Enter เพื่อสร้างแท็กสดได้ทันที!
                createOnBlur: true,
                onChange: function(values) {
                    const container = document.getElementById('pv-tags');
                    container.innerHTML = '';
                    
                    this.control.querySelectorAll('.item').forEach(item => {
                        const span = document.createElement('span');
                        span.className = 'bg-slate-50 border border-slate-100 px-1.5 py-0.5 rounded-md text-slate-500 mr-1';
                        // ลบไอคอนกากบาทของป้ายออกเพื่อดึงเฉพาะข้อความแท็ก
                        span.innerText = item.innerText.replace('×', '').trim();
                        if(!span.innerText.startsWith('#')) {
                            span.innerText = '#' + span.innerText;
                        }
                        container.appendChild(span);
                    });
                }
            });

            new TomSelect('#advisors-select', {
                plugins: ['remove_button'],
                create: false
            });
        }

        // ระบบ Sync ข้อมูลเบื้องต้น
        const syncInput = (inputId, targetId) => {
            const input = document.getElementById(inputId);
            if (input) {
                input.addEventListener('input', (e) => {
                    document.getElementById(targetId).innerText = e.target.value || '...';
                });
            }
        };
        syncInput('in-name', 'pv-name');
        syncInput('in-team', 'pv-team');
        syncInput('in-max', 'pv-max');

        document.getElementById('in-status').addEventListener('change', function(e) {
            const val = e.target.value;
            document.getElementById('pv-status').innerText = val === 'completed' ? 'Completed' : (val === 'canceled' ? 'Canceled' : 'In Progress');
        });

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
    });
</script>

@endsection