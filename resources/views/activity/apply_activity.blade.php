@extends('layout')
@section('content')

<section class="max-w-screen-xl mx-auto py-12 px-6 font-mitr bg-white">
    <div class="mb-8">
        <a href="{{ route('activity') }}" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-[#5EBEE6] transition-colors">
            <i class="fa-solid fa-chevron-left text-xs"></i> กลับไปหน้ากิจกรรม
        </a>
    </div>

    <div class="flex flex-col lg:flex-row gap-10 items-start">
        <div class="w-full lg:w-1/2">
            <div class="rounded-md border border-gray-100 overflow-hidden bg-white shadow-sm">
                <div class="aspect-video relative overflow-hidden bg-gray-100">
                    <img src="{{ $activity->image_path ? asset($activity->image_path) : asset('assets/img/default-event.jpg') }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4 bg-[#5EBEE6] text-white text-[10px] px-3 py-1 rounded-sm font-bold uppercase tracking-widest">
                        {{ $activity->category ?? 'Workshop' }}
                    </div>
                </div>

                <div class="p-8">
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">{{ $activity->title }}</h2>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8 font-light italic">
                        {{ $activity->description ?? 'ไม่มีคำอธิบายกิจกรรม' }}
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-gray-50 pt-8">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-md border border-blue-50 flex items-center justify-center text-[#5EBEE6] bg-blue-50/30">
                                <i class="fa-regular fa-calendar"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase">วันที่จัด</p>
                                <p class="text-xs font-semibold text-slate-700">{{ date('d F Y', strtotime($activity->date)) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-md border border-blue-50 flex items-center justify-center text-[#5EBEE6] bg-blue-50/30">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase">เวลา</p>
                                <p class="text-xs font-semibold text-slate-700">{{ $activity->time_range ?? 'ไม่ระบุเวลา' }} น.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2">
            <div class="rounded-md border border-gray-100 p-8 bg-white shadow-sm">
                
                @if($isRegistered)
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-slate-800 italic">ข้อมูลการสมัครของคุณ</h3>
                            @if($registration->status == 'pending')
                                <span class="px-4 py-1 bg-amber-100 text-amber-600 text-[10px] font-bold rounded-full uppercase tracking-widest border border-amber-200">Pending</span>
                            @elseif($registration->status == 'approved')
                                <span class="px-4 py-1 bg-emerald-100 text-emerald-600 text-[10px] font-bold rounded-full uppercase tracking-widest border border-emerald-200">Approved</span>
                            @elseif($registration->status == 'rejected')
                                <span class="px-4 py-1 bg-rose-100 text-rose-600 text-[10px] font-bold rounded-full uppercase tracking-widest border border-rose-200">Rejected</span>
                            @endif
                        </div>

                        <div class="bg-gray-50 rounded-md p-6 space-y-4 border border-gray-100">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">ชั้น / เลขที่</p>
                                    <p class="text-sm font-medium text-slate-700">{{ $registration->class_room }} เลขที่ {{ $registration->student_no }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">เบอร์โทรศัพท์</p>
                                    <p class="text-sm font-medium text-slate-700">{{ $registration->phone }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">SOP ที่ส่งสมัคร</p>
                                <p class="text-xs text-slate-600 leading-relaxed font-light">{{ $registration->note }}</p>
                            </div>
                        </div>

                        <div class="mt-8">
                            @if($registration->status == 'approved')
                                <div class="w-full bg-emerald-500 text-white py-4 rounded-md font-bold text-sm text-center uppercase tracking-[0.2em] shadow-md flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-circle-check"></i> Registration Confirmed
                                </div>
                            @elseif($registration->status == 'pending')
                                <div class="w-full bg-gray-100 text-gray-500 py-4 rounded-md font-bold text-sm text-center uppercase tracking-[0.2em] border border-gray-200">
                                    Waiting for Review
                                </div>
                            @else
                                <div class="w-full bg-rose-50 text-rose-500 border border-rose-200 py-4 rounded-md font-bold text-sm text-center uppercase tracking-[0.2em]">
                                    Application Rejected
                                </div>
                            @endif
                        </div>
                    </div>

                @else
                    <div class="mb-8 border-b border-gray-50 pb-6">
                        <h3 class="text-xl font-bold text-slate-800 italic">สมัครเข้าร่วมกิจกรรม</h3>
                        <p class="text-xs text-gray-400 mt-1 uppercase tracking-tighter font-bold">Registration Form</p>
                    </div>

                    <form action="{{ route('activity.apply.submit', $activity->id) }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2 tracking-widest">ชื่อ - นามสกุล</label>
                                    <input type="text" value="{{ Auth::check() ? (Auth::user()->first_name . ' ' . Auth::user()->last_name) : 'กรุณาเข้าสู่ระบบ' }}" readonly 
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-md text-sm text-gray-500 cursor-not-allowed">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2 tracking-widest">อีเมล</label>
                                    <input type="email" value="{{ Auth::check() ? Auth::user()->email : '-' }}" readonly 
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-md text-sm text-gray-500 cursor-not-allowed">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2 tracking-widest">ชั้น (เช่น ม.6/3) <span class="text-red-500">*</span></label>
                                    <input type="text" name="class_room" required placeholder="ม.6/3"
                                           class="w-full px-4 py-3 bg-white border border-gray-200 rounded-md text-sm focus:border-[#5EBEE6] focus:outline-none transition-all">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2 tracking-widest">เลขที่ <span class="text-red-500">*</span></label>
                                    <input type="text" name="student_no" required placeholder="01"
                                           class="w-full px-4 py-3 bg-white border border-gray-200 rounded-md text-sm focus:border-[#5EBEE6] focus:outline-none transition-all">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2 tracking-widest">เบอร์โทรศัพท์ <span class="text-red-500">*</span></label>
                                <input type="tel" name="phone" required placeholder="0XX-XXX-XXXX"
                                       class="w-full px-4 py-3 bg-white border border-gray-200 rounded-md text-sm focus:border-[#5EBEE6] focus:outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2 tracking-widest text-[#5EBEE6]">SOP (Statement of Purpose) <span class="text-red-500">*</span></label>
                                <textarea name="note" rows="4" required placeholder="เขียนเรียงความสั้นๆ เกี่ยวกับเหตุผลที่สนใจกิจกรรมนี้..." 
                                          class="w-full px-4 py-3 bg-white border border-gray-200 rounded-md text-sm focus:border-[#5EBEE6] focus:outline-none transition-all"></textarea>
                            </div>

                            <div class="pt-4">
                                @if(!Auth::check())
                                    <a href="{{ route('login') }}" class="w-full block bg-slate-800 text-white py-4 rounded-md font-bold text-sm text-center uppercase tracking-widest">Please Login to Register</a>
                                @elseif($activity->current_participants < $activity->max_participants)
                                    <button type="submit" class="w-full bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white py-4 rounded-md font-bold text-sm transition-all tracking-[0.2em] uppercase shadow-sm">Confirm Registration</button>
                                @else
                                    <div class="w-full bg-gray-100 text-gray-400 py-4 rounded-md font-bold text-sm text-center cursor-not-allowed uppercase">Registration Closed (Full)</div>
                                @endif
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection