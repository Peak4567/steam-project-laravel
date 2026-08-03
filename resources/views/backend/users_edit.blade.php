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
                            <span class="block text-base font-black text-slate-800">{{ number_format($stats['portfolios']) }} เล่ม</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wide">พอร์ตฟอลิโอ</span>
                        </div>
                        <div class="bg-slate-50/60 p-3 rounded-xl border border-slate-100/50">
                            <span class="block text-base font-black text-[#5EBEE6]">{{ number_format($stats['sheets']) }} ไฟล์</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wide">แชร์ชีทสรุป</span>
                        </div>
                        <div class="bg-slate-50/60 p-3 rounded-xl border border-slate-100/50">
                            <span class="block text-base font-black text-emerald-500">{{ number_format($stats['sheet_downloads']) }}</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wide">ยอดโหลดชีท</span>
                        </div>
                        <div class="bg-slate-50/60 p-3 rounded-xl border border-slate-100/50">
                            <span class="block text-base font-black text-purple-500">{{ number_format($stats['projects']) }} ทีม</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wide">เข้าร่วมโครงงาน</span>
                        </div>
                    </div>

                    <div class="pt-1.5 text-[11px] font-medium text-slate-400 space-y-1">
                        <p class="flex justify-between"><span>วันที่สมัครสมาชิก:</span> <span class="font-bold text-slate-700">{{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') : '-' }}</span></p>
                        <p class="flex justify-between"><span>สิทธิ์ปัจจุบัน:</span> <span class="font-bold text-[#5EBEE6] uppercase">{{ $user->level }}</span></p>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-3">
                    <div class="flex items-center justify-between gap-2 border-b border-slate-50 pb-2.5">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-shield-halved text-amber-500 text-xs"></i>
                            <h4 class="font-extrabold text-slate-800 text-xs uppercase tracking-wider">ประวัติความปลอดภัยไอพี</h4>
                        </div>
                        @if($user->is_banned)
                            <span class="inline-flex items-center gap-1 bg-rose-50 border border-rose-100 text-rose-500 px-2 py-0.5 rounded-md font-bold text-[9px] uppercase"><i class="fa-solid fa-ban text-[8px]"></i> ถูกแบน</span>
                        @endif
                    </div>

                    @if($user->last_login_ip)
                        <div class="bg-slate-50/60 p-3 rounded-xl border border-slate-100/50 space-y-1">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wide">ไอพีเข้าสู่ระบบล่าสุด</p>
                            <p class="font-mono font-black text-slate-800 text-sm">{{ $user->last_login_ip }}</p>
                            <p class="text-[10px] text-slate-400">{{ \Carbon\Carbon::parse($user->last_login_at)->format('d/m/Y H:i') }} น.</p>
                        </div>

                        @if($user->is_banned)
                            <form action="{{ route('backend.users.unbanIp', $user->id) }}" method="POST" data-confirm="ยืนยันปลดแบนไอพีนี้?" data-confirm-title="ปลดแบนไอพี" data-confirm-type="safe">
                                @csrf
                                <button type="submit" class="w-full py-2.5 bg-emerald-50 hover:bg-emerald-500 hover:text-white text-emerald-600 border border-emerald-100 rounded-xl text-xs font-bold transition-all">
                                    <i class="fa-solid fa-lock-open mr-1"></i> ปลดแบนไอพีนี้
                                </button>
                                @if($user->ban_reason)
                                    <p class="text-[10px] text-slate-400 mt-1.5 text-center">เหตุผลที่แบน: {{ $user->ban_reason }}</p>
                                @endif
                            </form>
                        @else
                            <form action="{{ route('backend.users.banIp', $user->id) }}" method="POST" data-confirm="ยืนยันแบนไอพี {{ $user->last_login_ip }}?" data-confirm-title="ยืนยันการแบนไอพี" class="space-y-2">
                                @csrf
                                <input type="text" name="reason" maxlength="255" placeholder="ระบุเหตุผลในการแบน (ไม่บังคับ)"
                                    class="w-full px-3 py-2 bg-slate-50/50 border border-slate-100 rounded-xl text-[11px] font-medium outline-none focus:bg-white focus:border-rose-300 focus:ring-4 focus:ring-rose-500/10 transition-all text-slate-700">
                                <button type="submit" class="w-full py-2.5 bg-rose-50 hover:bg-rose-500 hover:text-white text-rose-600 border border-rose-100 rounded-xl text-xs font-bold transition-all">
                                    <i class="fa-solid fa-ban mr-1"></i> แบนไอพีนี้
                                </button>
                            </form>
                        @endif
                    @else
                        <p class="text-[11px] text-slate-400 font-medium text-center py-3 bg-slate-50 rounded-xl border border-dashed border-slate-100">ผู้ใช้งานรายนี้ยังไม่เคยเข้าสู่ระบบ</p>
                    @endif

                    <div class="pt-2 border-t border-slate-50 space-y-1.5">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wide mb-1.5">ประวัติเข้า-ออกระบบ (ล่าสุด 10 ครั้ง)</p>
                        @forelse($loginLogs as $log)
                            <div class="flex items-start gap-2.5 bg-slate-50/40 p-2 rounded-xl border border-slate-100/50">
                                <div class="w-1.5 h-1.5 rounded-full {{ $log->action === 'login' ? 'bg-emerald-400' : 'bg-slate-300' }} mt-1.5 shrink-0"></div>
                                <div class="text-[10px] leading-normal font-medium min-w-0">
                                    <p class="font-bold text-slate-700">{{ $log->action === 'login' ? 'เข้าสู่ระบบสำเร็จ' : 'ออกจากระบบ' }}</p>
                                    <p class="text-slate-400 mt-0.5 font-mono">{{ $log->ip_address }} • {{ $log->created_at->format('d/m/Y H:i') }}</p>
                                    <p class="text-slate-300 mt-0.5 truncate" title="{{ $log->user_agent }}">{{ \Illuminate\Support\Str::limit($log->user_agent, 60) }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-[11px] text-slate-400 font-medium text-center py-3 bg-slate-50 rounded-xl border border-dashed border-slate-100">ยังไม่มีประวัติการเข้าสู่ระบบ</p>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection