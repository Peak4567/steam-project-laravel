@extends('backend.layout')
@section('content')
    <section class="w-full min-h-[calc(100vh-80px)] p-4 md:p-8 font-mitr bg-slate-50/50">
        <div class="max-w-6xl mx-auto">
            
            {{-- 🔝 1. ส่วนหัวนำทางย้อนกลับ (Header & Back Navigation) --}}
            <div class="mb-8 border-b border-slate-100 pb-4">
                <a href="{{ route('backend.activity') }}"
                    class="text-xs font-bold text-slate-400 hover:text-[#5EBEE6] transition-all flex items-center gap-1.5 mb-2 group w-fit">
                    <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-0.5"></i> กลับไปหน้าจัดการกิจกรรม
                </a>
                <div class="flex items-center gap-2.5">
                    <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                    <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">
                        {{ isset($activity) ? 'แก้ไขข้อมูลกิจกรรม Workshop' : 'สร้างลงทะเบียนกิจกรรมใหม่' }}
                    </h2>
                </div>
            </div>

            {{-- 📊 2. ส่วนแบ่ง Layout ฟอร์มกรอกข้อมูล และ กล่อง Live Preview (2/3 กับ 1/3) --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                {{-- ฝั่งซ้าย: ฟอร์มจัดการรายละเอียดกิจกรรม (lg:col-span-8) --}}
                <div class="lg:col-span-8">
                    <form
                        action="{{ isset($activity) ? route('backend.activity.update', $activity->id) : route('backend.activity.store') }}"
                        method="POST" enctype="multipart/form-data"
                        class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] space-y-5">
                        @csrf
                        @if (isset($activity))
                            @method('PUT')
                        @endif

                        {{-- ชื่อกิจกรรม --}}
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">ชื่อหัวข้อกิจกรรม / Workshop <span class="text-rose-500">*</span></label>
                            <input type="text" name="title" id="in-title" value="{{ $activity->title ?? '' }}" required placeholder="เช่น อบรมเชิงปฏิบัติการการพัฒนาโมเดล AI เบื้องต้น"
                                class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                        </div>

                        {{-- คัดเลือกวิทยากร (TomSelect Multiple) --}}
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">วิทยากรผู้บรรยายหลัก <span class="text-slate-400 font-medium">(ค้นหารายชื่อและเลือกได้มากกว่า 1 คน)</span></label>
                            <select id="lecturer_ids" name="lecturer_ids[]" multiple placeholder="พิมพ์คีย์เวิร์ดเพื่อค้นหาชื่อวิทยากร..." autocomplete="off">
                                @foreach ($lecturers as $user)
                                    <option value="{{ $user->id }}"
                                        {{ isset($activity) && $activity->lecturers->contains($user->id) ? 'selected' : '' }}>
                                        {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- หมวดหมู่ และ สถานที่ --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-slate-500 pl-0.5">หมวดหมู่กิจกรรม</label>
                                <input type="text" name="category" id="in-cat" value="{{ $activity->category ?? '' }}" placeholder="เช่น คอมพิวเตอร์, หุ่นยนต์, ศิลปะ"
                                    class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                            </div>
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-slate-500 pl-0.5">สถานที่จัดกิจกรรม <span class="text-rose-500">*</span></label>
                                <input type="text" name="location" id="in-loc" value="{{ $activity->location ?? '' }}" required placeholder="เช่น ห้องปฏิบัติการคอมพิวเตอร์ 4"
                                    class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                            </div>
                        </div>

                        {{-- วันที่, ช่วงเวลา, จำนวนรับสมัคร --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-slate-500 pl-0.5">วันที่จัดงาน <span class="text-rose-500">*</span></label>
                                <input type="date" name="date" id="in-date" value="{{ $activity->date ?? '' }}" required
                                    class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-bold outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700 cursor-pointer">
                            </div>
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-slate-500 pl-0.5">ช่วงเวลาการจัด <span class="text-rose-500">*</span></label>
                                <input type="text" name="time_range" id="in-time" value="{{ $activity->time_range ?? '' }}" required placeholder="09:00 - 16:30"
                                    class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                            </div>
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-slate-500 pl-0.5">ที่นั่ง/จำนวนเปิดรับ <span class="text-rose-500">*</span></label>
                                <input type="number" name="max_participants" id="in-max" value="{{ $activity->max_participants ?? 30 }}" required
                                    class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-bold outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                            </div>
                        </div>

                        {{-- รายละเอียดเพิ่มเติม --}}
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">รายละเอียดและข้อกำหนดกิจกรรม</label>
                            <textarea name="description" rows="4" placeholder="ระบุขอบเขตเนื้อหา สิ่งที่นักเรียนจะได้รับจากการเข้าร่วม หรือสิ่งที่ต้องเตรียมพร้อมมาล่วงหน้า..."
                                class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 min-h-[100px] resize-none transition-all text-slate-700">{{ $activity->description ?? '' }}</textarea>
                        </div>

                        {{-- ภาพปก --}}
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">ภาพถ่ายหน้าปกโปสเตอร์โปรโมทกิจกรรม</label>
                            <input type="file" name="image" id="in-img" accept="image/*"
                                class="w-full px-4 py-2.5 bg-white border border-slate-100 rounded-xl text-xs text-slate-400 font-medium file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-[#5EBEE6] hover:file:bg-blue-100/50 cursor-pointer transition-all shadow-sm">
                        </div>

                        {{-- ปุ่มคำสั่ง Action Buttons (โชว์เด่นชัดถาวร ไม่ซ่อนซ้อนรูปลักษณ์) --}}
                        <div class="pt-5 border-t border-slate-50 flex gap-3">
                            <button type="submit" class="flex-1 bg-slate-900 hover:bg-slate-800 text-white py-3 rounded-xl text-xs font-bold shadow-md transition-all active:scale-95">
                                <i class="fa-regular fa-floppy-disk mr-1"></i> {{ isset($activity) ? 'อัปเดตบันทึกข้อมูลกิจกรรม' : 'บันทึกกิจกรรมขึ้นระบบหลัก' }}
                            </button>
                            <a href="{{ route('backend.activity') }}" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-500 py-3 rounded-xl text-xs font-bold text-center transition-all active:scale-95">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>

                {{-- ฝั่งขวา: กล่องแสดงตัวอย่างผลงานแบบ Real-time Live Preview (lg:col-span-4) --}}
                <div class="lg:col-span-4">
                    <p class="text-xs font-bold text-slate-400 mb-3 flex items-center gap-1.5 pl-0.5 uppercase tracking-wider">
                        <i class="fa-solid fa-desktop text-[#5EBEE6]"></i> การแสดงผลบนเว็บไซต์ (Live Preview)
                    </p>
                    
                    <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-lg space-y-4 group">
                        {{-- พื้นที่กล่องรูปภาพปกโปสเตอร์ --}}
                        <div class="aspect-video bg-slate-50 border border-slate-100 rounded-xl overflow-hidden relative">
                            <img id="pv-img" src="{{ isset($activity->image_path) ? asset($activity->image_path) : '' }}" class="w-full h-full object-cover {{ isset($activity->image_path) ? '' : 'hidden' }}">
                            <div id="pv-no-img" class="w-full h-full flex flex-col items-center justify-center text-slate-300 {{ isset($activity->image_path) ? 'hidden' : '' }}">
                                <i class="fa-regular fa-image text-3xl mb-1.5 text-slate-200"></i>
                                <span class="text-[10px] font-bold text-slate-400 tracking-wide">ยังไม่ได้อัปโหลดภาพปก</span>
                            </div>
                        </div>

                        {{-- บล็อกอธิบายเนื้อหาจำลองตัวชี้วัด --}}
                        <div class="space-y-3 pt-1">
                            <span id="pv-cat" class="inline-block text-[9px] bg-blue-50 border border-blue-100/50 text-[#5EBEE6] px-2.5 py-0.5 rounded-md font-bold uppercase tracking-widest">{{ $activity->category ?? 'CATEGORY' }}</span>
                            <h3 id="pv-title" class="text-sm font-bold text-slate-800 line-clamp-1 group-hover:text-[#5EBEE6] transition-colors leading-snug">{{ $activity->title ?? 'ชื่อกิจกรรมจะแสดงที่ตรงนี้' }}</h3>
                            
                            <div class="space-y-1.5 border-t border-slate-50 pt-2.5 text-[11px] text-slate-400 font-medium">
                                <p class="flex items-center gap-1.5 truncate"><i class="fa-solid fa-user-tie text-[10px] text-slate-300"></i> วิทยากร: 
                                    <span id="pv-lecturer" class="font-bold text-slate-600 italic">
                                        @if (isset($activity) && $activity->lecturers->count() > 0)
                                            {{ $activity->lecturers->implode('first_name', ', ') }}
                                        @else
                                            ไม่ได้ระบุรายชื่อ
                                        @endif
                                    </span>
                                </p>
                                <p class="flex items-center gap-1.5 truncate"><i class="fa-solid fa-location-dot text-[10px] text-slate-300"></i> สถานที่: <span id="pv-loc" class="font-bold text-slate-600">{{ $activity->location ?? 'ยังไม่ได้ระบุ' }}</span></p>
                                <p class="flex items-center gap-1.5"><i class="fa-regular fa-calendar text-[10px] text-slate-300"></i> วันที่จัด: <span id="pv-date" class="font-bold text-slate-600">{{ $activity->date ?? 'ยังไม่ได้ระบุ' }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <script>
        var lecturerSelect = new TomSelect("#lecturer_ids", {
            plugins: ['remove_button'],
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            },
            onChange: function(values) {
                if (values.length > 0) {
                    const names = values.map(v => this.options[v].text.split(' (')[0]);
                    document.getElementById('pv-lecturer').innerText = names.join(', ');
                } else {
                    document.getElementById('pv-lecturer').innerText = 'ไม่ได้ระบุรายชื่อ';
                }
            }
        });

        const sync = (id, target) => document.getElementById(id).addEventListener('input', e => document.getElementById(
            target).innerText = e.target.value || '...');

        sync('in-title', 'pv-title');
        sync('in-cat', 'pv-cat');
        sync('in-loc', 'pv-loc');
        sync('in-date', 'pv-date');

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