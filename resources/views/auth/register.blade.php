@extends('layout')
@section('content')
    <section class="min-h-screen w-full flex items-center justify-center bg-[#F8F9FA] font-mitr py-12 px-6">

        <div class="w-full max-w-[500px] bg-white rounded-xl border border-gray-100 p-8 md:p-10 shadow-xl shadow-blue-500/5">

            <div class="text-center mb-10">
                <h2 class="text-2xl font-medium text-slate-800 mb-2">สร้างบัญชีผู้ใช้งาน</h2>
                <p class="text-sm text-gray-400 font-normal">มาร่วมเป็นส่วนหนึ่งของครอบครัว STEAM PROJECT กันครับ</p>
            </div>

            <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 text-red-500 px-4 py-3 rounded-xl text-xs font-normal mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="space-y-2 text-left">
                    <label for="nickname" class="text-sm font-medium text-slate-700 ml-1">ชื่อเล่น</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <input type="text" id="nickname" name="nickname" value="{{ old('name') }}" required
                            class="w-full bg-gray-50 border border-gray-100 text-sm rounded-xl py-3.5 pl-12 pr-4 outline-none focus:ring-1 focus:ring-[#5EBEE6] focus:bg-white transition-all text-slate-600 font-normal @error('name') border-red-300 @enderror"
                            placeholder="นายเด็กดี มีสตีม">
                    </div>
                </div>

                <div class="space-y-2 text-left">
                    <label for="email" class="text-sm font-medium text-slate-700 ml-1">อีเมลผู้ใช้งาน</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full bg-gray-50 border border-gray-100 text-sm rounded-xl py-3.5 pl-12 pr-4 outline-none focus:ring-1 focus:ring-[#5EBEE6] focus:bg-white transition-all text-slate-600 font-normal @error('email') border-red-300 @enderror"
                            placeholder="example@email.com">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2 text-left">
                        <label for="password" class="text-sm font-medium text-slate-700 ml-1">รหัสผ่าน</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input type="password" id="password" name="password" required
                                class="w-full bg-gray-50 border border-gray-100 text-sm rounded-xl py-3.5 pl-12 pr-4 outline-none focus:ring-1 focus:ring-[#5EBEE6] focus:bg-white transition-all text-slate-600 font-normal"
                                placeholder="••••••••">
                        </div>
                    </div>
                    <div class="space-y-2 text-left">
                        <label for="password_confirmation"
                            class="text-sm font-medium text-slate-700 ml-1">ยืนยันรหัสผ่านอีกครั้ง</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-shield-check"></i>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full bg-gray-50 border border-gray-100 text-sm rounded-xl py-3.5 pl-12 pr-4 outline-none focus:ring-1 focus:ring-[#5EBEE6] focus:bg-white transition-all text-slate-600 font-normal"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="flex items-start gap-2 px-1 pt-2">
                    <input type="checkbox" id="terms" name="terms" required
                        class="mt-1 w-4 h-4 rounded border-gray-200 text-[#5EBEE6] focus:ring-[#5EBEE6]">
                    <label for="terms" class="text-[11px] text-gray-400 font-normal leading-relaxed select-none">
                        ฉันยอมรับ <a href="#" class="text-[#5EBEE6] hover:underline">เงื่อนไขการใช้งาน</a> และ <a
                            href="#" class="text-[#5EBEE6] hover:underline">นโยบายความเป็นส่วนตัว</a> ของ STEAM
                        PROJECT
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white py-3.5 rounded-xl font-medium text-sm transition-all active:scale-[0.98] shadow-none mt-4">
                    ยืนยันการสมัครสมาชิก
                </button>
            </form>

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-100"></div>
                </div>
                <div class="relative flex justify-center text-[10px] uppercase">
                    <span class="bg-white px-4 text-gray-300 font-medium tracking-widest">หรือเชื่อมต่อด้วย</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-8">
                <button
                    class="flex items-center justify-center gap-2 py-2.5 border border-gray-100 rounded-xl hover:bg-gray-50 transition-all">
                    <img src="https://www.google.com/favicon.ico" class="w-4 h-4">
                    <span class="text-xs text-slate-600 font-medium">Google</span>
                </button>
                <button
                    class="flex items-center justify-center gap-2 py-2.5 border border-gray-100 rounded-xl hover:bg-gray-50 transition-all">
                    <i class="fa-brands fa-facebook text-blue-600"></i>
                    <span class="text-xs text-slate-600 font-medium">Facebook</span>
                </button>
            </div>

            <div class="text-center">
                <p class="text-[13px] text-gray-400 font-normal">
                    มีบัญชีผู้ใช้งานอยู่แล้ว?
                    <a href="{{ route('login') }}"
                        class="text-[#5EBEE6] font-medium hover:underline ml-1">เข้าสู่ระบบที่นี่</a>
                </p>
            </div>

        </div>
    </section>
@endsection
