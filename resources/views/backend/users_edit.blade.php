@extends('backend.layout')
@section('content')

<section class="w-full min-h-[calc(100vh-80px)] p-4 md:p-8 font-mitr bg-slate-50/50 text-slate-700">
    <div class="max-w-6xl mx-auto">
        
        <div class="mb-8 border-b border-slate-100 pb-4">
            <a href="{{ route('backend.users') }}" class="text-xs font-bold text-slate-400 hover:text-[#5EBEE6] transition-all flex items-center gap-1.5 mb-2 group w-fit">
                <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-0.5"></i> กลับไปหน้ารายชื่อผู้ใช้งานทั้งหมด
            </a>
            <div class="flex items-center gap-2.5">
                <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">แก้ไขข้อมูลและสิทธิ์ผู้ใช้: <span class="text-[#5EBEE6]">{{ $user->first_name }}</span></h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <div class="lg:col-span-8">
                <form action="{{ route('backend.users.update', $user->id) }}" method="POST" class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] space-y-5">
                    @csrf 
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">คำนำหน้า</label>
                            <input type="text" name="prefix" value="{{ $user->prefix }}" placeholder="เช่น นาย / นางสาว" class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">ชื่อจริง <span class="text-rose-500">*</span></label>
                            <input type="text" name="first_name" value="{{ $user->first_name }}" required class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">นามสกุล <span class="text-rose-500">*</span></label>
                            <input type="text" name="last_name" value="{{ $user->last_name }}" required class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">ชื่อเล่น <span class="text-rose-500">*</span></label>
                            <input type="text" name="nickname" value="{{ $user->nickname }}" required class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">ที่อยู่อีเมลบัญชี <span class="text-rose-500">*</span></label>
                            <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">รหัสประจำตัวนักเรียน</label>
                            <input type="text" name="student_id" value="{{ $user->student_id }}" placeholder="ระบุรหัสประจำตัว..." class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">ระดับชั้นเรียน</label>
                            <input type="text" name="grade_level" value="{{ $user->grade_level }}" placeholder="เช่น ม.5 / ม.6" class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-500 pl-0.5">ระดับสิทธิ์การเข้าถึง <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <select name="level" class="appearance-none w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-bold text-slate-600 outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 cursor-pointer transition-all">
                                    <option value="member" {{ $user->level == 'member' ? 'selected' : '' }}>Member (นักเรียน/สมาชิก)</option>
                                    <option value="teacher" {{ $user->level == 'teacher' ? 'selected' : '' }}>Teacher (อาจารย์ผู้ตรวจ)</option>
                                    <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin (ผู้ดูแลระบบสูงสุด)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1.5 bg-amber-50/40 p-4 rounded-2xl border border-amber-100/60">
                        <label class="block text-xs font-bold text-slate-600 pl-0.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-trophy text-amber-500 text-[11px]"></i> สถานะสมาชิกดีเด่น (Hall of Fame Exhibition)
                        </label>
                        <div class="relative mt-1">
                            <select name="is_hall_of_fame" class="appearance-none w-full px-4 py-3 bg-white border border-slate-100 rounded-xl text-xs font-bold text-slate-700 outline-none focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 cursor-pointer transition-all">
                                <option value="0" {{ ($user->is_hall_of_fame ?? 0) == 0 ? 'selected' : '' }}>ปิดการแสดงผลทำเนียบเกียรติยศ</option>
                                <option value="1" {{ ($user->is_hall_of_fame ?? 0) == 1 ? 'selected' : '' }}>เปิดการแสดงผลทำเนียบเกียรติยศหลัก</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <i class="fa-solid fa-chevron-down text-[10px]"></i>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-[#5EBEE6] pl-0.5"><i class="fa-solid fa-key text-[10px]"></i> ตั้งรหัสผ่านใหม่ <span class="text-slate-400 font-medium">(ปล่อยว่างไว้หากต้องการใช้รหัสผ่านเดิม)</span></label>
                        <input type="password" name="password" placeholder="••••••••" class="w-full px-4 py-3 bg-slate-50/50 border border-slate-100 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all text-slate-700">
                    </div>

                    <div class="pt-5 border-t border-slate-50 flex gap-3">
                        <button type="submit" class="flex-1 bg-slate-900 hover:bg-slate-800 text-white py-3 rounded-xl text-xs font-bold shadow-md transition-all active:scale-95">
                            <i class="fa-regular fa-floppy-disk mr-1"></i> อัปเดตข้อมูลผู้ใช้งาน
                        </button>
                        <a href="{{ route('backend.users') }}" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-500 py-3 rounded-xl text-xs font-bold text-center transition-all active:scale-95 flex items-center justify-center">
                            ยกเลิก
                        </a>
                    </div>
                </form>
            </div>

            <div class="lg:col-span-4 space-y-5 w-full">
                
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                    <div class="flex items-center gap-2 border-b border-slate-50 pb-2.5">
                        <i class="fa-solid fa-chart-pie text-[#5EBEE6] text-xs"></i>
                        <h4 class="font-extrabold text-slate-800 text-xs uppercase tracking-wider">สถิติกิจกรรมประวัติผู้ใช้</h4>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3 text-center">
                        <div class="bg-slate-50/60 p-3 rounded-xl border border-slate-100/50">
                            <span class="block text-base font-black text-slate-800">4 เล่ม</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wide">พอร์ตฟอลิโอ</span>
                        </div>
                        <div class="bg-slate-50/60 p-3 rounded-xl border border-slate-100/50">
                            <span class="block text-base font-black text-[#5EBEE6]">12 ไฟล์</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wide">แชร์ชีทสรุป</span>
                        </div>
                    </div>
                    
                    <div class="pt-1.5 text-[11px] font-medium text-slate-400 space-y-1">
                        <p class="flex justify-between"><span>วันที่สมัครสมาชิก:</span> <span class="font-bold text-slate-700">{{ $user->created_at ? date('d/m/Y', strtotime($user->created_at)) : '12/02/2026' }}</span></p>
                        <p class="flex justify-between"><span>สิทธิ์ปัจจุบัน:</span> <span class="font-bold text-[#5EBEE6] uppercase">{{ $user->level }}</span></p>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-3">
                    <div class="flex items-center gap-2 border-b border-slate-50 pb-2.5">
                        <i class="fa-solid fa-shield-halved text-amber-500 text-xs"></i>
                        <h4 class="font-extrabold text-slate-800 text-xs uppercase tracking-wider">ประวัติความปลอดภัยไอพี</h4>
                    </div>
                    
                    <div class="space-y-2 pt-1">
                        <div class="flex items-start gap-2.5 bg-slate-50/40 p-2 rounded-xl border border-slate-100/50">
                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-400 mt-1.5 shrink-0"></div>
                            <div class="text-[10px] leading-normal font-medium">
                                <p class="font-bold text-slate-700">ล็อกอินล่าสุดสำเร็จ (Chrome/Windows)</p>
                                <p class="text-slate-400 mt-0.5">IP: 182.52.4.110 • วันนี้</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</section>

@endsection