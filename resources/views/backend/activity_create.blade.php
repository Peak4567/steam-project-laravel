@extends('backend.layout')
@section('content')
    <section class="w-full min-h-[calc(100vh-80px)] p-6 md:p-10 font-kanit bg-gray-50/50">
        <div class="max-w-6xl mx-auto">
            <div class="mb-8">
                <a href="{{ route('backend.activity') }}"
                    class="text-sm font-medium text-gray-400 hover:text-[#5EBEE6] transition-colors flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-arrow-left"></i> กลับไปหน้าจัดการกิจกรรม
                </a>
                <h2 class="text-2xl font-bold text-slate-800">
                    {{ isset($activity) ? 'แก้ไขกิจกรรม' : 'เพิ่มกิจกรรมใหม่' }}
                </h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <div class="w-full lg:w-2/3">
                    <form
                        action="{{ isset($activity) ? route('backend.activity.update', $activity->id) : route('backend.activity.store') }}"
                        method="POST" enctype="multipart/form-data"
                        class="bg-white p-6 md:p-8 rounded-md border border-gray-100 shadow-sm space-y-5">
                        @csrf
                        @if (isset($activity))
                            @method('PUT')
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">ชื่อกิจกรรม <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="title" id="in-title" value="{{ $activity->title ?? '' }}"
                                required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:outline-none focus:border-[#5EBEE6]">
                        </div>

                        {{-- 🌟 ส่วนที่แก้: เปลี่ยนเป็น Multiple เพื่อให้เลือกวิทยากรได้หลายคน 🌟 --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">วิทยากร
                                (ค้นหาชื่อและเลือกได้หลายคน)</label>
                            <select id="lecturer_ids" name="lecturer_ids[]" multiple
                                placeholder="พิมพ์เพื่อค้นหาชื่อวิทยากร..." autocomplete="off">
                                @foreach ($lecturers as $user)
                                    <option value="{{ $user->id }}"
                                        {{ isset($activity) && $activity->lecturers->contains($user->id) ? 'selected' : '' }}>
                                        {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1.5">หมวดหมู่</label>
                                <input type="text" name="category" id="in-cat" value="{{ $activity->category ?? '' }}"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:outline-none focus:border-[#5EBEE6]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1.5">สถานที่ <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="location" id="in-loc"
                                    value="{{ $activity->location ?? '' }}" required
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:outline-none focus:border-[#5EBEE6]">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1.5">วันที่จัด <span
                                        class="text-red-500">*</span></label>
                                <input type="date" name="date" id="in-date" value="{{ $activity->date ?? '' }}"
                                    required
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:outline-none focus:border-[#5EBEE6]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1.5">ช่วงเวลา <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="time_range" id="in-time"
                                    value="{{ $activity->time_range ?? '' }}" required placeholder="09.00 - 17.00"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:outline-none focus:border-[#5EBEE6]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1.5">จำนวนรับ <span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="max_participants" id="in-max"
                                    value="{{ $activity->max_participants ?? 30 }}" required
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:outline-none focus:border-[#5EBEE6]">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">รายละเอียด</label>
                            <textarea name="description" rows="4"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:outline-none focus:border-[#5EBEE6]">{{ $activity->description ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">รูปหน้าปก
                                ({{ isset($activity) ? 'อัปโหลดใหม่เพื่อเปลี่ยน' : 'อัปโหลดรูปภาพ' }})</label>
                            <input type="file" name="image" id="in-img" accept="image/*"
                                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-500 file:mr-4 file:py-1.5 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-[#5EBEE6] cursor-pointer">
                        </div>

                        <div class="pt-6 border-t border-gray-50 flex gap-3">
                            <button type="submit"
                                class="flex-1 bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white py-2.5 rounded-md font-medium shadow-sm transition-all">
                                {{ isset($activity) ? 'อัปเดตข้อมูล' : 'บันทึกกิจกรรม' }}
                            </button>
                        </div>
                    </form>
                </div>

                <div class="w-full lg:w-1/3">
                    <p class="text-sm font-medium text-gray-400 mb-4 flex items-center gap-2"><i
                            class="fa-solid fa-eye"></i> ตัวอย่างการแสดงผล</p>
                    <div class="bg-white rounded-md border border-gray-100 p-4 shadow-sm space-y-4">
                        <div class="aspect-video bg-gray-100 rounded-md overflow-hidden relative">
                            <img id="pv-img"
                                src="{{ isset($activity->image_path) ? asset($activity->image_path) : '' }}"
                                class="w-full h-full object-cover {{ isset($activity->image_path) ? '' : 'hidden' }}">
                            <div id="pv-no-img"
                                class="w-full h-full flex flex-col items-center justify-center text-gray-300 {{ isset($activity->image_path) ? 'hidden' : '' }}">
                                <i class="fa-regular fa-image text-3xl"></i>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <span id="pv-cat"
                                class="text-[10px] bg-blue-50 text-[#5EBEE6] px-2 py-0.5 rounded-sm font-bold border border-blue-100 uppercase tracking-widest">{{ $activity->category ?? 'CATEGORY' }}</span>
                            <h3 id="pv-title" class="text-sm font-bold text-slate-800 line-clamp-2">
                                {{ $activity->title ?? 'ชื่อกิจกรรมจะแสดงที่นี่' }}</h3>
                            <p class="text-[10px] text-gray-400"><i class="fa-solid fa-user mr-1"></i> วิทยากร: <span
                                    id="pv-lecturer" class="font-medium text-slate-600 italic">
                                    {{-- แสดงรายชื่อวิทยากรเดิมใน Preview --}}
                                    @if (isset($activity) && $activity->lecturers->count() > 0)
                                        {{ $activity->lecturers->implode('first_name', ', ') }}
                                    @else
                                        ไม่ได้ระบุ
                                    @endif
                                </span></p>
                            <p class="text-[10px] text-gray-400"><i class="fa-solid fa-location-dot mr-1"></i> <span
                                    id="pv-loc">{{ $activity->location ?? 'สถานที่' }}</span></p>
                            <p class="text-[10px] text-gray-400"><i class="fa-regular fa-calendar mr-1"></i> <span
                                    id="pv-date">{{ $activity->date ?? 'วันที่' }}</span></p>
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
                    document.getElementById('pv-lecturer').innerText = 'ไม่ได้ระบุ';
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
