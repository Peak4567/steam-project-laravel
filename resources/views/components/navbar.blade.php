<nav class="w-full font-mitr bg-[#5EBEE6] relative z-30 shadow-none">
    <div class="max-w-screen-xl mx-auto py-3 px-6 md:px-12 flex items-center justify-between">

        <div class="flex items-center">
            <img src="{{ asset('assets/img/steam-logo.png') }}" alt="STEAM" class="h-9 md:h-11 w-auto object-contain">
        </div>

        <div class="hidden lg:flex items-center gap-1.5">
            <a href="{{ route('home') }}"
                class="flex items-center gap-2 px-4 py-2 bg-white/20 text-white rounded-lg hover:bg-white/30 transition-all text-md border border-white/10">
                <i class="fa-solid fa-house"></i> หน้าหลัก
            </a>
            <a href="{{ route('projects') }}"
                class="flex items-center gap-2 px-4 py-2 bg-white/20 text-white rounded-lg hover:bg-white/30 transition-all text-md border border-white/10">
                <i class="fa-solid fa-book"></i> โครงงาน
            </a>
            <a href="{{ route('activity') }}"
                class="flex items-center gap-2 px-4 py-2 bg-white/20 text-white rounded-lg hover:bg-white/30 transition-all text-md border border-white/10">
                <i class="fa-solid fa-user-gear"></i> กิจกรรม
            </a>
            <a href="{{ route('sheets') }}"
                class="flex items-center gap-2 px-4 py-2 bg-white/20 text-white rounded-lg hover:bg-white/30 transition-all text-md border border-white/10">
                <i class="fa-solid fa-file-lines"></i> ชีทสรุป
            </a>
            <a href="{{ route('portfolio') }}"
                class="flex items-center gap-2 px-4 py-2 bg-white/20 text-white rounded-lg hover:bg-white/30 transition-all text-md border border-white/10">
                <i class="fa-solid fa-folder-open"></i> แฟ้มผลงาน
            </a>
        </div>

        <div class="flex items-center gap-6">
            @auth
                <div class="relative" x-data="{ open: false }" @click.away="open = false">

                    <button @click="open = !open" class="flex items-center gap-3 focus:outline-none group">
                        <div class="flex flex-col items-end hidden md:flex">
                            <span
                                class="text-white text-[10px] font-normal opacity-70 uppercase tracking-wider">สวัสดี</span>
                            <span
                                class="text-white text-sm font-medium tracking-tight group-hover:text-blue-100 transition-colors">{{ Auth::user()->name }}</span>
                        </div>

                        <div
                            class="w-10 h-10 rounded-full border-2 border-white/20 overflow-hidden group-hover:border-white/50 transition-all">
                            @if (Auth::user()->profile)
                                <img src="{{ asset('assets/img/profile/' . Auth::user()->profile) }}"
                                    class="w-full h-full object-cover" alt="Profile Photo">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->first_name ?? 'User') }}&color=7F9CF5&background=EBF4FF"
                                    class="w-full h-full object-cover" alt="Default Profile Photo">
                            @endif
                        </div>

                        <i class="fa-solid fa-chevron-down text-white text-[10px] transition-transform duration-300"
                            :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        class="absolute right-0 mt-3 w-56 bg-white rounded-xl border border-gray-100 shadow-xl z-50 overflow-hidden font-mitr"
                        style="display: none;">

                        <div class="px-5 py-4 bg-gray-50/50 border-b border-gray-50">
                            <p class="text-[11px] text-gray-400 font-normal">ล็อกอินในชื่อ</p>
                            <p class="text-sm font-medium text-slate-800 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <div class="p-2">
                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-blue-50 hover:text-[#5EBEE6] rounded-lg transition-colors group">
                                <i class="fa-regular fa-circle-user text-gray-400 group-hover:text-[#5EBEE6]"></i>
                                <span class="font-normal">บัญชีของฉัน</span>
                            </a>

                            @if (Auth::user()->level == 'admin')
                                <a href="/admin"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-orange-50 hover:text-orange-500 rounded-lg transition-colors group">
                                    <i class="fa-solid fa-gauge-high text-gray-400 group-hover:text-orange-500"></i>
                                    <span class="font-normal">จัดการหลังบ้าน</span>
                                </a>
                            @endif

                            <div class="my-1 border-t border-gray-50"></div>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 rounded-lg transition-colors group">
                                    <i class="fa-solid fa-arrow-right-from-bracket opacity-70"></i>
                                    <span class="font-normal">ออกจากระบบ</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="text-white text-sm hover:opacity-80 transition-opacity font-medium">เข้าสู่ระบบ</a>
                <a href="{{ route('register') }}"
                    class="px-7 py-2.5 bg-white/30 text-white text-sm rounded-full border border-white/10 hover:bg-white/40 transition-all font-medium">สมัครสมาชิก</a>
            @endauth
        </div>

    </div>
</nav>
