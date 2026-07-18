@extends('profile.profile-layout')

@section('profile-content')
    <div class="text-slate-700 max-w-6xl mx-auto font-mitr">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <div class="lg:col-span-4 space-y-5">
                
                <div class="bg-white rounded-2xl border border-slate-100/80 p-6 flex flex-col items-center shadow-[0_8px_30px_rgba(0,0,0,0.02)] relative">
                    <form action="{{ route('profile.upload.image') }}" method="POST" enctype="multipart/form-data"
                        id="profile-image-form" class="hidden">
                        @csrf
                        <input type="file" name="profile_image" id="profile-input" accept="image/*"
                            onchange="document.getElementById('profile-image-form').submit()">
                    </form>

                    <div class="relative mb-4 group/avatar">
                        <div class="w-28 h-24 md:w-28 md:h-28 rounded-full border-4 border-slate-50 overflow-hidden shadow-md bg-white relative">
                            @if (Auth::user()->profile && file_exists(public_path('assets/img/profile/' . Auth::user()->profile)))
                                <img src="{{ asset('assets/img/profile/' . Auth::user()->profile) }}"
                                    id="avatar-preview" class="w-full h-full object-cover" alt="Profile ของ {{ Auth::user()->nickname }}">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nickname ?? Auth::user()->name) }}&background=EBF4FF&color=5EBEE6&size=128"
                                    id="avatar-preview" class="w-full h-full object-cover" alt="Default Profile">
                            @endif
                        </div>
                    </div>

                    <h3 class="text-base font-bold text-slate-800 mb-0.5">{{ Auth::user()->name }}</h3>
                    <p class="text-xs text-slate-400 font-medium mb-4">
                        {{ Auth::user()->grade_level == 'M4' ? 'มัธยมศึกษาปีที่ 4' : (Auth::user()->grade_level == 'M5' ? 'มัธยมศึกษาปีที่ 5' : 'มัธยมศึกษาปีที่ 6') }}
                    </p>

                    <button type="button" onclick="document.getElementById('profile-input').click()"
                        class="w-full py-2 bg-slate-50 border border-slate-100 text-slate-600 rounded-xl text-xs font-bold hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] transition-all mb-5 shadow-sm">
                        เปลี่ยนรูปโปรไฟล์
                    </button>
                    <div class="w-full space-y-1.5 pt-4 border-t border-slate-50">
                        <div class="flex justify-between text-[10px] font-bold px-0.5">
                            <span class="text-slate-400 uppercase tracking-wider">Completeness</span>
                            <span id="completeness-text" class="text-[#5EBEE6]">0%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                            <div id="completeness-bar" class="w-[0%] h-full bg-gradient-to-r from-[#5EBEE6] to-blue-500 rounded-full transition-all duration-500">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100/80 p-4 space-y-2 shadow-[0_8px_30px_rgba(0,0,0,0.02)]">
                    <span class="inline-block text-[9px] font-bold text-slate-400 uppercase tracking-widest px-1 mb-1">Connections</span>
                    
                    <div class="flex items-center justify-between bg-slate-50/50 p-2.5 rounded-xl border border-slate-100/30">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-50">
                                <i class="fa-brands fa-google text-red-500 text-sm"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-700">Google Account</span>
                        </div>
                        <span class="text-[9px] font-bold px-2 py-0.5 bg-red-50 text-red-400 rounded-md border border-red-100/30 uppercase tracking-wider">Soon</span>
                    </div>

                    <div class="flex items-center justify-between bg-slate-50/50 p-2.5 rounded-xl border border-slate-100/30">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex items-center justify-center bg-white rounded-lg shadow-sm border border-slate-50">
                                <i class="fa-brands fa-discord text-[#5865F2] text-sm"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-700">Discord Connection</span>
                        </div>
                        <span class="text-[9px] font-bold px-2 py-0.5 bg-red-50 text-red-400 rounded-md border border-red-100/30 uppercase tracking-wider">Soon</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8">
                <form action="{{ route('profile.update') }}" method="POST" id="profile-update-form"
                    class="bg-white rounded-2xl border border-slate-100/80 p-6 md:p-8 shadow-[0_8px_30px_rgba(0,0,0,0.02)] h-full">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 border-b border-slate-50 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                            <h2 class="text-lg font-extrabold text-slate-800 tracking-tight">ข้อมูลส่วนตัวทั่วไป</h2>
                        </div>
                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl text-xs shadow-md transition-all active:scale-95 flex items-center justify-center gap-1.5">
                            <i class="fa-regular fa-floppy-disk"></i> บันทึกข้อมูล
                        </button>
                    </div>

                    <div class="grid grid-cols-12 gap-x-6 gap-y-5">
                        <div class="col-span-12 md:col-span-4 space-y-4">
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-500 pl-0.5">คำนำหน้า</label>
                                <select name="prefix" id="field_prefix"
                                    class="w-full bg-slate-50/50 border border-slate-100 text-slate-700 font-medium text-xs rounded-xl px-3.5 py-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all cursor-pointer profile-completeness-field">
                                    <option value="" {{ Auth::user()->prefix == '' ? 'selected' : '' }}>ไม่ระบุ</option>
                                    <option value="นาย" {{ Auth::user()->prefix == 'นาย' ? 'selected' : '' }}>นาย</option>
                                    <option value="นางสาว" {{ Auth::user()->prefix == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                                </select>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-500 pl-0.5">ระดับชั้น</label>
                                <select name="grade_level" id="field_grade_level"
                                    class="w-full bg-slate-50/50 border border-slate-100 text-slate-700 font-medium text-xs rounded-xl px-3.5 py-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all cursor-pointer profile-completeness-field">
                                    <option value="M4" {{ Auth::user()->grade_level == 'M4' ? 'selected' : '' }}>มัธยมศึกษาปีที่ 4</option>
                                    <option value="M5" {{ Auth::user()->grade_level == 'M5' ? 'selected' : '' }}>มัธยมศึกษาปีที่ 5</option>
                                    <option value="M6" {{ Auth::user()->grade_level == 'M6' ? 'selected' : '' }}>มัธยมศึกษาปีที่ 6</option>
                                </select>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-500 pl-0.5">วิชาที่ชื่นชอบ</label>
                                <select name="favorite_subject" id="field_favorite_subject"
                                    class="w-full bg-slate-50/50 border border-slate-100 text-slate-700 font-medium text-xs rounded-xl px-3.5 py-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all cursor-pointer profile-completeness-field">
                                    <option value="พละศึกษา" {{ Auth::user()->favorite_subject == 'พละศึกษา' ? 'selected' : '' }}>พละศึกษา</option>
                                    <option value="คอมพิวเตอร์" {{ Auth::user()->favorite_subject == 'คอมพิวเตอร์' ? 'selected' : '' }}>คอมพิวเตอร์</option>
                                    <option value="คณิตศาสตร์" {{ Auth::user()->favorite_subject == 'คณิตศาสตร์' ? 'selected' : '' }}>คณิตศาสตร์</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-8">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-slate-500 pl-0.5">ชื่อจริง</label>
                                    <input type="text" name="first_name" id="field_first_name"
                                        value="{{ old('first_name', Auth::user()->first_name) }}" placeholder="ป้อนชื่อจริงของคุณ"
                                        class="w-full bg-slate-50/50 border border-slate-100 text-slate-700 font-medium text-xs rounded-xl px-3.5 py-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all profile-completeness-field">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-slate-500 pl-0.5">นามสกุล</label>
                                    <input type="text" name="last_name" id="field_last_name"
                                        value="{{ old('last_name', Auth::user()->last_name) }}" placeholder="ป้อนนามสกุลของคุณ"
                                        class="w-full bg-slate-50/50 border border-slate-100 text-slate-700 font-medium text-xs rounded-xl px-3.5 py-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all profile-completeness-field">
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-slate-500 pl-0.5">ชื่อเล่น</label>
                                    <input type="text" name="nickname" id="field_nickname"
                                        value="{{ old('nickname', Auth::user()->nickname) }}" placeholder="ป้อนชื่อเล่น"
                                        class="w-full bg-slate-50/50 border border-slate-100 text-slate-700 font-medium text-xs rounded-xl px-3.5 py-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all profile-completeness-field">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-slate-500 pl-0.5">รหัสประจำตัวนักเรียน</label>
                                    <input type="text" name="student_id" id="field_student_id"
                                        value="{{ old('student_id', Auth::user()->student_id) }}" placeholder="ป้อนรหัสประจำตัว"
                                        class="w-full bg-slate-50/50 border border-slate-100 text-slate-700 font-medium text-xs rounded-xl px-3.5 py-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all profile-completeness-field">
                                </div>

                                <div class="col-span-1 sm:col-span-2 space-y-1.5">
                                    <label class="text-xs font-bold text-slate-500 pl-0.5">แนะนำตัวเองสักเล็กน้อย</label>
                                    <textarea name="bio" id="field_bio" rows="3" placeholder="เล่าเรื่องราวความสนใจ ประสบการณ์เกี่ยวกับตัวเอง..." maxlength="200"
                                        class="w-full bg-slate-50/50 border border-slate-100 text-slate-700 font-medium text-xs rounded-xl px-3.5 py-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 resize-none transition-all profile-completeness-field">{{ old('bio', Auth::user()->bio) }}</textarea>
                                    <div class="text-right text-[10px] font-bold text-slate-300 pr-1">
                                        <span id="bio-count" class="text-[#5EBEE6]">0</span> / 200
                                    </div>
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-slate-500 pl-0.5">โรงเรียนที่ศึกษา</label>
                                    <select name="school_name" id="field_school_name"
                                        class="w-full bg-slate-50/50 border border-slate-100 text-slate-700 font-medium text-xs rounded-xl px-3.5 py-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all cursor-pointer profile-completeness-field">
                                        <option value="ชลประทานวิทยา" {{ Auth::user()->school_name == 'ชลประทานวิทยา' ? 'selected' : '' }}>ชลประทานวิทยา</option>
                                    </select>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-slate-500 pl-0.5">มหาวิทยาลัยในฝัน</label>
                                    <select name="dream_university" id="field_dream_university"
                                        class="w-full bg-slate-50/50 border border-slate-100 text-slate-700 font-medium text-xs rounded-xl px-3.5 py-3 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all cursor-pointer profile-completeness-field">
                                        <option value="มหาวิทยาลัย" {{ Auth::user()->dream_university == 'มหาวิทยาลัย' ? 'selected' : '' }}>ยังไม่เลือกเป้าหมาย</option>
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