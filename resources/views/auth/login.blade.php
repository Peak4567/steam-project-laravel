@extends('layout')
@section('content')
    <section class="min-h-screen w-full flex items-center justify-center bg-[#F8F9FA] font-mitr py-12 px-6">
        <div class="w-full max-w-[450px] bg-white rounded-xl border border-gray-100 p-8 md:p-10 shadow-xl shadow-blue-500/5">

            <div class="text-center mb-10">
                <h2 class="text-2xl font-medium text-slate-800 mb-2">เข้าสู่ระบบ</h2>
                <p class="text-sm text-gray-400 font-normal">ยินดีต้อนรับกลับมา! กรุณาเข้าสู่ระบบเพื่อใช้งาน</p>
            </div>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf

                @if ($errors->has('login_error'))
                    <div class="bg-red-50 border border-red-100 text-red-500 px-4 py-3 rounded-xl text-xs font-normal mb-4">
                        {{ $errors->first('login_error') }}
                    </div>
                @endif

                <div class="space-y-2 text-left">
                    <label for="nickname" class="text-sm font-medium text-slate-700 ml-1">ชื่อเล่นผู้ใช้งาน</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}" required
                            class="w-full bg-gray-50 border border-gray-100 text-sm rounded-xl py-3.5 pl-12 pr-4 outline-none focus:ring-1 focus:ring-[#5EBEE6] focus:bg-white transition-all text-slate-600 font-normal" 
                            placeholder="กรอกชื่อเล่นของคุณ">
                    </div>
                    @error('nickname')
                        <span class="text-red-500 text-[10px] ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2 text-left">
                    <div class="flex justify-between items-center px-1">
                        <label for="password" class="text-sm font-medium text-slate-700">รหัสผ่าน</label>
                        <a href="#" class="text-[12px] text-[#5EBEE6] hover:underline font-normal">ลืมรหัสผ่าน?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="w-full bg-gray-50 border border-gray-100 text-sm rounded-xl py-3.5 pl-12 pr-4 outline-none focus:ring-1 focus:ring-[#5EBEE6] focus:bg-white transition-all text-slate-600 font-normal" placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center gap-2 px-1">
                    <input type="checkbox" id="remember" name="remember"
                        class="w-4 h-4 rounded border-gray-200 text-[#5EBEE6] focus:ring-[#5EBEE6]">
                    <label for="remember" class="text-xs text-gray-400 font-normal select-none">จดจำฉันไว้ในระบบ</label>
                </div>

                <button type="submit"
                    class="w-full bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white py-3.5 rounded-xl font-medium text-sm transition-all active:scale-[0.98] shadow-none mt-4">
                    เข้าสู่ระบบ
                </button>
            </form>

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-100"></div>
                </div>
                <div class="relative flex justify-center text-[10px] uppercase">
                    <span class="bg-white px-4 text-gray-300 font-medium tracking-widest">หรือเข้าสู่ระบบด้วย</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-8">
                <button class="flex items-center justify-center gap-2 py-2.5 border border-gray-100 rounded-xl hover:bg-gray-50 transition-all">
                    <img src="https://www.google.com/favicon.ico" class="w-4 h-4">
                    <span class="text-xs text-slate-600 font-medium">Google</span>
                </button>
                <button class="flex items-center justify-center gap-2 py-2.5 border border-gray-100 rounded-xl hover:bg-gray-50 transition-all">
                    <i class="fa-brands fa-facebook text-blue-600"></i>
                    <span class="text-xs text-slate-600 font-medium">Facebook</span>
                </button>
            </div>

            <div class="text-center">
                <p class="text-[13px] text-gray-400 font-normal">
                    ยังไม่มีบัญชีผู้ใช้งาน?
                    <a href="{{ route('register') }}"
                        class="text-[#5EBEE6] font-medium hover:underline ml-1">สมัครสมาชิกที่นี่</a>
                </p>
            </div>

        </div>
    </section>
@endsection