@extends('profile.profile-layout')

@section('profile-content')
    <div class="text-slate-700 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <div class="lg:col-span-4 space-y-4">
                <div class="bg-white rounded-xl border border-gray-100 p-6 flex flex-col items-center shadow-sm">
                    <form action="{{ route('profile.upload.image') }}" method="POST" enctype="multipart/form-data"
                        id="profile-image-form" class="hidden">
                        @csrf
                        <input type="file" name="profile_image" id="profile-input" accept="image/*"
                            onchange="document.getElementById('profile-image-form').submit()">
                    </form>

                    <div class="relative mb-4">
                        <div class="w-32 h-32 rounded-full border-2 border-[#5EBEE6]/20 overflow-hidden shadow-sm bg-white">
                            @if (Auth::user()->profile && file_exists(public_path('assets/img/profile/' . Auth::user()->profile)))
                                <img src="{{ asset('assets/img/profile/' . Auth::user()->profile) }}"
                                    id="avatar-preview" class="w-full h-full object-cover" alt="Profile ของ {{ Auth::user()->nickname }}">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nickname ?? Auth::user()->name) }}&background=EBF4FF&color=5EBEE6&size=128"
                                    id="avatar-preview" class="w-full h-full object-cover" alt="Default Profile">
                            @endif
                        </div>
                    </div>

                    <h3 class="text-base text-slate-800 mb-0.5">{{ Auth::user()->name }}</h3>
                    <p class="text-xs text-gray-400 mb-4">
                        {{ Auth::user()->grade_level == 'M4' ? 'มัธยมศึกษาปีที่ 4' : (Auth::user()->grade_level == 'M5' ? 'มัธยมศึกษาปีที่ 5' : 'มัธยมศึกษาปีที่ 6') }}
                    </p>

                    <button type="button" onclick="document.getElementById('profile-input').click()"
                        class="w-full py-1.5 border border-gray-200 rounded-full text-xs font-medium text-gray-500 hover:bg-gray-50 transition-colors mb-6">
                        เปลี่ยนรูปโปรไฟล์
                    </button>

                    <div class="w-full space-y-1">
                        <div class="flex justify-between text-[10px] font-medium px-1">
                            <span class="text-gray-400 italic">ความสมบูรณ์ของโปรไฟล์</span>
                            <span id="completeness-text" class="text-[#5EBEE6]">0%</span>
                        </div>
                        <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div id="completeness-bar" class="w-[0%] h-full bg-[#5EBEE6] rounded-full shadow-[0_0_8px_rgba(94,190,230,0.4)] transition-all duration-500">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="bg-white rounded-xl border border-gray-100 p-3 flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 flex items-center justify-center bg-gray-50 rounded-lg">
                                <i class="fa-brands fa-google text-red-500 text-sm"></i>
                            </div>
                            <span class="text-xs text-slate-600">เข้าสู่ระบบด้วย Google</span>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 bg-red-100 text-red-500 rounded">เร็วๆนี้</span>
                    </div>

                    <div class="bg-white rounded-xl border border-gray-100 p-3 flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 flex items-center justify-center bg-gray-50 rounded-lg">
                                <i class="fa-brands fa-discord text-[#5865F2] text-sm"></i>
                            </div>
                            <span class="text-xs text-slate-600">เข้าสู่ระบบด้วย Discord</span>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 bg-red-100 text-red-500 rounded">เร็วๆนี้</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8">
                <form action="{{ route('profile.update') }}" method="POST" id="profile-update-form"
                    class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm h-full">
                    @csrf
                    @method('PUT')

                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-lg text-slate-700">ข้อมูลส่วนตัว</h2>
                        <button type="submit"
                            class="px-5 py-1.5 bg-[#5EBEE6] text-white rounded-lg text-xs hover:bg-[#4fb1d8] transition-all">
                            บันทึกข้อมูล
                        </button>
                    </div>

                    <div class="grid grid-cols-12 gap-x-6 gap-y-5">

                        <div class="col-span-12 md:col-span-4 space-y-5">
                            <div class="space-y-1.5">
                                <label class="text-[11px] text-gray-400">คำนำหน้า</label>
                                <select name="prefix" id="field_prefix"
                                    class="w-full bg-white border border-gray-200 text-xs rounded-lg px-3 py-2 outline-none focus:border-[#5EBEE6] transition-all profile-completeness-field">
                                    <option value="" {{ Auth::user()->prefix == '' ? 'selected' : '' }}>ไม่ระบุ</option>
                                    <option value="นาย" {{ Auth::user()->prefix == 'นาย' ? 'selected' : '' }}>นาย</option>
                                    <option value="นางสาว" {{ Auth::user()->prefix == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                                </select>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[11px] text-gray-400">ระดับชั้น</label>
                                <select name="grade_level" id="field_grade_level"
                                    class="w-full bg-white border border-gray-200 text-xs rounded-lg px-3 py-2 outline-none focus:border-[#5EBEE6] transition-all profile-completeness-field">
                                    <option value="M4" {{ Auth::user()->grade_level == 'M4' ? 'selected' : '' }}>มัธยมศึกษาปีที่ 4</option>
                                    <option value="M5" {{ Auth::user()->grade_level == 'M5' ? 'selected' : '' }}>มัธยมศึกษาปีที่ 5</option>
                                    <option value="M6" {{ Auth::user()->grade_level == 'M6' ? 'selected' : '' }}>มัธยมศึกษาปีที่ 6</option>
                                </select>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[11px] text-gray-400">วิชาที่ชอบ</label>
                                <select name="favorite_subject" id="field_favorite_subject"
                                    class="w-full bg-white border border-gray-200 text-xs rounded-lg px-3 py-2 outline-none focus:border-[#5EBEE6] transition-all profile-completeness-field">
                                    <option value="พละศึกษา" {{ Auth::user()->favorite_subject == 'พละศึกษา' ? 'selected' : '' }}>พละศึกษา</option>
                                    <option value="คอมพิวเตอร์" {{ Auth::user()->favorite_subject == 'คอมพิวเตอร์' ? 'selected' : '' }}>คอมพิวเตอร์</option>
                                    <option value="คณิตศาสตร์" {{ Auth::user()->favorite_subject == 'คณิตศาสตร์' ? 'selected' : '' }}>คณิตศาสตร์</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-8">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-[11px] text-gray-400">ชื่อ</label>
                                    <input type="text" name="first_name" id="field_first_name"
                                        value="{{ old('first_name', Auth::user()->first_name) }}" placeholder="ชื่อจริง"
                                        class="w-full border border-gray-100 text-xs rounded-lg px-3 py-2 outline-none focus:border-[#5EBEE6] profile-completeness-field">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] text-gray-400">นามสกุล</label>
                                    <input type="text" name="last_name" id="field_last_name"
                                        value="{{ old('last_name', Auth::user()->last_name) }}" placeholder="นามสกุล"
                                        class="w-full border border-gray-100 text-xs rounded-lg px-3 py-2 outline-none focus:border-[#5EBEE6] profile-completeness-field">
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-[11px] text-gray-400">ชื่อเล่น</label>
                                    <input type="text" name="nickname" id="field_nickname"
                                        value="{{ old('nickname', Auth::user()->nickname) }}" placeholder="ชื่อเล่น"
                                        class="w-full border border-gray-100 text-xs rounded-lg px-3 py-2 outline-none focus:border-[#5EBEE6] profile-completeness-field">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] text-gray-400">รหัสประจำตัว</label>
                                    <input type="text" name="student_id" id="field_student_id"
                                        value="{{ old('student_id', Auth::user()->student_id) }}" placeholder="รหัสประจำตัว"
                                        class="w-full border border-gray-100 text-xs rounded-lg px-3 py-2 outline-none focus:border-[#5EBEE6] profile-completeness-field">
                                </div>

                                <div class="col-span-2 space-y-1.5">
                                    <label class="text-[11px] text-gray-400">แนะนำตัว</label>
                                    <textarea name="bio" id="field_bio" rows="3" placeholder="เล่าเกี่ยวกับตัวเอง" maxlength="200"
                                        class="w-full border border-gray-100 text-xs rounded-lg px-3 py-2 outline-none focus:border-[#5EBEE6] resize-none profile-completeness-field">{{ old('bio', Auth::user()->bio) }}</textarea>
                                    <div class="text-right text-[9px] text-gray-300">
                                        <span id="bio-count">0</span> / 200
                                    </div>
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-[11px] text-gray-400">โรงเรียน</label>
                                    <select name="school_name" id="field_school_name"
                                        class="w-full border border-gray-100 text-xs rounded-lg px-3 py-2 outline-none focus:border-[#5EBEE6] profile-completeness-field">
                                        <option value="ชลประทานวิทยา" {{ Auth::user()->school_name == 'ชลประทานวิทยา' ? 'selected' : '' }}>ชลประทานวิทยา</option>
                                    </select>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] text-gray-400">มหาวิทยาลัยในฝัน</label>
                                    <select name="dream_university" id="field_dream_university"
                                        class="w-full border border-gray-100 text-xs rounded-lg px-3 py-2 outline-none focus:border-[#5EBEE6] profile-completeness-field">
                                        <option value="มหาวิทยาลัย" {{ Auth::user()->dream_university == 'มหาวิทยาลัย' ? 'selected' : '' }}>มหาวิทยาลัย</option>
                                        <option value="จุฬาลงกรณ์มหาวิทยาลัย" {{ Auth::user()->dream_university == 'จุฬาลงกรณ์มหาวิทยาลัย' ? 'selected' : '' }}>จุฬาลงกรณ์มหาวิทยาลัย</option>
                                        <option value="มหาวิทยาลัยเกษตรศาสตร์" {{ Auth::user()->dream_university == 'มหาวิทยาลัยเกษตรศาสตร์' ? 'selected' : '' }}>มหาวิทยาลัยเกษตรศาสตร์</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const bioField = document.getElementById('field_bio');
            const bioCount = document.getElementById('bio-count');
            
            if(bioField && bioCount) {
                bioCount.textContent = bioField.value.length;
                bioField.addEventListener('input', function() {
                    bioCount.textContent = this.value.length;
                });
            }

            function calculateCompleteness() {
                const fields = document.querySelectorAll('.profile-completeness-field');
                const avatar = document.getElementById('avatar-preview');
                
                let filledCount = 0;
                let totalFields = fields.length + 1;


                fields.forEach(field => {
                    if (field.value.trim() !== '') {
                        filledCount++;
                    }
                });

                if (avatar && !avatar.src.includes('ui-avatars.com')) {
                    filledCount++;
                }

                const percentage = Math.round((filledCount / totalFields) * 100);
                
                const textDisplay = document.getElementById('completeness-text');
                const barDisplay = document.getElementById('completeness-bar');
                
                if (textDisplay && barDisplay) {
                    textDisplay.textContent = percentage + '%';
                    barDisplay.style.width = percentage + '%';
                }
            }

            calculateCompleteness();

            const completenessFields = document.querySelectorAll('.profile-completeness-field');
            completenessFields.forEach(field => {
                field.addEventListener('change', calculateCompleteness);
                field.addEventListener('input', calculateCompleteness);
            });
        });
    </script>
@endsection