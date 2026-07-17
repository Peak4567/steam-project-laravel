<div class="w-full px-4 py-3 sticky top-0 z-50">
    <nav class="max-w-6xl w-full mx-auto font-mitr bg-white rounded-full shadow-[0_8px_30px_rgba(0,0,0,0.08)] border border-gray-100 relative z-30 transition-all">
        <div class="py-1.5 px-6 lg:px-8 flex items-center justify-between min-h-[56px]">

            <div class="flex items-center shrink-0">
                <img src="{{ asset('assets/img/steam-logo.png') }}" alt="STEAM" class="h-8 md:h-10 w-auto object-contain">
            </div>

            <div class="hidden lg:flex items-center justify-center flex-1 gap-6 lg:gap-8">
                <a href="{{ route('home') }}"
                    class="text-slate-600 text-sm hover:text-[#5EBEE6] hover:-translate-y-0.5 transition-all font-medium tracking-wide">
                    หน้าหลัก
                </a>
                <a href="{{ route('projects') }}"
                    class="text-slate-600 text-sm hover:text-[#5EBEE6] hover:-translate-y-0.5 transition-all font-medium tracking-wide">
                    โครงงาน
                </a>
                <a href="{{ route('activity') }}"
                    class="text-slate-600 text-sm hover:text-[#5EBEE6] hover:-translate-y-0.5 transition-all font-medium tracking-wide">
                    กิจกรรม
                </a>
                <a href="{{ route('sheets') }}"
                    class="text-slate-600 text-sm hover:text-[#5EBEE6] hover:-translate-y-0.5 transition-all font-medium tracking-wide">
                    ชีทสรุป
                </a>
                <a href="{{ route('portfolio') }}"
                    class="text-slate-600 text-sm hover:text-[#5EBEE6] hover:-translate-y-0.5 transition-all font-medium tracking-wide">
                    แฟ้มผลงาน
                </a>
            </div>

            <div class="flex items-center gap-4 lg:gap-6 shrink-0">
                @auth
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">

                        <button @click="open = !open" class="flex items-center gap-2.5 focus:outline-none group">
                            <div class="flex flex-col items-end hidden md:flex">
                                <span class="text-gray-400 text-[9px] font-normal uppercase tracking-wider">สวัสดี</span>
                                <span class="text-slate-700 text-sm font-bold tracking-tight group-hover:text-[#5EBEE6] transition-colors">{{ Auth::user()->name }}</span>
                            </div>

                            <div class="w-9 h-9 rounded-full border-2 border-gray-100 overflow-hidden group-hover:border-[#5EBEE6] transition-all shadow-sm">
                                @if (Auth::user()->profile)
                                    <img src="{{ asset('assets/img/profile/' . Auth::user()->profile) }}"
                                        class="w-full h-full object-cover" alt="Profile Photo">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->first_name ?? 'User') }}&color=7F9CF5&background=EBF4FF"
                                        class="w-full h-full object-cover" alt="Default Profile Photo">
                                @endif
                            </div>

                            <i class="fa-solid fa-chevron-down text-gray-400 text-[10px] transition-transform duration-300 group-hover:text-[#5EBEE6]"
                                :class="open ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute right-0 mt-3 w-56 bg-white rounded-2xl border border-gray-100 shadow-xl z-50 overflow-hidden font-mitr"
                            style="display: none;">

                            <div class="px-5 py-4 bg-gray-50/50 border-b border-gray-50">
                                <p class="text-[11px] text-gray-400 font-normal">ล็อกอินในชื่อ</p>
                                <p class="text-sm font-medium text-slate-800 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="p-2">
                                <a href="{{ route('profile') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-blue-50 hover:text-[#5EBEE6] rounded-xl transition-colors group">
                                    <i class="fa-regular fa-circle-user text-gray-400 group-hover:text-[#5EBEE6]"></i>
                                    <span class="font-normal">บัญชีของฉัน</span>
                                </a>

                                @if (Auth::user()->level == 'admin')
                                    <a href="{{ route('backend.home') }}"
                                        class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-orange-50 hover:text-orange-500 rounded-xl transition-colors group">
                                        <i class="fa-solid fa-gauge-high text-gray-400 group-hover:text-orange-500"></i>
                                        <span class="font-normal">จัดการหลังบ้าน</span>
                                    </a>
                                @endif

                                <div class="my-1 border-t border-gray-50"></div>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 rounded-xl transition-colors group">
                                        <i class="fa-solid fa-arrow-right-from-bracket opacity-70"></i>
                                        <span class="font-normal">ออกจากระบบ</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-slate-600 text-sm hover:text-[#5EBEE6] hover:-translate-y-0.5 transition-all font-medium flex items-center gap-1.5">
                        <i class="fa-solid fa-arrow-right-to-bracket text-[11px] opacity-90"></i> เข้าสู่ระบบ
                    </a>
                    <a href="{{ route('register') }}"
                        class="text-slate-600 text-sm hover:text-[#5EBEE6] hover:-translate-y-0.5 transition-all font-medium">
                        สมัครสมาชิก
                    </a>
                @endauth
            </div>

        </div>
    </nav>
</div>